<?php
require_once __DIR__ . '/env.php';

function conectar(): PDO
{
    static $pdo = null;               // reaproveita a mesma conexão na requisição
    if ($pdo !== null) return $pdo;

    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        env('DB_HOST', 'localhost'),
        env('DB_PORT', '3306'),
        env('DB_NAME', 'deubug')
    );

    try {
        $pdo = new PDO($dsn, env('DB_USER', 'root'), env('DB_PASS', ''), [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    } catch (PDOException $e) {
        error_log('Erro de conexão: ' . $e->getMessage());   // detalhe só no log
        die('Não foi possível conectar ao banco de dados.'); // mensagem genérica na tela
    }
    return $pdo;
}
