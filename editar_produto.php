<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

apenasAdmin();
senhaPrimeiroAcesso();

// EDITA O PRODUTO E ARMAZENA LOGS...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // VERIFICA SE OS CAMPOS OBRIGATÓRIOS ESTÃO PREENCHIDOS ANTES DE ENVIAR...
    if (
        (isset($_POST['id']) && !empty($_POST['id'])) &&
        (isset($_POST['descricao'])) && (!empty($_POST['descricao'])) &&
        (isset($_POST['unidade_medida'])) && (!empty($_POST['unidade_medida'])) &&
        (isset($_POST['estoque'])) &&
        (isset($_POST['consumo_diario'])) &&
        (isset($_POST['aprovacao_oc'])) &&
        (isset($_POST['prazo_entrega'])) &&
        (isset($_POST['categoria']) && !empty($_POST['categoria']))
    ) {

        // SE OS CAMPOS ESTIVEREM TODOS PREENCHIDOS, A EDIÇÃO SERÁ CONCLUÍDA...
        $editaProduto = new Produtos($pdo);
        $editaProduto->editaProduto(
            $_POST['id'],
            $_POST['descricao'],
            $_POST['unidade_medida'],
            $_POST['estoque'],
            $_POST['consumo_diario'],
            $_POST['prazo_entrega'],
            $_POST['aprovacao_oc'],
            $_POST['categoria']
        );

        // ARMAZENA O LOG DE EDIÇÃO...
        $atividade = "Editou o produto \"$_POST[descricao]\"";
        $registraLog = new Logs($pdo);
        $registraLog->registraLogProduto("$atividade");

        header("Location: controle_estoque.php?edita_produto=editado_com_sucesso");
        die();
    } else {

        // SE OS CAMPOS OBRIGATÓRIOS NÃO ESTIVEREM TODOS PREENCHIDOS, UM ERRO SERÁ EXIBIDO...
        $http_referer_erro_no_envio = $_SERVER['HTTP_REFERER'] . "&verifica_campos=campos_nao_preenchidos";

        header("Location: $http_referer_erro_no_envio");
        die();
    }
}

// BUSCA O ID DO PRODUTO SELECIONADO PARA EDIÇÃO, SE NÃO FOR INFORMADO O ID NA URL, SERÁ REDIRECIONADO PARA TELA DE CONTROLE DE ESTOQUE...
if ($_GET['id'] === null) {
    header("Location: controle_estoque.php");
    die();
}
$idProduto = new Produtos($pdo);
$buscaIdProduto = $idProduto->buscaIdProduto($_GET['id']);

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
                    <h3><a href="inicio.php">INÍCIO</a> / EDIÇÃO DE PRODUTO</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>
                <section class="conteudo-center">
                    <form method="post" class="form-labels-lado-a-lado" id="form-labels-lado-a-lado">
                        <header id="form-cabecalho">
                            <h1>Edição de produto</h1>
                            <i class="fa-solid fa-pen-to-square"></i>
                        </header>

                        <h2>Preencha os campos</h2>

                        <label for="descricao">Descrição <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-box"></i>
                                <input type="text" name="descricao" placeholder="Descrição do produto" value="<?= $buscaIdProduto['descricao'] ?>" required>
                            </div>
                        </label>

                        <label for="unidade_medida">Unidade de medida <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-ruler-combined"></i>
                                <select name="unidade_medida" required>
                                    <option value="<?= $buscaIdProduto['unidade_medida'] ?>"><?= $buscaIdProduto['unidade_medida'] ?></option>
                                    <option>Caixa</option>
                                    <option>Galão</option>
                                    <option>KG</option>
                                    <option>Metro</option>
                                    <option>Pacote</option>
                                    <option>Par</option>
                                    <option>Rolo</option>
                                    <option>Unidade</option>
                                </select>
                            </div>
                        </label>

                        <label for="estoque">Em estoque <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-boxes-stacked"></i>
                                <input type="text" name="estoque" placeholder="Quanto há em estoque" min="0" value="<?= $buscaIdProduto['estoque'] ?>" required>
                            </div>
                        </label>

                        <label for="consumo_diario">Consumo diário <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-user-clock"></i>
                                <input type="text" name="consumo_diario" placeholder="Consumo médio em dias desse produto" min="0" value="<?= $buscaIdProduto['consumo_diario'] ?>" required>
                            </div>
                        </label>

                        <label for="prazo_entrega">Prazo de entrega (em dias) <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-truck-fast"></i>
                                <input type="text" name="prazo_entrega" placeholder="Prazo médio para entrega pelo fornecedor" min="0" value="<?= $buscaIdProduto['prazo_entrega'] ?>" required>
                            </div>
                        </label>

                        <label for="prezo_oc">Aprovação OC (em dias) <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-calendar-check"></i>
                                <input type="text" name="aprovacao_oc" placeholder="Prazo de aprovação da OC pela gerência" min="0" value="<?= $buscaIdProduto['aprovacao_oc'] ?>" required>
                            </div>
                        </label>

                        <label for="categoria">Categoria <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <select name="categoria" required>
                                    <option value="<?= $buscaIdProduto['categoria'] ?>"><?= $buscaIdProduto['categoria'] ?></option>
                                    <option>Essencial</option>
                                    <option>Não essencial</option>
                                </select>
                            </div>
                        </label>

                        <input type="hidden" name="id" value="<?= $buscaIdProduto['id'] ?>">

                        <div>
                            <button type="submit">Concluir</button>
                            <a href="controle_estoque.php"><button type="button" id="btn-cancelar">Cancelar</button></a>
                        </div>
                    </form>
                </section>

                <?php
                // EXIBE O RODAPÉ...
                require_once "src/views/layout/rodape.php";
                ?>

                <div class="btns-atalhos">
                    <button type="button" id="btn-atalho" title="Excluir"><i class="fa-solid fa-trash-can"></i></button>

                    <div id="box-confirmacao">

                        <header class="box-ajuda-cabecalho">
                            <h1>Confirmação</h1>
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </header>

                        <p>
                            Tem certeza que deseja excluir esse produto?<br><br>
                            Essa ação não poderá ser desfeita.
                        </p>
                        <div id="box-confimarcao-btns">
                            <form action="src/manipulacoes_produto/exclui_produto.php" method="post">
                                <input type="hidden" name="id" value="<?= $buscaIdProduto['id'] ?>">
                                <input type="hidden" name="descricao" value="<?= $buscaIdProduto['descricao'] // PARA ARMAZERNAR A DESCRIÇÃO NO LOG NO MOMENTO DA EXCLUSÃO 
                                                                                ?>">
                                <button type="submit" title="Excluir esse produto">Excluir</button>
                            </form>

                            <button type="button" id="btn-cancelar">Cancelar</button>
                        </div>
                    </div>

                </div>

            </article>
        </section>
    </main>


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>