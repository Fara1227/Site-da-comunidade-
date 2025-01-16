<?php
session_start(); // Inicia a sessão para gerenciar os usuários
include "connect.php";

// Verifica se o ID do usuário está presente na sessão
if (isset($_SESSION['id_user']) && isset($_POST['post_id'])) {
    $id_user_logado = $_SESSION['id_user'];
    $postId = intval($_POST['post_id']);

    // Debug: verifica o ID do usuário logado
    // print_r($id_user_logado);

    // Inicia uma transação
    mysqli_begin_transaction($link);

    try {
        // Verifica se o usuário já curtiu a postagem
        $checkLikeSql = "SELECT id_like FROM tb_likes WHERE id_user = ? AND id_postagem = ?";
        $stmt = mysqli_prepare($link, $checkLikeSql);
        mysqli_stmt_bind_param($stmt, 'ii', $id_user_logado, $postId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 0) {
            // Usuário ainda não curtiu; insere o "like"
            $insertLikeSql = "INSERT INTO tb_likes (id_user, id_postagem) VALUES (?, ?)";
            $stmtInsert = mysqli_prepare($link, $insertLikeSql);
            mysqli_stmt_bind_param($stmtInsert, 'ii', $id_user_logado, $postId);
            mysqli_stmt_execute($stmtInsert);

            // Atualiza o contador de "likes" na tabela `tb_postagens`
            $updatePostSql = "UPDATE tb_postagens SET gostos = gostos + 1 WHERE id_postagem = ?";
            $stmtUpdate = mysqli_prepare($link, $updatePostSql);
            mysqli_stmt_bind_param($stmtUpdate, 'i', $postId);
            mysqli_stmt_execute($stmtUpdate);

            mysqli_commit($link); // Confirma a transação

            // Fecha as instruções preparadas para liberar recursos
            mysqli_stmt_close($stmt);
            mysqli_stmt_close($stmtInsert);
            mysqli_stmt_close($stmtUpdate);

            echo "Like registrado com sucesso!";
        } else {
            mysqli_stmt_close($stmt); // Fecha a verificação de like
            echo "Você já curtiu esta postagem.";
        }
    } catch (Exception $e) {
        mysqli_rollback($link); // Reverte a transação em caso de erro
        echo "Erro ao registrar o like: " . $e->getMessage();
    }
} else {
    echo "Erro: Usuário não autenticado ou ID da postagem ausente.";
}
?>
