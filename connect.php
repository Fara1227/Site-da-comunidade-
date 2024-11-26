<?php
//arquivo de conecao com a base de dados 
$host = "localhost";
$user = "root";
$pass = "";
$banco = "db_site";

$link = mysqli_connect($host,$user,$pass,$banco);

if (!$link) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// Define o charset para a conexão
mysqli_set_charset($link, "utf8mb4");


?>