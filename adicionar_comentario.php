<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $conteudo = $_POST['conteudo'];

    // Inserir o comentário no banco de dados
    $query_inserir = "INSERT INTO comentarios (post_id, conteudo, data_comentario) VALUES ('$post_id', '$conteudo', NOW())";
    if (mysqli_query($conn, $query_inserir)) {
        header("Location: comentarios.php?id=$post_id"); // Redireciona de volta para a página de comentários
        exit();
    } else {
        echo "Erro ao adicionar comentário.";
    }
}
?>
