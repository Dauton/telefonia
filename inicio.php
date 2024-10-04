<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

senhaPrimeiroAcesso();

$dadoDispositivo = new Telefonia($pdo);
$exibeDispositivosMinhaUnidade = $dadoDispositivo->exibeDispositivosMinhaUnidade();

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
                            <a href="cadastrar_dispositivo.php">
                                <div>
                                    <div id="box-infos-amarela">
                                        <span>
                                            <h4>CADASTRAR DISPOSITIVO</h4>
                                        </span>
                                        <h3>Cadastrar</h3>
                                        <i class="fa-solid fa-microchip"></i>
                                        <p class="texto-filtro">Clique para abrir</p>
                                    </div>
                                </div>
                            </a>
                            <a href="">
                                <div>
                                    <div id="box-infos-azul">
                                        <span>
                                            <h4>CONSULTAR DISPOSITIVO</h4>
                                        </span>
                                        <h3>Consultar</h3>
                                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                                        <p class="texto-filtro">Clique para abrir</p>
                                    </div>
                                </div>
                            </a>
                            <a href="cadastrar_opcoes.php">
                                <div>
                                    <div id="box-infos-verde">
                                        <span>
                                            <h4>CADASTRO DE OPÇÕES</h4>
                                        </span>
                                        <h3>Cadastrar</h3>
                                        <i class="fa-solid fa-gears"></i>
                                        <p class="texto-filtro">Clique para abrir</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="conteudo-center-box-02">
                            <h1>Minha unidade</h1>
                            <table>
                                <thead>
                                    <tr>
                                        <td>Nome usuário</td>
                                        <td>Linha</td>
                                        <td>Status da linha</td>
                                        <td>IMEI aparelho</td>
                                        <td>Unidade</td>
                                        <td>Centro de custos</td>
                                        <td>Ponto focal</td>
                                        <td>Visualizar</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($exibeDispositivosMinhaUnidade as $dadoDispositivo) : ?>
                                    <tr>
                                        <td><?= htmlentities($dadoDispositivo['nome']) ?></td>
                                        <td><?= htmlentities($dadoDispositivo['linha']) ?></td>
                                        <td id="Status"><p><?= htmlentities($dadoDispositivo['status']) ?></p></td>
                                        <td><?= htmlentities($dadoDispositivo['imei_aparelho']) ?></td>
                                        <td><?= htmlentities($dadoDispositivo['unidade']) ?></td>
                                        <td><?= htmlentities($dadoDispositivo['centro_custo']) ?></td>
                                        <td><?= htmlentities($dadoDispositivo['ponto_focal']) ?></td>
                                        <td>
                                            <a href="visualiza_dispositivo.php?id=<?= $dadoDispositivo['id'] ?>"><i class="fa-solid fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
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