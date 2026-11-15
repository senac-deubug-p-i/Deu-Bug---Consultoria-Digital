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
                solicitacao_previsao_contato
           FROM solicitacao_projeto
          WHERE usuario_id = :id AND solicitacao_status IN ('pendente', 'em_contato')
          ORDER BY solicitacao_id DESC"
    );
    $stmt->execute(['id' => $usuarioId]);
    return $stmt->fetchAll();
}
