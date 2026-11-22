<?php
// Consultas que alimentam as telas do admin. Cada função devolve arrays prontos para virar JSON.
require_once __DIR__ . '/admin.php';

function projeto_para_js(array $r, string $hoje): array
{
    $prazo = $r['projeto_prazo'] ? new DateTimeImmutable($r['projeto_prazo']) : null;
    $tag = $r['projeto_tag']; $estilo = $r['projeto_tag_estilo'];
    $etapa = (int)$r['projeto_etapa'];
    if (!$tag && $etapa < ETAPA_PUBLICADO) {
        if ((int)($r['aprov_pend'] ?? 0) > 0)            { $tag = 'Aguardando cliente'; $estilo = 'warn'; }
        elseif ($r['projeto_prazo'] && $r['projeto_prazo'] < $hoje) { $tag = 'Prazo vencido'; $estilo = 'red'; }
    }
    return [
        'id' => (int)$r['projeto_id'], 'stage' => $etapa, 'client' => $r['projeto_empresa'], 'clientId' => (int)$r['usuario_id'],
        'title' => $r['projeto_titulo'], 'progress' => (int)$r['projeto_progresso'],
        'day' => $prazo ? (int)$prazo->format('j') : 0, 'month' => $prazo ? (int)$prazo->format('n') - 1 : 0,
        'year' => $prazo ? (int)$prazo->format('Y') : 0, 'hasDeadline' => (bool)$prazo,
        'owner' => $r['responsavel_id'] ? (string)$r['responsavel_id'] : '',
        'tag' => $tag, 'tagStyle' => $tag ? $estilo : null, 'paused' => (bool)$r['projeto_pausado'],
    ];
}

const SQL_PROJETO = 'SELECT p.*, (SELECT COUNT(*) FROM projeto_aprovacao a
                      WHERE a.projeto_id = p.projeto_id AND a.aprovacao_status = \'pendente\') AS aprov_pend
                     FROM projeto p';

function admin_projetos(PDO $pdo): array
{
    $hoje = agora()->format('Y-m-d');
    $out = [];
    foreach ($pdo->query(SQL_PROJETO . ' ORDER BY p.projeto_etapa, p.projeto_id')->fetchAll() as $r) {
        $out[] = projeto_para_js($r, $hoje);
    }
    return $out;
}

function admin_clientes_para_select(PDO $pdo): array
{
    $out = [];
    foreach ($pdo->query("SELECT usuario_id, usuario_nome, usuario_empresa FROM usuario WHERE usuario_tipo = 'cliente' ORDER BY usuario_nome")->fetchAll() as $c) {
        $out[] = ['id' => (int)$c['usuario_id'], 'label' => ($c['usuario_empresa'] ?: $c['usuario_nome']) . ' · ' . $c['usuario_nome']];
    }
    return $out;
}

function cliente_para_js(array $c, array $projetos, array $notas, int $aprovPend, bool $atrasado): array
{
    $nome = $c['usuario_empresa'] ?: $c['usuario_nome'];
    $ativos = array_filter($projetos, fn($p) => (int)$p['projeto_etapa'] < ETAPA_PUBLICADO);
    if ($atrasado)               { $status = 'risk'; $label = 'Projeto atrasado'; }
    elseif ($aprovPend > 0)      { $status = 'warn'; $label = 'Aprovação pendente'; }
    elseif (!$projetos)          { $status = 'new';  $label = 'Novo'; }
    elseif (!$ativos)            { $status = 'done'; $label = 'Concluído'; }
    else                         { $status = 'ok';   $label = 'Em dia'; }
    $criado = new DateTimeImmutable($c['usuario_criacao']);
    return [
        'id' => (int)$c['usuario_id'], 'name' => $nome, 'initials' => iniciais($nome), 'contact' => $c['usuario_nome'],
        'email' => $c['usuario_email'], 'phone' => $c['usuario_telefone'] ?: '',
        'since' => 'Cliente desde ' . MESES_CURTOS[(int)$criado->format('n') - 1] . ' ' . $criado->format('Y'),
        'sinceTs' => $criado->getTimestamp(), 'status' => $status, 'statusLabel' => $label,
        'lastAccess' => acesso_relativo($c['usuario_ultimo_acesso']),
        'daysSinceAccess' => $c['usuario_ultimo_acesso'] ? (int)agora()->setTime(0, 0)->diff((new DateTimeImmutable($c['usuario_ultimo_acesso']))->setTime(0, 0))->format('%a') : 999,
        'projects' => array_map(fn($p) => ['id' => (int)$p['projeto_id'], 'name' => $p['projeto_titulo'],
                       'stage' => nome_etapa((int)$p['projeto_etapa']), 'progress' => (int)$p['projeto_progresso']], $ativos),
        'notes' => $notas,
    ];
}

function admin_clientes(PDO $pdo, ?int $soEste = null): array
{
    $hoje = agora()->format('Y-m-d');
    $sql = "SELECT usuario_id, usuario_nome, usuario_email, usuario_telefone, usuario_empresa, usuario_criacao, usuario_ultimo_acesso
              FROM usuario WHERE usuario_tipo = 'cliente'" . ($soEste ? ' AND usuario_id = ' . (int)$soEste : '') . ' ORDER BY usuario_nome';
    $clientes = $pdo->query($sql)->fetchAll();

    $projetos = []; $aprov = [];
    foreach ($pdo->query(SQL_PROJETO . ' ORDER BY p.projeto_id')->fetchAll() as $p) {
        $projetos[$p['usuario_id']][] = $p;
        $aprov[$p['usuario_id']] = ($aprov[$p['usuario_id']] ?? 0) + (int)$p['aprov_pend'];
    }
    $notas = [];
    foreach ($pdo->query('SELECT n.usuario_id, n.nota_texto, n.nota_criacao, a.usuario_nome AS autor
                            FROM cliente_nota n LEFT JOIN usuario a ON a.usuario_id = n.autor_id ORDER BY n.nota_id')->fetchAll() as $n) {
        $notas[$n['usuario_id']][] = $n['nota_texto'] . ' — ' . ($n['autor'] ? primeiro_nome($n['autor']) : 'Equipe') . ', ' . quando($n['nota_criacao']);
    }
    $out = [];
    foreach ($clientes as $c) {
        $meus = $projetos[$c['usuario_id']] ?? [];
        $atrasado = (bool)array_filter($meus, fn($p) => (int)$p['projeto_etapa'] < ETAPA_PUBLICADO && $p['projeto_prazo'] && $p['projeto_prazo'] < $hoje);
        $out[] = cliente_para_js($c, $meus, $notas[$c['usuario_id']] ?? [], $aprov[$c['usuario_id']] ?? 0, $atrasado);
    }
    return $out;
}

if (!function_exists('primeiro_nome')) {
    function primeiro_nome(string $nome): string { return explode(' ', trim($nome))[0]; }
}

function admin_dashboard(PDO $pdo): array
{
    $hoje = agora()->format('Y-m-d');
    $em7  = agora()->modify('+7 days')->format('Y-m-d');
    $mes  = agora()->format('Y-m-01');
    $ano  = agora()->format('Y-01-01');
    $um = fn(string $sql, array $p = []) => (function () use ($pdo, $sql, $p) { $s = $pdo->prepare($sql); $s->execute($p); return (int)$s->fetchColumn(); })();

    $ativos    = $um('SELECT COUNT(*) FROM projeto WHERE projeto_etapa < ' . ETAPA_PUBLICADO);
    $novosMes  = $um('SELECT COUNT(*) FROM projeto WHERE projeto_etapa < ' . ETAPA_PUBLICADO . ' AND projeto_inicio >= :m', ['m' => $mes]);
    $semana    = $um('SELECT COUNT(*) FROM projeto WHERE projeto_etapa < ' . ETAPA_PUBLICADO . ' AND projeto_prazo BETWEEN :a AND :b', ['a' => $hoje, 'b' => $em7]);
    $atrasados = $um('SELECT COUNT(*) FROM projeto WHERE projeto_etapa < ' . ETAPA_PUBLICADO . ' AND projeto_prazo < :h', ['h' => $hoje]);
    $aprovacoes = $um("SELECT COUNT(*) FROM projeto_aprovacao WHERE aprovacao_status = 'pendente'");
    $projComAprov = $um("SELECT COUNT(DISTINCT projeto_id) FROM projeto_aprovacao WHERE aprovacao_status = 'pendente'");
    $novas     = $um("SELECT COUNT(*) FROM solicitacao_projeto WHERE solicitacao_status = 'pendente'");
    $publicados = $um('SELECT COUNT(*) FROM projeto WHERE projeto_etapa = ' . ETAPA_PUBLICADO . ' AND projeto_publicado_em >= :a', ['a' => $ano]);

    $kpis = [
        ['label' => 'Projetos ativos', 'value' => (string)$ativos, 'note' => $novosMes ? "+$novosMes este mês" : 'Nenhum novo este mês', 'tone' => $novosMes ? 'positive' : 'neutral', 'href' => 'project.php'],
        ['label' => 'Entregas da semana', 'value' => (string)$semana, 'note' => 'Prazo nos próximos 7 dias', 'tone' => 'neutral', 'href' => 'project.php'],
        ['label' => 'Aguardando cliente', 'value' => (string)$aprovacoes, 'note' => $aprovacoes ? "$projComAprov " . ($projComAprov == 1 ? 'projeto' : 'projetos') . ' com aprovação pendente' : 'Nenhuma aprovação pendente', 'tone' => 'highlight', 'href' => 'project.php'],
        ['label' => 'Solicitações novas', 'value' => (string)$novas, 'note' => $novas ? 'Aguardando contato da equipe' : 'Tudo respondido', 'tone' => $novas ? 'negative' : 'neutral', 'href' => 'solicitation.php'],
        ['label' => 'Projetos atrasados', 'value' => (string)$atrasados, 'note' => $atrasados ? 'Prazo já vencido' : 'Nenhum atraso', 'tone' => $atrasados ? 'negative' : 'positive', 'href' => 'project.php'],
    ];

    // Precisam de atenção: atrasados primeiro, depois com aprovação pendente / etiqueta de alerta
    $atencao = [];
    foreach ($pdo->query(SQL_PROJETO . ' WHERE p.projeto_etapa < ' . ETAPA_PUBLICADO . ' ORDER BY p.projeto_prazo IS NULL, p.projeto_prazo')->fetchAll() as $r) {
        $j = projeto_para_js($r, $hoje);
        if (!$j['tag'] || $j['tagStyle'] === 'ok') continue;
        $atencao[] = ['id' => $j['id'], 'name' => $j['title'], 'meta' => $r['projeto_empresa'] . ' · ' . nome_etapa($j['stage']),
                      'reason' => $j['tag'], 'tone' => $j['tagStyle'] === 'org' ? 'org' : $j['tagStyle'], 'deadline' => dia_mes($r['projeto_prazo'])];
        if (count($atencao) >= 6) break;
    }

    $porEtapa = array_fill(0, ETAPA_PUBLICADO, 0);
    foreach ($pdo->query('SELECT projeto_etapa, COUNT(*) AS n FROM projeto WHERE projeto_etapa < ' . ETAPA_PUBLICADO . ' GROUP BY projeto_etapa')->fetchAll() as $r) {
        $porEtapa[(int)$r['projeto_etapa']] = (int)$r['n'];
    }
    $etapas = [];
    foreach ($porEtapa as $i => $n) $etapas[] = ['name' => ETAPAS[$i], 'count' => $n, 'percent' => $ativos ? (int)round($n * 100 / $ativos) : 0];

    $pedidos = [];
    $stmt = $pdo->query("SELECT s.solicitacao_id, s.solicitacao_empresa, s.solicitacao_tipo, s.solicitacao_criacao, u.usuario_nome
                           FROM solicitacao_projeto s JOIN usuario u ON u.usuario_id = s.usuario_id
                          WHERE s.solicitacao_status = 'pendente' ORDER BY s.solicitacao_id DESC LIMIT 4");
    foreach ($stmt->fetchAll() as $s) {
        $pedidos[] = ['id' => (int)$s['solicitacao_id'], 'title' => 'Novo projeto: ' . nome_tipo_site($s['solicitacao_tipo']),
                      'meta' => $s['usuario_nome'] . ' · ' . $s['solicitacao_empresa'] . ' · há ' . tempo_atras($s['solicitacao_criacao'])];
    }

    $atividade = [];
    $stmt = $pdo->query('SELECT u.atualizacao_titulo, u.atualizacao_cor, u.atualizacao_criacao, p.projeto_titulo, a.usuario_nome AS autor
                           FROM projeto_atualizacao u JOIN projeto p ON p.projeto_id = u.projeto_id
                           LEFT JOIN usuario a ON a.usuario_id = u.autor_id
                          ORDER BY u.atualizacao_id DESC LIMIT 6');
    foreach ($stmt->fetchAll() as $a) {
        $atividade[] = ['color' => in_array($a['atualizacao_cor'], ['brand', 'green', 'yellow'], true) ? $a['atualizacao_cor'] : 'brand',
                        'text' => ($a['autor'] ? primeiro_nome($a['autor']) . ': ' : '') . $a['atualizacao_titulo'],
                        'meta' => quando($a['atualizacao_criacao']) . ' · ' . $a['projeto_titulo']];
    }

    $carga = [];
    $stmt = $pdo->query("SELECT u.usuario_nome, u.usuario_cargo,
                                (SELECT COUNT(*) FROM projeto p WHERE p.responsavel_id = u.usuario_id AND p.projeto_etapa < " . ETAPA_PUBLICADO . ") AS n
                           FROM usuario u WHERE u.usuario_tipo = 'admin' ORDER BY n DESC, u.usuario_nome");
    foreach ($stmt->fetchAll() as $c) {
        $n = (int)$c['n'];
        $carga[] = ['name' => $c['usuario_nome'] . ($c['usuario_cargo'] ? ' · ' . mb_strtolower($c['usuario_cargo']) : ''),
                    'label' => "$n de " . CAPACIDADE_EQUIPE . ($n >= CAPACIDADE_EQUIPE ? ' · lotado' : ''),
                    'percent' => min(100, (int)round($n * 100 / CAPACIDADE_EQUIPE)), 'full' => $n >= CAPACIDADE_EQUIPE];
    }

    return compact('kpis', 'atencao', 'etapas', 'pedidos', 'atividade', 'carga') + ['ativos' => $ativos, 'publicados' => $publicados];
}

function admin_projeto(PDO $pdo, int $id): ?array
{
    $stmt = $pdo->prepare(SQL_PROJETO . ' WHERE p.projeto_id = :id');
    $stmt->execute(['id' => $id]);
    $p = $stmt->fetch();
    if (!$p) return null;

    $c = $pdo->prepare('SELECT usuario_id, usuario_nome, usuario_email, usuario_telefone, usuario_ultimo_acesso FROM usuario WHERE usuario_id = :id');
    $c->execute(['id' => $p['usuario_id']]);

    $hist = $pdo->prepare('SELECT u.*, a.usuario_nome AS autor FROM projeto_atualizacao u LEFT JOIN usuario a ON a.usuario_id = u.autor_id
                            WHERE u.projeto_id = :id ORDER BY u.atualizacao_id DESC');
    $hist->execute(['id' => $id]);
    $tar = $pdo->prepare('SELECT t.*, r.usuario_nome AS resp FROM projeto_tarefa t LEFT JOIN usuario r ON r.usuario_id = t.responsavel_id
                           WHERE t.projeto_id = :id ORDER BY t.tarefa_id');
    $tar->execute(['id' => $id]);
    $arq = $pdo->prepare('SELECT arquivo_id, arquivo_nome_original, arquivo_tamanho FROM projeto_arquivo WHERE projeto_id = :id ORDER BY arquivo_id DESC');
    $arq->execute(['id' => $id]);
    $apr = $pdo->prepare("SELECT * FROM projeto_aprovacao WHERE projeto_id = :id AND aprovacao_status = 'pendente' ORDER BY aprovacao_id DESC LIMIT 1");
    $apr->execute(['id' => $id]);

    $a = $apr->fetch() ?: null;
    return [
        'projeto' => $p, 'cliente' => $c->fetch(),
        'historico' => array_map(fn($h) => formatar_historico($h), $hist->fetchAll()),
        'tarefas' => array_map(fn($t) => ['id' => (int)$t['tarefa_id'], 'title' => $t['tarefa_titulo'],
                       'owner' => $t['resp'] ? primeiro_nome($t['resp']) : '—', 'done' => (bool)$t['tarefa_concluida']], $tar->fetchAll()),
        'arquivos' => array_map(fn($f) => ['id' => (int)$f['arquivo_id'], 'name' => $f['arquivo_nome_original'], 'size' => formatar_tamanho((int)$f['arquivo_tamanho'])], $arq->fetchAll()),
        'aprovacao' => $a,
    ];
}

function formatar_historico(array $h): array
{
    return ['title' => $h['atualizacao_titulo'], 'visible' => (bool)$h['atualizacao_visivel'],
            'dot' => in_array($h['atualizacao_cor'], ['blue', 'yellow', 'green'], true) ? $h['atualizacao_cor'] : 'blue',
            'meta' => quando($h['atualizacao_criacao']) . ' · ' . ($h['autor'] ?? 'Cliente')];
}

function formatar_tamanho(int $bytes): string
{
    return $bytes > 1000000 ? number_format($bytes / 1e6, 1, ',', '') . ' MB' : max(1, (int)round($bytes / 1000)) . ' KB';
}

function admin_solicitacoes(PDO $pdo): array
{
    $stmt = $pdo->query('SELECT s.*, u.usuario_nome FROM solicitacao_projeto s JOIN usuario u ON u.usuario_id = s.usuario_id ORDER BY s.solicitacao_id DESC');
    $msgs = [];
    foreach ($pdo->query('SELECT m.*, a.usuario_nome AS autor FROM solicitacao_mensagem m LEFT JOIN usuario a ON a.usuario_id = m.autor_id ORDER BY m.mensagem_id')->fetchAll() as $m) {
        $msgs[$m['solicitacao_id']][] = $m;
    }
    $proj = [];
    foreach ($pdo->query('SELECT solicitacao_id, projeto_id FROM projeto WHERE solicitacao_id IS NOT NULL')->fetchAll() as $p) {
        $proj[$p['solicitacao_id']] = (int)$p['projeto_id'];
    }
    $out = [];
    foreach ($stmt->fetchAll() as $s) {
        $mensagens = [['from' => 'client', 'text' => $s['solicitacao_descricao'], 'time' => quando($s['solicitacao_criacao'])]];
        $notas = [];
        foreach ($msgs[$s['solicitacao_id']] ?? [] as $m) {
            if ((int)$m['msg_interna']) $notas[] = $m['msg_texto'];
            else $mensagens[] = ['from' => 'team', 'text' => $m['msg_texto'], 'time' => quando($m['msg_criacao']), 'author' => $m['autor']];
        }
        $out[] = [
            'id' => (int)$s['solicitacao_id'], 'title' => $s['solicitacao_empresa'], 'client' => $s['usuario_nome'],
            'project' => nome_tipo_site($s['solicitacao_tipo']), 'time' => tempo_atras($s['solicitacao_criacao']),
            'tag' => 'Novo projeto', 'tagTone' => 'neutral', 'status' => $s['solicitacao_status'],
            'assignee' => $s['solicitacao_responsavel_id'] ? (string)$s['solicitacao_responsavel_id'] : '',
            'priority' => $s['solicitacao_prioridade'], 'contactBy' => dia_mes($s['solicitacao_previsao_contato']),
            'projectId' => $proj[$s['solicitacao_id']] ?? null, 'messages' => $mensagens, 'notes' => $notas,
        ];
    }
    return $out;
}
