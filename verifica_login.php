<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão somente se ainda não foi iniciada
}
include "connect.php";

// Recupera o login e senha da sessão, se estiverem definidos
$l = isset($_SESSION["login_user"]) ? $_SESSION["login_user"] : "";
$s = isset($_SESSION["senha_user"]) ? $_SESSION["senha_user"] : "";

if ($l != "" && $s != "") {
    $sql = mysqli_query($link, "SELECT * FROM tb_user WHERE email = '$l'");

    if ($d = mysqli_fetch_array($sql)) {
        $_SESSION['id_user'] = $d['id_user'];
        $_SESSION['nome_user'] = $d['nome'];
        $_SESSION['email_user'] = $d['email'];
        $_SESSION['dica_user'] = $d['dica'];
        $_SESSION['capa_user'] = $d['capa'];
        $_SESSION['perfil_user'] = $d['perfil'];
    } else {
        header('Location: index.php');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}

/*include "connect.php"; 
//Recupero a sessão 
//SESSION_START();
//$l de login
$l = isset($_SESSION["login_user"])?$_SESSION["login_user"]:"";
//$s de senha
$s = isset($_SESSION["senha_user"])?$_SESSION["senha_user"]:"";
$_SESSION['id_user'] = $id_log;

if($l != "" && $s != ""){
    $sql = mysqli_query($link,"select * from tb_user WHERE email = '$l'");
    while($d = mysqli_fetch_array($sql)){
        $id_log = $d['id_user'];
        $nome_log = $d['nome'];
        $email_log = $d['email'];
        $senha_log = $d['senha'];
        $dica_log = $d['dica'];
        $capa_log = $d['capa'];
        $perfil_log = $d['perfil'];
    }
}else{
    header('location:index.php');
}*/
?>