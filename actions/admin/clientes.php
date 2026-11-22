<?php
// API do admin para CLIENTES: criar conta e anotar notas internas.
require_once __DIR__ . '/../../includes/admin-dados.php';

$d   = api_iniciar();
$pdo = conectar();
$eu  = (int)$_SESSION['usuario_id'];

function senha_provisoria(int $tam = 10): string
{
    $alfabeto = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';   // sem 0/O/1/l/I
    $s = '';
    for ($i = 0; $i < $tam; $i++) $s .= $alfabeto[random_int(0, strlen($alfabeto) - 1)];
    return $s;
}

switch ((string)($d['acao'] ?? '')) {
    case 'criar':
        $empresa = api_texto($d, 'empresa', 150);
        $contato = api_texto($d, 'contato', 255);
        $email   = api_texto($d, 'email', 255);
        $tel     = api_texto($d, 'telefone', 30);
        if ($empresa === '' || $contato === '') api_erro('Preencha empresa e contato.');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) api_erro('Informe um e-mail válido.');

        $senha = senha_provisoria();
        try {
            $pdo->prepare('INSERT INTO usuario (usuario_nome, usuario_email, usuario_senha, usuario_telefone, usuario_empresa, usuario_tipo)
                           VALUES (:n, :e, :s, :t, :emp, \'cliente\')')
                ->execute(['n' => $contato, 'e' => $email, 's' => password_hash($senha, PASSWORD_DEFAULT), 't' => $tel, 'emp' => $empresa]);
        } catch (PDOException $ex) {
            if ($ex->getCode() === '23000') api_erro('Este e-mail já está cadastrado.', 409);
            error_log('Erro ao criar cliente: ' . $ex->getMessage());
            api_erro('Não foi possível criar o cliente.', 500);
        }
        $novo = admin_clientes($pdo, (int)$pdo->lastInsertId())[0];
        api_responder(['ok' => true, 'cliente' => $novo, 'senha_provisoria' => $senha]);

    case 'nota':
        $id = api_int($d, 'id');
        $texto = api_texto($d, 'texto', 500);
        if (!$id || $texto === '') api_erro('Escreva a nota.');
        $s = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE usuario_id = :id AND usuario_tipo = 'cliente'");
        $s->execute(['id' => $id]);
        if (!$s->fetchColumn()) api_erro('Cliente não encontrado.', 404);
        $agora = agora()->format('Y-m-d H:i:s');
        $pdo->prepare('INSERT INTO cliente_nota (usuario_id, autor_id, nota_texto, nota_criacao) VALUES (:u, :a, :t, :q)')
            ->execute(['u' => $id, 'a' => $eu, 't' => $texto, 'q' => $agora]);
        $nome = $pdo->prepare('SELECT usuario_nome FROM usuario WHERE usuario_id = :id'); $nome->execute(['id' => $eu]);
        api_responder(['ok' => true, 'nota' => $texto . ' — ' . primeiro_nome((string)$nome->fetchColumn()) . ', ' . quando($agora)]);

    default:
        api_erro('Ação desconhecida.');
}
