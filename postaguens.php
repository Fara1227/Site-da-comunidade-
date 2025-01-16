<div id="todoss">
<?php
// Apenas iniciar a sessão se ainda não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['id_user'])) {
    echo "Usuário não está logado.";
    exit;
}

// Acessa o ID do usuário logado diretamente da sessão
$id_user_logado = $_SESSION['id_user'];

// Exibe o ID do usuário logado
//echo "ID do usuário logado: " . $id_user_logado;

header('content-type: text/html; charset=utf-8');
include "connect.php";
echo "<br>";

// Consulta com o ID do usuário logado
$sql = "SELECT * FROM tb_postagens WHERE id_user = '$id_user_logado'";
$postagens = mysqli_query($link, $sql);

while ($dados = mysqli_fetch_array($postagens)) {
    echo "<p class='posts'>$dados[id_postagem]: $dados[postagem]
    <a href='update.php?id_post=$dados[id_postagem]'><img src='imagens/Atualizar.png' class='img_posts'></a>
    <a href='user.php?page=3'><img src='imagens/creat.png' class='img_posts'></a><br>
    </p>";
}
?>
</div>
