<?php
// "Abrir solicitação" da tela de Suporte (formulário clássico: POST + redirect).
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/chat.php';
require_once __DIR__ . '/../config/database.php';

const VOLTAR_SUPORTE = 'pages/client/support-area/index.php';
const LIMITE_CHAMADOS_ABERTOS = 10;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirecionar(VOLTAR_SUPORTE);
exigir_login();

if (!csrf_valido($_POST['csrf'] ?? null)) {
    definir_erro('Sessão expirada. Tente novamente.', 'chamado');
    redirecionar(VOLTAR_SUPORTE);
}

$assunto   = trim((string)($_POST['assunto'] ?? ''));
$descricao = trim((string)($_POST['descricao'] ?? ''));
$projetoId = filter_var($_POST['projeto_id'] ?? '', FILTER_VALIDATE_INT) ?: null;   // vazio = suporte geral

$_SESSION['antigo_chamado'] = ['assunto' => $assunto, 'descricao' => $descricao, 'projeto_id' => (string)$projetoId];   // para reabrir o formulário preenchido se der erro

$erros = [];
if ($assunto === '' || mb_strlen($assunto) > 150) $erros[] = 'Informe o assunto (até 150 caracteres).';
if (mb_strlen($descricao) < 10 || mb_strlen($descricao) > CHAT_MAX_TEXTO - 200) $erros[] = 'Descreva o que você precisa (mínimo 10 caracteres).';

$pdo = conectar();
$uid = (int)$_SESSION['usuario_id'];

// O projeto escolhido no dropdown precisa ser DESTE cliente
if ($projetoId !== null && !projeto_do_cliente($pdo, $uid, $projetoId)) {
    $erros[] = 'Projeto inválido.';
}

if (!$erros) {
    $abertos = $pdo->prepare("SELECT COUNT(*) FROM chamado WHERE usuario_id = :u AND chamado_status <> 'resolvido'");
    $abertos->execute(['u' => $uid]);
    if ((int)$abertos->fetchColumn() >= LIMITE_CHAMADOS_ABERTOS) {
        $erros[] = 'Você já tem ' . LIMITE_CHAMADOS_ABERTOS . ' solicitações abertas. Aguarde a equipe responder.';
    }
}

if ($erros) {
    definir_erro(implode(' ', $erros), 'chamado');
    redirecionar(VOLTAR_SUPORTE . ($projetoId ? '?projeto=' . $projetoId : ''));
}

$pdo->beginTransaction();
$pdo->prepare('INSERT INTO chamado (usuario_id, projeto_id, chamado_assunto, chamado_descricao, chamado_criacao) VALUES (:u, :p, :a, :d, :q)')
    ->execute(['u' => $uid, 'p' => $projetoId, 'a' => mb_substr($assunto, 0, 150), 'd' => $descricao, 'q' => agora()->format('Y-m-d H:i:s')]);

// A solicitação também abre a conversa: a equipe responde pelo chat
$chatId = chat_obter($pdo, $uid, $projetoId);
chat_enviar($pdo, $chatId, 'cliente', $uid, "📌 Solicitação: $assunto\n\n$descricao");
$pdo->commit();

unset($_SESSION['antigo_chamado']);
definir_sucesso('Solicitação enviada! A equipe responde pelo chat em até 1 dia útil.', 'chamado');
redirecionar(VOLTAR_SUPORTE . ($projetoId ? '?projeto=' . $projetoId : ''));
