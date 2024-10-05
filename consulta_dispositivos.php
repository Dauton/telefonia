<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

senhaPrimeiroAcesso();

$dispositivo = new Telefonia($pdo);
$exibeTodosDispositivos = $dispositivo->exibeDispositivos();

$mdm = new Telefonia($pdo);
$totalMDM = $mdm->contagemMDM();

$linha = new Telefonia($pdo);
$totalLinhas = $linha->contagemLinhas();

$aparelho = new Telefonia($pdo);
$totalAparelhos = $aparelho->contagemAparelhos();

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
                        <a href=""><i class="fa-solid fa-circle-question"></i></a>
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
                            <a href="consulta_dispositivos.php">
                                <div>
                                    <div id="box-infos-azul">
                                        <span>
                                            <h4>TOTAL APARELHOS CADASTRADOS</h4>
                                        </span>
                                        <h3><?= $totalAparelhos ?> aparelhos</h3>
                                        <i class="fa-solid fa-mobile-screen"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                            <a href="consulta_dispositivos.php">
                                <div>
                                    <div id="box-infos-verde">
                                        <span>
                                            <h4>TOTAL LINHAS CADASTRADAS</h4>
                                        </span>
                                        <h3><?= $totalLinhas ?> linhas</h3>
                                        <i class="fa-solid fa-sim-card"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                            <a href="consulta_dispositivos.php">
                                <div>
                                    <div id="box-infos-roxa">
                                        <span>
                                            <h4>TOTAL APARELHOS COM MDM</h4>
                                        </span>
                                        <h3><?= $totalMDM; ?> aparelhos</h3>
                                        <i class="fa-solid fa-shield-halved"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div>
                            <form method="post" action="#">
                                <header id="form-cabecalho">
                                    <h1>Consulta de dispositivo</h1>
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </header>
                                <h2>Buscar dispositivo</h2>
                                <label>Buscar
                                    <div>
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <input type="search" name="busca" placeholder="Digite alguma informação do dispositivo">
                                    </div>
                                </label>
                                <button type="submit">Buscar</button>
                            </form>
                            
                        </div>
                        <div>
                            
                            <h1>Dispositivos cadastrados</h1>
                            <table>
                                <thead>
                                    <tr>
                                        <td>Nome usuário</td>
                                        <td>Linha</td>
                                        <td>Status da linha</td>
                                        <td>Modelo do aparelho</td>
                                        <td>IMEI aparelho</td>
                                        <td>MDM</td>
                                        <td>Unidade</td>
                                        <td>Centro de custos</td>
                                        <td>Ponto focal</td>
                                        <td>Visualizar</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($exibeTodosDispositivos as $dispositivo) : ?>
                                    <tr>
                                        <td><?= htmlentities($dispositivo['nome']) ?></td>
                                        <td><?= htmlentities($dispositivo['linha']) ?></td>
                                        <td id="Status"><p><?= htmlentities($dispositivo['status']) ?></p></td>
                                        <td><?= htmlentities($dispositivo['modelo_aparelho']) ?></td>
                                        <td><?= htmlentities($dispositivo['imei_aparelho']) ?></td>
                                        <td><?= htmlentities($dispositivo['gestao_mdm']) ?></td>
                                        <td><?= htmlentities($dispositivo['unidade']) ?></td>
                                        <td><?= htmlentities($dispositivo['centro_custo']) ?></td>
                                        <td><?= htmlentities($dispositivo['ponto_focal']) ?></td>
                                        <td id="status">
                                            <a href="visualiza_dispositivo.php?id=<?= $dispositivo['id'] ?>"><i class="fa-solid fa-eye"></i></a>
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