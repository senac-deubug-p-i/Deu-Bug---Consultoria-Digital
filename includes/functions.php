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