<?php
// API do chat do ADMIN (equipe): listar conversas, ler mensagens e responder.
require_once __DIR__ . '/../../includes/admin-dados.php';

$d   = api_iniciar();
$pdo = conectar();
$eu  = (int)$_SESSION['usuario_id'];

if (($d['acao'] ?? '') === 'conversas') {
    api_responder(['ok' => true, 'conversas' => chat_conversas_admin($pdo)]);
}

$chatId = api_int($d, 'chat_id');
$s = $pdo->prepare('SELECT chat_id FROM chat_conversa WHERE chat_id = :c');
$s->execute(['c' => $chatId]);
if (!$chatId || !$s->fetchColumn()) api_erro('Conversa não encontrada.', 404);

switch ((string)($d['acao'] ?? '')) {
    case 'mensagens':
        $novas = array_map(fn($m) => chat_formatar($m, 'equipe'), chat_mensagens($pdo, $chatId, (int)($d['depois_de'] ?? 0)));
        chat_marcar_visto($pdo, $chatId, 'equipe');
        api_responder(['ok' => true, 'mensagens' => $novas]);

    case 'enviar':
        $m = chat_enviar($pdo, $chatId, 'equipe', $eu, (string)($d['texto'] ?? ''));
        if (!$m) api_erro('Escreva uma mensagem (até ' . CHAT_MAX_TEXTO . ' caracteres).', 422);
        api_responder(['ok' => true, 'mensagem' => $m]);

    default:
        api_erro('Ação desconhecida.');
}
