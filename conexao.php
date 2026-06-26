<?php 
// $host = 'localhost';
// $user = 'root';
// $password = '';
// $dbname = 'millionaire';
$host = 'millionaire.mysql.dbaas.com.br';
$user = 'millionaire';
$password = 'RT#4060Ti';
$dbname = 'millionaire';


$conexao = new mysqli($host,$user,$password,$dbname);

if($conexao->connect_error){
    echo 'Erro na conexão com banco de dados';
    $conexao->close();
}else{
    // echo 'Conexão bem sucedida com o banco de dados';
    include_once __DIR__.'/ponte.php';
}



?>