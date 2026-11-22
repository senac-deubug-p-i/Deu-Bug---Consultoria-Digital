<?php
    require_once __DIR__ . '/../../../includes/auth.php';
    require_once __DIR__ . '/../../../includes/chat.php';
    require_once __DIR__ . '/../../../config/database.php';
    exigir_login();

    $pdo       = conectar();
    $uid       = (int)$_SESSION['usuario_id'];
    $conversas = chat_conversas_do_cliente($pdo, $uid);   // [0] = suporte geral, depois um por projeto

    // Conversa aberta: ?projeto=ID (chat daquele projeto) ou, sem nada, o suporte geral
    $projetoPedido = filter_var($_GET['projeto'] ?? null, FILTER_VALIDATE_INT) ?: null;
    $atual = $conversas[0];
    foreach ($conversas as $c) {
        if ($projetoPedido !== null && $c['projeto_id'] === $projetoPedido) $atual = $c;
    }
    $chatId    = (int)$atual['chat_id'];
    $mensagens = array_map(fn($m) => chat_formatar($m, 'cliente'), chat_mensagens($pdo, $chatId));
    chat_marcar_visto($pdo, $chatId, 'cliente');
    foreach ($conversas as &$c) { if ((int)$c['chat_id'] === $chatId) $c['nao_lidas'] = 0; }
    unset($c);

    $projetos   = projetos_do_cliente($pdo, $uid);
    $avisoOk    = pegar_sucesso('chamado');
    $avisoErro  = pegar_erro('chamado');
    $antigo     = $_SESSION['antigo_chamado'] ?? []; unset($_SESSION['antigo_chamado']);
    $projetoForm = $antigo['projeto_id'] ?? ($atual['projeto_id'] !== null ? (string)$atual['projeto_id'] : '');

    $stmt = $pdo->prepare('SELECT c.chamado_assunto, c.chamado_status, c.chamado_criacao, p.projeto_titulo
                             FROM chamado c LEFT JOIN projeto p ON p.projeto_id = c.projeto_id
                            WHERE c.usuario_id = :u ORDER BY c.chamado_id DESC LIMIT 5');
    $stmt->execute(['u' => $uid]);
    $chamados = $stmt->fetchAll();
    $rotuloChamado = ['aberto' => 'Aberta', 'em_andamento' => 'Em andamento', 'resolvido' => 'Resolvida'];
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

        <section class="support-screen">
            <div class="support-title-screen">
                <h2>Fale com a equipe</h2>
                <p>Tire dúvidas, peça ajustes ou abra uma solicitação. A gente responde rápido.</p>
            </div>

            <div class="support-modals">
                <div class="chats-request">
                    <div class="support-chats">
                        <h2>Conversas</h2>

                        <div class="chats-grid" id="chats-grid">
                            <?php foreach ($conversas as $c): ?>
                                <a class="chat-card<?= (int)$c['chat_id'] === $chatId ? ' selected' : '' ?>" data-chat="<?= (int)$c['chat_id'] ?>"
                                   href="?<?= $c['projeto_id'] ? 'projeto=' . (int)$c['projeto_id'] : 'geral=1' ?>">
                                    <span class="chat-avatar"><?= e(iniciais($c['titulo'])) ?></span>
                                    <span class="chat-card-text">
                                        <h3><?= e($c['titulo']) ?></h3>
                                        <small><?= e($c['subtitulo']) ?></small>
                                    </span>
                                    <span class="chat-dot" <?= $c['nao_lidas'] > 0 ? '' : 'hidden' ?>><?= (int)$c['nao_lidas'] ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <form class="open-request" action="../../../actions/abrir-chamado.php" method="post">
                        <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                        <h2>Abrir solicitação</h2>

                        <?php if ($avisoOk): ?><div class="aviso-suporte" role="status"><?= e($avisoOk) ?></div><?php endif; ?>
                        <?php if ($avisoErro): ?><div class="aviso-suporte aviso-erro" role="alert"><?= e($avisoErro) ?></div><?php endif; ?>

                        <div class="input-request">
                            <h4>Assunto</h4>
                            <input type="text" name="assunto" maxlength="150" required placeholder="Ex:.. Trocar o texto da página inicial" value="<?= e($antigo['assunto'] ?? '') ?>">
                        </div>

                        <div class="input-request">
                            <h4>Projeto Relacionado</h4>
                            <select name="projeto_id">
                                <option value="">Suporte geral (dúvidas gerais)</option>
                                <?php foreach ($projetos as $p): ?>
                                    <option value="<?= (int)$p['projeto_id'] ?>" <?= $projetoForm === (string)$p['projeto_id'] ? 'selected' : '' ?>><?= e($p['projeto_titulo']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="input-request">
                            <h4>Descrição</h4>
                            <textarea name="descricao" required minlength="10" maxlength="1800" placeholder="Conte o que você precisa"><?= e($antigo['descricao'] ?? '') ?></textarea>
                        </div>

                        <button type="submit">Enviar Solicitação</button>
                    </form>
                </div>

                <div class="contact-modals">
                    <div class="chat-modal" id="chat-modal" data-chat="<?= $chatId ?>" data-csrf="<?= e(csrf_token()) ?>">
                        <div class="chat-modal-header">
                            <span class="chat-avatar"><?= e(iniciais($atual['titulo'])) ?></span>
                            <h2><?= e($atual['titulo']) ?></h2>
                        </div>

                        <div class="chat-modal-messages" id="mensagens">
                            <?php foreach ($mensagens as $m): ?>
                                <div class="<?= $m['mine'] ? 'right-message' : 'left-message' ?>" data-id="<?= (int)$m['id'] ?>">
                                    <h3><?= e($m['mine'] ? 'Você' : $m['author']) ?></h3>
                                    <p><?= nl2br(e($m['text'])) ?></p>
                                    <small><?= e($m['time']) ?></small>
                                </div>
                            <?php endforeach; ?>
                            <p class="chat-vazio" id="chat-vazio" <?= $mensagens ? 'hidden' : '' ?>>Nenhuma mensagem ainda. Escreva abaixo e a equipe responde por aqui.</p>
                        </div>

                        <form class="chat-modal-inputs" id="chat-form" autocomplete="off">
                            <input type="text" id="chat-texto" maxlength="<?= CHAT_MAX_TEXTO ?>" placeholder="Digite sua mensagem">
                            <button type="submit">Enviar</button>
                        </form>
                    </div>

                    <?php if ($chamados): ?>
                    <div class="contact-card my-requests">
                        <h3>Minhas solicitações</h3>
                        <ul>
                            <?php foreach ($chamados as $ch): ?>
                                <li>
                                    <span><?= e($ch['chamado_assunto']) ?><small><?= e($ch['projeto_titulo'] ?? 'Suporte geral') ?> · <?= e(quando($ch['chamado_criacao'])) ?></small></span>
                                    <em class="status-<?= e($ch['chamado_status']) ?>"><?= e($rotuloChamado[$ch['chamado_status']]) ?></em>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <div class="contact-card">
                        <h3>Prefere outro canal?</h3>
                        <div>
                            <div>
                                <img src="../../../assets/images/basil_whatsapp-outline.svg" alt="whatsapp-logo">
                                <p>(11) 90000-0000</p>
                            </div>
                            <div>
                                <img src="../../../assets/images/clarity_email-line.svg" alt="email-logo">
                                <p>ola@gmail.com</p>
                            </div>
                        </div>
                        <hr style="border: 1px solid #ffffff62; width: 60%; border-radius: 24px;">
                        <p>Atendimento de segunda a sexta, das 9h às 18h. Respondemos em até 1 dia útil.</p>
                    </div>
                </div>
            </div>
        </section>

        <script src="index.js"></script>
    </body>
</html>
