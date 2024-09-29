<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

senhaPrimeiroAcesso();

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
                    <i class="fa-solid fa-circle-question"></i>
                        <a href=""><<i class="fa-solid fa-circle-question"></i></a>
                    </div>
                </header>
                <section class="conteudo-center">
                    <article class="conteudo-center-boxs">
                        <div class="conteudo-center-box-01">
                            <h1>Alguns atalhos</h1>
                            <a href="">
                                <div>
                                    <div id="box-infos-amarela">
                                        <span>
                                            <h4>ATALHO</h4>
                                        </span>
                                        <h3>Atalho</h3>
                                        <i class="fa-solid fa-circle-question"></i>
                                        <p class="texto-filtro">Clique para abrir</p>
                                    </div>
                                </div>
                            </a>
                            <a href="">
                                <div>
                                    <div id="box-infos-azul">
                                        <span>
                                            <h4>ATALHO</h4>
                                        </span>
                                        <h3>Atalho</h3>
                                        <i class="fa-solid fa-circle-question"></i>
                                        <p class="texto-filtro">Clique para abrir</p>
                                    </div>
                                </div>
                            </a>
                            <a href="">
                                <div>
                                    <div id="box-infos-verde">
                                        <span>
                                            <h4>ATALHO</h4>
                                        </span>
                                        <h3>Atalho</h3>
                                        <i class="fa-solid fa-circle-question"></i>
                                        <p class="texto-filtro">Clique para abrir</p>
                                    </div>
                                </div>
                            </a>
                            <a href="">
                                <div>
                                    <div id="box-infos-vermelha">
                                        <span>
                                            <h4>ATALHO</h4>
                                        </span>
                                        <h3>Atalho</h3>
                                        <i class="fa-solid fa-circle-question"></i>
                                        <p class="texto-filtro">Clique para abrir</p>
                                    </div>
                                </div>
                            </a>
                            <a href="">
                                <div>
                                    <div id="box-infos-roxa">
                                        <span>
                                            <h4>ATALHO</h4>
                                        </span>
                                        <h3>Atalho</h3>
                                        <i class="fa-solid fa-circle-question"></i>
                                        <p class="texto-filtro">Clique para abrir</p>
                                    </div>
                                </div>
                            </a>
                            <a href="">
                                <div>
                                    <div id="box-infos-cinza">
                                        <span>
                                            <h4>ATALHO</h4>
                                        </span>
                                        <h3>Atalho</h3>
                                        <i class="fa-solid fa-circle-question"></i>
                                        <p class="texto-filtro">Clique para abrir</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="conteudo-center-box-02">
                            <h1>Título da tabela</h1>
                            <table>
                                <thead>
                                    <tr>
                                        <td>Coluna 01</td>
                                        <td>Coluna 02</td>
                                        <td>Coluna 03</td>
                                        <td>Coluna 04</td>
                                        <td>Coluna 05</td>
                                        <td>Coluna 06</td>
                                        <td>Status</td>
                                        <td>Ações</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Dado 01</td>
                                        <td>Dado 02</td>
                                        <td>Dado 03</td>
                                        <td>Dado 04</td>
                                        <td>Dado 05</td>
                                        <td>Dado 06</td>
                                        <td id="status" title="Status">
                                            <p>ENTREGUE</p>
                                        </td>
                                        <td>
                                            <form method="post" action="">
                                                <input type="hidden" name="id" value="">
                                                <button id="table-form-btn-excluir"><i class="fa-solid fa-square-xmark"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>Não há mais dados a serem exibidos</p>
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

    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>