<div id="todoss">
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "connect.php";


// Obter filtro selecionado
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 'recentes';

// Determinar ordem com base no filtro
switch ($filtro) {
    case 'gostos':
        $ordem = "ORDER BY tb_postagens.gostos DESC";
        $condicao = ""; // Sem condição adicional
        break;
    case 'sem_comentarios':
        $ordem = ""; // Não é necessário ordenar
        $condicao = "WHERE tb_postagens.id_postagem NOT IN (SELECT DISTINCT id_postagem FROM tb_comentarios)";
        break;
    case 'recentes':
    default:
        $ordem = "ORDER BY tb_postagens.id_postagem DESC";
        $condicao = ""; // Sem condição adicional
        break;
}

// Consulta SQL com ordenação e condição
$sql = "SELECT tb_postagens.id_postagem, tb_postagens.postagem, IFNULL(tb_postagens.gostos, 0) as gostos, tb_user.nome, tb_user.email, tb_user.perfil 
        FROM tb_postagens 
        JOIN tb_user ON tb_postagens.id_user = tb_user.id_user 
        $condicao 
        $ordem";

$postagens = mysqli_query($link, $sql);

// Menu de filtros
echo "<form method='GET' class='filter-menu'>
    <label for='filtro'>Ordenar por:</label>
    <select name='filtro' id='filtro' onchange='this.form.submit()'>
        <option value='recentes' " . ($filtro === 'recentes' ? 'selected' : '') . ">Mais recentes</option>
        <option value='gostos' " . ($filtro === 'gostos' ? 'selected' : '') . ">Mais gostos</option>
        <option value='sem_comentarios' " . ($filtro === 'sem_comentarios' ? 'selected' : '') . ">Sem comentários</option>
    </select>
</form>";

// Exibir postagens
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
                <span class='like-icon' onclick='likePost(" . $id_postagem . ")'>&#128077;</span>
            </div>
            <a href='comentarios.php?id=" . $id_postagem . "' class='comment-link'>Comentários</a>
        </div>";
    }
} else {
    echo "Erro ao buscar as postagens.";
}
?>
</div>

<script>
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

#todoss{
    margin-top: 60px;
}

.filter-menu {
    width: 90%;
    max-width: 800px;
    margin: 20px auto;
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.filter-menu label {
    font-weight: bold;
}

.filter-menu select {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

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
