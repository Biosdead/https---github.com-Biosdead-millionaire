<?php
include_once "./conexao.php";
session_start();


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="email" placeholder="Insira seu email" required>
        <input type="password" name="password" placeholder="Insira sua senha" required>
        <input type="submit" value="Enviar">
        <a href="./cadastrar.php">Caso não possua login. Cadastre-se aqui!</a>
    </form>

    <?php

    if (isset($_POST["email"]) && isset($_POST["password"])) {
        // if (isset($_POST["email"])) {
    
        $email = $_POST["email"];
        $password = $_POST["password"];


        $preparada = $conexao->prepare(
            "SELECT * FROM users WHERE email = ? LIMIT 1"
            // "SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1"
        );

        if ($preparada) {

            // $preparada->bind_param("ss", $email, $password);
            $preparada->bind_param("s", $email);

            if ($preparada->execute()) {

                $resultado = $preparada->get_result();

                if ($resultado->num_rows > 0) {

                    $usuario = $resultado->fetch_assoc();

                    if (password_verify($password, $usuario["password"])) {
                        echo "<p>Login realizado com sucesso! <br> Redirecionando para sua dashboard.</p>";
                        echo "Você será redirecionado em 1 segundos...";

                        // Exemplo de acesso aos dados:
                        $_SESSION["id"] = $usuario["id"];
                        $_SESSION["nome"] = $usuario["name"];
                        $_SESSION["email"] = $usuario["email"];
                        $_SESSION["moeda"] = $usuario["currencie"];
                        $_SESSION["montante"] = $usuario["amount"];

                        echo "<p>Login realizado com sucesso! <br> Redirecionando para sua dashboard.</p>";
                        echo "Você será redirecionado em 2 segundos...";

                        echo "<script>
                            setTimeout(function(){
                                window.location.href = './dashboard.php';
                            }, 1000);
                          </script>";

                        exit;
                    } else {
                        echo "Dados não encontrados. Tente novamente!";
                    }


                } else {
                    echo "Dados não encontrados. Tente novamente!";

                }

            } else {
                echo "Erro ao executar a consulta.";
            }

            $preparada->close();

        } else {
            echo "Erro ao preparar a consulta: " . $conexao->error;
        }
    }

    ?>

</body>

</html>