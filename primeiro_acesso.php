<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resetaSenhaUsuario = new Usuario($pdo);
    $resetaSenhaUsuario->resetaSenhaUsuario($_POST['id_usuario'], $_POST['senha'], 'ALTERADA');

    $armazenaLog = new Logs($pdo);
    $armazenaLog->armazenaLog(
        'Usuários',
        $_SESSION['usuario'],
        'Resetou a própria senha no primeiro acesso',
        'Sucesso',
        ''
    );

    session_destroy();
    header("Location: index.php?verifica_senha=primeiro_acesso");
    die();
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
        
        <section class="principal">
                <section class="conteudo-center" style="flex-direction: row">
                    <form method="post" id="form-altera-senha">
                        <header id="form-cabecalho">
                            <h1>Primeiro acesso</h1>
                            <i class="fa-solid fa-key"></i>
                        </header>
                        
                        <i class='fa-solid fa-circle-user'></i>
                        
                        <h2 style="text-align: center">Olá, <?= htmlentities($_SESSION['nome']) ?>!<br><p>Para continuar, altere sua senha seguindo os requisitos informados no botão <i class="fa-regular fa-circle-question"></i></p></h2>

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
                            <a href="src/config/logout.php"><button type="button" id="btn-cancelar">Sair</button></a>
                        </div>
                    </form>
                </section>

                <?php
                    // EXIBE O RODAPÉ...
                    require_once "src/views/layout/rodape.php";
                ?> 
            
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