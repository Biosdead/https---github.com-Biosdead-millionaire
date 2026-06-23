<?php
include_once "./conexao.php";
include_once "moedas.php";
session_start();

include_once "./autenticador.php";

$montante = $_SESSION["montante"];
$moedaAtual = $_SESSION["moeda"];



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form id="sacar" action="./sacar.php" method="post">
        <label for="moedaAtual">Escolha sua moeda:</label>
        <select name="moedaAtual">
            <?php
            foreach ($moedas as $moeda) {
                if ($moeda['sigla'] == $moedaAtual) {
                    echo "<option value={$moeda['sigla']} selected>{$moeda['nome_pt']}</option>";
                } else {
                    echo "<option value={$moeda['sigla']}>{$moeda['nome_pt']}</option>";
                }
            }
            ?>
        </select>
        <label for="valor">Atualize seu montante:</label>
        <input type="number" placeholder="Insira o novo Valor" name="valor" value=<?php echo $montante ?> step="0.01" min="0.00">
        <input type="submit" value="Atualizar">
    </form>

    <?php
    if (isset($_POST["valor"]) || isset($_POST["moedaAtual"])) {
        if ($_POST["valor"] != $_SESSION["montante"]) {
            $_SESSION["montante"] = $_POST["valor"];
            $valor = (float) $_POST['valor'];
            $id = (int) $_SESSION['id'];

            $preparada = $conexao->prepare(
                "UPDATE users SET amount = ? WHERE id = ?"
            );

            if ($preparada) {
                $preparada->bind_param("di", $valor, $id);

                if ($preparada->execute()) {
                    // echo "Valor atualizado com sucesso!";
                    // $_SESSION["montante"] = $_POST["valor"];
                } else {
                    echo "Erro ao atualizar valor.";
                }

                $preparada->close();
            } else {
                echo "Erro na preparação da consulta.";
            }
        }
        if ($_POST["moedaAtual"] != $_SESSION["moeda"]) {
            $_SESSION["moeda"] = $_POST["moedaAtual"];
            $coin = (string) $_POST['moedaAtual'];
            $id = (int) $_SESSION['id'];

            $preparada = $conexao->prepare(
                "UPDATE users SET currencie = ? WHERE id = ?"
            );

            if ($preparada) {
                $preparada->bind_param("si", $coin, $id);

                if ($preparada->execute()) {
                    // echo "Valor atualizado com sucesso!";
                    // $_SESSION["moeda"] = $_POST["moedaAtual"];
                } else {
                    echo "Erro ao atualizar valor.";
                }

                $preparada->close();
            } else {
                echo "Erro na preparação da consulta.";
            }
        }
        echo "<script>
                            setTimeout(function(){
                                window.location.href = './dashboard.php';
                            }, 1000);
                          </script>";
    }


    ?>

</body>
<script>
    // Captura o formulário pelo ID
const formulario = document.getElementById('sacar');

formulario.addEventListener('submit', function(event) {
    // Evita que a página seja recarregada
    event.preventDefault();

    // Cria um objeto com os dados do formulário
    const formData = new FormData(formulario);

    // Envia os dados para o arquivo PHP
    fetch('sacar.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text()) // ou response.json() se o PHP retornar JSON
    .then(data => {
        // Exibe a resposta do PHP na div "resposta"
        document.getElementById('resposta').innerHTML = data;
        
        // Opcional: limpa o formulário após o envio
        formulario.reset();
        
    })
    .catch(error => console.error('Erro:', error));
    setTimeout(function(){window.location.href = './dashboard.php';}, 1000);
});

</script>

</html>