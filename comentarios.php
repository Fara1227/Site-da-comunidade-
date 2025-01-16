<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "connect.php";

if (isset($_SESSION['id_user'])) {
    $id_user_logado = $_SESSION['id_user'];
    echo "Bem-vindo, usuário já logado!";
} else {
    echo "Por favor, faça login.";
    exit;
}

// Verifica se o ID da postagem foi passado
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_postagem = intval($_GET['id']);

    // Consulta para buscar os comentários da postagem específica
    $sqlComentarios = "SELECT tb_comentarios.comentario, tb_user.nome, tb_user.email, tb_user.perfil
                       FROM tb_comentarios 
                       JOIN tb_user ON tb_comentarios.id_user = tb_user.id_user 
                       WHERE tb_comentarios.id_postagem = $id_postagem 
                       ORDER BY tb_comentarios.data_comentario DESC";

    $comentarios = mysqli_query($link, $sqlComentarios);

    //Botão para voltar
    echo "<a href='user.php?page=4?id=" . $id_postagem . "' class='comment-link'>Voltar</a>";

    echo "<h1>Comentários da Postagem</h1>";
    if ($comentarios && mysqli_num_rows($comentarios) > 0) {
        while ($comentario = mysqli_fetch_array($comentarios)) {
            $caminhoImagemComentario = "users/" . htmlspecialchars($comentario['email']) . "/" . htmlspecialchars($comentario['perfil']);
            if (!file_exists($caminhoImagemComentario)) {
                $caminhoImagemComentario = "imagens/usuario.png";
            }

            echo "<div class='comment'>
                    <img src='" . $caminhoImagemComentario . "' alt='Foto de perfil' class='profile-pic-comment'>
                    <strong>" . htmlspecialchars($comentario['nome']) . "</strong>: " . htmlspecialchars($comentario['comentario']) . "
                  </div>";
        }
    } else {
        echo "<p>Não há comentários para esta postagem.</p>";
    }

    // Formulário para adicionar um novo comentário
    echo '<form method="POST" action="add_comment.php">
    <input type="hidden" name="id_postagem" value="' . htmlspecialchars($id_postagem) . '">
    <input type="text" name="comentario" placeholder="Escreva um comentário..." required>
    <button type="submit">Enviar</button>
    </form>';
} else {
    echo "<p>Postagem não encontrada.</p>";
}
?>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

h1 {
    text-align: center;
    color: #333;
}

.comment-link {
    display: inline-block;
    margin: 10px 0;
    padding: 10px 15px;
    color: #fff;
    background-color: #007bff;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
}

.comment-link:hover {
    background-color: #0056b3;
}

.comment {
    background-color: #fff;
    margin: 10px auto;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    max-width: 600px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.profile-pic-comment {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
    vertical-align: middle;
}

</style>