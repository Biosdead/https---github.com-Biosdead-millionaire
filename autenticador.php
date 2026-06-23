<?php 
if (!isset($_SESSION['id'])) {
    // Redireciona para a página de login
    header("Location: login.php");
    // Interrompe a execução do restante da página
    exit();
}


?>