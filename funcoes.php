<?php
const Milion = 1000000;

function converterMoeda($MoedaCorrente, $MoedaExterna) {
    return (1 / $MoedaCorrente) * $MoedaExterna;
}

function converterFaltante($Faltando, $MoedaExterna, $MoedaCorrente) {
    return ($Faltando / $MoedaExterna) * $MoedaCorrente;
}

/**
 * Formats a number >= 1,000,000 as a compact string: 4.5M, 1B, 2.3T, etc.
 */
function formatAmount(float $n): string {
    $fmt = function (float $v): string {
        return rtrim(rtrim(number_format($v, 1, '.', ''), '0'), '.');
    };
    if ($n >= 1e12) return $fmt($n / 1e12) . 'T';
    if ($n >= 1e9)  return $fmt($n / 1e9)  . 'B';
    return $fmt($n / 1e6) . 'M';
}
