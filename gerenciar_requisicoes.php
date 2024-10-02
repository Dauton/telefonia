<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

    apenasAdmin();
    senhaPrimeiroAcesso();

    $requisicao = new Requisicao($pdo);
    $exibeRequisicoes = $requisicao->exibeRequisicoes();

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
                    <h3><a href="inicio.php">INÍCIO</a> / GERENCIAR REQUISIÇÕES</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>
                
                <section class="conteudo-center">
                    <h1>Gerenciar requisições em aberto</h1>

                    <table>
                        <thead>
                            <tr>
                                <td>Nº da requisição</td>
                                <td>Descrição</td>
                                <td>Unidade de medida</td>
                                <td>Quantidade</td>
                                <td>Solicitante</td>
                                <td>Data da abertura</td>
                                <td>Status</td>
                                <td>Entregar/Recusar</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($exibeRequisicoes as $requisicao): ?>
                            <tr>
                                <td><?= htmlentities($requisicao['id']) ?></td>
                                <td><b><?= htmlentities($requisicao['descricao']) ?></b></td>
                                <td><?= htmlentities($requisicao['unidade_medida']) ?></td>
                                <td><b><?= htmlentities($requisicao['quantidade']) ?><b></td>
                                <td><?= htmlentities($requisicao['solicitante']) ?></td>
                                <td><?= htmlentities($requisicao['data_requisicao']) ?></td>
                                <td id="status" title="Status"><p><?= htmlentities($requisicao['status']) ?></p></td>
                                <td id="acoes">
                                    <form method="post" action="src/manipulacoes_requisicao/entrega_requisicao.php" title="Baixar essa requisição">
                                        <input type="hidden" name="id" value="<?= $requisicao['id'] ?>">
                                        <input type="hidden" name="data_baixa_historico" value="<?= exibeDataAtual() ?>">
                                        <button><i class="fa-solid fa-square-check"></i></button>
                                    </form>
                                    <form method="post" action="src/manipulacoes_requisicao/recusa_requisicao.php" title="Recusar essa requisição">
                                        <input type="hidden" name="id" value="<?= $requisicao['id'] ?>">
                                        <input type="hidden" name="quantidade" value="<?= $requisicao['quantidade'] ?>">
                                        <input type="hidden" name="descricao" value="<?= $requisicao['descricao'] ?>">
                                        <input type="hidden" name="data_baixa_historico" value="<?= exibeDataAtual() ?>">
                                        <button id="table-form-btn-excluir"><i class="fa-solid fa-square-xmark"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <p>Nenhuma requisição a mais para ser exibida</p>

                    <div id="box-ajuda">
                    <header class="box-ajuda-cabecalho">
                        <h1>Caixa de ajuda</h1>
                        <i class="fa-solid fa-list-check"></i>
                    </header>
                        <p>
                            Quando o solicitante abrir uma requisição, o valor do produto em estoque será reservado, ou seja, a quantidade requisitada será subtraída pela quantidade em estoque desse produto.<br><br>
                            Quando o administrador realizar a baixa da requisição o valor em estoque já subtraído será mantido.<br><br>
                            Quando o administrador recusar uma requisição, o valor requisitado será devolvido ao estoque.
                        </p>

                        <button id="box-ajuda-fechar-btn">Fechar</button>

                    </div>

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
        <a href="historico_requisicoes.php"><button id="btn-atalho" title="Historico de requisições">
            <i class="fa-solid fa-clock-rotate-left"></i>
        </button></a>
    </div>
    

    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>