<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';

/**
 * Dados do usuário logado (nome, e-mail, telefone, plano ativo...).
 * O id vem SEMPRE da sessão, nunca da URL ($_GET) nem de formulário.
 * Devolve null se não houver login. A senha nunca é selecionada.
 */
function usuario_atual(): ?array
{
    static $cache = null;
    if ($cache !== null) return $cache;

    if (!usuario_logado()) return null;

    $stmt = conectar()->prepare(
        "SELECT u.usuario_id, u.usuario_nome, u.usuario_email, u.usuario_telefone, u.usuario_criacao,
                p.plano_nome, p.plano_descricao, p.plano_preco, p.plano_periodo,
                a.assinatura_datainicio, a.assinatura_datafim, a.assinatura_status
           FROM usuario u
           LEFT JOIN assinatura a ON a.usuario_id = u.usuario_id AND a.assinatura_status = 'ativa'
           LEFT JOIN plano p      ON p.plano_id   = a.plano_id
          WHERE u.usuario_id = :id
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
