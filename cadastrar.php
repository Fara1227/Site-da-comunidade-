<?php
//Arquivo de conecao com o banco de dados
include "connect.php"; 
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$dica = $_POST['dica'];
$cadastrar = false;

//Variaveis com o arquivo do upload

$capa = $_FILES['capa'] ['name'];
$capa_tipo = $_FILES['capa'] ['type'];

$perfil = $_FILES['perfil'] ['name'];
$perfil_tipo = $_FILES['perfil'] ['type'];


//Verficar se e possível cadastrar

if($nome != "" && $email != "" && $senha != "" && $dica != "" && $capa != "" && $perfil != ""){
    $cadastrar = true;
}else{
    echo "nao pode deixar campos vazios ";
    echo "<a href='cadastre.php'>Voltar a tela de cadastro</a><br>";
}

//local das imaguens dos usuarios cadastrados 
$pasta = $email;

//criar pasta em php com base em uma verificação
if(file_exists("users/".$pasta)) {
    //header("location:cadastre.php");
    $cadastrar = false;
    echo "Você já possui uma pasta<br>";
    echo "<a href='cadastre.php'>Voltar a tela de cadastro</a><br>";
}else{
    $cadastrar = true;
    mkdir("users/".$pasta,0777);
    //Inprimendo os valores armazenados nas variaveis 
    echo "Nome: ".$nome."<br>";
    echo "Email: ".$email."<br>";
    echo "senha: ".$senha."<br>";
    echo "dica: ".$dica."<br>";
    echo "capa: ".$capa."<br>";
    echo "Tipo de arquivo da capa: ".$capa_tipo."<br>";
    echo "perfil: ".$perfil."<br>";
    echo "Tipo de arquivo do perfil: ".$perfil_tipo."<br>";
}







if($cadastrar){
    $sql = "insert into tb_user(nome,email,senha,dica,perfil,capa)values
    ('$nome','$email','$senha','$dica','$perfil','$capa');";
    mysqli_query($link, $sql);
    echo "<a href='index.php'>Ir para a tela de login</a><br>";
    echo "<a href='cadastre.php'>Cadastre outro usuario</a>";
    //upload das imaguens               
    move_uploaded_file($_FILES['capa'] ['tmp_name'],"users/".$pasta."/".$capa);
    move_uploaded_file($_FILES['perfil'] ['tmp_name'],"users/".$pasta."/".$perfil);
}







?>