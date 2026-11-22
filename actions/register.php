<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';

const PAGINA_LANDING = 'pages/client/landingpage/index.php';
const PAGINA_AREA    = 'pages/client/client-area/index.php';

function voltar_com_erro(string $mensagem, array $antigo): never
{
    definir_erro($mensagem, 'cadastro');
    definir_antigo($antigo);              // repreenche o formulário (sem as senhas)
    redirecionar(PAGINA_LANDING);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirecionar(PAGINA_LANDING);
}

// 1) Ler e limpar os dados
$nome      = preg_replace('/\s+/', ' ', trim($_POST['nome'] ?? ''));
$sobrenome = preg_replace('/\s+/', ' ', trim($_POST['sobrenome'] ?? ''));
$email     = mb_strtolower(trim($_POST['email'] ?? ''));
$telefone  = trim($_POST['telefone'] ?? '');
$senha     = $_POST['senha'] ?? '';            // senha: sem trim
$confirma  = $_POST['confirmar_senha'] ?? '';

$antigo = ['nome' => $nome, 'sobrenome' => $sobrenome, 'email' => $email, 'telefone' => $telefone];

// 2) Validar (para na primeira falha)
if ($nome === '' || $sobrenome === '' || $email === '' || $telefone === '' || $senha === '' || $confirma === '') {
    voltar_com_erro('Preencha todos os campos.', $antigo);
}
foreach ([$nome, $sobrenome] as $parte) {
    if (mb_strlen($parte) < 2 || mb_strlen($parte) > 100 || !preg_match("/^[\p{L}' -]+$/u", $parte)) {
        voltar_com_erro('Nome e sobrenome devem ter só letras (mínimo 2).', $antigo);
    }
}
if (mb_strlen($email) > 255 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    voltar_com_erro('Informe um e-mail válido.', $antigo);
}

$digitos = preg_replace('/\D/', '', $telefone);        // só números
if (!preg_match('/^\d{10,11}$/', $digitos)) {
    voltar_com_erro('Telefone inválido. Use DDD + número.', $antigo);
}
// Guarda formatado: (11) 91111-1111
$telefone = strlen($digitos) === 11
    ? sprintf('(%s) %s-%s', substr($digitos, 0, 2), substr($digitos, 2, 5), substr($digitos, 7))
    : sprintf('(%s) %s-%s', substr($digitos, 0, 2), substr($digitos, 2, 4), substr($digitos, 6));

if (strlen($senha) < 8) {
    voltar_com_erro('A senha deve ter pelo menos 8 caracteres.', $antigo);
}
if (strlen($senha) > 72) {                              // limite do bcrypt
    voltar_com_erro('A senha deve ter no máximo 72 caracteres.', $antigo);
}
if ($senha !== $confirma) {
    voltar_com_erro('As senhas não conferem.', $antigo);
}

// 3) Gravar
$pdo = conectar();
try {
    $stmt = $pdo->prepare(
        'INSERT INTO usuario (usuario_nome, usuario_email, usuario_senha, usuario_telefone)
         VALUES (:nome, :email, :senha, :telefone)'
    );
    $stmt->execute([
        'nome'     => $nome . ' ' . $sobrenome,
        'email'    => $email,
        'senha'    => password_hash($senha, PASSWORD_DEFAULT),
        'telefone' => $telefone,
    ]);
} catch (PDOException $e) {
    if ($e->getCode() === '23000') {                    // violação do UNIQUE do e-mail
        voltar_com_erro('Este e-mail já está cadastrado.', $antigo);
    }
    error_log('Erro no cadastro: ' . $e->getMessage());
    voltar_com_erro('Não foi possível concluir o cadastro. Tente novamente.', $antigo);
}

// 4) Já entra logado
iniciar_sessao_usuario([
    'usuario_id'   => (int)$pdo->lastInsertId(),
    'usuario_nome' => $nome . ' ' . $sobrenome,
]);

redirecionar(PAGINA_AREA);
