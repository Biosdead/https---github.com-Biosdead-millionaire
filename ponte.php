<?php
// include "./conexao.php";
include_once "moedas.php";
date_default_timezone_set('America/Sao_Paulo');
$dataHoje = new DateTime();
$horaAgora = new DateTime();
$dataHoje = $dataHoje->format('Y-m-d');
$horaAgora = $horaAgora->format('H:i:s');

/**
 * O arquivo Ponte vai pegar os dados da api se está tiver uma data diferente da armazenada no banco de dados.
 * Ao verificar o primeiro id e ver que a data é diferente o arquivo ponte vai acessar a api e copiar os dados para o banco.
 * 
 * Plano gratuito: 1.000 req/mês, base USD, atualização de hora em hora. Sabendo disso, vou fazer uma atualização por dia
 */

$app_id = '6eaf150d31314422a7ed80f2b6b4ef74'; // Substitua pela sua chave da API
$url = "https://openexchangerates.org/api/latest.json?app_id={$app_id}";

$sql = "SELECT date FROM currencies WHERE id = 1";
$resultado = $conexao->query($sql);
$res = $resultado->fetch_assoc();
$dataDaBaseDeDados = $res['date'];


if ($dataDaBaseDeDados == $dataHoje) {
    // echo "Dados já estão atualizados <br>";
    // echo "Dia do banco $dataDaBaseDeDados <br>";
    // echo "Dia de Hoje $dataHoje";
} else {
    $json = file_get_contents($url);



    //Salva no banco de dados o Json
    $stmt = $conexao->prepare("INSERT INTO jsonscurrencies (json, date, time) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $json, $dataHoje, $horaAgora);
    $stmt->execute();
    $stmt->close();



    // Decodifica o JSON
    $dados = json_decode($json, true);

    // Verifica erro retornado pela API
    if (isset($dados['error']) && $dados['error']) {
        die("Erro da API: " . $dados['message']);
    }

    // Dados retornados
    $moeda_base = $dados['base'];                         // "USD"
    // $atualizado = date('d/m/Y H:i', $dados['timestamp']); // Data da última atualização
    $taxas = $dados['rates'];                         // Array com todas as moedas


    // Exibe os resultados
    echo "Base: 1 {$moeda_base} — Atualizado em: {$dataHoje}\n\n";

    $id = 1;
    $nameEnglish = '';
    $namePortuguese = '';
    $acronym = '';
    $dollarValue;
    // $atualizado = new date('d/m/y');
    $horaApi = $dados['timestamp'];

    // $stmtMoeda = $conexao->prepare("UPDATE currencies SET (nameEnglish, namePortuguese, acronym, dollarValue, date, time) VALUES (?, ?, ?, ?, ?, ?)");
    $stmtMoeda = $conexao->prepare("UPDATE currencies SET dollarValue = ?, date = ?, time = ? WHERE id = ?");
    $stmtMoeda->bind_param("dssi", $dollarValue, $dataHoje, $horaApi, $id);


    foreach ($taxas as $codigo => $valor) {
        echo "$id -  1 USD = {$valor} {$codigo}\n";
        // $nameEnglish = $moedas[$id]['nome_en'];
        // $namePortuguese = $moedas[$id]['nome_pt'];
        // $acronym = $codigo;
        $dollarValue = $valor;
        $stmtMoeda->execute();
        $id++;


    }

}






?>