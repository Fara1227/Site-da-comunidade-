<?php
session_start();
include "../connect.php";

// Verificar se o usuário está logado e é um administrador
if (!isset($_SESSION['email']) || $_SESSION['email'] == '' || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != true) {
    header("Location: ../index.php"); // Redireciona caso não seja admin
    exit();
}

// Verificar se o ID do usuário foi passado via GET
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Consultar se o usuário existe no banco de dados antes de excluir
    $query = "SELECT * FROM tb_user WHERE id_user = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_usuario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Usuário encontrado, realizar a exclusão
        $delete_query = "DELETE FROM tb_user WHERE id_user = ?";
        $stmt = mysqli_prepare($link, $delete_query);
        mysqli_stmt_bind_param($stmt, "i", $id_usuario);

        if (mysqli_stmt_execute($stmt)) {
            // Usuário excluído com sucesso, redireciona para a página de gerenciamento
            header("Location: admin.php");
            exit();
        } else {
            // Caso ocorra algum erro durante a exclusão
            $erro = "Erro ao excluir o usuário. Tente novamente.";
        }
    } else {
        // Se o usuário não for encontrado, redireciona para a página de gerenciamento
        header("Location: admin.php");
        exit();
    }
} else {
    // Se o ID do usuário não for passado via GET, redireciona para a página de gerenciamento
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Excluir Usuário</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assumindo que você tem um arquivo CSS para estilo -->
</head>
<body>

<h1>Excluir Usuário</h1>

<?php if (isset($erro)) { echo "<p style='color: red;'>$erro</p>"; } ?>

<p>Tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita.</p>

<form method="POST">
    <button type="submit">Sim, excluir usuário</button>
    <a href="gerenciar_usuarios.php">Cancelar</a>
</form>

</body>
</html>
