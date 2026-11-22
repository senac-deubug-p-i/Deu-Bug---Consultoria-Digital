<?php
    require_once __DIR__ . '/functions.php';
    require_once __DIR__ . '/auth.php';
    require_once __DIR__ . '/../actions/user-infos.php';
    require_once __DIR__ . '/projetos.php';
    exigir_login();
    $usuario = usuario_atual();
    // Sininho: logs de atualização dos projetos + aprovações pendentes
    $notif = notificacoes_do_cliente(conectar(), (int)$_SESSION['usuario_id']);

    // Item do menu que fica "active" = pasta da página atual
    $paginaAtual = basename(dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    $secaoDe = [
        'client-area'          => 'visao-geral',
        'projects-area'        => 'projetos',
        'project-visualization' => 'projetos',     // detalhe do projeto também marca "Meus Projetos"
        'support-area'         => 'suporte',
    ];
    $secaoAtiva = $secaoDe[$paginaAtual] ?? '';
    $ativo = fn(string $s) => $s === $secaoAtiva ? ' class="active" aria-current="page"' : '';
?>

<header>
        <div class="logoheader">
            <img src="../../../assets/images/WhiteLogo_DeuBug.svg" alt="DeuBug-Logo">
            <h2>Deu Bug!</h2>
        </div>

        <nav>
            <a href="../client-area/index.php"<?= $ativo('visao-geral') ?>>Visão Geral</a>
            <a href="../projects-area/index.php"<?= $ativo('projetos') ?>>Meus Projetos</a>
            <a href="../support-area/index.php"<?= $ativo('suporte') ?>>Suporte</a>
        </nav>

        <div class="user-group">
            <section class="notification-group" id="notificacoes" data-csrf="<?= e(csrf_token()) ?>" data-badge-fixo="<?= count($notif['pendencias']) ?>">
                <div class="bell-group" id="sino" role="button" tabindex="0" aria-haspopup="true" aria-expanded="false" aria-label="Notificações">
                    <?php if ($notif['badge'] > 0): ?><h2 id="sino-contador"><?= (int)$notif['badge'] ?></h2><?php endif; ?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                        <path
                            d="M320 64C306.7 64 296 74.7 296 88L296 97.7C214.6 109.3 152 179.4 152 264L152 278.5C152 316.2 142 353.2 123 385.8L101.1 423.2C97.8 429 96 435.5 96 442.2C96 463.1 112.9 480 133.8 480L506.2 480C527.1 480 544 463.1 544 442.2C544 435.5 542.2 428.9 538.9 423.2L517 385.7C498 353.1 488 316.1 488 278.4L488 263.9C488 179.3 425.4 109.2 344 97.6L344 87.9C344 74.6 333.3 63.9 320 63.9zM488.4 432L151.5 432L164.4 409.9C187.7 370 200 324.6 200 278.5L200 264C200 197.7 253.7 144 320 144C386.3 144 440 197.7 440 264L440 278.5C440 324.7 452.3 370 475.5 409.9L488.4 432zM252.1 528C262 556 288.7 576 320 576C351.3 576 378 556 387.9 528L252.1 528z" />
                    </svg>
                </div>

                <div class="notifications-screen" id="painel-notificacoes" role="dialog" aria-label="Notificações" hidden>
                    <div class="notif-topo">Notificações</div>

                    <div class="notif-lista">
                        <?php foreach ($notif['pendencias'] as $p): ?>
                            <a class="notif-item notif-pendente" href="../project-visualization/index.php?id=<?= (int)$p['projeto_id'] ?>">
                                <span class="notif-ponto"></span>
                                <span>
                                    <strong>Aprovação pendente: <?= e($p['aprovacao_titulo']) ?></strong>
                                    <small><?= e($p['projeto_titulo']) ?><?= $p['aprovacao_prazo'] ? ' · até ' . e(dia_mes($p['aprovacao_prazo'])) : '' ?></small>
                                </span>
                            </a>
                        <?php endforeach; ?>

                        <?php foreach ($notif['itens'] as $n): ?>
                            <a class="notif-item<?= $n['nova'] ? ' notif-nova' : '' ?>" href="../project-visualization/index.php?id=<?= (int)$n['projeto_id'] ?>">
                                <span class="notif-ponto"></span>
                                <span>
                                    <strong><?= e($n['atualizacao_titulo']) ?></strong>
                                    <small><?= e(quando($n['atualizacao_criacao'])) ?> · <?= e($n['projeto_titulo']) ?></small>
                                </span>
                            </a>
                        <?php endforeach; ?>

                        <?php if (!$notif['itens'] && !$notif['pendencias']): ?>
                            <p class="notif-vazio">Nenhuma novidade por enquanto. As atualizações dos seus projetos aparecem aqui.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <section class="user-section">
                <h2><?= e(iniciais($usuario['usuario_nome'])) ?></h2>
                <div>
                    <h3><?= e($usuario['usuario_nome']) ?></h3>
                    <p><?= e($usuario['usuario_empresa'] ?: 'Cliente') ?></p>
                </div>
            </section>

            <form action="../../../actions/logout.php" method="post">
                <button type="submit">Sair</button>
            </form>
        </div>
    </header>

<style>
    /* Item ativo do menu (mesmo visual do :focus que já existia) */
    header nav a.active {
        background-color: #7B4BB3;
        border-radius: 10px;
        color: #fff;
    }

    /* Sino: o painel abre/fecha com a classe .open no .notification-group (mesma ideia do modal de login) */
    .bell-group { cursor: pointer; }

    .notification-group .notifications-screen {
        display: flex;
        flex-direction: column;
        width: 380px;
        height: auto;
        max-height: 480px;
        top: 68px;
        right: 0;
        z-index: 50;
        overflow: hidden;
        background-color: #120D1B;
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.55);
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transform: translateY(-6px);
        transition: opacity 0.25s, transform 0.25s, visibility 0.25s;
    }

    .notification-group .notifications-screen[hidden] { display: flex; }   /* o atributo hidden só serve de fallback sem CSS */

    .notification-group.open .notifications-screen {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
        transform: translateY(0);
    }

    .notif-topo {
        padding: 16px 20px;
        font: 800 18px "Nunito";
        color: #fff;
        border-bottom: 1px solid #3a2a57;
    }

    .notif-lista {
        display: flex;
        flex-direction: column;
        overflow-y: auto;
    }

    .notif-lista::-webkit-scrollbar { width: 6px; }
    .notif-lista::-webkit-scrollbar-thumb { background-color: #7B4BB3; border-radius: 20px; }

    .notif-item {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        padding: 14px 20px;
        border-bottom: 1px solid #1f1630;
        transition: background-color 0.2s;
    }

    .notif-item:hover { background-color: #1c1328; }
    .notif-item strong { display: block; font: 700 15px "Nunito"; color: #fff; }
    .notif-item small  { display: block; margin-top: 3px; font: 300 13px "Nunito"; color: #CFA6FF; }
    .notif-ponto { flex: none; width: 10px; height: 10px; margin-top: 6px; border-radius: 100%; background-color: #3a2a57; }
    .notif-nova .notif-ponto { background-color: #7B4BB3; }
    .notif-pendente .notif-ponto { background-color: #FACC15; }

    .notif-vazio { padding: 28px 22px; text-align: center; font: 400 15px "Nunito"; color: #917AAB; }
</style>

<script>
    // Sino de notificações: clicar abre/fecha; clicar fora ou Esc fecha. Ao abrir, marca os logs como vistos.
    (function () {
        const grupo = document.getElementById('notificacoes');
        if (!grupo) return;
        const sino = document.getElementById('sino');
        let marcou = false;

        function abrir(aberto) {
            grupo.classList.toggle('open', aberto);
            sino.setAttribute('aria-expanded', aberto ? 'true' : 'false');
            if (aberto && !marcou) {
                marcou = true;
                fetch('../../../actions/notificacoes-lidas.php', {
                    method: 'POST', credentials: 'same-origin', headers: { 'X-CSRF-Token': grupo.dataset.csrf },
                }).then(() => {
                    // sobra no contador só o que ainda depende do cliente (aprovações pendentes)
                    const fixo = +grupo.dataset.badgeFixo || 0;
                    const contador = document.getElementById('sino-contador');
                    if (contador) { if (fixo) contador.textContent = fixo; else contador.remove(); }
                }).catch(() => {});
            }
        }

        sino.addEventListener('click', (e) => { e.stopPropagation(); abrir(!grupo.classList.contains('open')); });
        sino.addEventListener('keydown', (e) => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); abrir(!grupo.classList.contains('open')); } });
        document.addEventListener('click', (e) => { if (!grupo.contains(e.target)) abrir(false); });
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') abrir(false); });
    })();
</script>
