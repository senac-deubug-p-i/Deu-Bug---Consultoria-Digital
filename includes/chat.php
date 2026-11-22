<?php
// Chat do suporte: conversa por projeto + suporte geral. Usado pelo cliente e pelo admin.
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/projetos.php';

const CHAT_MAX_TEXTO = 2000;

// Devolve o id da conversa (cria na primeira vez). $projetoId null = suporte geral.
// IMPORTANTE: quem chama deve garantir que o projeto pertence ao cliente.
function chat_obter(PDO $pdo, int $usuarioId, ?int $projetoId): int
{
    if ($projetoId === null) {
        $s = $pdo->prepare('SELECT chat_id FROM chat_conversa WHERE usuario_id = :u AND projeto_id IS NULL ORDER BY chat_id LIMIT 1');
        $s->execute(['u' => $usuarioId]);
    } else {
        $s = $pdo->prepare('SELECT chat_id FROM chat_conversa WHERE usuario_id = :u AND projeto_id = :p ORDER BY chat_id LIMIT 1');
        $s->execute(['u' => $usuarioId, 'p' => $projetoId]);
    }
    $id = $s->fetchColumn();
    if ($id) return (int)$id;

    $pdo->prepare('INSERT INTO chat_conversa (usuario_id, projeto_id) VALUES (:u, :p)')->execute(['u' => $usuarioId, 'p' => $projetoId]);
    return (int)$pdo->lastInsertId();
}

function chat_formatar(array $m, string $meuLado): array
{
    return [
        'id'     => (int)$m['msg_id'],
        'mine'   => $m['msg_remetente'] === $meuLado,
        'author' => $m['msg_remetente'] === 'equipe'
                        ? (($m['autor'] ?? null) ? primeiro_nome_chat($m['autor']) . ' · equipe' : 'Equipe')
                        : ($m['autor'] ?? 'Cliente'),
        'text'   => $m['msg_texto'],
        'time'   => quando($m['msg_criacao']),
    ];
}

function primeiro_nome_chat(string $n): string { return explode(' ', trim($n))[0]; }

function chat_mensagens(PDO $pdo, int $chatId, int $depoisDe = 0, int $limite = 300): array
{
    $s = $pdo->prepare(
        'SELECT m.msg_id, m.msg_remetente, m.msg_texto, m.msg_criacao, a.usuario_nome AS autor
           FROM chat_mensagem m LEFT JOIN usuario a ON a.usuario_id = m.autor_id
          WHERE m.chat_id = :c AND m.msg_id > :d ORDER BY m.msg_id LIMIT ' . (int)$limite
    );
    $s->execute(['c' => $chatId, 'd' => $depoisDe]);
    return $s->fetchAll();
}

// $remetente: 'cliente' | 'equipe'. Devolve a mensagem já formatada ou null se o texto for inválido.
function chat_enviar(PDO $pdo, int $chatId, string $remetente, ?int $autorId, string $texto): ?array
{
    $texto = trim($texto);
    if ($texto === '' || mb_strlen($texto) > CHAT_MAX_TEXTO) return null;
    $agora = agora()->format('Y-m-d H:i:s');

    $pdo->prepare('INSERT INTO chat_mensagem (chat_id, msg_remetente, autor_id, msg_texto, msg_criacao) VALUES (:c, :r, :a, :t, :q)')
        ->execute(['c' => $chatId, 'r' => $remetente, 'a' => $autorId, 't' => $texto, 'q' => $agora]);
    $id = (int)$pdo->lastInsertId();

    $coluna = $remetente === 'cliente' ? 'chat_cliente_visto_em' : 'chat_equipe_visto_em';   // quem escreve já "viu" tudo
    $pdo->prepare("UPDATE chat_conversa SET chat_ultima_em = :q1, $coluna = :q2 WHERE chat_id = :c")->execute(['q1' => $agora, 'q2' => $agora, 'c' => $chatId]);

    $m = chat_mensagens($pdo, $chatId, $id - 1, 1)[0] ?? null;
    return $m ? chat_formatar($m, $remetente) : null;
}

function chat_marcar_visto(PDO $pdo, int $chatId, string $lado): void
{
    $coluna = $lado === 'cliente' ? 'chat_cliente_visto_em' : 'chat_equipe_visto_em';
    $pdo->prepare("UPDATE chat_conversa SET $coluna = :q WHERE chat_id = :c")->execute(['q' => agora()->format('Y-m-d H:i:s'), 'c' => $chatId]);
}

// Mensagens da OUTRA parte ainda não vistas por $lado
function chat_nao_lidas(PDO $pdo, int $chatId, string $lado): int
{
    $outro = $lado === 'cliente' ? 'equipe' : 'cliente';
    $coluna = $lado === 'cliente' ? 'chat_cliente_visto_em' : 'chat_equipe_visto_em';
    $s = $pdo->prepare(
        "SELECT COUNT(*) FROM chat_mensagem m JOIN chat_conversa c ON c.chat_id = m.chat_id
          WHERE m.chat_id = :c AND m.msg_remetente = :o AND (c.$coluna IS NULL OR m.msg_criacao > c.$coluna)"
    );
    $s->execute(['c' => $chatId, 'o' => $outro]);
    return (int)$s->fetchColumn();
}

// Lista do cliente: suporte geral + um chat por projeto
function chat_conversas_do_cliente(PDO $pdo, int $usuarioId): array
{
    $lista = [[
        'chat_id' => chat_obter($pdo, $usuarioId, null), 'projeto_id' => null,
        'titulo' => 'Suporte geral', 'subtitulo' => 'Dúvidas gerais',
    ]];
    foreach (projetos_do_cliente($pdo, $usuarioId) as $p) {
        $lista[] = [
            'chat_id' => chat_obter($pdo, $usuarioId, (int)$p['projeto_id']), 'projeto_id' => (int)$p['projeto_id'],
            'titulo' => $p['projeto_titulo'], 'subtitulo' => nome_etapa((int)$p['projeto_etapa']),
        ];
    }
    foreach ($lista as &$c) $c['nao_lidas'] = chat_nao_lidas($pdo, (int)$c['chat_id'], 'cliente');
    return $lista;
}

// Todas as conversas, para o admin (mais recentes primeiro)
function chat_conversas_admin(PDO $pdo): array
{
    $linhas = $pdo->query(
        "SELECT c.chat_id, c.chat_ultima_em, c.projeto_id, u.usuario_nome, u.usuario_empresa, p.projeto_titulo,
                (SELECT m.msg_texto FROM chat_mensagem m WHERE m.chat_id = c.chat_id ORDER BY m.msg_id DESC LIMIT 1) AS ultima
           FROM chat_conversa c
           JOIN usuario u ON u.usuario_id = c.usuario_id
           LEFT JOIN projeto p ON p.projeto_id = c.projeto_id
          WHERE EXISTS (SELECT 1 FROM chat_mensagem m WHERE m.chat_id = c.chat_id)
          ORDER BY c.chat_ultima_em DESC, c.chat_id DESC"
    )->fetchAll();
    $out = [];
    foreach ($linhas as $l) {
        $out[] = [
            'chatId' => (int)$l['chat_id'], 'client' => $l['usuario_empresa'] ?: $l['usuario_nome'], 'contact' => $l['usuario_nome'],
            'topic' => $l['projeto_titulo'] ?: 'Suporte geral', 'general' => $l['projeto_id'] === null,
            'last' => mb_strimwidth((string)$l['ultima'], 0, 70, '…'), 'time' => tempo_atras($l['chat_ultima_em']),
            'unread' => chat_nao_lidas($pdo, (int)$l['chat_id'], 'equipe'),
        ];
    }
    return $out;
}

function chat_total_nao_lidas_admin(PDO $pdo): int
{
    return (int)$pdo->query(
        "SELECT COUNT(*) FROM chat_mensagem m JOIN chat_conversa c ON c.chat_id = m.chat_id
          WHERE m.msg_remetente = 'cliente' AND (c.chat_equipe_visto_em IS NULL OR m.msg_criacao > c.chat_equipe_visto_em)"
    )->fetchColumn();
}
