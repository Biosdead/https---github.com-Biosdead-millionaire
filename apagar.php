<?php
include_once "./conexao.php";
session_start();

include_once "./autenticador.php";

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .erro {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Para Apagar sua conta digite sua senha:</h1>
    <form action="" method="post">
        <input type="password" name="password" placeholder="Insira sua senha" required>
        <input type="submit" value="Apagar">
        <a href="./dashboard.php">Voltar para sua Conta!</a>
    </form>

    <?php

    if (isset($_POST["password"])) {

        $password = $_POST["password"];
        $id = (int) $_SESSION["id"];

        $preparada = $conexao->prepare(
            "SELECT * FROM users WHERE id = ? LIMIT 1"
            // "SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1"
        );

        if ($preparada) {

            // $preparada->bind_param("ss", $email, $password);
            $preparada->bind_param("i", $id);

            if ($preparada->execute()) {

                $resultado = $preparada->get_result();

                if ($resultado->num_rows > 0) {

                    $usuario = $resultado->fetch_assoc();

                    if (password_verify($password, $usuario["password"])) {


                        $conexao->query("DELETE FROM users WHERE id = $id");
                        session_unset();
                        session_destroy();
                        echo "<p>Conta apagada com sucesso! <br> Redirecionando para o login.</p>";


                        echo "<script>
                            setTimeout(function(){
                                window.location.href = './login.php';
                            }, 1000);
                          </script>";

                        exit;
                    } else {
                        echo "<p class='erro'>Senha está incorreta.Tente Novamente</p>";
                    }


                }
            }
        }
    }

    ?>

</body>

</html>