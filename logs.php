<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

liberacaoInfraIDL();
senhaPrimeiroAcesso();

if($_SERVER['QUERY_STRING'] === 'acessos') {
    $logs = new Logs($pdo);
    $listaLogs = $logs->listaLogsAcessos();

    $titulo_log = "Logs de acessos (30 dias)";

} elseif($_SERVER['QUERY_STRING'] === 'telefonia') {
    $logs = new Logs($pdo);
    $listaLogs = $logs->listaLogsTelefonia();

    $titulo_log = "Logs de telefonia (30 dias)";

}elseif($_SERVER['QUERY_STRING'] === 'opcoes') {
    $logs = new Logs($pdo);
    $listaLogs = $logs->listaLogsOpcoes();

    $titulo_log = "Logs de opções (30 dias)";

}elseif($_SERVER['QUERY_STRING'] === 'usuarios') {
    $logs = new Logs($pdo);
    $listaLogs = $logs->listaLogsUsuarios();

    $titulo_log = "Logs de usuários (30 dias)";

} else {
    header('Location: inicio.php');
    die();
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
                    <h3><a href="inicio.php">INÍCIO</a></h3>
                </header>
                <section class="conteudo-center">
                    <h1><?= $titulo_log ?></h1>
                    <table>
                        <thead>
                            <td>ID registro</td>
                            <td>Usuário</td>
                            <td>Atividade</td>
                            <td>Resultado da atividade</td>
                            <td>Data da atividade</td>
                        </thead>
                        <tbody>
                            <?php foreach ($listaLogs as $logs) : ?>
                                <tr>
                                    <td><?= htmlentities($logs['id']) ?></td>
                                    <td><?= htmlentities($logs['usuario_log']) ?></td>
                                    <td><?= htmlentities($logs['atividade_log']) ?></td>
                                    <td><?= htmlentities($logs['result_atividade_log']) ?></td>
                                    <td><?= htmlentities($logs['data_log']) ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <p>Nada a mais para ser exibido.<br>Para eventos além de 30 dias, extraia para Excel precionando o botão inferior direito.</p>
                </section>

                <?php
                // EXIBE O RODAPÉ...
                require_once "src/views/layout/rodape.php";
                ?>

            </article>
        </section>
    </main>

    <div class="btns-atalhos">
        <a href="src/excel/extrair_logs.php?<?= $_SERVER['QUERY_STRING'] ?>"><button id="btn-atalho" title="Extrair para Excel">
                <img src="img/logo-excel.png">
            </button></a>
    </div>

    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>