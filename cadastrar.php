<?php
include_once "./conexao.php";
include_once "moedas.php";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="./cadastrar.php" method="post">
        <input type="text" name="name" placeholder="Insira seu nome" required>
        <input type="text" name="email" placeholder="Insira seu email" required>
        <input type="password" name="password" placeholder="Insira sua senha" required>
        <input type="password" name="confirmPassword" placeholder="Confirme sua senha" required>
        <label for="moedaAtual">Escolha sua Moeda: </label>
        <select name="currencie" required>
            <?php
            foreach ($moedas as $moeda) {
                echo "<option value={$moeda['sigla']}>{$moeda['nome_pt']}</option>";
            }
            ?>
        </select>
        <input type="number" name="amount" step="0.01" min="0.00"
            placeholder="Insira quanto você tem guardado para sua reserva de Emergência: " required>
        <input type="submit" value="Enviar">
        <a href="./login.php">Caso já possua cadastro. Faça o login clicando aqui!</a>
    </form>

    <?php
    if (isset($_POST["name"]) && ($_POST["password"] == $_POST["confirmPassword"])) {


        $email = $_POST["email"];
        $preparada = $conexao->prepare(
            "SELECT * FROM users WHERE email = ? LIMIT 1"
        );
        $preparada->bind_param("s", $email);
        $preparada->execute();
        $preparada->store_result();

        if ($preparada->num_rows > 0) {

            echo "Email já existe tente outro!";
        } else {


            $senhaHash = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $preparada = $conexao->prepare("INSERT INTO users (name, password, email, currencie, amount) VALUES (?, ?, ?, ?, ?)");
            $preparada->bind_param("ssssd", $_POST["name"], $senhaHash, $_POST["email"], $_POST["currencie"], $_POST["amount"]);
            if ($preparada->execute()) {
                echo "<p>Dados cadastrados com sucesso! <br> Redirecionando para o Login.</p>";
                echo "Você será redirecionado em 2 segundos...";

                // Executa o redirecionamento após 3000 milissegundos
                echo "<script>
                    setTimeout(function(){
                        window.location.href = './login.php';
                            }, 2000);
                        </script>";
                exit;
            }
        }
    }

    ?>
</body>

</html>