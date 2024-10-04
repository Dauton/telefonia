<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

apenasAdmin();
senhaPrimeiroAcesso();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resetaSenhaUsuario = new Usuario($pdo);
    $resetaSenhaUsuario->resetaSenhaUsuario($_POST['id_usuario'], $_POST['senha']);

    header("Location: gerenciar_usuarios.php?verifica_senha=senha_resetada");
    die();
}

// BUSCA O ID DO USUÁRIO SELECIONADO PARA RESET DE SENHA, SE NÃO FOR INFORMADO O ID NA URL, SERÁ REDIRECIONADO PARA TELA DE GERENCIAMENTO DE USUÁRIO...
if ($_GET['id_usuario'] ===  null) {
    header("Location: gerenciar_usuarios.php");
    die();
}

$idUsuario = new Usuario($pdo);
$buscaIdUsuario = $idUsuario->buscaIdUsuario($_GET['id_usuario']);

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
                    <h3><a href="inicio.php">INÍCIO</a> / RESET SENHA</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>
                <section class="conteudo-center">
                    <form method="post" class="form-requisicao" id="form-requisicao">
                        <header id="form-cabecalho">
                            <h1>Reset de senha</h1>
                            <i class="fa-solid fa-key"></i>
                        </header>

                        <i class='fa-solid fa-circle-user'></i>

                        <h2 style="text-align: center"><?= htmlentities($buscaIdUsuario['nome']) ?></h2>

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
                        <input type="hidden" name="usuario" value="<?= $buscaIdUsuario['usuario'] // PARA ARMAZENAR O USUÁRIO ALTERADO NO LOG 
                                                                    ?>">

                        <div>
                            <button type="submit">Concluir</button>
                            <a href="<?= $_SERVER['HTTP_REFERER'] ?>"><button type="button" id="btn-cancelar">Cancelar</button></a>
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