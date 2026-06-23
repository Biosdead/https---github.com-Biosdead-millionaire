<?php 
const Milion = 1000000;
function converterMoeda($MoedaCorrente, $MoedaExterna){
    return (1/$MoedaCorrente) * $MoedaExterna;
    // return $MoedaCorrente / $MoedaExterna;
}

function converterFaltante($Faltando, $MoedaExterna,  $MoedaCorrente){
    return ($Faltando/$MoedaExterna) * $MoedaCorrente;
}   


?>