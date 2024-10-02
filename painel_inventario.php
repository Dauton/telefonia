<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

apenasAdmin();
senhaPrimeiroAcesso();


// EXIBE TODOS OS INVENÁRIOS CRIADOS
$exibeInventario = new Inventario($pdo);
$exibeInventarios = $exibeInventario->exibeInventarios();

// CRIA UM NOVO INVENTÁRIO
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    // CHAMA O METODO QUE RECUPERA O STATUS DOS INVENTÁRIOS
    $recuperaStatus = new Inventario($pdo);
    $status = $recuperaStatus->recuperaStatusInv();

    if($status) {

        header("Location: painel_inventario.php?inventario=inventario_nao_criado");
        die();

    } else {

        $criaInventario = new Inventario($pdo);
        $criaInventario->criaInventario($_POST['nome_inventario']);
    
        header("Location: painel_inventario.php?inventario=inventario_criado");
        die();
    }
    
}


// EXIBE TODAS AS MINHAS REQUISIÇÕES
$todasMinhas = new Requisicao($pdo);
$todasMinhasRequisicoes = $todasMinhas->exibeMinhasRequisicoesHistorico();


?>


<!DOCTYPE html>
<html lang="pt-br">

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
                    <h3><a href="inicio.php">INÍCIO</a> / PAINEL DE INVENTÁRIO</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>

                <section class="conteudo-center">
                    <article class="conteudo-center-boxs">

                        <div class="conteudo-center-box-01" id="table-cria-inv">
                            <h1>Criar um inventário</h1>
                        <table>
                            <thead>
                                <tr>
                                    <td>Nome do inventário</td>
                                    <td>Ação</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <form method="post">
                                        <td><input type="text" name="nome_inventario" placeholder="Dê um nome ao inventário" required></td>
                                        <input type="hidden" name="data_inicio" value="<?= exibeDataAtual(); ?>" required readonly>
                                        <td><button type="submit">Criar</button></td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        <div class="conteudo-center-box-02">
                            <h1>Inventários</h1>
                            <table>
                                <thead>
                                    <tr>
                                        <td>Nome do inventário</td>
                                        <td>Criado por</td>
                                        <td>Data de início</td>
                                        <td>Data de conclusão</td>
                                        <td>Status</td>
                                        <td>Ação</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($exibeInventarios as $exibeInventario) : ?>
                                        <tr>
                                            <td>
                                                <?php
                                                    $nome_inventario = htmlentities($exibeInventario['nome_inventario']);
                                                    $renove_uniqid = preg_replace('/\d/', '', $nome_inventario); 
                                                    echo $renove_uniqid;
                                                ?>
                                            </td>
                                            <td><?= htmlentities($exibeInventario['criado_por']) ?></td>
                                            <td><?= htmlentities($exibeInventario['data_inicio']) ?></td>
                                            <td><?= htmlentities($exibeInventario['data_final']) ?></td>
                                            <td  title="Status"><p><?= htmlentities($exibeInventario['status_inventario']) ?></p></td>
                                            <td id="acoes">
                                            <form>
                                                <?php 
                                                    if($exibeInventario['status_inventario'] === "EM ANDAMENTO") {
                                                        echo "<button type='button'><a href='inventario.php?nome_inventario=$exibeInventario[nome_inventario]' title='Iniciar inventário'><i class='fa-solid fa-circle-play'></i></button>";
                                                    } else {
                                                        echo "<button type='button'><a href='visualiza_inventario.php?nome_inventario=$exibeInventario[nome_inventario]' title='Visualizar inventário'><i class='fa-solid fa-eye'></i></a></button>";
                                                    }
                                                ?>
                                            </form>
                                        </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            <p>Nenhum inventário a mais para ser exibido.</p>
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


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>