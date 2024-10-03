<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

apenasAdmin();
senhaPrimeiroAcesso();

    // EXIBE TODOS OS USUÁRIOS CADASTRADOS
    $exibeUsuarios = new Usuario($pdo);
    $exibeTodosUsuarios = $exibeUsuarios->exibeUsuarios();

?>


<!DOCTYPE html>
<html>

<head>
    
    <?php
        // META TAGS E LINKS DO HEAD...
        require_once "src/views/layout/head.php";
    ?>

</head>

<body>
    <main class="corpo">
        
        <?php
            // EXIBE O MENU LATERAL... 
            require_once "src/views/layout/menu_lateral.php"; 
        ?>

        <section class="principal">
            
            <?php
                // EXIBE O CABEÇALHO...
                require_once "src/views/layout/cabecalho.php";
            ?>

            <article class="conteudo">
                <header class="conteudo-cabecalho">
                    <h3><a href="inicio.php">INÍCIO</a> / GERENCIAR USUÁRIOS</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>
                
                <section class="conteudo-center">
                    <h1>Gerenciamento de usuários</h1>
                    <table>
                        <thead>
                            <tr>
                                <td></td>
                                <td>Nome</td>
                                <td>Usuário</td>
                                <td>Perfil</td>
                                <td>Status</td>
                                <td>Cadastrado por</td>
                                <td>Data cadastro</td>
                                <td>Edição</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($exibeTodosUsuarios as $exibeUsuarios) : ?>
                            <tr>
                                <td>
                                    <?php  

                                        if(empty($exibeUsuarios['foto_perfil']))
                                        {
                                            // SE NÃO TIVER SIDO ENVIADO UMA FOTO, UM ÍCONE DE USER SERÁ EXIBIDO
                                            echo "<i class='fa-solid fa-circle-user'></i>";
                                        } else {
                                            // SE TIVER SIDO ENVIADO UMA FOTO, ESSA FOTO SERÁ EXIBIDA NA TEBALA
                                            echo "<img src='$exibeUsuarios[foto_perfil]' id='table-foto-perfil'>";
                                        }
                                    ?>
                                </td>
                                <td><?= htmlentities($exibeUsuarios['nome']) ?></td>
                                <td><?= htmlentities($exibeUsuarios['usuario']) ?></td>
                                <td><?= htmlentities($exibeUsuarios['perfil']) ?></td>
                                <td><?= htmlentities($exibeUsuarios['status']) ?></td>
                                <td><?= htmlentities($exibeUsuarios['cadastrado_por']) ?></td>
                                <td><?= htmlentities($exibeUsuarios['data_cadastro']) ?></td>
                                <td id="acoes">
                                    <form>
                                        <button type="button" id="table-form-btn-editar"><a href="editar_usuario.php?id_usuario=<?= $exibeUsuarios['id_usuario'] ?>" title="Editar esse usuário"><i class="fa-solid fa-square-pen"></i></a></button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </section>

                <?php
                    // EXIBE O RODAPÉ...
                    require_once "src/views/layout/rodape.php";
                ?>

            </article>
        </section>
    </main>

    <div class="btns-atalhos">
        <a href="cadastrar_usuario.php"><button id="btn-atalho" title="Cadastrar um novo usuário">
            <i class="fa-solid fa-user-plus"></i>
        </button></a>
    </div>


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>