<?php
// Chamado pelo sino do cabeçalho (fetch) quando o cliente abre a lista: marca os logs como vistos.
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !usuario_logado()) {
    http_response_code(401);
    exit(json_encode(['ok' => false]));
}
if (!csrf_valido($_SERVER['HTTP_X_CSRF_TOKEN'] ?? null)) {
    http_response_code(419);
    exit(json_encode(['ok' => false]));
}

conectar()->prepare('UPDATE usuario SET usuario_notif_visto_em = :q WHERE usuario_id = :id')
    ->execute(['q' => agora()->format('Y-m-d H:i:s'), 'id' => $_SESSION['usuario_id']]);

echo json_encode(['ok' => true]);
