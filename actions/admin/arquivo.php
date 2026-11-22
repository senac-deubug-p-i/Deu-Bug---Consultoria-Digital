<?php
// Download de arquivo de projeto: só admin ou o cliente dono do projeto.
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../config/database.php';

exigir_login();
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
if (!$id) { http_response_code(404); exit('Arquivo não encontrado.'); }

$s = conectar()->prepare('SELECT a.arquivo_nome_original, a.arquivo_nome_salvo, p.usuario_id
                            FROM projeto_arquivo a JOIN projeto p ON p.projeto_id = a.projeto_id WHERE a.arquivo_id = :id');
$s->execute(['id' => $id]);
$a = $s->fetch();

$pode = $a && (usuario_eh_admin() || (int)$a['usuario_id'] === (int)$_SESSION['usuario_id']);
$caminho = $a ? __DIR__ . '/../../uploads/projetos/' . basename($a['arquivo_nome_salvo']) : '';   // basename: nunca sair da pasta
if (!$pode || !is_file($caminho)) { http_response_code(404); exit('Arquivo não encontrado.'); }

header('Content-Type: application/octet-stream');
header('X-Content-Type-Options: nosniff');
header('Content-Disposition: attachment; filename="' . str_replace(['"', "\r", "\n"], '', $a['arquivo_nome_original']) . '"');
header('Content-Length: ' . filesize($caminho));
readfile($caminho);
