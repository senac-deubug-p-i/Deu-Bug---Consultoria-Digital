<?php
// API do admin para SOLICITAÇÕES de projeto: responder, nota interna, mudar situação/responsável/prioridade.
require_once __DIR__ . '/../../includes/admin-dados.php';

$d   = api_iniciar();
$pdo = conectar();
$eu  = (int)$_SESSION['usuario_id'];

function solicitacao_existe(PDO $pdo, ?int $id): array
{
    if (!$id) api_erro('Solicitação inválida.');
    $s = $pdo->prepare('SELECT * FROM solicitacao_projeto WHERE solicitacao_id = :id');
    $s->execute(['id' => $id]);
    return $s->fetch() ?: api_erro('Solicitação não encontrada.', 404);
}

switch ((string)($d['acao'] ?? '')) {
    case 'responder':
    case 'nota':
        $s = solicitacao_existe($pdo, api_int($d, 'id'));
        $texto = api_texto($d, 'texto', 3000);
        if ($texto === '') api_erro('Escreva uma mensagem primeiro.');
        $interna = $d['acao'] === 'nota' ? 1 : 0;
        $pdo->prepare('INSERT INTO solicitacao_mensagem (solicitacao_id, autor_id, msg_texto, msg_interna, msg_criacao) VALUES (:s, :a, :t, :i, :q)')
            ->execute(['s' => $s['solicitacao_id'], 'a' => $eu, 't' => $texto, 'i' => $interna, 'q' => agora()->format('Y-m-d H:i:s')]);
        $status = $s['solicitacao_status'];
        if (!$interna && $status === 'pendente') {          // primeira resposta = equipe já entrou em contato
            $status = 'em_contato';
            $pdo->prepare('UPDATE solicitacao_projeto SET solicitacao_status = :st WHERE solicitacao_id = :id')->execute(['st' => $status, 'id' => $s['solicitacao_id']]);
        }
        api_responder(['ok' => true, 'status' => $status]);

    case 'salvar':
        $s = solicitacao_existe($pdo, api_int($d, 'id'));
        $status = (string)($d['status'] ?? '');
        if (!in_array($status, ['pendente', 'em_contato', 'aprovada', 'recusada'], true)) api_erro('Situação inválida.');
        $prio = (string)($d['prioridade'] ?? 'normal');
        if (!in_array($prio, ['baixa', 'normal', 'alta'], true)) api_erro('Prioridade inválida.');
        $resp = api_int($d, 'responsavel_id');
        if ($resp) {
            $c = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE usuario_id = :id AND usuario_tipo = 'admin'");
            $c->execute(['id' => $resp]);
            if (!$c->fetchColumn()) api_erro('Responsável inválido.');
        }
        $jaAprovada = $s['solicitacao_status'] === 'aprovada';
        if ($jaAprovada && $status !== 'aprovada') api_erro('Esta solicitação já virou projeto. Gerencie pela tela de Projetos.');

        $pdo->beginTransaction();
        $pdo->prepare('UPDATE solicitacao_projeto SET solicitacao_status = :st, solicitacao_responsavel_id = :r, solicitacao_prioridade = :p WHERE solicitacao_id = :id')
            ->execute(['st' => $status, 'r' => $resp, 'p' => $prio, 'id' => $s['solicitacao_id']]);

        $projetoId = null;
        if ($status === 'aprovada' && !$jaAprovada) {       // aprovar = criar o projeto de verdade
            $titulo = nome_tipo_site($s['solicitacao_tipo']) . ' ' . $s['solicitacao_empresa'];
            $pdo->prepare('INSERT INTO projeto (usuario_id, solicitacao_id, responsavel_id, projeto_titulo, projeto_empresa, projeto_tipo, projeto_etapa, projeto_progresso, projeto_prazo, projeto_inicio)
                           VALUES (:u, :s, :r, :t, :e, :tp, 0, 0, :pz, :i)')
                ->execute(['u' => $s['usuario_id'], 's' => $s['solicitacao_id'], 'r' => $resp, 't' => mb_substr($titulo, 0, 150), 'e' => $s['solicitacao_empresa'],
                           'tp' => $s['solicitacao_tipo'], 'pz' => agora()->modify('+30 days')->format('Y-m-d'), 'i' => agora()->format('Y-m-d')]);
            $projetoId = (int)$pdo->lastInsertId();
            registrar_atualizacao($pdo, $projetoId, $eu, 'Solicitação aprovada: projeto iniciado', null, true, 'green');
        }
        $pdo->commit();
        api_responder(['ok' => true, 'projetoId' => $projetoId]);

    default:
        api_erro('Ação desconhecida.');
}
