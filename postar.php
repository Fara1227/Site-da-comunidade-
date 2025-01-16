<?php
session_start(); // Inicia a sessão
include "connect.php";
include "verifica_login.php"; // Confirma se o usuário está logado

// Verifica se o ID do usuário está na sessão
if (isset($_SESSION['id_user'])) {
    $id_user_logado = $_SESSION['id_user'];
} else {
    echo "Usuário não está logado.";
    exit;
}

// Obtém o conteúdo da postagem
if (isset($_POST['postagem']) && !empty(trim($_POST['postagem']))) {
    $postagem = mysqli_real_escape_string($link, $_POST['postagem']); // Sanitiza o conteúdo da postagem

    // Insere a postagem no banco de dados
    $sql = "INSERT INTO tb_postagens (postagem, id_user) VALUES ('$postagem', '$id_user_logado')";

    if (mysqli_query($link, $sql)) {
        // Redireciona para a página do usuário após o sucesso
        header('Location: user.php?page=2');
        exit;
    } else {
        echo "Erro ao inserir a postagem: " . mysqli_error($link);
    }
} else {
    // Redireciona para a página do usuário se a postagem estiver vazia
    header('Location: user.php');
    exit;
}
?>
