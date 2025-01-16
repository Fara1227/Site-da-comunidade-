<?php
// Inclui a conexão com o banco de dados
include "connect.php"; 

// Obtém os valores do formulário
$login = $_POST["login"];
$senha = $_POST["senha"];

if ($login && $senha) {
    // Consulta o banco de dados para verificar o usuário
    $sql = mysqli_query($link, "SELECT * FROM tb_user WHERE email = '$login'");
    
    // Verifica se o usuário existe
    if ($sql && mysqli_num_rows($sql) > 0) {
        // Obtém os dados do usuário
        $dados = mysqli_fetch_assoc($sql);
        $email = $dados['email'];
        $pass = $dados['senha'];

        // Verifica se o login e senha estão corretos
        if ($login == $email && $senha == $pass) {
            // Inicia a sessão
            session_start();

            // Configura as variáveis de sessão
            $_SESSION['login_user'] = $email;
            $_SESSION['senha_user'] = $pass;
            $_SESSION['id_user'] = $dados['id_user']; // Adiciona o ID do usuário
            $_SESSION['email'] = $email; // Adiciona o email do usuário
            $_SESSION['is_admin'] = $dados['Admin'] == 1; // Verifica se é admin

            // Redireciona para a página do usuário
            header('location:user.php');
            exit;
        } else {
            // Redireciona para o login se a senha estiver errada
            header('location:index.php?error=senha_incorreta');
            exit;
        }
    } else {
        // Redireciona para o login se o email não for encontrado
        header('location:index.php?error=usuario_inexistente');
        exit;
    }
} else {
    // Redireciona para o login se os campos estiverem vazios
    header('location:index.php?error=campos_vazios');
    exit;
}
?>
