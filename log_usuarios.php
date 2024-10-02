<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

apenasAdmin();
senhaPrimeiroAcesso();

// EXIBE TODAS AS MINHAS REQUISIÇÕES
$todasMinhas = new Requisicao($pdo);
$todasMinhasRequisicoes = $todasMinhas->exibeMinhasRequisicoesHistorico();

$logs = new Logs($pdo);
$dados_logs = $logs->exibeRegistrosLogUsuarios();

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
                    <h3><a href="inicio.php">INÍCIO</a> / REGISTROS DE USUÁRIOS</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>
                <section class="conteudo-center">
                            <h1>Registro de cadastro, exclusão e edição de usuário (30 dias)</h1>
                            <table>
                                <thead>
                                    <td>ID registro</td>
                                    <td>Usuário</td>
                                    <td>Evento</td>
                                    <td>Data do evento</td>
                                </thead>
                                <tbody>
                                    <?php foreach ($dados_logs as $logs) : ?>
                                        <tr>
                                            <td><?= htmlentities($logs['id']) ?></td>
                                            <td><?= htmlentities($logs['usuario']) ?></td>
                                            <td><?= htmlentities($logs['evento']) ?></td>
                                            <td><b><?= htmlentities($logs['data_evento']) ?></b></td>
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

    <?php
        // EXIBE A ESTRUTURA HTML QUE EXIBE O HISTORICO DE REQUISIÇÕES DO USUÁRIO LOGADO...
        require_once "src/views/layout/meu_historico_requisicoes.php";
    ?>

    <div class="btns-atalhos">
        <a href="src/excel/extrair_registros_usuarios.php"><button id="btn-atalho" title="Extrair para Excel">
                <img src="img/logo-excel.png">
        </button></a>
    </div>


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>