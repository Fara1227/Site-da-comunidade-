<?php 
session_start();
include "connect.php";

// Altere de $_POST['post_id'] para $_POST['id_postagem']
if (isset($_SESSION['id_user'], $_POST['id_postagem'], $_POST['comentario'])) {
    $id_user = $_SESSION['id_user'];
    $post_id = intval($_POST['id_postagem']); // Note a mudança
    $comentario = mysqli_real_escape_string($link, trim($_POST['comentario']));

    if (empty($comentario)) {
        echo "Comentário não pode estar vazio.";
        exit;
    }

    $sql = "INSERT INTO tb_comentarios (id_postagem, id_user, comentario) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 'iis', $post_id, $id_user, $comentario);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Comentário adicionado com sucesso!";
        header("Location: comentarios.php?id=" . $post_id); // Redireciona para os comentários da postagem
        exit;
    } else {
        echo "Erro ao adicionar comentário: " . mysqli_error($link);
    }
} else {
    echo "Dados incompletos. Verifique se todos os campos estão preenchidos.";
    var_dump($_SESSION, $_POST); // Para depuração
}
?>