<?php 
SESSION_START();
include "connect.php";
include "verifica_login.php";

$foto_perfil = "users/$email_log/$perfil_log";
$foto_capa = "users/$email_log/$capa_log";

//rttemocao das imagens na pasta 
unlink($foto_perfil);
unlink($foto_capa);

$sql = "UPDATE tb_user set perfil = 'usuario.png', capa = '00068.png' WHERE id_user = '$id_log'";
mysqli_query($link, $sql);


echo "<a href='user.php'>voltar para tela principal</a>";

?>