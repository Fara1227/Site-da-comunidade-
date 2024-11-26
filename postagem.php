<?php 
include "verifica_login.php"; 
header('content-type: text/html; charser=utf-8');
?>
                <form action="postar.php" method="post">
                    <label>
                        <br>Postaguem:<br><br>
                    
                        <textarea name="postagem" rows="10" cols="50"></textarea><br><br>
                        <input type="submit" value="Publicar">
                    </label>
                </form>
                
        
    