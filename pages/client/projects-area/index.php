<?php
    require_once __DIR__ . '/../../../includes/auth.php';
    require_once __DIR__ . '/../../../includes/projetos.php';
    exigir_login();

    $erroSolic    = pegar_erro('solicitacao');
    $sucessoSolic = pegar_sucesso('solicitacao');
    $antigo       = pegar_antigo();
    $tipos        = tipos_de_site();
    $solicitacoes = solicitacoes_abertas(conectar(), (int)$_SESSION['usuario_id']);
    $projetos     = projetos_do_cliente(conectar(), (int)$_SESSION['usuario_id']);
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
        ?>

                <section class="projects">
            <div class="title-projects">
                <h2>Projetos</h2>
                <button type="button" id="abrir-solicitacao">Solicitar novo projeto</button>
            </div>

            <?php if ($sucessoSolic): ?>
                <div class="aviso aviso--sucesso" role="status"><?= e($sucessoSolic) ?></div>
            <?php endif; ?>

            <div class="project-grid">

                <!-- Solicitações enviadas, aguardando contato da equipe -->
                <?php foreach ($solicitacoes as $s): ?>
                    <div class="project-card project-card--solicitacao">
                        <div>
                            <h2><?= e($s['solicitacao_empresa']) ?></h2>
                            <p><?= e(nome_tipo_site($s['solicitacao_tipo'])) ?></p>
                            <p class="retorno">Retorno previsto até <?= e(data_br($s['solicitacao_previsao_contato'])) ?></p>
                            <?php if (!empty($s['ultima_resposta'])): ?>
                                <p class="retorno">Equipe: <?= e(mb_strimwidth($s['ultima_resposta'], 0, 140, '…')) ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="project-status">
                            <p><?= $s['solicitacao_status'] === 'em_contato' ? 'Em contato' : 'Em análise' ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Projetos reais do cliente (tabela projeto) -->
                <?php foreach ($projetos as $p): ?>
                    <div class="project-card">
                        <div>
                            <h3><?= e(nome_tipo_site((string)($p['projeto_tipo'] ?? 'outro'))) ?></h3>
                            <h2><?= e($p['projeto_titulo']) ?></h2>
                            <p><?= e(nome_etapa((int)$p['projeto_etapa'])) ?> · <?= (int)$p['projeto_progresso'] ?>%</p>
                            <?php if ($p['projeto_prazo']): ?><p class="retorno">Prazo: <?= e(data_br($p['projeto_prazo'])) ?></p><?php endif; ?>
                        </div>

                        <div class="project-status">
                            <p><?= $p['projeto_pausado'] ? 'Pausado' : ((int)$p['projeto_etapa'] === ETAPA_PUBLICADO ? 'Publicado' : e('Em ' . mb_strtolower(nome_etapa((int)$p['projeto_etapa'])))) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </section>

        <!-- Modal: solicitar novo projeto -->
        <dialog id="modal-solicitacao" class="modal-solicitacao" aria-labelledby="titulo-solicitacao"
                <?= $erroSolic ? 'data-abrir' : '' ?>>
            <form class="solic-form" action="../../../actions/solicitar-projeto.php" method="post">
                <div class="solic-topo">
                    <h2 id="titulo-solicitacao">Solicitar novo projeto</h2>
                    <button type="button" class="solic-fechar" data-fechar aria-label="Fechar">&times;</button>
                </div>
                <p class="solic-sub">Conte o básico sobre o que você precisa. Nossa equipe entra em contato em até <?= PRAZO_CONTATO_DIAS_UTEIS ?> dias úteis.</p>

                <?php if ($erroSolic): ?>
                    <div class="aviso aviso--erro" role="alert"><?= e($erroSolic) ?></div>
                <?php endif; ?>

                <label for="solic-empresa">Nome da empresa</label>
                <input id="solic-empresa" type="text" name="empresa" maxlength="150" required
                       autocomplete="organization" value="<?= e($antigo['empresa'] ?? '') ?>">

                <label for="solic-tipo">Tipo de site</label>
                <select id="solic-tipo" name="tipo" required>
                    <option value="" disabled <?= empty($antigo['tipo']) ? 'selected' : '' ?>>Selecione uma opção</option>
                    <?php foreach ($tipos as $chave => $rotulo): ?>
                        <option value="<?= e($chave) ?>" <?= ($antigo['tipo'] ?? '') === $chave ? 'selected' : '' ?>><?= e($rotulo) ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="solic-descricao">Breve descrição</label>
                <textarea id="solic-descricao" name="descricao" rows="5" minlength="10" maxlength="1000" required
                          placeholder="O que você precisa, referências, prazo desejado..."><?= e($antigo['descricao'] ?? '') ?></textarea>

                <div class="solic-acoes">
                    <button type="button" class="btn-secundario" data-fechar>Cancelar</button>
                    <button type="submit" class="btn-primario">Enviar solicitação</button>
                </div>
            </form>
        </dialog>

        <script src="index.js" defer></script>
    </body>
</html>