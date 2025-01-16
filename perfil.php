<div id="todoss"> 
<div id="fundooo" style="
<?php
if (isset($_SESSION['email_user']) && isset($_SESSION['capa_user'])) {
    // Constrói o caminho da imagem baseado no email do usuário
    $emailDirectory = htmlspecialchars($_SESSION['email_user']);
    $imageName = htmlspecialchars($_SESSION['capa_user']);
    echo "background-image: url('users/" . $emailDirectory . "/" . $imageName . "');";
    echo "background-size: cover;";
    echo "background-position: center;";
    echo "background-repeat: no-repeat;";
}
?>
">
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado antes de acessar as informações
if (!isset($_SESSION['id_user'])) {
    echo "Usuário não está logado.";
    exit;
}

echo "<br><h1>Dados do usuário</h1>";

// Exibe os dados do usuário a partir da sessão
echo "<p>Nome: " . (isset($_SESSION['nome_user']) ? htmlspecialchars($_SESSION['nome_user']) : "Não disponível") . "</p>";
echo "<p>E-mail: " . (isset($_SESSION['email_user']) ? htmlspecialchars($_SESSION['email_user']) : "Não disponível") . "</p>";
echo "<p>Dica: " . (isset($_SESSION['dica_user']) ? htmlspecialchars($_SESSION['dica_user']) : "Não disponível") . "</p>";
echo "<p>Senha: " . (isset($_SESSION['senha_user']) ? htmlspecialchars($_SESSION['senha_user']) : "Não disponível") . "</p>";

// Exibe o nome da imagem de capa do usuário, se disponível
if (isset($_SESSION['capa_user'])) {
    echo "<p>Capa do usuário: " . htmlspecialchars($_SESSION['capa_user']) . "</p>";
}

// Exibe o nome da imagem de perfil do usuário, se disponível
if (isset($_SESSION['perfil_user'])) {
    echo "<p>Foto de perfil: " . htmlspecialchars($_SESSION['perfil_user']) . "</p>";
}
?>
</div>
</div>

<style>
#fundooo{
    width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white; /* Ajuste de cor do texto para contraste */
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
}
</style>
