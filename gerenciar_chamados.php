<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

senhaPrimeiroAcesso();

$chamados = new Chamado($pdo);
$exibeTodosChamados = $chamados->exibeTodosChamados();

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
                    <h3><a href="inicio.php">INÍCIO</a> / GERENCIAMENTO DE CHAMADOS</h3>
                </header>
                <section class="conteudo-center">
                    <article class="conteudo-center-boxs">
                        <div class="conteudo-center-box-01">
                            <h1>Alguns atalhos e informações</h1>
                            <a href="cadastrar_dispositivo.php">
                                <div>
                                    <div id="box-infos-amarela">
                                        <span>
                                            <h4>PREENCHER</h4>
                                        </span>
                                        <h3>PREENCHER</h3>
                                        <i class="fa-solid fa-square-plus"></i>
                                        <p class="texto-filtro">Clique para abrir</p>
                                    </div>
                                </div>
                            </a>
                            <a href="consulta_dispositivos.php?aparelhos">
                                <div>
                                    <div id="box-infos-azul">
                                        <span>
                                            <h4>PREENCHER</h4>
                                        </span>
                                        <h3>PREENCHER</h3>
                                        <i class="fa-solid fa-mobile-screen"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                            <a href="consulta_dispositivos.php?linhas">
                                <div>
                                    <div id="box-infos-verde">
                                        <span>
                                            <h4>PREENCHER</h4>
                                        </span>
                                        <h3>PREENCHER</h3>
                                        <i class="fa-solid fa-sim-card"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                            <a href="consulta_dispositivos.php?mdm">
                                <div>
                                    <div id="box-infos-roxa">
                                        <span>
                                            <h4>PREENCHER</h4>
                                        </span>
                                        <h3>PREENCHER</h3>
                                        <i class="fa-solid fa-shield-halved"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                            <a href="consulta_dispositivos.php">
                                <div>
                                    <div id="box-infos-cinza">
                                        <span>
                                            <h4>PREENCHER</h4>
                                        </span>
                                        <h3>PREENCHER</h3>
                                        <i class="fa-solid fa-globe"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div>
                            <form method="get" action="consulta_dispositivos.php">
                                <header id="form-cabecalho">
                                    <h1>Consulta de chamados</h1>
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </header>
                                <h2>Buscar chamados</h2>
                                <label>Buscar
                                    <div>
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <input type="search" name="busca" placeholder="Digite alguma informação do chamado">
                                    </div>
                                </label>
                                <button type="submit">Buscar</button>
                            </form>

                        </div>
                        <div>

                            <h1>Gerenciar chamados em aberto</h1>
                            <table>
                                <thead>
                                    <tr>
                                        <td>ID chamado</td>
                                        <td>Título</td>
                                        <td>Departamento</td>
                                        <td>Categoria</td>
                                        <td>Prioridade</td>
                                        <td>Usuário</td>
                                        <td>Unidade</td>
                                        <td>Data abertura</td>
                                        <td>Status</td>
                                        <td>Gerenciar</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($exibeTodosChamados as $chamados) : ?>
                                        <tr>
                                            <td><a href="gerencia_chamado.php?id=<?= $chamados['id'] ?>"><?= htmlentities($chamados['id']) ?></a></td>
                                            <td><a href="gerencia_chamado.php?id=<?= $chamados['id'] ?>"><?= htmlentities($chamados['titulo']) ?></a></td>
                                            <td><?= htmlentities($chamados['departamento']) ?></td>
                                            <td><?= htmlentities($chamados['categoria']) ?></td>
                                            <td id="status">
                                                <p><?= htmlentities($chamados['prioridade']) ?></p>
                                            </td>
                                            <td><?= htmlentities($chamados['usuario']) ?></td>
                                            <td><?= htmlentities($chamados['unidade_usuario']) ?></td>
                                            <td><?= htmlentities($chamados['data_abertura']) ?></td>
                                            <td id="status">
                                                <p><?= htmlentities($chamados['status']) ?></p>
                                            </td>
                                            <td>
                                                <a href="visualiza_dispositivo.php?id=<?= $chamados['id'] ?>"><i class="fa-solid fa-eye"></i></a>
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