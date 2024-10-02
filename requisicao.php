<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

senhaPrimeiroAcesso();

$exibeProduto = new Requisicao($pdo);
$exibeProdutos = $exibeProduto->exibeProdutoRequisicao();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // VERIFICA SE TODOS OS CAMPOS OBRIGATORIOS ESTÃO PREENCHIDOS...
    if(
        (isset($_POST['descricao'])) && !empty($_POST['descricao']) &&
        (isset($_POST['quantidade'])) && !empty($_POST['quantidade']) &&
        (isset($_POST['unidade_medida'])) && !empty($_POST['unidade_medida'])
        
    ) {
        // VERIFICA A QUANTIDADE EM ESTOQUE DO PRODUTO SELECIONADO
        $consultaQuantidade = "SELECT estoque FROM tb_produtos WHERE descricao = :descricao_selecionada";
        $stmt = $pdo->prepare($consultaQuantidade);
        $stmt->bindValue(":descricao_selecionada", $_POST['descricao'], PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // SE A QUANTIDADE ESCOLHIDA FOR MAIOR QUE A QUANTIDADE EM ESTOQUE, A REQUISIÇÃO NÃO SERÁ REALIZADA
        if ($_POST['quantidade'] > $resultado['estoque']) {

            header("Location: requisicao.php?erro_requisicao=quantidade_invalida");
            die();  
        } else { // SE A QUANTIDADE NÃO FOR MAIOR, A REQUISIÇÃO SERÁ REALIZADA COM SUCESSO!!!

            $abreRequisicao = new Requisicao($pdo);
            $abreRequisicao->abreRequisicao($_POST['descricao'], $_POST['unidade_medida'], $_POST['quantidade']);

            header("Location: requisicao.php?abre_requisicao=aberta_com_sucesso");
            die();
        } 
    } else {

        // SE HOUVER ALGUM CAMPO OBRIGATÓRIO NÃO PREENCHIDO UM ERRO SERÁ EXIBIDO...
        header("Location: requisicao.php?verifica_campos=campos_nao_preenchidos");
        die();
    }

}

// EXIBE TODAS AS MINHAS REQUISIÇÕES
$todasMinhas = new Requisicao($pdo);
$todasMinhasRequisicoes = $todasMinhas->exibeMinhasRequisicoesHistorico();

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
                    <h3><a href="inicio.php">INÍCIO</a> / ABRIR REQUISIÇÃO</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>
                <section class="conteudo-center">
                    <form method="post" class="form-requisicao" id="form-requisicao" autocomplete="off">
                        <header id="form-cabecalho">
                            <h1>Requisição de insumo</h1>
                            <i class="fa-solid fa-basket-shopping"></i>
                        </header>

                        <h2>Preencha os campos</h2>

                        <label for="descricao">Descrição <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-box"></i>
                                <select name="descricao" id="descricao" required="required">
                                    <option value="">Selecione o produto</option>
                                    <?php foreach ($exibeProdutos as $exibeProduto) : ?>
                                        <option value="<?= $exibeProduto['descricao'] ?>"><?= $exibeProduto['descricao'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </label>
                        <label for="quantidade">Quantidade Desejada <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-arrow-up-9-1"></i>
                                <input type="number" name="quantidade" id="quantidade" placeholder="Insira a quantidade" required>
                            </div>
                        </label>

                        <label for="unidade">Unidade de Medida
                            <div>
                                <i class="fa-solid fa-ruler-combined"></i>
                                <input type="text" name="unidade_medida" id="unidade" placeholder="Preenchido automaticamente" readonly>
                            </div>
                        </label>

                        <label for="estoque">Estoque Atual
                            <div>
                                <i class="fa-solid fa-boxes-stacked"></i>
                                <input type="text" name="estoque" id="estoque" placeholder="Preenchido automaticamente" readonly>
                            </div>
                        </label>
                        
                        <div>
                            <button type="submit">Requisitar</button>
                        </div>
                    </form>

                    <div id="box-ajuda">
                        
                        <header class="box-ajuda-cabecalho">
                            <h1>Caixa de ajuda</h1>
                            <i class="fa-solid fa-circle-question"></i>
                        </header>
                        <p>
                            Selecione o produto e quantidade conforme necessidade e envie a requisição ao almoxarifado.<br><br>
                            Para cada produto diferente será necessário a abertura de uma nova requisição.<br><br>
                            <b>Lembre-se</b>: A quantidade desejada deverá ser menor que a quantidade disponível em estoque atual desse produto, caso contrário não será possivel realizar a requisição.<br><br>
                            Para acompanhar o status da sua requisição acesse a página <a href="inicio.php">inicial</a> ou visualize todo seu histórico de requisições precionando o botão verde no topo da página.
                        </p>
                        
                        <button id="box-ajuda-fechar-btn">Fechar</button>

                    </div>
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
        <button type="button" id="btn-atalho" title="Caixa de ajuda"><i class="fa-regular fa-circle-question"></i></button>
    </div>


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var descricaoSelect = document.getElementById('descricao');
        var unidadeInput = document.getElementById('unidade');
        var estoqueInput = document.getElementById('estoque');

        var todasDescricoes = <?php echo json_encode($exibeProdutos); ?>;

        descricaoSelect.addEventListener('change', function() {
            var descricaoSelecionada = this.value;
            var descricaoEncontrada = todasDescricoes.find(function(descricao) {
                return descricao.descricao === descricaoSelecionada;
            });
            if (descricaoEncontrada) {
                unidadeInput.value = descricaoEncontrada.unidade_medida;
                estoqueInput.value = descricaoEncontrada.estoque;
            } else {
                unidadeInput.value = '';
                estoqueInput.value = '';
            }
        });
    });
</script>

</html>