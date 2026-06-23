<?php
include_once "../conexao.php";
// Devolve um JSON como Lista contendo todas as moedas do banco.  

$querySelecionaTodas = "SELECT * FROM currencies";

$retorno = $conexao->query($querySelecionaTodas);

$retorno = $retorno->fetch_all();

// var_dump($retorno);

echo json_encode($retorno, JSON_PRETTY_PRINT);

