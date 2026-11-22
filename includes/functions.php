<?php
function data_hoje(bool $comAno = false, ?DateTimeInterface $data = null): string
{
    $dias  = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
    $meses = [1 => 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
              'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

    $data ??= new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

    $texto = $dias[(int)$data->format('w')] . ', '
           . $data->format('j') . ' de '
           . $meses[(int)$data->format('n')];

    return $comAno ? $texto . ' de ' . $data->format('Y') : $texto;
}

// ---------- Datas e textos em português (usados no admin e na área do cliente) ----------
const MESES_CURTOS = ['jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez'];

function agora(): DateTimeImmutable
{
    return new DateTimeImmutable('now', new DateTimeZone('America/Sao_Paulo'));
}

// "Hoje, 10:42" | "Ontem, 18:00" | "14 out, 14:05"
function quando(?string $datahora): string
{
    if (!$datahora) return '';
    $d    = new DateTimeImmutable($datahora, new DateTimeZone('America/Sao_Paulo'));
    $hoje = agora()->setTime(0, 0);
    $dias = (int)$hoje->diff($d->setTime(0, 0))->format('%r%a');
    $hora = $d->format('H:i');
    if ($dias === 0)  return "Hoje, $hora";
    if ($dias === -1) return "Ontem, $hora";
    return $d->format('d') . ' ' . MESES_CURTOS[(int)$d->format('n') - 1] . ", $hora";
}

// "5 min" | "3 h" | "Ontem" | "4 dias" | "2 sem"
function tempo_atras(?string $datahora): string
{
    if (!$datahora) return '';
    $seg = max(0, agora()->getTimestamp() - (new DateTimeImmutable($datahora, new DateTimeZone('America/Sao_Paulo')))->getTimestamp());
    if ($seg < 3600)    return max(1, intdiv($seg, 60)) . ' min';
    if ($seg < 86400)   return intdiv($seg, 3600) . ' h';
    if ($seg < 172800)  return 'Ontem';
    if ($seg < 1209600) return intdiv($seg, 86400) . ' dias';
    return intdiv($seg, 604800) . ' sem';
}

// "Hoje" | "Ontem" | "Há 3 dias" | "Nunca"  (último acesso)
function acesso_relativo(?string $datahora): string
{
    if (!$datahora) return 'Nunca';
    $d    = new DateTimeImmutable($datahora, new DateTimeZone('America/Sao_Paulo'));
    $dias = (int)agora()->setTime(0, 0)->diff($d->setTime(0, 0))->format('%a');
    if ($dias === 0) return 'Hoje';
    if ($dias === 1) return 'Ontem';
    if ($dias < 14)  return "Há $dias dias";
    return 'Há ' . intdiv($dias, 7) . ' semanas';
}

// "05 nov" a partir de 2026-11-05
function dia_mes(?string $data): string
{
    if (!$data) return '—';
    $d = new DateTimeImmutable($data);
    return $d->format('d') . ' ' . MESES_CURTOS[(int)$d->format('n') - 1];
}

function iniciais(string $nome): string
{
    $partes = preg_split('/\s+/', trim($nome)) ?: [];
    $a = mb_substr($partes[0] ?? '?', 0, 1);
    $b = count($partes) > 1 ? mb_substr(end($partes), 0, 1) : mb_substr($partes[0] ?? '', 1, 1);
    return mb_strtoupper($a . $b);
}
