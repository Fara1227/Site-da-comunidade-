<?php
//Sair da conta 
SESSION_START();
$email = $_SESSION["login_user"];

unset($_SESSION["login_user"]);
unset( $_SESSION["senha_user"]);

header('location:index.php');

?>