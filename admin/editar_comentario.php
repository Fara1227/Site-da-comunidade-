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

    // Consultar o comentário
    $query = "SELECT * FROM tb_comentarios WHERE id_comentario = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_comentario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $comentario = mysqli_fetch_assoc($result);
    } else {
        header("Location: comentarios.php");
        exit();
    }
} else {
    header("Location: comentarios.php");
    exit();
}

// Processar o formulário de edição
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comentario_texto = $_POST['comentario'];

    // Atualizar o comentário
    $update_query = "UPDATE tb_comentarios SET comentario = ? WHERE id_comentario = ?";
    $stmt = mysqli_prepare($link, $update_query);
    mysqli_stmt_bind_param($stmt, "si", $comentario_texto, $id_comentario);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: comentarios.php");
        exit();
    } else {
        $erro = "Erro ao atualizar o comentário. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Comentário</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Editar Comentário</h1>

<?php if (isset($erro)) { echo "<p style='color: red;'>$erro</p>"; } ?>

<form method="POST">
    <label for="comentario">Comentário:</label>
    <textarea id="comentario" name="comentario" required><?php echo htmlspecialchars($comentario['comentario']); ?></textarea><br><br>
    <button type="submit">Salvar Alterações</button>
</form>

<p><a href="comentarios.php">Voltar para a lista de comentários</a></p>

</body>
</html>
