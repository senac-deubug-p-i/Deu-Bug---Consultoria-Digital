<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';

/**
 * Dados do usuário logado (nome, e-mail, telefone, tipo...).
 * O id vem SEMPRE da sessão, nunca da URL ($_GET) nem de formulário.
 * Devolve null se não houver login. A senha nunca é selecionada.
 */
function usuario_atual(): ?array
{
    static $cache = null;
    if ($cache !== null) return $cache;

    if (!usuario_logado()) return null;

    $stmt = conectar()->prepare(
        "SELECT usuario_id, usuario_nome, usuario_email, usuario_telefone, usuario_tipo,
                usuario_empresa, usuario_cargo, usuario_criacao
           FROM usuario
          WHERE usuario_id = :id
          LIMIT 1"
    );
    $stmt->execute(['id' => $_SESSION['usuario_id']]);
    $cache = $stmt->fetch() ?: null;
    return $cache;
}

function primeiro_nome(string $nome): string
{
    return explode(' ', trim($nome))[0];
}
