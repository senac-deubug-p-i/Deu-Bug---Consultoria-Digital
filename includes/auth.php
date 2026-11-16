<?php
require_once __DIR__ . '/../config/env.php';

const TEMPO_MAX_INATIVO = 1800;   // 30 minutos sem atividade

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => !empty($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    session_start();
}

function url(string $caminho): string
{
    return rtrim(env('APP_URL', ''), '/') . '/' . ltrim($caminho, '/');
}

function redirecionar(string $caminho): never
{
    header('Location: ' . url($caminho));
    exit;
}

function usuario_logado(): bool
{
    if (!($_SESSION['logado'] ?? false)) return false;

    if (time() - ($_SESSION['ultimo_acesso'] ?? 0) > TEMPO_MAX_INATIVO) {
        encerrar_sessao();                 // sessão inativa por muito tempo
        return false;
    }
    $_SESSION['ultimo_acesso'] = time();
    return true;
}

// Chamar no topo de toda página da área do cliente
function exigir_login(): void
{
    if (!usuario_logado()) {
        redirecionar('pages/client/landingpage/index.php');
    }
}

// Chamar após validar e-mail e senha no login
function iniciar_sessao_usuario(array $usuario): void
{
    session_regenerate_id(true);           // evita session fixation
    $_SESSION['logado']        = true;
    $_SESSION['usuario_id']    = (int)$usuario['usuario_id'];
    $_SESSION['usuario_nome']  = $usuario['usuario_nome'];
    $_SESSION['ultimo_acesso'] = time();
}

function encerrar_sessao(): void
{
    $_SESSION = [];
    if (session_status() === PHP_SESSION_ACTIVE) session_destroy();
}

function e(?string $texto): string         // atalho para escapar na saída
{
    return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
}

// Mensagem de erro de uma só leitura (guardada na sessão e apagada ao ser lida).
// $canal separa os formulários: 'login' ou 'cadastro'.
function definir_erro(string $mensagem, string $canal = 'login'): void
{
    $_SESSION['flash_erro'][$canal] = $mensagem;
}

function pegar_erro(string $canal = 'login'): ?string
{
    $mensagem = $_SESSION['flash_erro'][$canal] ?? null;
    unset($_SESSION['flash_erro'][$canal]);
    return $mensagem;
}

// Valores digitados, para repreencher o formulário após um erro (nunca guardar senha aqui)
function definir_antigo(array $dados): void
{
    $_SESSION['flash_antigo'] = $dados;
}

function pegar_antigo(): array
{
    $dados = $_SESSION['flash_antigo'] ?? [];
    unset($_SESSION['flash_antigo']);
    return $dados;
}

// Mensagem de sucesso de uma só leitura
function definir_sucesso(string $mensagem, string $canal = 'geral'): void
{
    $_SESSION['flash_sucesso'][$canal] = $mensagem;
}

function pegar_sucesso(string $canal = 'geral'): ?string
{
    $mensagem = $_SESSION['flash_sucesso'][$canal] ?? null;
    unset($_SESSION['flash_sucesso'][$canal]);
    return $mensagem;
}
