<?php 
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
        <section id="principal">
            <section id="topo"  style="background-image:url(<?php 
            if($capa_log != "00068.png"){
                echo 'users/'.$email_log.'/'.$capa_log;
            }else{
                echo "imagens/$capa_log";
            }
            ?>);background-size:cover;"><!--heder-->
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
