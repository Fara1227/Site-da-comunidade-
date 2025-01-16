<?php 
include "connect.php";
SESSION_START();
include "verifica_login.php";
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
                <form action="atualizar_fotos.php" method="post" enctype="multipart/form-data"> 
                    <label>
                        Imaguem da Capa:
                    </label>
                    <input type="file" name="capa"  class="entradas" required><br>
                    
                    <label>
                        Imaguem de perfil:
                    </label>
                    <input type="file" name="perfil"  class="entradas" required><br>

                    <label>
                    <input type="submit" value="atualizar" class="bt_form">
                    </label>
                </form>
        </section>
    </body>


</html>