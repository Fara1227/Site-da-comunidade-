<?php
# Obter a página atual
$pagina = isset($_GET['page']) ? $_GET['page'] : "";

switch ($pagina) {
    case 2:
        include "postaguens.php";
        break;
    case 3:
        include "postagem.php";
        break;
    case 4:
        include "Todos.php";
        break;
    default:
        // Verificar se o filtro está presente para exibir postagens
        if (isset($_GET['filtro'])) {
            include "Todos.php"; // Certifique-se de que este arquivo contém o código principal
        } else {
            include "perfil.php"; // Página padrão se não houver filtro nem page
        }
        break;
}
?>
