<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

apenasAdmin();
senhaPrimeiroAcesso();

if(empty($_GET['nome_inventario']))
{
    header("Location: inicio.php");
    die();
}

$buscNomeInventario = new Inventario($pdo);
$inventario = $buscNomeInventario->buscaNomeInventario($_GET['nome_inventario']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inventariaProduto = new Inventario($pdo);
    $inventariaProduto->inventariaProduto(
        $inventario['nome_inventario'],
        $inventario['criado_por'],
        $inventario['data_inicio'],
        $inventario['data_final'],
        $_POST['descricao'],
        $_POST['unidade_medida'],
        $_POST['estoque'],
        $_POST['diferenca_estoque'],
        'INVENTARIADO',
        $inventario['status_inventario']
    );

    header("Location: inventario.php?nome_inventario=$inventario[nome_inventario]&inventario=produto_inventariado");
    die();
}


$exibeProduto = new Inventario($pdo);
$exibeProdutos = $exibeProduto->exibeProdutosInventario();


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
                    <h3><a href="inicio.php">INÍCIO</a> / <a href="painel_inventario.php">PAINEL DE INVENTÁRIO</a> / INVENTARIANDO</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>

                <section class="conteudo-center">
                    <article class="conteudo-center-boxs">

                        <div class="conteudo-center-box-02">
                            <h1>Informações desse inventário</h1>
                            <table>
                                <thead>
                                    <tr>
                                        <td>Nome do inventário</td>
                                        <td>Total de produtos</td>
                                        <td>Já inventariados</td>
                                        <td>Não inventariados</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p style="background: #ffa500;">
                                                <?php
                                                    $nome_inventario = htmlentities($_GET['nome_inventario']);
                                                    $renove_uniqid = preg_replace('/\d/', '', $nome_inventario); 
                                                    echo $renove_uniqid;
                                                ?>
                                            </p>
                                        </td>
                                        <td><p style="background: #0088ff;"><?= exibeQuantidadeProdutosCadastrados($pdo) ?> PRODUTO(OS)</p></td>
                                        <td><p style="background: #00a000;"><?= exibeQuantidadeInventariado($pdo) ?> PRODUTO(OS)</p></td>
                                        <td><p style="background: #cc2626;"><?= exibeQuantidadeNãoInventariado($pdo) ?> PRODUTO(OS)</td>
                                    </tr>
                                </tbody>
                            </table>
                            <button id="btn-finaliza-inv">Finalizar inventário</button>
                            <table>
                                <thead>
                                    <tr>
                                        <td>Descrição</td>
                                        <td>Unidade de medida</td>
                                        <td>Quantidade</td>
                                        <td>Diferença</td>
                                        <td>Inventariar</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($exibeProdutos as $exibeProduto) : ?>
                                        <tr>
                                            <form method="post">
                                                <td><?= htmlentities($exibeProduto['descricao']) ?></td>
                                                <td><?= htmlentities($exibeProduto['unidade_medida']) ?></td>
                                                <input type="hidden" name="descricao" value="<?= htmlentities($exibeProduto['descricao']) ?>" readonly id="form-hidden-input">
                                                <input type="hidden" name="unidade_medida" value="<?= htmlentities($exibeProduto['unidade_medida']) ?>" readonly id="form-hidden-input">
                                                <input type="hidden" name="status_inv_produto" value="<?= htmlentities($exibeProduto['status_inv_produto']) ?>" readonly id="form-hidden-input">
                                                <td><input type="number" name="estoque" value="<?= htmlentities($exibeProduto['estoque'])?>" placeholder="Novo saldo" required <?php if($exibeProduto['status_inv_produto'] === 'INVENTARIADO') {echo 'readonly';} else {echo "";}  ?> class="estoque-input"></td>
                                                <td><input type="number" name="diferenca_estoque" value="0" id="form-hidden-input" class="diferenca-input" readonly <?php if($exibeProduto['status_inv_produto'] === 'INVENTARIADO' ) {echo "hidden";} ?>></td>
                                                <td>
                                                    <button type="submit" id="btn-inventariar" title="Inventariar esse produto" <?php if($exibeProduto['status_inv_produto'] === 'INVENTARIADO' ) {echo "hidden";} ?>><i class="fa-solid fa-clipboard-check"></i></button>
                                                </td>
                                                <td title="Status de inventário do produto">
                                                    <p><?= htmlentities($exibeProduto['status_inv_produto']) ?></p>
                                                </td>
                                            </form>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>

                            <p>Nenhum produto a mais para ser exibido.</p>

                            <div id="box-confirmacao" title="Finalizar inventário">

                                <header class="box-ajuda-cabecalho">
                                    <h1>Confirmação</h1>
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                </header>

                                <h2>Confirmação</h2>
                                <p>
                                    Tem certeza que deseja finalizar esse inventário?<br><br>
                                    Certfique-se de que todos os produtos estejam com o status "Inventariado".
                                </p>
                                <div id="box-confirmacao-btns">
                                    <a href="src/manipulacoes_inventario/finaliza_inventario.php?nome_inventario=<?= $_GET['nome_inventario'] ?>"><button id="btn-finaliza-inv">Finalizar inventário</button></a>
                                    <button id="btn-cancelar">Cancelar</button>
                                </div>
                            </div>

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
        <button type="button" id="btn-atalho" title="Caixa de ajuda"><i class="fa-regular fa-circle-question"></i></button>
        <button type="button" id="btn-atalho" title="Calculadora"><i class="fa-solid fa-calculator"></i></button>
    </div>

    <div id="box-ajuda" title="Informações inventário">
        <header class="box-ajuda-cabecalho">
            <h1>Caixa de informações</h1>
            <i class="fa-solid fa-triangle-exclamation"></i>
        </header>
        <p>
            Para cada produto preencha o campo "Quantidade" com o valor físico contado e precione o botão verde<br><br>
            Ao inventariar um produto precionando o botão verde, o valor da quantidade informado será o novo valor em estoque desse produto.
        </p>

        <button id="box-ajuda-fechar-btn">Fechar</button>

    </div>

    <section class="calculadora">

        <header class="box-ajuda-cabecalho">
            <h1>Calculadora</h1>
            <i class="fa-solid fa-calculator"></i>
        </header>
        <header class="display">
            <p id="resultado"></p>
        </header>

        <article class="top-buttons">
            <div id="apagar" onclick="back()">
                <p>Apagar</p>
            </div>
            <div id="limpar" onclick="clean()">
                <p>Fechar</p>
            </div>
        </article>
        <article class="left-buttons">
            <div onclick="insert('7')">
                <p>7</p>
            </div>
            <div onclick="insert('8')">
                <p>8</p>
            </div>
            <div onclick="insert('9')">
                <p>9</p>
            </div>
            <div onclick="insert('4')">
                <p>4</p>
            </div>
            <div onclick="insert('5')">
                <p>5</p>
            </div>
            <div onclick="insert('6')">
                <p>6</p>
            </div>
            <div onclick="insert('1')">
                <p>1</p>
            </div>
            <div onclick="insert('2')">
                <p>2</p>
            </div>
            <div onclick="insert('3')">
                <p>3</p>
            </div>
            <div onclick="insert('0')">
                <p>0</p>
            </div>
            <div onclick="insert('00')">
                <p>00</p>
            </div>
            <div onclick="insert('.')">
                <p>.</p>
            </div>
        </article>
        <article class="right-buttons">
            <div onclick="insert('/')">
                <p>/</p>
            </div>
            <div onclick="insert('*')">
                <p>x</p>
            </div>
            <div id="menos" onclick="insert('-')">
                <p>-</p>
            </div>
            <div id="mais" onclick="insert('+')">
                <p>+</p>
            </div>
            <div id="igual" onclick="calcular()">
                <p>=</p>
            </div>
        </article>
    </section>
    </main>


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>