<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

apenasAdmin();
senhaPrimeiroAcesso();

$buscIdInventario = new Inventario($pdo);
$inventario = $buscIdInventario->buscaNomeInventario($_GET['nome_inventario']);

$visualizaInventario = new Inventario($pdo);
$inventario = $visualizaInventario->visualizaInventario($_GET['nome_inventario']);


// EXIBE TODAS AS MINHAS REQUISIÇÕES
$todasMinhas = new Requisicao($pdo);
$todasMinhasRequisicoes = $todasMinhas->exibeMinhasRequisicoesHistorico();


?>


<!DOCTYPE html>
<html lang="pt-br">

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
                    <h3><a href="inicio.php">INÍCIO</a> / <a href="painel_inventario.php">PAINEL DE INVENTÁRIO</a> / VISUALIZANDO INVENTÁRIO</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>

                <section class="conteudo-center">
                    <article class="conteudo-center-boxs">

                        <div class="conteudo-center-box-02">
                            <h1>Exibindo o inventário:
                                <b>
                                    <?php
                                    $nome_inventario = htmlentities($_GET['nome_inventario']);
                                    $renove_uniqid = preg_replace('/\d/', '', $nome_inventario);
                                    echo $renove_uniqid;
                                    ?>
                                </b>
                            </h1>
                            <table>
                                <thead>
                                    <tr>
                                        <td>Descrição</td>
                                        <td>Unidade de medida</td>
                                        <td>Quantidade</td>
                                        <td>Diferença</td>
                                        <td>Inventariado por</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($inventario as $visualizaInventario) : ?>
                                        <tr>
                                            <td><?= htmlentities($visualizaInventario['descricao']) ?></td>
                                            <td><?= htmlentities($visualizaInventario['unidade_medida']) ?></td>
                                            <td><?= htmlentities($visualizaInventario['estoque']) ?></td>
                                            <td><?= htmlentities($visualizaInventario['diferenca_estoque']) ?></td>
                                            <td><?= htmlentities($visualizaInventario['produto_inv_por']) ?></td>
                                            <td title="Status de inventário do produto">
                                                <p><?= htmlentities($visualizaInventario['status_inv_produto']) ?></p>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            <p>Nenhum produto a mais para ser exibido.</p>
                        </div>
                    </article>
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

        <form method="post" action="src/excel/extrair_inventario.php">
            <input type="hidden" name="nome_inventario" value="<?= $_GET['nome_inventario'] ?>">
            <button id="btn-atalho" title="Extrair para Excel">
                <img src="img/logo-excel.png">
            </button>
        </form>
        <button type="button" id="btn-atalho" title="Excluir"><i class="fa-solid fa-trash-can"></i></button>

        <div id="box-confirmacao">

            <header class="box-ajuda-cabecalho">
                <h1>Confirmação</h1>
                <i class="fa-solid fa-triangle-exclamation"></i>
            </header>

            <p>
                Tem certeza que deseja excluir esse inventário?<br><br>
                Essa ação não poderá ser desfeita.
            </p>
            <div id="box-confimarcao-btns">
                <form method="post" action="src/manipulacoes_inventario/exclui_inventario.php">
                    <input type="hidden" name="nome_inventario" value="<?= $_GET['nome_inventario'] ?>">
                    <button type="submit" title="Excluir">Excluir</button>
                </form>

                <button type="button" id="btn-cancelar">Cancelar</button>
            </div>
        </div>

    </div>
    </div>

    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>