<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão se ainda não foi iniciada
}
include "../connect.php";

// Verificar se o usuário está logado e é um administrador
if (!isset($_SESSION['email']) || $_SESSION['email'] == '' || $_SESSION['is_admin'] != 1) {
    header("Location: ../index.php");
    exit();
}

// Verificar se o ID do comentário foi passado
if (isset($_GET['id'])) {
    $id_comentario = $_GET['id'];

    // Excluir o comentário
    $delete_query = "DELETE FROM tb_comentarios WHERE id_comentario = ?";
    $stmt = mysqli_prepare($link, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $id_comentario);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: comentarios.php");
        exit();
    } else {
        echo "Erro ao excluir o comentário.";
    }
} else {
    header("Location: comentarios.php");
    exit();
}
