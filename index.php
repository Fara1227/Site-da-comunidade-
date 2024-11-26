<?php 
include "connect.php"; 
SESSION_START();//recuperar a sessâo
if(isset($_SESSION["login_user"]) && isset($_SESSION["senha_user"])){
    header('location:user.php');
}
?>
<!DOCTYPE html> 
<html lang="pt-br">
    <head><!--Secao de Cabeçalho-->
        <meta charset="utf-8">
        <title>Robô Car</title>
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body><!--Seção principal do site-->
        <section id="form">
                <form action="login.php" method="post">
                    <label>
                        Login:
                    </label>
                    <input type="text" name="login" placeholder="Emtre com o seu email" class="entradas" required><br>
                    <label>
                        Senha:
                    </label>
                    <input type="password" name="senha" placeholder="Digite a sua senha" class="entradas" required><br>
                    <label>
                    <input type="submit" value="Logar" class="bt_form">
                    </label>
                </form>
                <a href="cadastre.php">Novo usuario</a>
        </section>
    </body>


</html>
