<?php
// API do admin para PROJETOS. O JavaScript envia { acao: '...', ... } por fetch (POST + JSON).
require_once __DIR__ . '/../../includes/admin-dados.php';

$d   = api_iniciar();
$pdo = conectar();
$eu  = (int)$_SESSION['usuario_id'];
$acao = (string)($d['acao'] ?? '');

const PASTA_UPLOAD  = __DIR__ . '/../../uploads/projetos';
const MAX_UPLOAD    = 10 * 1024 * 1024;
const EXT_PERMITIDAS = ['pdf', 'png', 'jpg', 'jpeg', 'gif', 'webp', 'zip', 'txt', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

function projeto_existe(PDO $pdo, ?int $id): array
{
    if (!$id) api_erro('Projeto inválido.');
    $s = $pdo->prepare('SELECT * FROM projeto WHERE projeto_id = :id');
    $s->execute(['id' => $id]);
    return $s->fetch() ?: api_erro('Projeto não encontrado.', 404);
}

function responsavel_valido(PDO $pdo, ?int $id): ?int
{
    if (!$id) return null;
    $s = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE usuario_id = :id AND usuario_tipo = 'admin'");
    $s->execute(['id' => $id]);
    return $s->fetchColumn() ? $id : api_erro('Responsável inválido.');
}

function data_valida(string $v): ?string
{
    $x = DateTimeImmutable::createFromFormat('!Y-m-d', $v);
    return $x && $x->format('Y-m-d') === $v ? $v : null;
}

function mover(PDO $pdo, array $p, int $etapa, int $eu): array
{
    if ($etapa < 0 || $etapa > ETAPA_PUBLICADO) api_erro('Etapa inválida.');
    $de = (int)$p['projeto_etapa'];
    $tag = $p['projeto_tag']; $estilo = $p['projeto_tag_estilo']; $pub = $p['projeto_publicado_em'];
    if ($etapa === ETAPA_PUBLICADO) {
        $hoje = agora();
        $tag = 'No ar desde ' . $hoje->format('d') . ' ' . MESES_CURTOS[(int)$hoje->format('n') - 1];
        $estilo = 'ok'; $pub = $hoje->format('Y-m-d');
    } elseif ($de === ETAPA_PUBLICADO) {
        $tag = $estilo = $pub = null;
    }
    $prog = ETAPA_PROGRESSO[$etapa];
    $pdo->prepare('UPDATE projeto SET projeto_etapa = :e, projeto_progresso = :g, projeto_tag = :t, projeto_tag_estilo = :s, projeto_publicado_em = :b WHERE projeto_id = :id')
        ->execute(['e' => $etapa, 'g' => $prog, 't' => $tag, 's' => $estilo, 'b' => $pub, 'id' => $p['projeto_id']]);
    if ($de !== $etapa) {
        registrar_atualizacao($pdo, (int)$p['projeto_id'], $eu, 'Projeto avançou para ' . nome_etapa($etapa), null,
            $etapa === ETAPA_PUBLICADO, $etapa === ETAPA_PUBLICADO ? 'green' : 'blue');
    }
    return ['etapa' => $etapa, 'progresso' => $prog, 'tag' => $tag, 'tagEstilo' => $estilo];
}

switch ($acao) {
    case 'mover':
        $p = projeto_existe($pdo, api_int($d, 'id'));
        api_responder(['ok' => true] + mover($pdo, $p, (int)api_int($d, 'etapa'), $eu));

    case 'criar':
        $titulo = api_texto($d, 'titulo', 150);
        $cliente = api_int($d, 'cliente_id');
        if ($titulo === '' || !$cliente) api_erro('Preencha título e cliente.');
        $c = $pdo->prepare("SELECT usuario_nome, usuario_empresa FROM usuario WHERE usuario_id = :id AND usuario_tipo = 'cliente'");
        $c->execute(['id' => $cliente]);
        $cli = $c->fetch() ?: api_erro('Cliente não encontrado.');
        $etapa = (int)(api_int($d, 'etapa') ?? 0);
        if ($etapa < 0 || $etapa >= ETAPA_PUBLICADO) api_erro('Etapa inválida.');
        $prazo = data_valida((string)($d['prazo'] ?? '')) ?? agora()->modify('+14 days')->format('Y-m-d');
        $resp = responsavel_valido($pdo, api_int($d, 'responsavel_id'));
        $pdo->prepare('INSERT INTO projeto (usuario_id, responsavel_id, projeto_titulo, projeto_empresa, projeto_etapa, projeto_progresso, projeto_prazo, projeto_inicio)
                       VALUES (:u, :r, :t, :e, :et, :g, :pz, :i)')
            ->execute(['u' => $cliente, 'r' => $resp, 't' => $titulo, 'e' => $cli['usuario_empresa'] ?: $cli['usuario_nome'],
                       'et' => $etapa, 'g' => ETAPA_PROGRESSO[$etapa] > 8 ? ETAPA_PROGRESSO[$etapa] : 0, 'pz' => $prazo, 'i' => agora()->format('Y-m-d')]);
        $id = (int)$pdo->lastInsertId();
        registrar_atualizacao($pdo, $id, $eu, 'Projeto criado', null, true, 'blue');
        api_responder(['ok' => true, 'projeto' => admin_projetos_um($pdo, $id)]);

    case 'pausar':
        $p = projeto_existe($pdo, api_int($d, 'id'));
        $novo = !empty($d['pausado']) ? 1 : 0;
        $pdo->prepare('UPDATE projeto SET projeto_pausado = :v WHERE projeto_id = :id')->execute(['v' => $novo, 'id' => $p['projeto_id']]);
        registrar_atualizacao($pdo, (int)$p['projeto_id'], $eu, $novo ? 'Projeto pausado' : 'Projeto retomado', null, false, 'yellow');
        api_responder(['ok' => true, 'pausado' => (bool)$novo]);

    case 'responsavel':
        $p = projeto_existe($pdo, api_int($d, 'id'));
        $resp = responsavel_valido($pdo, api_int($d, 'responsavel_id'));
        $pdo->prepare('UPDATE projeto SET responsavel_id = :r WHERE projeto_id = :id')->execute(['r' => $resp, 'id' => $p['projeto_id']]);
        api_responder(['ok' => true]);

    case 'prazo':
        $p = projeto_existe($pdo, api_int($d, 'id'));
        $prazo = data_valida((string)($d['prazo'] ?? '')) ?? api_erro('Data inválida.');
        $pdo->prepare('UPDATE projeto SET projeto_prazo = :d WHERE projeto_id = :id')->execute(['d' => $prazo, 'id' => $p['projeto_id']]);
        registrar_atualizacao($pdo, (int)$p['projeto_id'], $eu, 'Prazo alterado para ' . data_br($prazo), null, false, 'yellow');
        api_responder(['ok' => true]);

    case 'tarefa_criar':
        $p = projeto_existe($pdo, api_int($d, 'id'));
        $titulo = api_texto($d, 'titulo', 200);
        if ($titulo === '') api_erro('Informe o nome da tarefa.');
        $pdo->prepare('INSERT INTO projeto_tarefa (projeto_id, responsavel_id, tarefa_titulo) VALUES (:p, :r, :t)')
            ->execute(['p' => $p['projeto_id'], 'r' => $eu, 't' => $titulo]);
        $nome = $pdo->prepare('SELECT usuario_nome FROM usuario WHERE usuario_id = :id'); $nome->execute(['id' => $eu]);
        api_responder(['ok' => true, 'tarefa' => ['id' => (int)$pdo->lastInsertId(), 'title' => $titulo, 'owner' => primeiro_nome((string)$nome->fetchColumn()), 'done' => false]]);

    case 'tarefa_alternar':
        $tid = api_int($d, 'tarefa_id');
        $s = $pdo->prepare('SELECT tarefa_id, tarefa_concluida FROM projeto_tarefa WHERE tarefa_id = :id');
        $s->execute(['id' => $tid]);
        $t = $s->fetch() ?: api_erro('Tarefa não encontrada.', 404);
        $novo = $t['tarefa_concluida'] ? 0 : 1;
        $pdo->prepare('UPDATE projeto_tarefa SET tarefa_concluida = :v WHERE tarefa_id = :id')->execute(['v' => $novo, 'id' => $t['tarefa_id']]);
        api_responder(['ok' => true, 'done' => (bool)$novo]);

    case 'lembrete':
        $p = projeto_existe($pdo, api_int($d, 'id'));
        $s = $pdo->prepare("SELECT aprovacao_id, aprovacao_titulo FROM projeto_aprovacao WHERE projeto_id = :id AND aprovacao_status = 'pendente' ORDER BY aprovacao_id DESC LIMIT 1");
        $s->execute(['id' => $p['projeto_id']]);
        $a = $s->fetch() ?: api_erro('Não há aprovação pendente neste projeto.');
        $pdo->prepare('UPDATE projeto_aprovacao SET aprovacao_lembrete_em = :q WHERE aprovacao_id = :id')
            ->execute(['q' => agora()->format('Y-m-d H:i:s'), 'id' => $a['aprovacao_id']]);
        registrar_atualizacao($pdo, (int)$p['projeto_id'], $eu, 'Lembrete de aprovação registrado: ' . $a['aprovacao_titulo'], null, false, 'yellow');
        api_responder(['ok' => true]);

    case 'atualizar':   // multipart/form-data: titulo, mensagem, visivel, pedir_aprovacao, arquivo ($_FILES)
        $p = projeto_existe($pdo, api_int($d, 'id'));
        $titulo = api_texto($d, 'titulo', 200); $msg = api_texto($d, 'mensagem', 3000);
        if ($titulo === '' || $msg === '') api_erro('Preencha título e mensagem.');
        $visivel = !empty($d['visivel']) && $d['visivel'] !== '0' && $d['visivel'] !== 'false';
        $pedir   = !empty($d['pedir_aprovacao']) && $d['pedir_aprovacao'] !== '0' && $d['pedir_aprovacao'] !== 'false';
        if ($pedir && !$visivel) api_erro('Para pedir aprovação, a atualização precisa ficar visível para o cliente.');

        $arquivo = null;
        if (!empty($_FILES['arquivo']) && $_FILES['arquivo']['error'] !== UPLOAD_ERR_NO_FILE) {
            $f = $_FILES['arquivo'];
            if ($f['error'] !== UPLOAD_ERR_OK)  api_erro('Falha no envio do arquivo (código ' . $f['error'] . ').');
            if ($f['size'] > MAX_UPLOAD)        api_erro('Arquivo maior que 10 MB.');
            $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, EXT_PERMITIDAS, true)) api_erro('Tipo de arquivo não permitido.');
            if (!is_uploaded_file($f['tmp_name']) && !defined('TESTE_UPLOAD')) api_erro('Upload inválido.');
            if (!is_dir(PASTA_UPLOAD)) {
                mkdir(PASTA_UPLOAD, 0775, true);
                file_put_contents(PASTA_UPLOAD . '/.htaccess', "Require all denied\n");   // ninguém abre pela URL
            }
            $salvo = bin2hex(random_bytes(16)) . '.' . $ext;
            $ok = defined('TESTE_UPLOAD') ? rename($f['tmp_name'], PASTA_UPLOAD . '/' . $salvo) : move_uploaded_file($f['tmp_name'], PASTA_UPLOAD . '/' . $salvo);
            if (!$ok) api_erro('Não foi possível salvar o arquivo.', 500);
            $arquivo = ['salvo' => $salvo, 'original' => mb_substr(basename($f['name']), 0, 255), 'tamanho' => (int)$f['size']];
        }

        $pdo->beginTransaction();
        registrar_atualizacao($pdo, (int)$p['projeto_id'], $eu, $titulo, $msg, $visivel, $visivel ? 'blue' : 'yellow');
        $resp = ['ok' => true];
        if ($pedir) {
            $pdo->prepare('INSERT INTO projeto_aprovacao (projeto_id, aprovacao_titulo, aprovacao_descricao, aprovacao_prazo, aprovacao_criacao)
                           VALUES (:p, :t, :d, :pz, :q)')
                ->execute(['p' => $p['projeto_id'], 't' => $titulo, 'd' => $msg, 'pz' => agora()->modify('+3 days')->format('Y-m-d'), 'q' => agora()->format('Y-m-d H:i:s')]);
        }
        if ($arquivo) {
            $pdo->prepare('INSERT INTO projeto_arquivo (projeto_id, enviado_por, arquivo_nome_original, arquivo_nome_salvo, arquivo_tamanho, arquivo_criacao)
                           VALUES (:p, :u, :o, :s, :t, :q)')
                ->execute(['p' => $p['projeto_id'], 'u' => $eu, 'o' => $arquivo['original'], 's' => $arquivo['salvo'], 't' => $arquivo['tamanho'], 'q' => agora()->format('Y-m-d H:i:s')]);
            $resp['arquivo'] = ['id' => (int)$pdo->lastInsertId(), 'name' => $arquivo['original'], 'size' => formatar_tamanho($arquivo['tamanho'])];
        }
        $pdo->commit();
        $nome = $pdo->prepare('SELECT usuario_nome FROM usuario WHERE usuario_id = :id'); $nome->execute(['id' => $eu]);
        $resp['historico'] = formatar_historico(['atualizacao_titulo' => $titulo, 'atualizacao_visivel' => $visivel, 'atualizacao_cor' => $visivel ? 'blue' : 'yellow',
                              'atualizacao_criacao' => agora()->format('Y-m-d H:i:s'), 'autor' => $nome->fetchColumn()]);
        $resp['pedirAprovacao'] = $pedir;
        api_responder($resp);

    default:
        api_erro('Ação desconhecida.');
}

function admin_projetos_um(PDO $pdo, int $id): array
{
    $s = $pdo->prepare(SQL_PROJETO . ' WHERE p.projeto_id = :id');
    $s->execute(['id' => $id]);
    return projeto_para_js($s->fetch(), agora()->format('Y-m-d'));
}
