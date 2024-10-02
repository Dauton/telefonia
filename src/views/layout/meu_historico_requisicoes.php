<?php

    if(!isset($_SESSION['usuario']))
    {
        header("Location: ../../../index.php");
        die();
    }
    
?>

<?php

    // EXIBE TODAS AS MINHAS REQUISIÇÕES
    $todasMinhas = new Requisicao($pdo);
    $todasMinhasRequisicoes = $todasMinhas->exibeMinhasRequisicoesHistorico();

?>

<section id="botao-verde-box">
        <article class="box-table-botao-verde">
            <h3>Meu historico de requisições (30 dias)</h3>
            <i class="fa-solid fa-rectangle-xmark" id="btn-close-botao-verde-box"></i>
            <table>
                <thead>
                    <td>Nº da requisição</td>
                    <td>Descrição</td>
                    <td>Unidade de medida</td>
                    <td>Quantidade</td>
                    <td>Solicitante</td>
                    <td>Data da abertura</td>
                    <td>Status</td>
                </thead>
                <tbody>
                    <?php foreach ($todasMinhasRequisicoes as $todasMinhas) : ?>
                        <tr>
                            <td><?= htmlentities($todasMinhas['id_historico']) ?></td>
                            <td><?= htmlentities($todasMinhas['descricao_historico']) ?></td>
                            <td><?= htmlentities($todasMinhas['unidade_medida_historico']) ?></td>
                            <td><?= htmlentities($todasMinhas['quantidade_historico']) ?></td>
                            <td><?= htmlentities($todasMinhas['solicitante_historico']) ?></td>
                            <td><?= htmlentities($todasMinhas['data_requisicao_historico']) ?></td>
                            <td title="Status"><p><?= htmlentities($todasMinhas['status_historico']) ?></p></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <p>Nenhuma requisição a mais para exibir.</p>
            <div id="bottom-table">
                <button id="total-botao-verde">Total: <?= exibeQuantidadeMinhasRequisicoes($pdo) ?></button>
                <button id="btn-excel-minhas-req"><a href="src/excel/extrair_meu_historico_requisicao.php"><img src="img/logo-excel.png"></a></button>
            </div>
        </article>
    </section>