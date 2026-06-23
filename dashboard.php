<?php
session_start();
include_once "./autenticador.php";

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,
        tr,
        th,
        td {
            background-color: green;
            color: whitesmoke;
            border: 4px, solid, gold;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 20px;
        }
    </style>
</head>

<body>
    <nav>
        <a href="./sacar.php">Sacar e Depositar</a>
        <a href="./dashboard.php?acao=sair">Sair</a>
        <a href="./apagar.php">Apagar Conta</a>
    </nav>

    <?php
    include "conexao.php";
    include "funcoes.php";
    $QtdMoeda = $_SESSION["montante"];
    $moedaOrigem = $_SESSION["moeda"];
    echo "<h1>Seja Bem-Vindo -> " . $_SESSION["nome"] . "</h1>";
    echo "<h2>Moeda Atual -> " . $moedaOrigem . "</h2>";
    echo "<h1>Valor -> " . number_format($QtdMoeda, 2) . "</h1>";
    date_default_timezone_set('America/Sao_Paulo');


    $dataAtual = new DateTime();
    $horaAtual = new DateTime();
    echo " Data: ";
    echo $dataAtual->format('d/m/y');
    echo " Horas: ";
    echo $horaAtual->format('H:i:s');



    $valorMoedaAtual = $conexao->query("SELECT dollarValue FROM currencies Where acronym = '{$moedaOrigem}'");
    $vma = $valorMoedaAtual->fetch_assoc();
    $va = $vma['dollarValue'];


    $Moedas = $conexao->query("SELECT * FROM currencies ORDER BY dollarValue DESC");
    $QuantidadePaisesMilionarios = 0;

    if ($Moedas->num_rows > 0) {
        echo "<table><tr><th>Moeda</th><th>Sigla</th><th>Valor</th><th>Milionário</th></tr>";
        while ($resultado = $Moedas->fetch_assoc()) {
            $MoedaConvertida = converterMoeda($va, $resultado["dollarValue"]);
            $MoedaConvertida = $MoedaConvertida * $QtdMoeda;
            if ($MoedaConvertida >= Milion) {
                echo "<tr>" . "<td>" . $resultado["namePortuguese"] . "</td>" . "<td>" . $resultado["acronym"] . "</td>" . "<td>" . number_format($MoedaConvertida, 2) . "</td><td>Sim</td></tr>";
                $QuantidadePaisesMilionarios++;

            } else {
                $Falta = Milion - $MoedaConvertida;
                // $FaltaConvertida = ($Falta/$resultado["dollarValue"]) * $va;
                $FaltaConvertida = converterFaltante($Falta, $resultado["dollarValue"], $va);
                echo "<br>Falta em $moedaOrigem " . number_format($FaltaConvertida, 2) . " Para ser Milionário em " . $resultado["acronym"] . " - " . $resultado["namePortuguese"];
                echo "<br>Parabéns - Você é Milionário em $QuantidadePaisesMilionarios Países";
                break;
            }
        }
        echo "</table>";
    }


    if (isset($_GET['acao']) && $_GET['acao'] == 'sair') {
        session_unset();
        session_destroy();
        echo "<script>
                    setTimeout(function(){
                        window.location.href = './login.php';
                            }, 1000);
                        </script>";
    }




    ?>
</body>

</html>