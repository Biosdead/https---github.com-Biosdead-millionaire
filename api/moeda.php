<?php
include_once "../conexao.php";
// Devolve um JSON contendo uma moedas do banco através do parâmetro sigla.

if (isset($_REQUEST["sigla"])) {
    $querySelecionaMoeda = "SELECT * FROM currencies WHERE acronym = '$_REQUEST[sigla]'";
    $retorno = $conexao->query($querySelecionaMoeda);
    if ($retorno->num_rows > 0) {
        $retorno = $retorno->fetch_all();
        echo json_encode($retorno, JSON_PRETTY_PRINT);
    }else{
        echo "Dado incorreto. Você precisa passar o parâmetro sigla pela url. Exemplo: moeda.php?sigla=BRL";
    }
} else {
    echo "Precisa passar o parâmetro sigla pela url. Exemplo: moeda.php?sigla=BRL";
}


