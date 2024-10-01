<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

senhaPrimeiroAcesso();

if($_SERVER['REQUEST_METHOD'] === 'POST')
{

    if(validacaoMinhaSenha($pdo)) {

    } else {
        $resetaSenhaUsuario = new Usuario($pdo);
        $resetaSenhaUsuario->resetaSenhaUsuario($_POST['id_usuario'], $_POST['senha']);
    
        header("Location: inicio.php?verifica_senha=senha_resetada");
        die();
    }
}

$idUsuario = new Usuario($pdo);
$buscaIdUsuario = $idUsuario->buscaIdUsuario($_SESSION['id_usuario']);

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
                    <h3><a href="inicio.php">INÍCIO</a> / RESET MINHA SENHA</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>
                <section class="conteudo-center">
                    <form method="post" class="form-requisicao" id="form-requisicao">
                        <header id="form-cabecalho">
                            <h1>Reset minha senha</h1>
                            <i class="fa-solid fa-key"></i>
                        </header>
                        <?php
                        if (empty($_SESSION['foto_perfil'])) {
                            // SE NÃO TIVER SIDO ENVIADO UMA FOTO, UM ÍCONE DE USER SERÁ EXIBIDO
                            echo "<i class='fa-solid fa-circle-user'></i>";
                        } else {
                            // SE TIVER SIDO ENVIADO UMA FOTO, ESSA FOTO SERÁ EXIBIDA
                            echo "<img src='$_SESSION[foto_perfil]' id='form-foto-perfil'>";
                        }
                        ?>
                        <h2 style="text-align: center"><?= htmlentities($_SESSION['nome_usuario']) ?></h2>

                        <label for="senha">Nova senha
                            <div>
                                <i class="fa-solid fa-key"></i>
                                <input type="password" name="senha" id="senha" placeholder="Nova senha" required>
                                <i id="mostrar-senha" class="fa-solid fa-eye"></i>
                                <i id="ocultar-senha" class="fa-solid fa-eye-slash" style="display: none"></i>
                            </div>
                        </label>

                        <label for="repete_senha">Repita a nova senha
                            <div>
                                <i class="fa-solid fa-key"></i>
                                <input type="password" name="repete_senha" id="repete-senha" placeholder="Nova senha novamente" required>
                                <i id="mostrar-repete-senha" class="fa-solid fa-eye"></i>
                                <i id="ocultar-repete-senha" class="fa-solid fa-eye-slash" style="display: none"></i>
                            </div>
                        </label>

                        <input type="hidden" name="id_usuario" value="<?= $buscaIdUsuario['id_usuario'] ?>">

                        <div>
                            <button type="submit">Concluir</button>
                            <a href="inicio.php"><button type="button" id="btn-cancelar">Cancelar</button></a>
                        </div>
                    </form>
                </section>

                <?php
                    // EXIBE O RODAPÉ...
                    require_once "src/views/layout/rodape.php";
                ?>

            </article>            
            
            <div id="box-ajuda">
                <header class="box-ajuda-cabecalho">
                    <h1>Requisitos de senha</h1>
                    <i class="fa-solid fa-key"></i>
                </header>
                <p>
                    <b>Caracteres</b>: a senha deve conter no mínimo 12 caracteres.<br><br>
                    <b>Letras</b>: a senha deve conter letras maiúsculas e minúsculas.<br><br>
                    <b>Números</b>: a senha deve conter pelo menos um número.<br><br>
                    <b>Resumindo</b>: a senha deve possuir uma combinação de 12 caracteres sendo elas letras maiúsculas, minúsculas e números.
                </p>
                <button id="box-ajuda-fechar-btn">Fechar</button>

            </div>
        </section>
    </main>

    <div class="btns-atalhos">
        <button type="button" id="btn-atalho" title="Caixa de ajuda"><i class="fa-regular fa-circle-question"></i></button>
    </div>


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>