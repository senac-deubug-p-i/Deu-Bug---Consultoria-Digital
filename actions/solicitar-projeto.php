<?php
require_once __DIR__ . '/../includes/projetos.php';
exigir_login();

const PAGINA_PROJETOS = 'pages/client/projects-area/index.php';

function voltar_com_erro(string $mensagem, array $antigo): never
{
    definir_erro($mensagem, 'solicitacao');
    definir_antigo($antigo);              // reabre o modal com o que foi digitado
    redirecionar(PAGINA_PROJETOS);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirecionar(PAGINA_PROJETOS);
}

// 1) Ler e limpar
$empresa   = preg_replace('/\s+/', ' ', trim($_POST['empresa'] ?? ''));
$tipo      = $_POST['tipo'] ?? '';
$descricao = trim(str_replace("\r\n", "\n", $_POST['descricao'] ?? ''));

$antigo = ['empresa' => $empresa, 'tipo' => $tipo, 'descricao' => $descricao];

// 2) Validar
if ($empresa === '' || $tipo === '' || $descricao === '') {
    voltar_com_erro('Preencha todos os campos.', $antigo);
}
if (mb_strlen($empresa) < 2 || mb_strlen($empresa) > 150) {
    voltar_com_erro('O nome da empresa deve ter entre 2 e 150 caracteres.', $antigo);
}
if (!array_key_exists($tipo, tipos_de_site())) {      // o valor do select não é confiável
    voltar_com_erro('Escolha um tipo de site válido.', $antigo);
}
if (mb_strlen($descricao) < 10) {
    voltar_com_erro('Descreva um pouco mais o que você precisa (mínimo 10 caracteres).', $antigo);
}
if (mb_strlen($descricao) > 1000) {
    voltar_com_erro('A descrição pode ter no máximo 1000 caracteres.', $antigo);
}

// 3) Limite de solicitações em aberto
$pdo       = conectar();
$usuarioId = (int)$_SESSION['usuario_id'];      // o dono vem SEMPRE da sessão

if (contar_solicitacoes_abertas($pdo, $usuarioId) >= LIMITE_SOLICITACOES_ABERTAS) {
    voltar_com_erro('Você já tem ' . LIMITE_SOLICITACOES_ABERTAS . ' solicitações em análise. Aguarde o contato da equipe.', $antigo);
}

// 4) Gravar com a data prevista de contato
$previsao = previsao_contato();

try {
    $stmt = $pdo->prepare(
        'INSERT INTO solicitacao_projeto
            (usuario_id, solicitacao_empresa, solicitacao_tipo, solicitacao_descricao, solicitacao_previsao_contato)
         VALUES (:usuario, :empresa, :tipo, :descricao, :previsao)'
    );
    $stmt->execute([
        'usuario'   => $usuarioId,
        'empresa'   => $empresa,
        'tipo'      => $tipo,
        'descricao' => $descricao,
        'previsao'  => $previsao->format('Y-m-d'),
    ]);
} catch (PDOException $e) {
    error_log('Erro ao salvar solicitação: ' . $e->getMessage());
    voltar_com_erro('Não foi possível enviar a solicitação. Tente novamente.', $antigo);
}

definir_sucesso(
    'Solicitação enviada! Nossa equipe entrará em contato até ' . data_br($previsao, true) . '.',
    'solicitacao'
);
redirecionar(PAGINA_PROJETOS);
