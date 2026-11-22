<?php
// API do chat do CLIENTE (fetch + JSON). O cliente só acessa conversas que são dele.
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/chat.php';
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json; charset=utf-8');
function resp(array $d, int $s = 200): never { http_response_code($s); echo json_encode($d, JSON_UNESCAPED_UNICODE); exit; }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') resp(['ok' => false, 'erro' => 'Método não permitido.'], 405);
if (!usuario_logado()) resp(['ok' => false, 'erro' => 'Sessão expirada.'], 401);
if (!csrf_valido($_SERVER['HTTP_X_CSRF_TOKEN'] ?? null)) resp(['ok' => false, 'erro' => 'Token inválido.'], 419);

$d   = json_decode(file_get_contents('php://input') ?: '', true) ?: [];
$pdo = conectar();
$eu  = (int)$_SESSION['usuario_id'];

if (($d['acao'] ?? '') === 'resumo') {          // contadores de não lidas para as bolinhas da lista
    $mapa = [];
    foreach (chat_conversas_do_cliente($pdo, $eu) as $c) $mapa[$c['chat_id']] = $c['nao_lidas'];
    resp(['ok' => true, 'naoLidas' => $mapa]);
}

// as demais ações precisam de uma conversa DESTE cliente
$chatId = filter_var($d['chat_id'] ?? null, FILTER_VALIDATE_INT);
$s = $pdo->prepare('SELECT chat_id FROM chat_conversa WHERE chat_id = :c AND usuario_id = :u');
$s->execute(['c' => $chatId, 'u' => $eu]);
if (!$chatId || !$s->fetchColumn()) resp(['ok' => false, 'erro' => 'Conversa não encontrada.'], 404);

switch ($d['acao'] ?? '') {
    case 'mensagens':      // novas mensagens depois de um id (polling)
        $novas = array_map(fn($m) => chat_formatar($m, 'cliente'), chat_mensagens($pdo, $chatId, (int)($d['depois_de'] ?? 0)));
        if ($novas) chat_marcar_visto($pdo, $chatId, 'cliente');
        resp(['ok' => true, 'mensagens' => $novas]);

    case 'enviar':
        $m = chat_enviar($pdo, $chatId, 'cliente', $eu, (string)($d['texto'] ?? ''));
        if (!$m) resp(['ok' => false, 'erro' => 'Escreva uma mensagem (até ' . CHAT_MAX_TEXTO . ' caracteres).'], 422);
        resp(['ok' => true, 'mensagem' => $m]);

    default:
        resp(['ok' => false, 'erro' => 'Ação desconhecida.'], 400);
}
