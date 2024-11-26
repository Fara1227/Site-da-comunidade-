<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado antes de acessar as informações
if (!isset($_SESSION['id_user'])) {
    echo "Usuário não está logado.";
    exit;
}


// Verifica se o usuário está logado antes de acessar as informações
if (!isset($_SESSION['id_user'])) {
    echo "Usuário não está logado.";
    exit;
}

echo "<h1>Dados do usuário</h1>";

// Exibe os dados do usuário a partir da sessão
echo "<p>Nome: " . (isset($_SESSION['nome_user']) ? htmlspecialchars($_SESSION['nome_user']) : "Não disponível") . "</p>";
echo "<p>E-mail: " . (isset($_SESSION['email_user']) ? htmlspecialchars($_SESSION['email_user']) : "Não disponível") . "</p>";
echo "<p>Dica: " . (isset($_SESSION['dica_user']) ? htmlspecialchars($_SESSION['dica_user']) : "Não disponível") . "</p>";
echo "<p>Senha: " . (isset($_SESSION['senha_user']) ? htmlspecialchars($_SESSION['senha_user']) : "Não disponível") . "</p>";

// Exibe a imagem de capa e de perfil do usuário, se disponíveis
if (isset($_SESSION['email_user'], $_SESSION['capa_user'])) {
    $capaPath = "users/" . htmlspecialchars($_SESSION['email_user']) . "/" . htmlspecialchars($_SESSION['capa_user']);
    echo "<p>Capa do usuário: <img src='$capaPath' alt='Capa do usuário' class='cover-pic'></p>";
}

if (isset($_SESSION['email_user'], $_SESSION['perfil_user'])) {
    $perfilPath = "users/" . htmlspecialchars($_SESSION['email_user']) . "/" . htmlspecialchars($_SESSION['perfil_user']);
    echo "<p>Foto de perfil: <img src='$perfilPath' alt='Foto de perfil' class='profile-pic'></p>";
}

/*echo "<br>";
echo "<h1>Dados do  usuário</h1>";
echo "<p class=\"dados\">Nome: $nome_log";
echo "<br>E-mail: $email_log";
echo "<br>dica: $dica_log";
echo "<br>Senha: $senha_log";
echo "<br>capa do usuario: $capa_log";
echo "<br>Foto do perfil: $perfil_log";
echo "</p>";*/
?>
