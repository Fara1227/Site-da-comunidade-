<header>
    <h1><?php 
    if (isset($_SESSION['nome_user'])) {
    echo  htmlspecialchars($_SESSION['nome_user']);
    } else {
    echo "Usuário não logado";
}
?>
</h1>
</header>
<figure id="img_perfil">
    <img src="<?php 
    if($perfil_log == "usuario.png"){
        echo "imagens/$perfil_log";
    }else{
        echo 'users/'.$email_log.'/'.$perfil_log; 
    }
    ?>" id="perfil">
</fogure>

<nav>
    <ul id="foto">
        <li><img src="imagens/cam.png" id="cam">
            <Ul id="itens_menu">
                <li><a href="atualiza.php">Atualizar</a></li>
                <?php
                    if($perfil_log != "usuario.png" && $capa_log != "00068.png"){
                ?>
                <li><a href="remover_fotos.php">Romover fotos</a></li>
                <?php }?>
            </ul>
        </li>
    </ul>
</nav>


<section id="menu_perfil">
    <a href="user.php?page=1">Sobre</a>
    <a href="user.php?page=2">Atividades</a>
    <a href="user.php?page=4">Posts</a>
    <a href="user.php?page=3">Nova Postaguem</a>
    <a href="logout.php">Sair</a>
</section>