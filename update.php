<?php
SESSION_START();
 include "verifica_login.php"; 
 $id_update = $_GET['id_post'];
 echo "id da postahuem que deve ser atualizada $id_update";
 header('content-type: text/html; charser=utf-8');
 //Pegar os dados do formulario de postagem
 include "connect.php";
 $sql = "select * from tb_postagens where id_postagem = '$id_update'";
$result = mysqli_query($link, $sql);
while($text_update = mysqli_fetch_array($result)){
    $text = $text_update['postagem'];
}
 ?>
                <form action="atualizar.php" method="post">
                    <label>
                        Atualizar:<br><br>
                    
                        <textarea name="atualiza" rows="10" cols="50"><?php echo  $text; ?></textarea><br><br>
                        <input type="hidden" name="id" value="<?php echo $id_update; ?>">
                        <input type="submit" value="Atualizar">
                    </label>
                </form>