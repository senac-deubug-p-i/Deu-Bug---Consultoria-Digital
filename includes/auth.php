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
        encerrar_sessao();            // inativo por muito tempo
        return false;
    }
    $_SESSION['ultimo_acesso'] = time();
    return true;
}

function exigir_login(): void         // topo de toda página da área do cliente
{
    if (!usuario_logado()) {
        redirecionar('pages/client/landingpage/index.php');
    }
}

function iniciar_sessao_usuario(array $usuario): void   // chamar após validar a senha
{
    session_regenerate_id(true);      // evita session fixation
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

function e(?string $texto): string    // atalho para htmlspecialchars na saída
{
    return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
}

// Mensagem de erro de uma só leitura (guardada na sessão e apagada ao ser lida)
function definir_erro(string $mensagem): void
{
    $_SESSION['flash_erro'] = $mensagem;
}

function pegar_erro(): ?string
{
    $mensagem = $_SESSION['flash_erro'] ?? null;
    unset($_SESSION['flash_erro']);
    return $mensagem;
}