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

$sql = "SELECT tb_postagens.id_postagem, tb_postagens.postagem, IFNULL(tb_postagens.gostos, 0) as gostos, tb_user.nome, tb_user.email, tb_user.perfil 
        FROM tb_postagens 
        JOIN tb_user ON tb_postagens.id_user = tb_user.id_user";

$postagens = mysqli_query($link, $sql);

if ($postagens) {
    while ($dados = mysqli_fetch_array($postagens)) {
        $caminhoImagem = "users/" . htmlspecialchars($dados['email']) . "/" . htmlspecialchars($dados['perfil']);
        $id_postagem = $dados['id_postagem'];

        echo "<div class='post'>
            <div class='user-info'>
                <img src='" . $caminhoImagem . "' alt='Foto de perfil' class='profile-pic'>
                <strong class='user-name'>" . htmlspecialchars($dados['nome']) . "</strong>
            </div>
            <p class='post-content'>" . htmlspecialchars($dados['postagem']) . "</p>
            <div class='likes'>
                <strong>Gostos: <span id='like-count-" . $id_postagem . "'>" . htmlspecialchars($dados['gostos']) . "</span></strong>
                <span class='like-icon' onclick='likePost(" . $id_postagem . ")'>&#128077;</span> <!-- Ícone de like -->
            </div>";

        // Botão "Comentários" que leva à página de comentários
        echo "<a href='comentarios.php?id=" . $id_postagem . "' class='comment-link'>Comentários</a>";// Botão de Comentários

        echo "</div>";
    }
} else {
    echo "Erro ao buscar as postagens.";
}
?>

<script>
function addComment(event, postId) {
    event.preventDefault();
    const form = event.target;
    const comentario = form.comentario.value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "add_comment.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (xhr.status === 200) {
            location.reload();
        } else {
            console.error("Erro ao enviar o comentário: " + xhr.responseText);
        }
    };
    xhr.send("post_id=" + postId + "&comentario=" + encodeURIComponent(comentario));
}

function likePost(postId) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "increment_likes.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function() {
        if (xhr.status === 200) {
            const likeCountElement = document.getElementById(`like-count-${postId}`);
            likeCountElement.textContent = xhr.responseText;
        } else {
            console.error("Erro ao enviar o like: " + xhr.responseText);
        }
    };

    xhr.send("post_id=" + postId);
}
</script>

<style>
/* Estilos do post */
.post {
    width: 90%;
    max-width: 800px;
    background-color: #fff;
    margin: 20px auto;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
}

.user-info {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.profile-pic {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;
    object-fit: cover;
}

.user-name {
    font-size: 16px;
    font-weight: bold;
}

.post-content {
    font-size: 14px;
    margin: 10px 0;
}

.likes {
    margin-top: 10px;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.like-icon {
    cursor: pointer;
    font-size: 20px;
    color: #007bff;
}

.comment-link {
    display: inline-block;
    margin-top: 10px;
    text-decoration: none;
    color: #007bff;
    cursor: pointer;
}

.comment-link:hover {
    text-decoration: underline;
}
</style>
