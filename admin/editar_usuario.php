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

    // Consultar as informações do usuário no banco de dados
    $query = "SELECT * FROM tb_user WHERE id_user = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_usuario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Recuperar os dados do usuário
        $usuario = mysqli_fetch_assoc($result);
    } else {
        // Se o usuário não for encontrado, redireciona
        header("Location: gerenciar_usuarios.php");
        exit();
    }
} else {
    // Se o ID não for passado, redireciona
    header("Location: gerenciar_usuarios.php");
    exit();
}

// Processar o envio do formulário para editar o usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coletar dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $perfil = $_POST['perfil'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0; // 1 para admin, 0 para usuário normal

    // Atualizar os dados no banco de dados
    $update_query = "UPDATE tb_user SET nome = ?, email = ?, perfil = ?, Admin = ? WHERE id_user = ?";
    $stmt = mysqli_prepare($link, $update_query);
    mysqli_stmt_bind_param($stmt, "sssii", $nome, $email, $perfil, $is_admin, $id_usuario);
    
    if (mysqli_stmt_execute($stmt)) {
        // Se a atualização for bem-sucedida, redireciona para a página de usuários
        header("Location: admin.php");
        exit();
    } else {
        // Caso haja erro ao atualizar
        $erro = "Erro ao atualizar o usuário. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assumindo que você tem um arquivo CSS para estilo -->
</head>
<body>

<h1>Editar Usuário</h1>

<?php if (isset($erro)) { echo "<p style='color: red;'>$erro</p>"; } ?>

<form method="POST" enctype="multipart/form-data">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required><br><br>

    <label for="perfil">Perfil (Arquivo de Imagem):</label>
    <input type="file" id="perfil" name="perfil"><br><br>
    <small>Deixe em branco para manter o perfil atual.</small><br><br>

    <label for="is_admin">Administrador:</label>
    <input type="checkbox" id="is_admin" name="is_admin" <?php echo $usuario['Admin'] == 1 ? 'checked' : ''; ?>>
    <label for="is_admin">Sim</label><br><br>

    <button type="submit">Salvar Alterações</button>
</form>

<p><a href="admin.php">Voltar para a lista de usuários</a></p>

</body>
</html>
