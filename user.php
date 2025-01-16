<?php 
SESSION_START();
include "verifica_login.php"; 
?>
<!DOCTYPE html> 
<html lang="pt-br">
    <head><!--Secao de Cabeçalho-->
        <meta charset="utf-8">
        <title>Projeto</title>
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body>
                <?php include "topo.php"; ?>
            </section>

            <section id="conteudo">
            <?php include "conteudo.php"; ?>
            </section>

            <section id="rodape"><!--footer-->
            <?php include "rodape.php"; ?>
            </section>
        </section>
    </body>


</html>
