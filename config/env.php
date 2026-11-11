<?php
function carregar_env(): void
{
    static $carregado = false;
    if ($carregado) return;

    $caminho = __DIR__ . '/../.env';
    if (!file_exists($caminho)) {
        die('Arquivo .env não encontrado. Copie o .env.example para .env.');
    }

    $vars = parse_ini_file($caminho, false, INI_SCANNER_RAW);
    if ($vars === false) {
        die('Erro ao ler o arquivo .env.');
    }

    foreach ($vars as $chave => $valor) {
        $_ENV[$chave] = $valor;   // parse_ini_file só devolve array: precisamos gravar em $_ENV
    }
    $carregado = true;
}

function env(string $chave, $padrao = null)
{
    carregar_env();
    return $_ENV[$chave] ?? $padrao;
}