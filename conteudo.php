<?php
#@$pagina = $_GET['page'];
$pagina = isset($_GET['page'])?$_GET['page']:"";

if($pagina == 2) {
    include "postaguens.php";
}else if($pagina == 3){
    include "postagem.php";
}else if($pagina == 4){
    include "Todos.php";
}
else{
    include "perfil.php";
}

?>