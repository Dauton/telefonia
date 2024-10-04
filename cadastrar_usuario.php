<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

apenasAdmin();
senhaPrimeiroAcesso();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cadastraUsuario = new Usuario($pdo);
    $cadastraUsuario->cadastraUsuario(
        $_POST['nome'],
        $_POST['matricula'],
        $_POST['unidade'],
        $_POST['cargo'],
        $_POST['perfil'],
        $_POST['usuario'],
        $_POST['senha'],
        $_POST['repete_senha'],
        $pdo // PASSADO POR PARÂMETRO POR CONTA DA VALIDAÇÃO DE USUÁRIO EXISTENTE, POS O MÉTODO É ESTÁTICO...
    );
    header("Location: gerenciar_usuarios.php?usuario=cadastrado_com_sucesso");
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
                    <h3><a href="inicio.php">INÍCIO</a> / CADASTRO DE USUÁRIO</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>
                <section class="conteudo-center" name="cadastro-usuario">
                    <form method="post" class="form-labels-lado-a-lado" id="form-labels-lado-a-lado" autocomplete="off">
                        <header id="form-cabecalho">
                            <h1>Cadastro de usuário</h1>
                            <i class="fa-solid fa-boxes-packing"></i>
                        </header>

                        <section class="form-secao-01" name="form-cadastro-usuario">

                            <h2>Preencha os campos</h2>

                            <label for="nome">Nome completo
                                <div>
                                    <i class="fa-solid fa-user"></i>
                                    <input type="text" name="nome" placeholder="Insira o nome do usuário">
                                </div>
                            </label>

                            <label for="matricula">Matrícula
                                <div>
                                    <i class="fa-solid fa-user-tag"></i>
                                    <input type="text" name="matricula" placeholder="Insira a matrícula">
                                </div>
                            </label>

                            <label for="unidade">Unidade
                                <div>
                                    <i class="fa-solid fa-map"></i>
                                    <select name="unidade">
                                        <option value="">Selecione</option>
                                        <option value="CDARCEX">CDARCEX</option>
                                        <option value="CDAMBEX">CDAMBEX</option>
                                    </select>
                                </div>
                            </label>

                            <label for="cargo">Cargo
                                <div>
                                    <i class="fa-solid fa-briefcase"></i>
                                    <select name="cargo">
                                        <option value="">Selecione</option>
                                        <option value="ANALISTA DE TI">ANALISTA DE TI</option>
                                    </select>
                                </div>
                            </label>

                            <label for="perfil">Perfil
                                <div>
                                    <i class="fa-solid fa-user-shield"></i>
                                    <select name="perfil">
                                        <option value="">Selecione o perfil</option>
                                        <option value="CONSULTANTE">CONSULTANTE</option>
                                        <option value="ADMIN">ADMIN</option>
                                    </select>
                                </div>
                            </label>

                            <label for="usuario">Usuário
                                <div>
                                    <i class="fa-solid fa-id-card-clip"></i>
                                    <input type="text" name="usuario" placeholder="Crie o usuário">
                                </div>
                            </label>

                            <label for="senha">senha
                                <div>
                                    <i class="fa-solid fa-key"></i>
                                    <input type="password" name="senha" id="senha" placeholder="Senha" autocomplete="new-password">
                                    <i id="mostrar-senha" class="fa-solid fa-eye"></i>
                                    <i id="ocultar-senha" class="fa-solid fa-eye-slash" style="display: none"></i>
                                </div>
                            </label>

                            <label for="repete_senha">Repita a senha
                                <div>
                                    <i class="fa-solid fa-key"></i>
                                    <input type="password" name="repete_senha" id="repete-senha" placeholder="Repita a senha" autocomplete="new-password">
                                    <i id="mostrar-repete-senha" class="fa-solid fa-eye"></i>
                                    <i id="ocultar-repete-senha" class="fa-solid fa-eye-slash" style="display: none"></i>
                                </div>
                            </label>

                            <div>
                                <button type="submit" name="btn-requisitar">Cadastrar</but>
                            </div>
                        </section>
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
        <a href="gerenciar_usuarios.php"><button id="btn-atalho" title="Gerenciar usuários">
                <i class="fa-solid fa-users"></i>
            </button></a>
    </div>


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>