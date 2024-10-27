<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

senhaPrimeiroAcesso();

$tipo = new Opcoes($pdo);
$listaTipos = $tipo->listaTiposOpcoes();

$buscIdOpcao = new Opcoes($pdo);
$opcao = $buscIdOpcao->buscaIdOpcao($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editaDispositivo = new Opcoes($pdo);
    $editaDispositivo->editaOpcao(
        $_POST['tipo'],
        $_POST['descricao'],
        $pdo
    );

    $armazenaLog = new Logs($pdo);
    $armazenaLog->armazenaLog(
        'Opções',
        $_SESSION['usuario'],
        'Atualizou a opção "' . $_POST['descricao'] . '" do tipo "' . $_POST['tipo'] . '"',
        'Sucesso',
        ''
    );

    header("Location: cadastrar_opcoes.php?opcao=editada");
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
                    <h3><a href="inicio.php">INÍCIO</a> / <a href="cadastrar_opcoes.php">CADASTRAR OPÇÕES</a> / EDITAR OPÇÃO</h3>
                </header>
                <section class="conteudo-center">

                    <form method="post" action="">
                        <header id="form-cabecalho">
                            <h1>Cadastrar e gerenciar opções</h1>
                            <i class="fa-solid fa-gears"></i>
                        </header>


                        <section style="display: flex;">
                            <label for="tipo">Tipo da opção<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-gears"></i>
                                    <select id="tipo" name="tipo">
                                        <option value="<?= htmlentities($opcao['tipo']) ?>"><?= htmlentities($opcao['tipo']) ?></option>
                                        <?php foreach ($listaTipos as $tipo) : ?>
                                            <option value="<?= htmlentities($tipo['descricao_tipo']) ?>"><?= htmlentities($tipo['descricao_tipo']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </label>
                            <label for="descricao">Descrição<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-mobile-screen"></i>
                                    <input type="text" id="descricao" name="descricao" value="<?= htmlentities($opcao['descricao']) ?>" placeholder="Descrição da opção">
                                </div>
                            </label>
                            <div>
                                <button type="submit">Editar</button>
                                <a href="cadastrar_opcoes.php"><button type="button" id="btn-cancelar">Cancelar</button></a>
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
                    <h1>Dúvidas</h1>
                    <i class="fa-solid fa-circle-question"></i>
                </header>
                <p>
                    Caso, no momento do cadastro ou edição de um dispositivo, não exista a opção desejada em um campo de seleção, você poderá cadastrá-la aqui.<br><br>
                    No cadastro de dispositivos, existem quatro campos que podem não conter a opção desejada:<br><br>
                    <b> • Marca do aparelho;</b><br>
                    <b> • Modelo do aparelho;</b><br>
                    <b> • Unidade;</b><br>
                    <b> • Centro.</b><br><br>
                    O campo "Unidade" também está presente no cadastro e edição de usuários.
                </p>

                <button id="box-ajuda-fechar-btn">Fechar</button>

            </div>
        </section>
    </main>

    <div class="btns-atalhos">
        <button type="button" id="btn-atalho" title="Caixa de ajuda"><i class="fa-regular fa-circle-question"></i></button>
        <button id="btn-atalho" title="Excluir" title="Gerenciar usuários">
            <i class="fa-solid fa-trash-can"></i>
        </button>

        <div id="box-confirmacao" title="Caixa de exclusão">

            <header class="box-ajuda-cabecalho">
                <h1>Confirmação</h1>
                <i class="fa-solid fa-triangle-exclamation"></i>
            </header>

            <h2>Observações</h2>
            <p>
                Tem certeza que deseja excluir essa opção?<br><br>
                Essa ação não poderá ser desfeita.
            </p>

            <div id="box-confimarcao-btns">
                <form action="src/manipulacoes_opcao/exclui_opcao.php" method="post">
                    <input type="hidden" name="id" title="Cancelar exclusão" value="<?= $opcao['id'] ?>">
                    
                    <div>
                        <button type="submit" id="btn-red" title="Excluir essa opção">Excluir</button>
                        <button type="button" id="btn-cancelar" title="Cancelar exclusão">Cancelar</button>
                    </div>
                </form>
            </div>

        </div>

    </div>


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>