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
            <p><?= $_SESSION['nome'] ?></p>
            <p><?= $_SESSION['unidade'] ?></p>
            <a href="src/config/logout.php"><button type="button" id="btn-sair">Sair</button></a>
        </span>
    </div>

    <div class="menu-divisoria">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <ul>
        <li><a href="inicio.php"><i class="fa-solid fa-house"></i></i>Início<i class="fa-solid fa-angle-right"></i></a></li>

        <li id="menu_02"><a><i class="fa-solid fa-database"></i>Cadastros<i class="fa-solid fa-angle-right"></i></a>
            <ul id="menusub_02">
                <li><a href="cadastrar_dispositivo.php"><i class="fa-solid fa-mobile-screen-button"></i>Dispositivo<i class="fa-solid fa-angle-right"></i></a></li>
                <li><a href='cadastrar_opcoes.php'><i class="fa-solid fa-gears"></i>Cadastro de opções<i class='fa-solid fa-angle-right'></i></a></li>
            </ul>
        </li>
        <li id='menu_03'><a><i class="fa-solid fa-magnifying-glass"></i>Consulta<i class='fa-solid fa-angle-right'></i></a>
            <ul id='menusub_03'>
                <li><a href='consulta_dispositivos.php'><i class="fa-solid fa-mobile-screen"></i>Consultar dispositivos<i class='fa-solid fa-angle-right'></i></a></li>
            </ul>
        </li>
        <li id='menu_04'><a><i class="fa-solid fa-headset"></i></i>Painel de chamados<i class='fa-solid fa-angle-right'></i></a>
            <ul id='menusub_04'>
                <li><a href='abrir_chamado.php'><i class="fa-solid fa-comment"></i></i>Abrir um chamado<i class='fa-solid fa-angle-right'></i></a></li>
                <li><a href='gerenciar_chamados.php'><i class="fa-solid fa-comments"></i>Gerenciar chamados<i class='fa-solid fa-angle-right'></i></a></li>
            </ul>
        </li>
        <li id='menu_05'><a><i class='fa-solid fa-gear'></i>Admin<i class='fa-solid fa-angle-right'></i></a>
            <ul id='menusub_05'>
                <li><a href='cadastrar_usuario.php'><i class="fa-solid fa-user-plus"></i>Cadastrar usuário<i class='fa-solid fa-angle-right'></i></a></li>
                <li><a href='gerenciar_usuarios.php'><i class="fa-solid fa-users"></i>Gerenciar usuários<i class='fa-solid fa-angle-right'></i></a></li>
                <li><a href='log_logins.php'><i class="fa-regular fa-circle"></i>Registros de acesso<i class='fa-solid fa-angle-right'></i></a></li>
                <li><a href='log_usuarios.php'><i class="fa-regular fa-circle"></i>Registros de usuários<i class='fa-solid fa-angle-right'></i></a></li>
            </ul>
        </li>

        <li><a href="minha_senha.php"><i class="fa-solid fa-key"></i>Minha senha<i class="fa-solid fa-angle-right"></i></a></li>
    </ul>

    <img src="img/id-logo-branco-extenso.png" class="menu-logo-id">
    <p class="data-atual"><?= exibeDataAtual() ?></p>
</nav>