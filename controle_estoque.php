<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

apenasAdmin();
senhaPrimeiroAcesso();

$exibeProduto = new Produtos($pdo);
$exibeProdutos = $exibeProduto->exibeProdutos();


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
                    <h3><a href="inicio.php">INÍCIO</a> / CONTROLE DE ESTOQUE</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>

                <section class="conteudo-center">
                    <article class="conteudo-center-boxs">

                        <div class="conteudo-center-box-01">
                            <h1>Informações e atividades</h1>
                            <a id="filtro-abaixo-do-minimo">
                                <div>
                                    <div id="box-infos-vermelha" <?php if(exibeQuantidadeAbaixoDoMinimo($pdo) > 0) { echo "class=box-infos-vermelha";} ?>>
                                        <span>
                                            <h4>ABAIXO DO ESTOQUE MÍNIMO</h4>
                                        </span>
                                        <h3><?= exibeQuantidadeAbaixoDoMinimo($pdo) ?> produtos</h3>
                                        <i class="fa-solid fa-thumbs-down"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                            <a id="filtro-no-estoque-minimo">
                                <div>
                                    <div id="box-infos-amarela">
                                        <span>
                                            <h4>NO ESTOQUE MÍNIMO</h4>
                                        </span>
                                        <h3><?= exibeQuantidadeNoEstoqueMinimo($pdo) ?> produtos</h3>
                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                            <a id="filtro-acima-do-minimo">
                                <div>
                                    <div id="box-infos-verde">
                                        <span>
                                            <h4>ACIMA DO ESTOQUE MÍNIMO</h4>
                                        </span>
                                        <h3><?= exibeQuantidadeAcimaDoMinimo($pdo) ?> produtos</h3>
                                        <i class="fa-solid fa-thumbs-up"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                            
                            <a id="filtro-todos-produtos">
                                <div>
                                    <div id="box-infos-azul">
                                        <span>
                                            <h4>PRODUTOS CADASTRADOS</h4>
                                        </span>
                                        <h3><?= exibeQuantidadeProdutosCadastrados($pdo) ?> produtos</h3>
                                        <i class="fa-solid fa-globe"></i>
                                        <p class="texto-filtro">Remover o filtro</p>
                                    </div>
                                </div>
                            </a>

                            <a href='painel_inventario.php'>
                                <div>
                                    <div id='box-infos-cinza'>
                                        <span>
                                            <h4>PAINEL DE INVENTÁRIO</h4>
                                        </span>
                                        <h3>Acessar</h3>
                                        <i class='fa-solid fa-table-cells-large'></i>
                                        <p class='texto-filtro'>Clique para abrir</p>
                                    </div>
                                </div>
                            </a>
                            <a href="log_produtos.php">
                                <div>
                                    <div id="box-infos-roxa">
                                        <span>
                                            <h4>VISUALIZAR REGISTROS</h4>
                                        </span>
                                        <h3>Visualizar</h3>
                                        <i class="fa-solid fa-eye"></i>
                                        <p class='texto-filtro'>Clique para abrir</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="conteudo-center-box-02">
                            <h1>Estado atual do estoque</h1>
                            <table>
                                <thead>
                                    <tr>
                                        <td>Descrição</td>
                                        <td>Unidade de medida</td>
                                        <td>Consumo diário</td>
                                        <td>Prazo de entrega</td>
                                        <td>Aprovação da OC</td>
                                        <td>Em estoque</td>
                                        <td>Estoque mínimo</td>
                                        <td>Categoria</td>
                                        <td>Última modificação</td>
                                        <td>Edição</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($exibeProdutos as $exibeProduto) : ?>
                                        <tr>
                                            <td><?= htmlentities($exibeProduto['descricao']) ?></td>
                                            <td><?= htmlentities($exibeProduto['unidade_medida']) ?></td>
                                            <td><?= htmlentities($exibeProduto['consumo_diario']) ?></td>
                                            <td><?= htmlentities($exibeProduto['prazo_entrega']) ?> dia(as)</td>
                                            <td><?= htmlentities($exibeProduto['aprovacao_oc']) ?> dia(as)</td>
                                            <td id="estoque"><?= htmlentities($exibeProduto['estoque']) ?></td>
                                            <td id="estoque_minimo"><?= htmlentities($exibeProduto['estoque_minimo']) ?></td>
                                            <td><?= htmlentities($exibeProduto['categoria']) ?></td>
                                            <td><?= htmlentities($exibeProduto['ultima_modificacao']) ?></td>
                                            <td id="acoes">
                                                <form>
                                                    <button type="button" id="table-form-btn-editar"><a href="editar_produto.php?id=<?= $exibeProduto['id'] ?>" title="Editar esse produto"><i class="fa-solid fa-square-pen"></i></a></button>
                                                </form>
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

        <a href="src/excel/extrair_estoque.php"><button id="btn-atalho" title="Extrair para Excel">
                <img src="img/logo-excel.png">
            </button></a>

        <a href="cadastrar_produto.php"><button id="btn-atalho" title="Cadastrar um novo produto">
                <i class="fa-solid fa-boxes-packing"></i>
            </button></a>
    </div>


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>