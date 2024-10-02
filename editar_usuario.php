<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

apenasAdmin();
senhaPrimeiroAcesso();

if(empty($_GET['id_usuario'])) {
    header("Location: gerenciar_usuarios.php");
    die();
}

$idUsuario = new Usuario($pdo);
$buscaIdUsuario = $idUsuario->buscaIdUsuario($_GET['id_usuario']);


// EDITA O USUÁRIO SELECIONADO...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // VERIFICA SE OS CAMPOS OBRIGATÓRIOS ESTÃO PREENCHIDOS ANTES DE ENVIAR...
    if (
        (isset($_POST['id_usuario'])) && (!empty($_POST['id_usuario'])) &&
        (isset($_POST['nome_usuario'])) && (!empty($_POST['nome_usuario'])) &&
        (isset($_POST['usuario'])) && (!empty($_POST['usuario'])) &&
        (isset($_POST['perfil'])) && (!empty($_POST['perfil'])) &&
        (isset($_POST['status'])) && (!empty($_POST['status']))
    ) {

        // SE OS CAMPOS ESTIVEREM TODOS PREENCHIDOS, A EDIÇÃO SERÁ CONCLUÍDA...
        $editaUsuario = new Usuario($pdo);
        $idUsuario = new Usuario($pdo);
        $buscaIdUsuario = $idUsuario->buscaIdUsuario($_GET['id_usuario']);

        $editaUsuario->editaUsuario($_POST['id_usuario'], $_POST['nome_usuario'], $_POST['usuario'], $_POST['perfil'], $_POST['status']);

        // REGISTRA O LOG DE EXCLUSÃO DE USUÁRIO
        $atividade = "Editou o usuário \"$_POST[usuario]\"";
        $regitraLogUsuario = new Logs($pdo);
        $regitraLogUsuario->registraLogUsuario("$atividade");

        header("Location: gerenciar_usuarios.php?edita_usuario=editado_com_sucesso");
        die();

    } else {

        // SE OS CAMPOS OBRIGATÓRIOS NÃO ESTIVEREM TODOS PREENCHIDOS, UM ERRO SERÁ EXIBIDO...
        $http_referer_erro_no_envio = $_SERVER['HTTP_REFERER'] . "&verifica_campos=campos_nao_preenchidos";

        header("Location: $http_referer_erro_no_envio");
        die();
    }
}

// BUSCA O ID DO USUÁRIO SELECIONADO PARA EDIÇÃO, SE NÃO FOR INFORMADO O ID NA URL, SERÁ REDIRECIONADO PARA TELA DE GERENCIAMENTO DE USUÁRIO...
if ($_GET['id_usuario'] ===  null) {
    header("Location: gerenciar_usuarios.php");
    die();
}


// EXIBE TODAS AS MINHAS REQUISIÇÕES
$todasMinhas = new Requisicao($pdo);
$todasMinhasRequisicoes = $todasMinhas->exibeMinhasRequisicoesHistorico();

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
                    <h3><a href="inicio.php">INÍCIO</a> / EDIÇÃO DE USUÁRIO</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>
                <section class="conteudo-center">
                    <form method="post" enctype="multipart/form-data">
                        <header id="form-cabecalho">
                            <h1>Edição de usuário</h1>
                            <i class="fa-solid fa-pen-to-square"></i>
                        </header>
                        <?php
                        if (empty($buscaIdUsuario['foto_perfil'])) {
                            // SE NÃO TIVER SIDO ENVIADO UMA FOTO, UM ÍCONE DE USER SERÁ EXIBIDO
                            echo "<i class='fa-solid fa-circle-user'></i>";
                        } else {
                            // SE TIVER SIDO ENVIADO UMA FOTO, ESSA FOTO SERÁ EXIBIDA
                            echo "<img src='$buscaIdUsuario[foto_perfil]' id='form-foto-perfil'>";
                        }
                        ?>
                        <h2 style="text-align: center"><?= htmlentities($buscaIdUsuario['nome_usuario']) ?></h2>
                        
                        <label for="nome_usuario">Alterar nome <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-user-large"></i>
                                <input type="text" name="nome_usuario" placeholder="Altere o nome do usuário" value="<?= $buscaIdUsuario['nome_usuario'] ?>">
                            </div>
                        </label>

                        <label for="usuario">Alterar usuário <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-user-tag"></i>
                                <input type="text" name="usuario" placeholder="Altere o usuário" value="<?= $buscaIdUsuario['usuario'] ?>" required>
                            </div>
                        </label>

                        <label for="perfil">Alterar perfil <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-user-shield"></i>
                                <select name="perfil" required>
                                    <option value="<?= $buscaIdUsuario['perfil'] ?>"><?= $buscaIdUsuario['perfil'] ?></option>
                                    <option value="Requisitante">Requisitante</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                        </label>

                        <label for="status">Ativa / Desatrivar <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-user-check"></i>
                                <select name="status" required>
                                    <option value="<?= $buscaIdUsuario['status'] ?>"><?= $buscaIdUsuario['status'] ?></option>
                                    <option value="Ativado">Ativado</option>
                                    <option value="Desativado">Desativado</option>
                                </select>
                            </div>
                        </label>

                        <input type="hidden" name="id_usuario" value="<?= $buscaIdUsuario['id_usuario'] ?>">

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
        </section>
    </main>

    <?php
    // EXIBE A ESTRUTURA HTML QUE EXIBE O HISTORICO DE REQUISIÇÕES DO USUÁRIO LOGADO...
    require_once "src/views/layout/meu_historico_requisicoes.php";
    ?>

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
                As requisições desse usuário serão excluídas do histórico.<br><br>
                Caso não queira perder o histórico de requisições desse usuário, você pode desativá-lo no formulário de edição em vez de excluí-lo.<br><br>
                Ao desativar o usuário, o acesso do mesmo será bloqueado.<br><br>
                Caso haja requisições desse usuário em aberto, não será possível excluí-lo.<br><br>
                Essa ação não poderá ser desfeita.
            </p>
            
            <div id="box-confimarcao-btns">
                <form action="src/manipulacoes_usuario/exclui_usuario.php" method="post">
                    <input type="hidden" name="id_usuario" value="<?= $buscaIdUsuario['id_usuario'] ?>">
                    <input type="hidden" name="usuario" value="<?= $buscaIdUsuario['usuario'] // PARA REGISTAR O NOME DO USUÁRIO EXCLUÍDO NO LOG ?>">
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