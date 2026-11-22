<?php
    require_once __DIR__ . '/../../../includes/auth.php';
    require_once __DIR__ . '/../../../includes/functions.php';
    require_once __DIR__ . '/../../../includes/projetos.php';
    require_once __DIR__ . '/../../../config/database.php';
    exigir_login();

    // O id vem da URL ($_GET), mas o projeto só abre se for DESTE cliente (checado no SQL)
    $pdo       = conectar();
    $projetoId = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
    $projeto   = $projetoId ? projeto_do_cliente($pdo, (int)$_SESSION['usuario_id'], $projetoId) : null;
    if (!$projeto) {
        redirecionar('pages/client/projects-area/index.php');
    }

    $etapa       = (int)$projeto['projeto_etapa'];
    $progresso   = max(0, min(100, (int)$projeto['projeto_progresso']));
    [$statusTxt, $statusCls] = rotulo_status_projeto($projeto);
    $paraAprovar = aprovacoes_do_projeto($pdo, (int)$projeto['projeto_id'], 'pendente');
    $aprovadas   = aprovacoes_do_projeto($pdo, (int)$projeto['projeto_id'], 'aprovada');
    $historico   = atualizacoes_visiveis_do_projeto($pdo, (int)$projeto['projeto_id']);
    $tarefas     = tarefas_do_projeto($pdo, (int)$projeto['projeto_id']);
    $equipe      = equipe_do_projeto($pdo, $projeto);
    $avisoOk     = pegar_sucesso('pendencias');
    $avisoErro   = pegar_erro('pendencias');
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="index.css">
        <link rel="shortcut icon" href="../../../assets/images/DeuBug_favIcon.ico" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jersey+10&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Tiny5&display=swap"
            rel="stylesheet">

        <title><?= e($projeto['projeto_titulo']) ?> - Deu Bug!</title>
    </head>
    <body>
        <!-- Inserção do Header -->
        <?php
            require __DIR__ . '/../../../includes/client-header.php';
        ?>

        <section class="hero-header">
            <div class="hero-title">
                <h3><?= e($projeto['projeto_tipo'] ? nome_tipo_site($projeto['projeto_tipo']) : 'Projeto') ?></h3>
                <h2><?= e($projeto['projeto_titulo']) ?></h2>
                <div class="project-status <?= $statusCls ?>">
                    <div></div>
                    <p><?= e($statusTxt) ?></p>
                </div>
            </div>

            <div class="hero-contact">
                <button onclick="location.href='../support-area/index.php'">Falar sobre este projeto</button>
            </div>
        </section>

        <section class="progress-status">
            <div class="data-progress">
                <div class="progress-percent">
                    <div>
                        <h3>Progresso geral</h3>
                        <h2><?= $progresso ?>%</h2>
                    </div>
                    <div class="progress-bar" role="progressbar" aria-valuenow="<?= $progresso ?>" aria-valuemin="0" aria-valuemax="100">
                        <div style="width: <?= $progresso ?>%"></div>
                    </div>
                </div>

                <div class="data-info">
                    <p>Início</p>
                    <h3><?= e(data_br($projeto['projeto_inicio'])) ?></h3>
                </div>

                <div class="data-info">
                    <p>Prazo Estimado</p>
                    <h3><?= $projeto['projeto_prazo'] ? e(data_br($projeto['projeto_prazo'])) : 'A definir' ?></h3>
                </div>

                <div class="data-info">
                    <p>Responsável</p>
                    <h3><?= e($projeto['responsavel'] ?? 'A definir') ?></h3>
                </div>
            </div>

            <div class="data-status">
                <div class="progress-stage">
                    <div style="width: <?= (int)round($etapa / (count(ETAPAS) - 1) * 100) ?>%"></div>
                </div>
                <?php foreach (ETAPAS as $i => $nome): ?>
                    <?php $estado = $i < $etapa || $etapa === ETAPA_PUBLICADO ? 'done' : ($i === $etapa ? 'current' : 'todo'); ?>
                    <div class="data-stage <?= $estado ?>">
                        <div></div>
                        <h3><?= e($i === ETAPA_PUBLICADO ? 'Publicação' : $nome) ?></h3>
                        <p><?= $estado === 'done' ? 'Concluída' : ($estado === 'current' ? 'Em andamento' : 'A seguir') ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="stage-previews">
            <section class="left-stages">

                <div class="to-approve">
                    <h2>Para aprovar</h2>

                    <?php if ($avisoOk): ?><div class="aviso-ok" role="status"><?= e($avisoOk) ?></div><?php endif; ?>
                    <?php if ($avisoErro): ?><div class="aviso-ok aviso-erro" role="alert"><?= e($avisoErro) ?></div><?php endif; ?>

                    <?php if ($paraAprovar): ?>
                        <?php foreach ($paraAprovar as $a): ?>
                            <div class="approve-item">
                                <div class="approve-text">
                                    <h3><?= e($a['aprovacao_titulo']) ?></h3>
                                    <?php if ($a['aprovacao_descricao']): ?><p><?= e($a['aprovacao_descricao']) ?></p><?php endif; ?>
                                    <small>Enviado pela equipe <?= e(mb_strtolower(quando($a['aprovacao_criacao']))) ?><?= $a['aprovacao_prazo'] ? ' · responder até ' . e(dia_mes($a['aprovacao_prazo'])) : '' ?></small>
                                </div>
                                <form action="../../../actions/aprovar.php" method="post">
                                    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                                    <input type="hidden" name="aprovacao_id" value="<?= (int)$a['aprovacao_id'] ?>">
                                    <input type="hidden" name="voltar_projeto" value="<?= (int)$projeto['projeto_id'] ?>">
                                    <button type="submit">Aprovar</button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="empty-note">Nada aguardando a sua aprovação agora. Quando a equipe enviar algo para você revisar, aparece aqui.</p>
                    <?php endif; ?>
                </div>

                <div class="project-team">
                    <h2>Equipe do Projeto</h2>

                    <?php foreach ($equipe as $m): ?>
                        <div class="project-partner">
                            <div>
                                <span class="partner-avatar"><?= e(iniciais($m['usuario_nome'])) ?></span>
                                <div>
                                    <h3><?= e($m['usuario_nome']) ?></h3>
                                    <p><?= e((int)$m['usuario_id'] === (int)$projeto['responsavel_id'] ? 'Responsável pelo projeto' : ($m['usuario_cargo'] ?: 'Equipe')) ?></p>
                                </div>
                            </div>
                            <button onclick="location.href='../support-area/index.php'">Mensagem</button>
                        </div>
                    <?php endforeach; ?>
                    <?php if (!$equipe): ?><p class="empty-note">A equipe será definida em breve.</p><?php endif; ?>
                </div>

                <div class="update-history">
                    <h2>Histórico de Atualizações</h2>

                    <div class="cards-grid">
                        <?php foreach ($historico as $h): ?>
                            <div class="update-card">
                                <div class="status-history"></div>
                                <div>
                                    <h3><?= e($h['atualizacao_titulo']) ?></h3>
                                    <p><?= e(quando($h['atualizacao_criacao'])) ?> - <?= e($h['autor'] ? primeiro_nome($h['autor']) : 'Equipe') ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php if (!$historico): ?><p class="empty-note">Ainda não há atualizações neste projeto.</p><?php endif; ?>
                    </div>
                </div>
            </section>

            <section class="right-stages">
                <div class="approved-deliveries">
                    <h2>Entregas Aprovadas</h2>

                    <div class="deliveries-grid">
                        <?php foreach ($aprovadas as $a): ?>
                            <div class="deliveries-card">
                                <div>
                                    <h3><?= e($a['aprovacao_titulo']) ?></h3>
                                    <p>Aprovado em <?= e(dia_mes($a['aprovacao_resposta_em'])) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php if (!$aprovadas): ?><p class="empty-note">Suas aprovações aparecem aqui.</p><?php endif; ?>
                    </div>
                </div>

                <div class="development-stage">
                    <div class="development-title">
                        <h2>Tarefas do projeto</h2>
                        <?php $feitas = count(array_filter($tarefas, fn($x) => $x['tarefa_concluida'])); ?>
                        <div class="development-status <?= $statusCls ?>">
                            <div></div>
                            <p><?= $feitas ?> de <?= count($tarefas) ?> feitas</p>
                        </div>
                    </div>

                    <div class="development-grid">
                        <?php foreach ($tarefas as $x): ?>
                            <div class="development-processes">
                                <div>
                                    <div class="development-status-ball<?= $x['tarefa_concluida'] ? '' : ' is-todo' ?>"></div>
                                    <h2><?= e($x['tarefa_titulo']) ?></h2>
                                </div>
                                <h3><?= $x['tarefa_concluida'] ? 'Feito' : 'Em andamento' ?></h3>
                            </div>
                        <?php endforeach; ?>
                        <?php if (!$tarefas): ?><p class="empty-note">As tarefas aparecem aqui quando a equipe iniciar o trabalho.</p><?php endif; ?>
                    </div>
                </div>

                <?php for ($i = ETAPA_PUBLICADO; $i >= 0; $i--): ?>
                    <?php $estado = $i < $etapa || $etapa === ETAPA_PUBLICADO ? 'done' : ($i === $etapa ? 'current' : 'todo'); ?>
                    <div class="design-stage stage-<?= $estado ?>">
                        <div class="design-title">
                            <h2><?= $i + 1 ?>. <?= e($i === ETAPA_PUBLICADO ? 'Publicação' : ETAPAS[$i]) ?></h2>
                            <div class="design-status">
                                <div></div>
                                <p><?= $estado === 'done' ? 'Concluída' : ($estado === 'current' ? 'Em andamento' : 'A seguir') ?></p>
                            </div>
                        </div>

                        <p><?= e(ETAPA_DESCRICAO[$i]) ?></p>
                    </div>
                <?php endfor; ?>
            </section>
        </section>
    </body>
</html>
