<?php
include "connect.php"; 
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$dica = $_POST['dica'];
$cadastrar = false;

// Check if files were uploaded without errors
if ($_FILES['capa']['error'] !== UPLOAD_ERR_OK || $_FILES['perfil']['error'] !== UPLOAD_ERR_OK) {
    echo "Error uploading files.";
    exit;
}

$capa = $_FILES['capa']['name'];
$capa_tipo = $_FILES['capa']['type'];
$perfil = $_FILES['perfil']['name'];
$perfil_tipo = $_FILES['perfil']['type'];

if ($nome != "" && $email != "" && $senha != "" && $dica != "" && $capa != "" && $perfil != "") {
    $cadastrar = true;
} else {
    echo "Não pode deixar campos vazios ";
    echo "<a href='cadastre.php'>Voltar a tela de cadastro</a><br>";
}

$pasta = $email;

if (file_exists("users/" . $pasta)) {
    $cadastrar = false;
    echo "Você já possui uma pasta<br>";
    echo "<a href='cadastre.php'>Voltar a tela de cadastro</a><br>";
} else {
    $cadastrar = true;
    mkdir("users/" . $pasta, 0777);
    echo "Nome: " . $nome . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Senha: " . $senha . "<br>";
    echo "Dica: " . $dica . "<br>";
    echo "Capa: " . $capa . "<br>";
    echo "Tipo de arquivo da capa: " . $capa_tipo . "<br>";
    echo "Perfil: " . $perfil . "<br>";
    echo "Tipo de arquivo do perfil: " . $perfil_tipo . "<br>";
}

if ($cadastrar) {
    $sql = "INSERT INTO tb_user(nome, email, senha, dica, perfil, capa) VALUES ('$nome', '$email', '$senha', '$dica', '$perfil', '$capa');";
    mysqli_query($link, $sql);
    echo "<a href='index.php'>Ir para a tela de login</a><br>";
    echo "<a href='cadastre.php'>Cadastre outro usuario</a>";
    move_uploaded_file($_FILES['capa']['tmp_name'], "users/" . $pasta . "/" . $capa);
    move_uploaded_file($_FILES['perfil']['tmp_name'], "users/" . $pasta . "/" . $perfil);
}
?>