<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

apenasAdmin();
senhaPrimeiroAcesso();

// EXIBE O HISTORICO DE REQUISIÇÕES
$historico = new Requisicao($pdo);
$exibeHistoricoRequisicoes = $historico->exibeHistoricoRequisicoes();

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
                    <h3><a href="inicio.php">INÍCIO</a> / HISTÓRICO DE REQUISIÇÕES</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>

                <section class="conteudo-center">
                    <article class="conteudo-center-boxs">
                    <div class="conteudo-center-box-01">
                            <h1>Filtros e informações</h1>
                            <a onclick="filtrarEntregues()">
                                <div>
                                    <div id="box-infos-verde">
                                        <span>
                                            <h4>REQUISIÇÕES ENTREGUES</h4>
                                        </span>
                                        <h3><?= exibeQuantidadeRequisicoesEntregues($pdo) ?> entregues</h3>
                                        <i class="fa-solid fa-handshake"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                            <a onclick="filtrarRecusadas()">
                                <div>
                                    <div id="box-infos-vermelha">
                                        <span>
                                            <h4>REQUISIÇÕES RECUSADAS</h4>
                                        </span>
                                        <h3><?= exibeQuantidadeRequisicoesRecusadas($pdo) ?> recusadas</h3>
                                        <i class="fa-solid fa-handshake-slash"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                            <a onclick="filtrarEmAberto()">
                                <div title="Clique para gerenciar requisições em aberto">
                                    <div id="box-infos-azul">
                                        <span>
                                            <h4>REQUISIÇÕES EM ABERTO</h4>
                                        </span>
                                        <h3><?= exibeQuantidadeRequisicoesEmAberto($pdo) ?> em aberto</h3>
                                        <i class="fa-solid fa-clock"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                            <a onclick="exibirTodas()">
                                <div>
                                    <div id="box-infos-roxa">
                                        <span>
                                            <h4>TOTAL DE REQUISIÇÕES</h4>
                                        </span>
                                        <h3><?= exibeQuantidadeRequisicoes($pdo) ?> requisições</h3>
                                        <i class="fa-solid fa-globe"></i>
                                        <p class="texto-filtro">Remover o filtro</p>
                                    </div>
                                </div>
                            </a>
                            <a>
                                <div>
                                    <div id="box-infos-amarela">
                                        <span>
                                            <h4>MAIS REQUISITADO ( 30 DIAS )</h4>
                                        </span>
                                        <h3><?= exibeProdutoMaisRequisitado($pdo) ?></h3>
                                        <i class="fa-solid fa-boxes-packing"></i>
                                    </div>
                                </div>
                            </a>

                        </div>
                        <div class="conteudo-center-box-02">
                            <h1>Histórico de requisições (30 dias)</h1>
                            <table id="tabela">
                                <thead>
                                    <tr>
                                        <td>Nº da requisição</td>
                                        <td>Descrição</td>
                                        <td>Unidade de medida</td>
                                        <td>Quantidade</td>
                                        <td>Solicitante</td>
                                        <td>Data da abertura</td>
                                        <td>Status</td>
                                        <td>Baixa</td>
                                        <td>Data da baixa</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($exibeHistoricoRequisicoes as $historico) : ?>
                                        <tr>
                                            <td><?= htmlentities($historico['id_historico']) ?></td>
                                            <td><?= htmlentities($historico['descricao_historico']) ?></td>
                                            <td><?= htmlentities($historico['unidade_medida_historico']) ?></td>
                                            <td><?= htmlentities($historico['quantidade_historico']) ?></td>
                                            <td><?= htmlentities($historico['solicitante_historico']) ?></td>
                                            <td><?= htmlentities($historico['data_requisicao_historico']) ?></td>
                                            <td title="Status"><p><?= htmlentities($historico['status_historico']) ?></p></td>
                                            <td><?= htmlentities($historico['baixa_historico']) ?></td>
                                            <td><?= htmlentities($historico['data_baixa_historico']) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            <p>Nenhuma requisição a mais para ser exibida.<br>Para requisições além de 30 dias, extraia para Excel precionando o botão inferior direito.</p>
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
        <a href="src/excel/extrair_historico_requisicoes.php"><button id="btn-atalho" title="Extrair para Excel">
                <img src="img/logo-excel.png">
        </button></a>
        <a href="gerenciar_requisicoes.php"><button id="btn-atalho" title="Gerenciar requisições em aberto">
                <i class="fa-solid fa-list-check"></i>
        </button></a>
    </div>


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>