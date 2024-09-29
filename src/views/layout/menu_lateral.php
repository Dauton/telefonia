<?php

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../../index.php");
    die();
}

?>

<div id="back-menu"></div>
<nav class="menu">
    <div class="menu-user-info">
        <span>
            <i class="fa-solid fa-circle-user"></i>
            <h3>Bem-vindo(a)!</h3>
            <p><?= $_SESSION['nome_usuario'] ?></p>
            <a href="src/config/logout.php"><button type="button" id="btn-sair">Sair</button></a>
        </span>
    </div>

    <div class="menu-divisoria">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <ul>
        <li><a href="inicio.php"><i class="fa-solid fa-circle-question"></i>Início<i class="fa-solid fa-angle-right"></i></a></li>

        <li id="menu_02"><a><i class="fa-solid fa-circle-question"></i>Dispositivos<i class="fa-solid fa-angle-right"></i></a>
            <ul id="menusub_02">
                <li><a href="cadastrar_dispositivo.php"><i class="fa-solid fa-arrow-pointer"></i>Cadastro<i class="fa-solid fa-angle-right"></i></a></li>
                <li><a href='consulta_dispositivos.php'><i class='fa-solid fa-arrow-pointer'></i>Consulta<i class='fa-solid fa-angle-right'></i></a></li>
                <li><a href='#'><i class='fa-solid fa-arrow-pointer'></i>Submenu 02/03<i class='fa-solid fa-angle-right'></i></a></li>

            </ul>
        </li>
        <li id='menu_03'><a><i class="fa-solid fa-circle-question"></i>Menu 03<i class='fa-solid fa-angle-right'></i></a>
            <ul id='menusub_03'>
                <li><a href=''><i class='fa-solid fa-arrow-pointer'></i>Submenu 03/01<i class='fa-solid fa-angle-right'></i></a></li>
                <li><a href=''><i class='fa-solid fa-arrow-pointer'></i>Submenu 03/02<i class='fa-solid fa-angle-right'></i></a></li>
                <li><a href=''><i class='fa-solid fa-arrow-pointer'></i>Submenu 03/03<i class='fa-solid fa-angle-right'></i></a></li>
                <li><a href=''><i class='fa-solid fa-arrow-pointer'></i>Submenu 03/04<i class='fa-solid fa-angle-right'></i></a></li>
            </ul>
        </li>
        <li id='menu_04'><a><i class='fa-solid fa-gear'></i>Admin<i class='fa-solid fa-angle-right'></i></a>
            <ul id='menusub_04'>
                <li><a href='cadastrar_usuario.php'><i class='fa-solid fa-arrow-pointer'></i>Cadastrar usuário<i class='fa-solid fa-angle-right'></i></a></li>
                <li><a href='gerenciar_usuarios.php'><i class='fa-solid fa-arrow-pointer'></i>Gerenciar usuários<i class='fa-solid fa-angle-right'></i></a></li>
                <li><a href='log_logins.php'><i class='fa-solid fa-arrow-pointer'></i>Registros de acesso<i class='fa-solid fa-angle-right'></i></a></li>
                <li><a href='log_usuarios.php'><i class='fa-solid fa-arrow-pointer'></i>Registros de usuários<i class='fa-solid fa-angle-right'></i></a></li>
            </ul>
        </li>

        <li><a href="minha_senha.php"><i class="fa-solid fa-key"></i>Minha senha<i class="fa-solid fa-angle-right"></i></a></li>
    </ul>

    <img src="img/id-logo-branco-extenso.png" class="menu-logo-id">
    <p class="data-atual"><?= exibeDataAtual() ?></p>
</nav>