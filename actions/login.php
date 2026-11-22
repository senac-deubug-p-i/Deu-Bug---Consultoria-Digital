<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';

const PAGINA_LOGIN  = 'pages/client/landingpage/index.php';
const PAGINA_CLIENTE = 'pages/client/client-area/index.php';

function voltar_com_erro(string $mensagem): never
{
    definir_erro($mensagem);
    redirecionar(PAGINA_LOGIN);
}

// Só aceita POST (abrir a URL direto pelo navegador volta para a landing page)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirecionar(PAGINA_LOGIN);
}

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';          // sem trim: espaço pode fazer parte da senha

if ($email === '' || $senha === '') {
    voltar_com_erro('Preencha e-mail e senha.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    voltar_com_erro('Informe um e-mail válido.');
}

$pdo = conectar();

$stmt = $pdo->prepare(
    'SELECT usuario_id, usuario_nome, usuario_senha, usuario_tipo
       FROM usuario
      WHERE usuario_email = :email'
);
$stmt->execute(['email' => $email]);
$usuario = $stmt->fetch();

// Mesma mensagem para "e-mail não existe" e "senha errada": não revela qual dos dois falhou
if (!$usuario || !password_verify($senha, $usuario['usuario_senha'])) {
    voltar_com_erro('E-mail ou senha incorretos.');
}

iniciar_sessao_usuario($usuario);

// Registra o último acesso (aparece na lista de clientes do admin)
$pdo->prepare('UPDATE usuario SET usuario_ultimo_acesso = :agora WHERE usuario_id = :id')
    ->execute(['agora' => date('Y-m-d H:i:s'), 'id' => $usuario['usuario_id']]);

// Administrador entra direto no painel dele
if ($usuario['usuario_tipo'] === 'admin') {
    redirecionar('pages/client/admin-area/index.php');
}

redirecionar(PAGINA_CLIENTE);
