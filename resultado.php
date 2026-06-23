<?php 
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include "conexao.php";
    include "funcoes.php";
    $QtdMoeda = $_POST['valor'];
    $moedaOrigem = $_POST['moedaAtual'];
    $moedaDestino = $_POST['moedaConvertida'];
    echo "<h1>Moeda Atual -> " . $moedaOrigem . "</h1>";
    echo "<h1>Valor -> " . $QtdMoeda . "</h1>";
    echo "<h1>Moeda Convertida -> " . $moedaDestino . "</h1>";
    


    $valorMoedaAtual = $conexao->query("SELECT dollarValue FROM currencies Where acronym = '{$moedaOrigem}'");
    $valorMoedaConvercao = $conexao->query("SELECT dollarValue FROM currencies Where acronym = '{$moedaDestino}'");
    $vma = $valorMoedaAtual->fetch_assoc();
    $vmc = $valorMoedaConvercao->fetch_assoc();
    $va = $vma['dollarValue'];
    $vc = $vmc['dollarValue'];

    $valorConvertido = converterMoeda($va, $vc);

    $valorFinal = $QtdMoeda * $valorConvertido;

    echo "<h1>Valor convertido - >  " . number_format($valorFinal, 2) . " </h1>";

    $Moedas = $conexao->query("SELECT * FROM currencies ORDER BY dollarValue DESC");

    if ($Moedas->num_rows > 0) {
        while ($resultado = $Moedas->fetch_assoc()) {
            $MoedaConvertida = converterMoeda($va, $resultado["dollarValue"]);
            $MoedaConvertida = $MoedaConvertida * $QtdMoeda;
            if($MoedaConvertida >= Milion){
                echo "<br>". " Nome Português - > " . $resultado["namePortuguese"] . " Valor - > " . $resultado["dollarValue"] . " Sigla - > " . $resultado["acronym"] . " Convertido - > " . number_format($MoedaConvertida, 2);
                echo "<span>Você é milionário em " . $resultado["namePortuguese"] . "<span>";
            }else{
                $Falta = Milion - $MoedaConvertida;
                // $FaltaConvertida = ($Falta/$resultado["dollarValue"]) * $va;
                $FaltaConvertida = converterFaltante($Falta,$resultado["dollarValue"],$va);
                echo "<br>Falta em $moedaOrigem " . number_format($FaltaConvertida, 2) . " Para ser Milionário em " . $resultado["acronym"] . " - " . $resultado["namePortuguese"];
                break;
            }
        }
    }


    ?>
</body>

</html>