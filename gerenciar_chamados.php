<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

senhaPrimeiroAcesso();

if(empty($_SERVER['QUERY_STRING']) || $_SERVER['QUERY_STRING'] === 'busca=') {

    $titulo_tabela_filtrada = "Exibindo todos os chamados";

    $chamados = new Chamado($pdo);
    $exibeTodosChamados = $chamados->exibeTodosChamados();

} elseif($_SERVER['QUERY_STRING'] === 'em_aberto') {

    $titulo_tabela_filtrada = "Exibindo todos os chamados em aberto";

    $chamados = new Chamado($pdo);
    $exibeTodosChamados = $chamados->exibeChamadosEmAberto();

} elseif($_SERVER['QUERY_STRING'] === 'meu_departamento') {

    $titulo_tabela_filtrada = "Exibindo todos os chamados em meu departamento";

    $chamados = new Chamado($pdo);
    $exibeTodosChamados = $chamados->exibeChamadosMeuDepartamento();

}  elseif($_SERVER['QUERY_STRING'] === 'minha_unidade') {

    $titulo_tabela_filtrada = "Exibindo todos os chamados em minha unidade";

    $chamados = new Chamado($pdo);
    $exibeTodosChamados = $chamados->exibeChamadosMinhaUnidade();

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $titulo_tabela_filtrada = "Exibindo resultado da pesquisa";

    $chamados = new Chamado($pdo);
    $exibeTodosChamados = $chamados->buscaChamado($_GET['busca']);

}

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
                            <a href="abrir_chamado.php">
                                <div>
                                    <div id="box-infos-amarela">
                                        <span>
                                            <h4>ABRIR CHAMADO</h4>
                                        </span>
                                        <h3>Abrir</h3>
                                        <i class="fa-solid fa-square-plus"></i>
                                        <p class="texto-filtro">Clique para abrir</p>
                                    </div>
                                </div>
                            </a>
                            <a href="gerenciar_chamados.php?em_aberto">
                                <div>
                                    <div id="box-infos-azul">
                                        <span>
                                            <h4>EM ABERTO</h4>
                                        </span>
                                        <h3>Exibir</h3>
                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                            <a href="gerenciar_chamados.php?meu_departamento">
                                <div>
                                    <div id="box-infos-verde">
                                        <span>
                                            <h4>MEU DEPARTAMENTO</h4>
                                        </span>
                                        <h3>Exibir</h3>
                                        <i class="fa-solid fa-building-user"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                            <a href="gerenciar_chamados.php?minha_unidade">
                                <div>
                                    <div id="box-infos-roxa">
                                        <span>
                                            <h4>MINHA UNIDADE</h4>
                                        </span>
                                        <h3>Exibir</h3>
                                        <i class="fa-solid fa-map-location-dot"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div>
                            <form method="get">
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

                            <h1><?= $titulo_tabela_filtrada ?></h1>
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
                                            <td><a href="visualiza_chamado.php?id=<?= $chamados['id'] ?>"><?= htmlentities($chamados['id']) ?></a></td>
                                            <td><a href="visualiza_chamado.php?id=<?= $chamados['id'] ?>"><?= htmlentities($chamados['titulo']) ?></a></td>
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
                                                <a href="visualiza_chamado.php?id=<?= $chamados['id'] ?>"><i class="fa-solid fa-eye"></i></a>
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

    <div class="btns-atalhos">
        <a href="abrir_chamado.php"><button id="btn-atalho" title="Abrir um chamado">
            <i class="fa-solid fa-square-plus"></i>
        </button></a>
    </div>

    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>