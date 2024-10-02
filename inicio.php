<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

senhaPrimeiroAcesso();

// EXIBE MINHAS REQUISIÇOES EM ABERTO
$minhas = new Requisicao($pdo);
$minhasRequisicoes = $minhas->exibeMinhasRequisicoesEmAberto();


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
                    <h3>INÍCIO</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>
                <section class="conteudo-center">
                    <article class="conteudo-center-boxs">
                        <div class="conteudo-center-box-01">
                            <h1>Alguns atalhos</h1>
                            <a href="requisicao.php">
                                <div>
                                    <div id="box-infos-amarela">
                                        <span>
                                            <h4>ABRIR NOVA REQUISIÇÃO</h4>
                                        </span>
                                        <h3>Requisitar</h3>
                                        <i class="fa-solid fa-basket-shopping"></i>
                                        <p class="texto-filtro">Clique para abrir</p>
                                    </div>
                                </div>
                            </a>
                            <?php if ($_SESSION['perfil'] != "Admin") {
                                echo "";
                            } else {
                                echo "
                                    <a href='gerenciar_requisicoes.php'>
                                        <div>
                                            <div id='box-infos-azul'>
                                                <span>
                                                    <h4>GERENCIAR REQUISIÇÕES</h4>
                                                </span>
                                                <h3>Gerenciar</h3>
                                                <i class='fa-solid fa-list-check'></i>"
                                                . exibeNotificacaoRequisicoesEmAberto($pdo) .
                                            "</div>
                                        </div>
                                    </a>
                                    <a href='historico_requisicoes.php'>
                                        <div>
                                            <div id='box-infos-verde'>
                                                <span>
                                                    <h4>HISTÓRICO DE REQUISIÇÕES</h4>
                                                </span>
                                                <h3>Visualizar</h3>
                                                <i class='fa-solid fa-clock-rotate-left'></i>
                                                <p class='texto-filtro'>Clique para abrir</p>
                                            </div>
                                        </div>
                                    </a>
                                ";
                                echo "
                                    <a href='controle_estoque.php'>
                                        <div>
                                            <div id='box-infos-roxa'>
                                                <span>
                                                    <h4>CONTROLE DE ESTOQUE</h4>
                                                </span>
                                                <h3>Controlar</h3>
                                                <i class='fa-solid fa-dolly'></i>
                                                <p class='texto-filtro'>Clique para abrir</p>
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
                                 ";
                                }
                            ?>

                        </div>
                        <div class="conteudo-center-box-02">
                            <h1>Minhas requisições em aberto</h1>
                            <table>
                                <thead>
                                    <td>Nº da requisição</td>
                                    <td>Descrição</td>
                                    <td>Unidade de medida</td>
                                    <td>Quantidade</td>
                                    <td>Solicitante</td>
                                    <td>Data</td>
                                    <td>Status</td>
                                    <td>Ações</td>
                                </thead>
                                <tbody>
                                    <?php foreach ($minhasRequisicoes as $minhas) : ?>
                                        <tr>
                                            <td><?= htmlentities($minhas['id']) ?></td>
                                            <td><?= htmlentities($minhas['descricao']) ?></td>
                                            <td><?= htmlentities($minhas['unidade_medida']) ?></td>
                                            <td><?= htmlentities($minhas['quantidade']) ?></td>
                                            <td><?= htmlentities($minhas['solicitante']) ?></td>
                                            <td><?= htmlentities($minhas['data_requisicao']) ?></td>
                                            <td id="status" title="Status"><p><?= htmlentities($minhas['status']) ?></p></td>
                                            <td>
                                                <form method="post" action="src/manipulacoes_requisicao/cancela_minha_requisicao.php">
                                                    <input type="hidden" name="id" value="<?= $minhas['id'] ?>">
                                                    <input type="hidden" name="quantidade" value="<?= $minhas['quantidade'] ?>">
                                                    <input type="hidden" name="descricao" value="<?= $minhas['descricao'] ?>">
                                                    <button id="table-form-btn-excluir"><i class="fa-solid fa-square-xmark"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            <p>Nenhuma requisição a mais para ser exibida.</p>
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
        // EXIBE A ESTRUTURA HTML QUE EXIBE O HISTÓRICO DE REQUISIÇÕES DO USUÁRIO LOGADO...
        require_once "src/views/layout/meu_historico_requisicoes.php";
    ?>

    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>