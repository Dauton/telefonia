<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

apenasAdmin();
senhaPrimeiroAcesso();

$logs = new Logs($pdo);
$dados_logs = $logs->exibeRegistrosLogAcessos();

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
                <h3><a href="inicio.php">INÍCIO</a> / REGISTROS DE ACESSO</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>
                <section class="conteudo-center">
                            <h1>Registro de tentativas de acessos (30 dias)</h1>
                            <table>
                                <thead>
                                    <td>ID registro</td>
                                    <td>Usuário informado</td>
                                    <td>Resultado do evento</td>
                                    <td>Data do evento</td>
                                </thead>
                                <tbody>
                                    <?php foreach ($dados_logs as $logs) : ?>
                                        <tr>
                                            <td><?= htmlentities($logs['id']) ?></td>
                                            <td><?= htmlentities($logs['usuario_informado']) ?></td>
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

    <div class="btns-atalhos">
        <a href="src/excel/extrair_registros_logins.php"><button id="btn-atalho" title="Extrair para Excel">
                <img src="img/logo-excel.png">
        </button></a>
    </div>


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>