<?php
//arquivo de login
include "connect.php"; 



$login = $_POST["login"];
$senha = $_POST["senha"];



if($login && $senha){
    $sql = mysqli_query($link,"select * from tb_user WHERE email = '$login'");
    while($dados = mysqli_fetch_array($sql)){
        $email = $dados['email'];
        $pass = $dados['senha'];
    }
    //Verificar se os dados batem com os do banco de dados
    //Inicio da verificão 
    if($login == $email && $senha == $pass){
        //Iniciar session
        SESSION_START();
        //variáveis de sessão
        $_SESSION['login_user'] =  $login;
        $_SESSION['senha_user'] = $senha;
        header('location:user.php');
    }else{
        header('location:index.php');
    }
    $_SESSION['id_user'] = $dados['id_user'];
    //Fim
}else{
    header('location:index.php');
}
?>