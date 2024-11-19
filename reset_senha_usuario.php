<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

senhaPrimeiroAcesso();
liberacaoInfraIDL();

$buscaIdUsuario = new Usuario($pdo);
$dadoUsuario = $buscaIdUsuario->buscaIdUsuario($_GET['id_usuario']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // VERIFICA SE O CHECKBOX DE ALTERAR A SENHA NO PROXIMO LOGIN ESTÁ ATIVADO...
    if (isset($_POST['primeiro_acesso'])) {
        $senha_primeiro_acesso = 'PENDENTE';
    } else {
        $senha_primeiro_acesso = 'ALTERADA';
    }

    $resetaSenhaUsuario = new Usuario($pdo);
    $resetaSenhaUsuario->resetaSenhaUsuario($_POST['id_usuario'], $_POST['senha'], $senha_primeiro_acesso);

    $armazenaLog = new Logs($pdo);
    $armazenaLog->armazenaLog(
        'Usuários',
        $_SESSION['usuario'],
        'Resetou a senha do usuário "' . $dadoUsuario['usuario'] . '"',
        'Sucesso',
        ''
    );

    header("Location: gerenciar_usuarios.php?verifica_senha=senha_resetada");
    die();
}

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
                </header>
                <section class="conteudo-center" name="altera_senha">
                    <form method="post" id="form-altera-senha">
                        <header id="form-cabecalho">
                            <h1>Reset de senha</h1>
                            <i class="fa-solid fa-key"></i>
                        </header>

                        <i class='fa-solid fa-circle-user'></i>

                        <h2 style="text-align: center"><?= htmlentities($dadoUsuario['nome']) ?></h2>

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

                        <label for="primeiro_acesso" id="label_ checkbox">
                            <input type="checkbox" name="primeiro_acesso" id="primeiro_acesso" checked> Obrigar alteração no próximo acesso
                        </label>

                        <input type="hidden" name="id_usuario" value="<?= $dadoUsuario['id_usuario'] ?>">
                        <input type="hidden" name="usuario" value="<?= $dadoUsuario['usuario'] // PARA ARMAZENAR O USUÁRIO ALTERADO NO LOG 
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
                    <b>Caracteres</b>: a senha deve possuir no mínimo 12 caracteres.<br><br>
                    <b>Letras</b>: a senha deve possuir letras maiúsculas e minúsculas.<br><br>
                    <b>Números</b>: a senha deve possuir pelo menos um número.<br><br>
                    <b>Caracteres especiais</b>: a senha deve possuir pelo menos um caractere especial.<br><br>
                    <b>Resumindo</b>: a senha deve possuir uma combinação de 12 caracteres sendo elas letras maiúsculas, minúsculas, números e caracteres espeicias.
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