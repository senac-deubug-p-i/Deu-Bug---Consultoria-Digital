<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../config/database.php';

const PRAZO_CONTATO_DIAS_UTEIS = 2;    // equipe retorna em até 2 dias úteis
const LIMITE_SOLICITACOES_ABERTAS = 5; // evita envio em massa

// Tipos de site do dropdown. Para adicionar um tipo novo, basta incluir uma linha aqui.
function tipos_de_site(): array
{
    return [
        'landing_page' => 'Landing Page',
        'ecommerce'    => 'E-commerce (loja virtual)',
        'institucional'=> 'Site institucional',
        'portfolio'    => 'Portfólio',
        'blog'         => 'Blog / conteúdo',
        'sistema_web'  => 'Sistema web',
        'outro'        => 'Outro',
    ];
}

function nome_tipo_site(string $chave): string
{
    return tipos_de_site()[$chave] ?? 'Outro';
}

// Soma dias ÚTEIS (segunda a sexta) a partir de hoje. Feriados não são considerados.
function previsao_contato(int $diasUteis = PRAZO_CONTATO_DIAS_UTEIS, ?DateTimeImmutable $base = null): DateTimeImmutable
{
    $data = $base ?? new DateTimeImmutable('now', new DateTimeZone('America/Sao_Paulo'));
    while ($diasUteis > 0) {
        $data = $data->modify('+1 day');
        if ((int)$data->format('w') !== 0 && (int)$data->format('w') !== 6) {
            $diasUteis--;
        }
    }
    return $data;
}

// 17/11/2026  ou, com $comDia, 17/11/2026 (terça-feira)
function data_br(DateTimeInterface|string $data, bool $comDia = false): string
{
    if (is_string($data)) $data = new DateTimeImmutable($data);
    $texto = $data->format('d/m/Y');
    if ($comDia) {
        $dias = ['domingo', 'segunda-feira', 'terça-feira', 'quarta-feira', 'quinta-feira', 'sexta-feira', 'sábado'];
        $texto .= ' (' . $dias[(int)$data->format('w')] . ')';
    }
    return $texto;
}

function contar_solicitacoes_abertas(PDO $pdo, int $usuarioId): int
{
    $stmt = $pdo->prepare(
        "SELECT COUNT(*) FROM solicitacao_projeto
          WHERE usuario_id = :id AND solicitacao_status IN ('pendente', 'em_contato')"
    );
    $stmt->execute(['id' => $usuarioId]);
    return (int)$stmt->fetchColumn();
}

function solicitacoes_abertas(PDO $pdo, int $usuarioId): array
{
    $stmt = $pdo->prepare(
        "SELECT solicitacao_id, solicitacao_empresa, solicitacao_tipo, solicitacao_status,
                solicitacao_previsao_contato,
                (SELECT m.msg_texto FROM solicitacao_mensagem m
                  WHERE m.solicitacao_id = solicitacao_projeto.solicitacao_id AND m.msg_interna = 0
                  ORDER BY m.mensagem_id DESC LIMIT 1) AS ultima_resposta
           FROM solicitacao_projeto
          WHERE usuario_id = :id AND solicitacao_status IN ('pendente', 'em_contato')
          ORDER BY solicitacao_id DESC"
    );
    $stmt->execute(['id' => $usuarioId]);
    return $stmt->fetchAll();
}


// =====================================================================
// PROJETOS (compartilhado entre a área do cliente e o admin)
// =====================================================================
const ETAPAS           = ['Briefing', 'Design', 'Desenvolvimento', 'Revisão', 'Publicado'];
const ETAPA_PROGRESSO  = [8, 35, 62, 88, 100];          // progresso padrão ao entrar em cada etapa
const ETAPA_PUBLICADO  = 4;
const CAPACIDADE_EQUIPE = 6;                             // projetos simultâneos por pessoa (carga da equipe)

function nome_etapa(int $etapa): string
{
    return ETAPAS[$etapa] ?? 'Briefing';
}

// Registra uma linha no log de atualizações da equipe
function registrar_atualizacao(PDO $pdo, int $projetoId, ?int $autorId, string $titulo,
                               ?string $mensagem = null, bool $visivel = true, string $cor = 'blue'): void
{
    $pdo->prepare(
        'INSERT INTO projeto_atualizacao
            (projeto_id, autor_id, atualizacao_titulo, atualizacao_mensagem, atualizacao_visivel, atualizacao_cor, atualizacao_criacao)
         VALUES (:p, :a, :t, :m, :v, :c, :q)'
    )->execute([
        'p' => $projetoId, 'a' => $autorId, 't' => $titulo, 'm' => $mensagem,
        'v' => $visivel ? 1 : 0, 'c' => $cor, 'q' => agora()->format('Y-m-d H:i:s'),
    ]);
}

// Projetos ativos (não publicados) do cliente
function projetos_do_cliente(PDO $pdo, int $usuarioId): array
{
    $stmt = $pdo->prepare(
        'SELECT p.projeto_id, p.projeto_titulo, p.projeto_empresa, p.projeto_tipo, p.projeto_etapa,
                p.projeto_progresso, p.projeto_prazo, p.projeto_pausado, r.usuario_nome AS responsavel
           FROM projeto p
           LEFT JOIN usuario r ON r.usuario_id = p.responsavel_id
          WHERE p.usuario_id = :id
          ORDER BY p.projeto_id DESC'
    );
    $stmt->execute(['id' => $usuarioId]);
    return $stmt->fetchAll();
}

function aprovacoes_pendentes_cliente(PDO $pdo, int $usuarioId): array
{
    $stmt = $pdo->prepare(
        "SELECT a.aprovacao_id, a.aprovacao_titulo, a.aprovacao_descricao, a.aprovacao_prazo,
                p.projeto_titulo, p.projeto_empresa
           FROM projeto_aprovacao a
           JOIN projeto p ON p.projeto_id = a.projeto_id
          WHERE p.usuario_id = :id AND a.aprovacao_status = 'pendente'
          ORDER BY a.aprovacao_id DESC"
    );
    $stmt->execute(['id' => $usuarioId]);
    return $stmt->fetchAll();
}

// Só o que a equipe marcou como visível para o cliente
function atividade_do_cliente(PDO $pdo, int $usuarioId, int $limite = 6): array
{
    $stmt = $pdo->prepare(
        'SELECT u.atualizacao_titulo, u.atualizacao_cor, u.atualizacao_criacao, p.projeto_titulo, a.usuario_nome AS autor
           FROM projeto_atualizacao u
           JOIN projeto p ON p.projeto_id = u.projeto_id
           LEFT JOIN usuario a ON a.usuario_id = u.autor_id
          WHERE p.usuario_id = :id AND u.atualizacao_visivel = 1
          ORDER BY u.atualizacao_id DESC
          LIMIT ' . (int)$limite
    );
    $stmt->execute(['id' => $usuarioId]);
    return $stmt->fetchAll();
}

// Números dos cards do painel do cliente
function resumo_do_cliente(PDO $pdo, int $usuarioId): array
{
    $projetos = array_filter(projetos_do_cliente($pdo, $usuarioId), fn($p) => (int)$p['projeto_etapa'] < ETAPA_PUBLICADO);
    $proxima  = null;
    foreach ($projetos as $p) {
        if ($p['projeto_prazo'] && ($proxima === null || $p['projeto_prazo'] < $proxima['projeto_prazo'])) $proxima = $p;
    }
    $pendencias = aprovacoes_pendentes_cliente($pdo, $usuarioId);
    return [
        'ativos'       => count($projetos),
        'proxima'      => $proxima,
        'pendencias'   => $pendencias,
        'solicitacoes' => contar_solicitacoes_abertas($pdo, $usuarioId),
    ];
}
