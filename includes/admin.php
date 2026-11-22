<?php
// Utilidades do painel admin: proteção, JSON para o JavaScript e API (fetch).
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/projetos.php';
require_once __DIR__ . '/../config/database.php';

const PALETA_EQUIPE = ['bg-[#5B21B6]', 'bg-brand-dark', 'bg-[#6D28D9]', 'bg-[#0F766E]', 'bg-[#9333EA]'];

// JSON seguro para colocar dentro de <script> (escapa < > & ' ")
function js_json(mixed $valor): string
{
    return json_encode($valor, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR);
}

// Topo de toda página do admin: exige login + papel admin e devolve [pdo, admin]
function admin_iniciar(): array
{
    exigir_admin();
    $pdo = conectar();
    $stmt = $pdo->prepare('SELECT usuario_id, usuario_nome, usuario_cargo FROM usuario WHERE usuario_id = :id');
    $stmt->execute(['id' => $_SESSION['usuario_id']]);
    $admin = $stmt->fetch();
    if (!$admin) { encerrar_sessao(); redirecionar('pages/client/landingpage/index.php'); }
    $admin['iniciais'] = iniciais($admin['usuario_nome']);
    $admin['cargo']    = $admin['usuario_cargo'] ?: 'Equipe';
    return [$pdo, $admin];
}

function admin_nav(PDO $pdo, string $ativo): array
{
    $novas = (int)$pdo->query("SELECT COUNT(*) FROM solicitacao_projeto WHERE solicitacao_status = 'pendente'")->fetchColumn();
    $itens = [
        ['icon' => 'dash',   'label' => 'Visão geral',  'href' => 'index.php'],
        ['icon' => 'folder', 'label' => 'Projetos',     'href' => 'project.php'],
        ['icon' => 'users',  'label' => 'Clientes',     'href' => 'client-admin.php'],
        ['icon' => 'inbox',  'label' => 'Solicitações', 'href' => 'solicitation.php', 'badge' => $novas],
    ];
    foreach ($itens as &$i) {
        $i['active'] = $i['href'] === $ativo;
        if (empty($i['badge'])) unset($i['badge']);
    }
    return $itens;
}

// Equipe = usuários com tipo 'admin'. A chave do JS é o id em texto.
function admin_equipe(PDO $pdo): array
{
    $linhas = $pdo->query("SELECT usuario_id, usuario_nome, usuario_cargo FROM usuario WHERE usuario_tipo = 'admin' ORDER BY usuario_nome")->fetchAll();
    $equipe = [];
    foreach ($linhas as $i => $l) {
        $equipe[(string)$l['usuario_id']] = [
            'name' => $l['usuario_nome'], 'initials' => iniciais($l['usuario_nome']),
            'role' => $l['usuario_cargo'] ?: 'Equipe', 'color' => PALETA_EQUIPE[$i % count(PALETA_EQUIPE)],
        ];
    }
    return $equipe;
}

// ---------- API (fetch + JSON) ----------
function api_responder(array $dados, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($dados, JSON_UNESCAPED_UNICODE);
    exit;
}

function api_erro(string $mensagem, int $status = 400): never
{
    api_responder(['ok' => false, 'erro' => $mensagem], $status);
}

// Só POST, só admin logado, só com token CSRF. Devolve os dados enviados (JSON ou formulário).
function api_iniciar(): array
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') api_erro('Método não permitido.', 405);
    if (!usuario_logado())  api_erro('Sessão expirada. Entre novamente.', 401);
    if (!usuario_eh_admin()) api_erro('Acesso negado.', 403);

    $token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? ($_POST['csrf'] ?? null);
    if (!csrf_valido($token)) api_erro('Token inválido. Recarregue a página.', 419);

    $tipo = $_SERVER['CONTENT_TYPE'] ?? '';
    if (str_contains($tipo, 'application/json')) {
        $dados = json_decode(file_get_contents('php://input') ?: '', true);
        return is_array($dados) ? $dados : [];
    }
    return $_POST;
}

function api_int(array $dados, string $chave): ?int
{
    $v = filter_var($dados[$chave] ?? null, FILTER_VALIDATE_INT);
    return $v === false ? null : $v;
}

function api_texto(array $dados, string $chave, int $max): string
{
    return mb_substr(trim((string)($dados[$chave] ?? '')), 0, $max);
}
