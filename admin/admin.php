<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão se ainda não foi iniciada
}
include "../connect.php";

// Verificar se o usuário logado é um administrador
if (!isset($_SESSION['email']) || $_SESSION['email'] == '' || $_SESSION['is_admin'] != 1) {
    echo "Sessão inválida ou não é admin!";
    var_dump($_SESSION);  // Isso irá mostrar o conteúdo da sessão, para verificar o que está armazenado
    header("Location: ../index.php");
    exit();
}

// Consultar todos os usuários
$query = "SELECT id_user, nome, email, perfil, Admin FROM tb_user";
$result = mysqli_query($link, $query);

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Utilizadores - Admin</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assumindo que você tem um arquivo CSS para estilo -->
</head>
<body>

<!-- Menu de Navegação -->
<div class="menu">
    <ul>
        <li><a href="admin.php">Usuários</a></li>
        <li><a href="comentarios.php">Comentários</a></li>
        <li><a href="../admin_loja.php">Produtos</a></li>
        <li><a href="../index.php">Voltar</a></li>
        <li><a href="../logout.php">Sair</a></li>
    </ul>
</div>

<h1>Gestão de Utilizadores</h1>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Perfil</th>
            <th>Admin</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($user = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $user['id_user'] . "</td>";
                echo "<td>" . $user['nome'] . "</td>";
                echo "<td>" . $user['email'] . "</td>";

                // Exibe apenas o nome do arquivo da foto de perfil
                echo "<td>" . htmlspecialchars($user['perfil']) . "</td>";

                echo "<td>" . ($user['Admin'] == 1 ? "Sim" : "Não") . "</td>";
                echo "<td>";
                echo "<a href='editar_usuario.php?id=" . $user['id_user'] . "'>Editar</a> | ";
                echo "<a href='excluir_usuario.php?id=" . $user['id_user'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este usuário?\")'>Excluir</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum usuário encontrado.</td></tr>";
        }
        ?>
    </tbody>
</table>

<style>
/* Estilo básico para o menu */
/* Reset básico para garantir que todos os navegadores renderizem de forma consistente */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Corpo da página */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 20px;
}

/* Estilo para o título principal */
h1 {
    font-size: 2.5em;
    margin-bottom: 20px;
    color: #2c3e50;
}

/* Menu de navegação */
.menu {
    background-color: #34495e;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.menu ul {
    list-style-type: none;
    display: flex;
    justify-content: space-around;
}

.menu li {
    display: inline-block;
}

.menu li a {
    color: white;
    padding: 12px 20px;
    text-decoration: none;
    font-size: 1.1em;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.menu li a:hover {
    background-color: #1abc9c;
}

/* Estilo da tabela */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 12px;
    text-align: left;
}

th {
    background-color: #34495e;
    color: white;
    font-size: 1.1em;
}

td {
    background-color: #fff;
    font-size: 1em;
    color: #333;
}

/* Estilo para o botão "Editar" e "Excluir" */
a {
    text-decoration: none;
    color: #2980b9;
    font-weight: bold;
}

a:hover {
    color: #e74c3c;
}

/* Estilo para a linha vazia na tabela */
table tbody tr td {
    text-align: center;
}

/* Estilo de alerta de confirmação */
.confirmation {
    background-color: #f39c12;
    padding: 5px;
    color: white;
    font-weight: bold;
    text-align: center;
}

</style>
</body>
</html>
