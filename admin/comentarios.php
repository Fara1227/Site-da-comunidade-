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

// Consultar todos os comentários
$query = "SELECT c.id_comentario, c.comentario, c.data_comentario, u.nome AS usuario_nome, p.postagem 
          FROM tb_comentarios c
          JOIN tb_user u ON c.id_user = u.id_user
          JOIN tb_postagens p ON c.id_postagem = p.id_postagem
          ORDER BY c.data_comentario DESC";
$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Comentários - Admin</title>
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

<h1>Gestão de Comentários</h1>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Comentário</th>
            <th>Data</th>
            <th>Usuário</th>
            <th>Postagem</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($comentario = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $comentario['id_comentario'] . "</td>";
                echo "<td>" . htmlspecialchars($comentario['comentario']) . "</td>";
                echo "<td>" . $comentario['data_comentario'] . "</td>";
                echo "<td>" . $comentario['usuario_nome'] . "</td>";
                echo "<td>" . $comentario['postagem'] . "</td>";
                echo "<td>";
                echo "<a href='editar_comentario.php?id=" . $comentario['id_comentario'] . "'>Editar</a> | ";
                echo "<a href='excluir_comentario.php?id=" . $comentario['id_comentario'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este comentário?\")'>Excluir</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum comentário encontrado.</td></tr>";
        }
        ?>
    </tbody>
</table>

<style>
/* Estilo básico para o menu */
/* Reset básico para garantir que todos os navegadores renderizem de forma consistente */
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

/* Estilo do link de voltar ao menu principal */
.menu li.voltar a {
    background-color: #2ecc71;
    color: white;
    font-size: 1.1em;
    transition: background-color 0.3s ease;
    border-radius: 5px;
    padding: 10px 20px;
}

.menu li.voltar a:hover {
    background-color: #27ae60;
}

/* Alerta de confirmação */
.confirmation {
    background-color: #f39c12;
    padding: 5px;
    color: white;
    font-weight: bold;
    text-align: center;
}



</style>
<a href="../index.php">Voltar ao Menu Principal</a>

</body>
</html>
