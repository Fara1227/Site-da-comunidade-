<!DOCTYPE html> 
<html lang="pt-br">
    <head><!--Secao de Cabeçalho-->
        <meta charset="utf-8">
        <title>Robô Car</title>
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body><!--Seção principal do site-->
        <section id="form">
                <form action="cadastrar.php" method="post" enctype="multipart/form-data">
                    <label>
                        Nome:
                    </label>
                    <input type="text" name="nome" placeholder="Diguite o seu nome" class="entradas" required><br>
                   
                    <label>
                        E-mail:
                    </label>
                    <input type="text" name="email" placeholder="Digite o e-mail" class="entradas" required><br>
                    
                    <label>
                        Senha:
                    </label>
                    <input type="password" name="senha" placeholder="Digite uma senha" class="entradas" required><br>

                    <label>
                        Dica:
                    </label>
                    <input type="texto" name="dica" placeholder="Digite uma dica" class="entradas" required><br>
                    
                    <label>
                        Imaguem da Capa:
                    </label>
                    <input type="file" name="capa"  class="entradas" required><br>
                    
                    <label>
                        Imaguem de perfil:
                    </label>
                    <input type="file" name="perfil"  class="entradas" required><br>

                    <label>
                    <input type="submit" value="cadastrar" class="bt_form">
                    </label>
                </form>
                <a href="index.php">Logar</a>
        </section>
    </body>


</html>