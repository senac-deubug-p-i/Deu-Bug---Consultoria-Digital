<?php
// O cliente aprova um item da lista "Pendências" (botão Aprovar).
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/projetos.php';
require_once __DIR__ . '/../config/database.php';

const VOLTAR = 'pages/client/client-area/index.php';

// Se o botão foi clicado na página do projeto, volta para ela (id validado como inteiro)
$projetoVolta = filter_var($_POST['voltar_projeto'] ?? null, FILTER_VALIDATE_INT);
function destino(?int $projetoId): string
{
    return $projetoId ? 'pages/client/project-visualization/index.php?id=' . $projetoId : VOLTAR;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirecionar(VOLTAR);
exigir_login();

if (!csrf_valido($_POST['csrf'] ?? null)) {
    http_response_code(419);
    definir_erro('Sessão expirada. Tente novamente.', 'pendencias');
    redirecionar(destino($projetoVolta ?: null));
}

$aprovacaoId = filter_var($_POST['aprovacao_id'] ?? null, FILTER_VALIDATE_INT);
if (!$aprovacaoId) redirecionar(VOLTAR);

$pdo = conectar();

// O JOIN com projeto.usuario_id garante que o cliente só aprova o que é DELE
$stmt = $pdo->prepare(
    "SELECT a.aprovacao_id, a.aprovacao_titulo, a.projeto_id
       FROM projeto_aprovacao a
       JOIN projeto p ON p.projeto_id = a.projeto_id
      WHERE a.aprovacao_id = :a AND p.usuario_id = :u AND a.aprovacao_status = 'pendente'"
);
$stmt->execute(['a' => $aprovacaoId, 'u' => $_SESSION['usuario_id']]);
$item = $stmt->fetch();

if ($item) {
    $pdo->beginTransaction();
    $pdo->prepare("UPDATE projeto_aprovacao SET aprovacao_status = 'aprovada', aprovacao_resposta_em = :q WHERE aprovacao_id = :a")
        ->execute(['q' => agora()->format('Y-m-d H:i:s'), 'a' => $item['aprovacao_id']]);
    registrar_atualizacao($pdo, (int)$item['projeto_id'], (int)$_SESSION['usuario_id'],
        'Cliente aprovou: ' . $item['aprovacao_titulo'], null, true, 'green');
    $pdo->commit();
    definir_sucesso('Aprovado! A equipe já foi avisada.', 'pendencias');
}

redirecionar(destino($projetoVolta ?: null));
