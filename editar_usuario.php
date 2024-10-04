<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

apenasAdmin();
senhaPrimeiroAcesso();

$idUsuario = new Usuario($pdo);
$buscaIdUsuario = $idUsuario->buscaIdUsuario($_GET['id_usuario']);


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editaUsuario = new Usuario($pdo);
    $editaUsuario->editaUsuario(
        $_POST['nome'],
        $_POST['matricula'],
        $_POST['unidade'],
        $_POST['cargo'],
        $_POST['perfil'],
        $_POST['usuario'],
        $_POST['status'],
        $pdo // PASSADO POR PARÂMETRO POR CONTA DA VALIDAÇÃO DE USUÁRIO EXISTENTE, POIS O MÉTODO É ESTÁTICO...

    );

    header("Location: gerenciar_usuarios.php?usuario=editado_com_sucesso");
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
                    <h3><a href="inicio.php">INÍCIO</a> / <a href="gerenciar_usuarios.php">GERENCIAR USUÁRIOS</a> / EDIÇÃO DE USUÁRIO</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>
                <section class="conteudo-center">
                    <form method="post">
                        <header id="form-cabecalho">
                            <h1>Edição de usuário</h1>
                            <i class="fa-solid fa-pen-to-square"></i>
                        </header>

                        <i class='fa-solid fa-circle-user'></i>

                        <h2 style="text-align: center"><?= htmlentities($buscaIdUsuario['nome']) ?></h2>

                        <section class="form-secao-01" name="form-cadastro-usuario">

                            <h2>Preencha os campos</h2>
                            
                            <label for="nome">Nome completo<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-user"></i>
                                    <input type="text" name="nome" value="<?= $buscaIdUsuario['nome'] ?>" placeholder="Insira o nome do usuário">
                                </div>
                            </label>

                            <label for="matricula">Matrícula<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-user-tag"></i>
                                    <input type="text" name="matricula" value="<?= $buscaIdUsuario['matricula'] ?>" placeholder="Insira a matrícula">
                                </div>
                            </label>

                            <label for="unidade">Unidade<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-map"></i>
                                    <select name="unidade" required>
                                        <option value="<?= $buscaIdUsuario['unidade'] ?>"><?= $buscaIdUsuario['unidade'] ?></option>
                                        <option value="CDARCEX">CDARCEX</option>
                                        <option value="CDAMBEX">CDAMBEX</option>
                                    </select>
                                </div>
                            </label>

                            <label for="cargo">Cargo<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-briefcase"></i>
                                    <select name="cargo" required>
                                        <option value="<?= $buscaIdUsuario['cargo'] ?>"><?= $buscaIdUsuario['cargo'] ?></option>
                                        <option value="ANALISTA DE TI">ANALISTA DE TI</option>
                                    </select>
                                </div>
                            </label>

                            <label for="perfil">Perfil<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-user-shield"></i>
                                    <select name="perfil" required>
                                        <option value="<?= $buscaIdUsuario['perfil'] ?>"><?= $buscaIdUsuario['perfil'] ?></option>
                                        <option value="CONSULTANTE">CONSULTANTE</option>
                                        <option value="ADMIN">ADMIN</option>
                                    </select>
                                </div>
                            </label>

                            <label for="usuario">Usuário<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-id-card-clip"></i>
                                    <input type="text" name="usuario" value="<?= $buscaIdUsuario['usuario'] ?>" placeholder="Crie o usuário" required>
                                </div>
                            </label>

                            <label for="status">Ativar / Desativar<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-user-slash"></i>
                                    <select name="status" required>
                                        <option value="<?= $buscaIdUsuario['status'] ?>"><?= $buscaIdUsuario['status'] ?></option>
                                        <option value="ATIVADO">ATIVADO</option>
                                        <option value="DESATIVADO">DESATIVADO</option>
                                    </select>
                                </div>
                            </label>

                            <div>
                                <button type="submit" name="btn-requisitar">Editar</button>
                                <a href="gerenciar_usuarios.php"><button type="button" id="btn-cancelar">Cancelar</button></a>
                            </div>

                        </section>
                    </form>
                </section>

                <?php
                    // EXIBE O RODAPÉ...
                    require_once "src/views/layout/rodape.php";
                ?>

            </article>
        </section>
    </main>

    <div class="btns-atalhos">
        <a href="reset_senha_usuario.php?id_usuario=<?= $buscaIdUsuario['id_usuario'] ?>"><button type="button" id="btn-atalho" title="Resetar a senha desse usuário"><i class="fa-solid fa-key"></i></button></a>
        <button type="button" id="btn-atalho" title="Excluir"><i class="fa-solid fa-trash-can"></i></button>

        <div id="box-confirmacao">

            <header class="box-ajuda-cabecalho">
                <h1>Confirmação</h1>
                <i class="fa-solid fa-triangle-exclamation"></i>
            </header>

            <h2>Observações</h2>
            <p>
                Tem certeza que deseja excluir esse usuário?<br><br>
                Essa ação não poderá ser desfeita.
            </p>

            <div id="box-confimarcao-btns">
                <form action="src/manipulacoes_usuario/exclui_usuario.php" method="post">
                    <input type="hidden" name="id_usuario" value="<?= $buscaIdUsuario['id_usuario'] ?>">
                    <input type="hidden" name="usuario" value="<?= $buscaIdUsuario['usuario'] // PARA REGISTAR O NOME DO USUÁRIO EXCLUÍDO NO LOG 
                                                                ?>">
                    <button type="submit" title="Excluir esse usuário">Excluir</button>
                </form>
                <button type="button" id="btn-cancelar">Cancelar</button>
            </div>

        </div>

    </div>


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>