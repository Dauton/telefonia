<?php

    if(!isset($_SESSION['usuario']))
    {
        header("Location: ../../../index.php");
        die();
    }
    
?>

<div id="back-menu"></div>
<nav class="menu">
    <div class="menu-user-info">
        <span>
            <a <?php if ($_SESSION['perfil'] === "Admin") {
                    echo "href='editar_usuario.php?id_usuario=$_SESSION[id_usuario]'";
                } ?> title="Editar perifl">

                <?= exibeFotoPerfilMenuLateral() ?>

                <h3>Bem-vindo(a)!</h3>
                <p><?= $_SESSION['nome_usuario'] ?></p>
            </a>
            <a href="src/config/logout.php"><button type="button" id="btn-sair">Sair</button></a>
        </span>
    </div>

    <div class="menu-divisoria">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <ul>
        <li><a href="inicio.php"><i class="fa-solid fa-house"></i>Início<i class="fa-solid fa-angle-right"></i></a></li>

        <li id="menu_02"><a><i class="fa-solid fa-basket-shopping"></i>Requisições<?= exibeNotificacaoRequisicoesEmAberto($pdo) ?></a>
            <ul id="menusub_02">
                <li><a href="requisicao.php"><i class="fa-solid fa-arrow-pointer"></i>Abrir requisição<i class="fa-solid fa-angle-right"></i></a></li>

                <?php if ($_SESSION['perfil'] != "Admin") { /* O restante do menu "Almoxarifado" só será exibido para usuários com perfil Admin ou Master */
                    echo "";
                } else {
                    echo "
                        <li><a href='gerenciar_requisicoes.php'><i class='fa-solid fa-arrow-pointer'></i>Gerenciar requisições" . exibeNotificacaoRequisicoesEmAberto($pdo) . "</a></li>
                        <li><a href='historico_requisicoes.php'><i class='fa-solid fa-arrow-pointer'></i>Histórico de requisições<i class='fa-solid fa-angle-right'></i></a></li>
                     ";
                }
                ?>
            </ul>
        </li>

        <?php if ($_SESSION['perfil'] != "Admin") {
            echo "";
        } else {
            echo "                
                <li id='menu_03'><a><i class='fa-solid fa-dolly'></i>Almoxarifado<i class='fa-solid fa-angle-right'></i></a>
                    <ul id='menusub_03'>
                        <li><a href='controle_estoque.php'><i class='fa-solid fa-arrow-pointer'></i>Controle de estoque<i class='fa-solid fa-angle-right'></i></a></li>
                        <li><a href='cadastrar_produto.php'><i class='fa-solid fa-arrow-pointer'></i>Cadastrar produto<i class='fa-solid fa-angle-right'></i></a></li>
                        <li><a href='painel_inventario.php'><i class='fa-solid fa-arrow-pointer'></i>Painel de inventário<i class='fa-solid fa-angle-right'></i></a></li>
                        <li><a href='log_produtos.php'><i class='fa-solid fa-arrow-pointer'></i>Registros do estoque<i class='fa-solid fa-angle-right'></i></a></li>
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
            ";
        }
        ?>

        <li><a href="minha_senha.php"><i class="fa-solid fa-key"></i>Minha senha<i class="fa-solid fa-angle-right"></i></a></li>
    </ul>

    <img src="img/id-logo-branco-extenso.png" class="menu-logo-id">
    <p class="data-atual"><?= exibeDataAtual() ?></p>
</nav>