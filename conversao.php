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
        include_once "moedas.php";
    ?>

    <form action="resultado.php" method="POST">
        <select name="moedaAtual">
            <?php 
            foreach ($moedas as $moeda) {
            echo  "<option value={$moeda['sigla']}>{$moeda['nome_pt']}</option>";
            }           
            ?>
        </select>
        <input type="number" placeholder="Insira o Valor para ser convertido" name="valor">
        <select name="moedaConvertida">
            <?php 
            foreach ($moedas as $moeda) {
            echo  "<option value={$moeda['sigla']}>{$moeda['nome_pt']}</option>";
            }           
            ?>
        </select>
        <input type="submit" value="Converter">
    </form>
</body>
</html>