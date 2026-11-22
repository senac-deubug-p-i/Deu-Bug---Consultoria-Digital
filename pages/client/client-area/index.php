<?php
    require_once __DIR__ . '/../../../includes/functions.php';
    require_once __DIR__ . '/../../../includes/auth.php';
    require_once __DIR__ . '/../../../actions/user-infos.php';
    require_once __DIR__ . '/../../../includes/projetos.php';
    exigir_login();
    $usuario  = usuario_atual();
    $pdo      = conectar();
    $resumo   = resumo_do_cliente($pdo, (int)$_SESSION['usuario_id']);
    $projetos = projetos_do_cliente($pdo, (int)$_SESSION['usuario_id']);
    $atividade = atividade_do_cliente($pdo, (int)$_SESSION['usuario_id']);
    $avisoPend = pegar_sucesso('pendencias');
    $erroPend  = pegar_erro('pendencias');
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

        <title>Deu Bug! - Consultoria Digital</title>
    </head>
    <body>
        <!-- Inserção do Header -->
        <?php
            require __DIR__ . '/../../../includes/client-header.php';

            $primeiroNome = primeiro_nome($usuario['usuario_nome'] ?? 'Cliente');
            $ativos       = array_values(array_filter($projetos, fn($p) => (int)$p['projeto_etapa'] < ETAPA_PUBLICADO));
            $temProjetos  = !empty($projetos);
            $pendencias   = $resumo['pendencias'];
            $qtdPend      = count($pendencias);
            $proxima      = $resumo['proxima'];
            $empresa      = $projetos[0]['projeto_empresa'] ?? null;
        ?>

        <section class="hero-header">
            <div class="hero-title">
                <h3><?= $empresa ? e($empresa) . ' - ' : '' ?><?= e(data_hoje()) ?></h3>
                <h2>Olá, <?= e($primeiroNome) ?>!</h2>
                <?php if (!$temProjetos): ?>
                    <p>Você ainda não tem nenhum projeto por aqui. Vamos começar o primeiro?</p>
                <?php elseif ($qtdPend > 0): ?>
                    <p>Seus projetos estão andando. Tem <?= $qtdPend ?> <?= $qtdPend === 1 ? 'coisa esperando' : 'coisas esperando' ?> por você.</p>
                <?php else: ?>
                    <p>Seus projetos estão andando bem. Não há nada pendente com você agora.</p>
                <?php endif; ?>
            </div>

            <div class="hero-contact">
                <?php if (!$temProjetos): ?>
                    <button onclick="location.href='../projects-area/index.php'">Solicitar meu projeto</button>
                <?php else: ?>
                    <button onclick="location.href='../support-area/index.php'">
                        <img src="../../../assets/images/chat-message-icon.svg" alt="">
                        Falar com a equipe
                    </button>
                    <button style="background-color: transparent;" onclick="location.href='../projects-area/index.php'">Solicitar novo projeto</button>
                <?php endif; ?>
            </div>
        </section>

        <section class="data-boxes">
            <div class="<?= $resumo['ativos'] ? '' : 'is-empty' ?>">
                <div>
                    <h3>Projetos Ativos</h3>
                    <h2><?= (int)$resumo['ativos'] ?></h2>
                </div>
                <p><?= $resumo['ativos'] ? e(implode(' · ', array_map(fn($p) => $p['projeto_titulo'], array_slice($ativos, 0, 2)))) : 'Nenhum projeto vinculado à sua conta' ?></p>
            </div>

            <div class="<?= $proxima ? '' : 'is-empty' ?>">
                <div>
                    <h3>Previsão da próxima entrega</h3>
                    <h2><?= $proxima ? e(dia_mes($proxima['projeto_prazo'])) : '—' ?></h2>
                </div>
                <p><?= $proxima ? e($proxima['projeto_titulo']) : 'Sem entregas previstas' ?></p>
            </div>

            <div class="<?= $resumo['solicitacoes'] ? '' : 'is-empty' ?>">
                <div>
                    <h3>Solicitações em andamento</h3>
                    <h2><?= (int)$resumo['solicitacoes'] ?></h2>
                </div>
                <p><?= $resumo['solicitacoes'] ? 'Aguardando retorno da equipe' : 'Nenhuma solicitação aberta' ?></p>
            </div>

            <div <?= $qtdPend ? 'style="background-color: #7B4BB3; border-color: #FFF;"' : 'class="is-empty"' ?>>
                <div>
                    <h3>Precisa da sua atenção</h3>
                    <h2><?= $qtdPend ?></h2>
                </div>
                <p><?= $qtdPend ? e(implode(' - ', array_map(fn($a) => $a['aprovacao_titulo'], array_slice($pendencias, 0, 2)))) : 'Nada pendente, está tudo em dia' ?></p>
            </div>
        </section>

        <section class="info-boxes">
            <div class="activity">
                <h2>Atividade recente</h2>

                <?php if ($atividade): ?>
                <div class="infosscreen">
                    <?php foreach ($atividade as $a): ?>
                    <div class="info-activity">
                        <div class="status-activity"></div>
                        <div>
                            <h3><?= e($a['atualizacao_titulo']) ?></h3>
                            <p><?= e(quando($a['atualizacao_criacao'])) ?> - <?= e($a['autor'] ? primeiro_nome($a['autor']) : 'Equipe') ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="empty-state">
                    <h3>Nenhuma atividade ainda</h3>
                    <p>Quando o seu projeto começar, as atualizações da equipe aparecem aqui.</p>
                </div>
                <?php endif; ?>
            </div>

            <div class="requests">
                <h2>Pendências</h2>

                <?php if ($avisoPend): ?><div class="aviso-pendencias" role="status"><?= e($avisoPend) ?></div><?php endif; ?>
                <?php if ($erroPend): ?><div class="aviso-pendencias" role="alert" style="background-color:#33131B;color:#F0777C"><?= e($erroPend) ?></div><?php endif; ?>

                <?php if ($pendencias): ?>
                <div class="pendencys">
                    <?php foreach ($pendencias as $a): ?>
                    <div class="pendency-box">
                        <div>
                            <h3><?= e($a['aprovacao_titulo']) ?></h3>
                            <p><?= e($a['projeto_empresa']) ?><?= $a['aprovacao_prazo'] ? ' - ' . e(dia_mes($a['aprovacao_prazo'])) : '' ?></p>
                        </div>
                        <form action="../../../actions/aprovar.php" method="post">
                            <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                            <input type="hidden" name="aprovacao_id" value="<?= (int)$a['aprovacao_id'] ?>">
                            <button type="submit">Aprovar</button>
                        </form>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="empty-state">
                    <h3>Nada para aprovar</h3>
                    <p>Layouts e materiais que precisarem do seu OK serão listados aqui.</p>
                </div>
                <?php endif; ?>
            </div>
        </section>
    </body>
</html>
