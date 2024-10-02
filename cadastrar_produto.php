<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

apenasAdmin();
senhaPrimeiroAcesso();

// CADASTRA UM PRODTO E ARMAZENA ATIVIDADE EM LOG...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // VERIFICA SE TODOS OS CAMPOR OBRIGATÓRIOS ESTÃO PREENCHIDOS...
    if(
        (isset($_POST['descricao'])) && (!empty($_POST['descricao'])) &&
        (isset($_POST['unidade_medida'])) && (!empty($_POST['unidade_medida'])) &&
        (isset($_POST['estoque'])) &&
        (isset($_POST['consumo_diario'])) &&
        (isset($_POST['aprovacao_oc'])) &&
        (isset($_POST['prazo_entrega'])) &&
        (isset($_POST['categoria']) && !empty($_POST['categoria']))
    ) {
        $cadastraProduto = new Produtos($pdo);
        $cadastraProduto->cadastraProduto(
            $_POST['descricao'],
            $_POST['unidade_medida'],
            $_POST['estoque'],
            $_POST['consumo_diario'],
            $_POST['prazo_entrega'],
            $_POST['aprovacao_oc'],
            $_POST['categoria']
        );

        // ARMAZENA O LOG DE CADASTRO...
        $atividade = "Cadastrou o produto \"$_POST[descricao]\"";
        $registraLog = new Logs($pdo);
        $registraLog->registraLogProduto($atividade);

        header("Location: cadastrar_produto.php?cadastra_produto=cadastrado_com_sucesso");
        die();
    } else {
        // SE HOUVER ALGUM CAMPO OBRIGATORIO NÃO PREENCHIDO, UM ERRO SERÁ EXIBIDO...
        header("Location: cadastrar_produto.php?verifica_campos=campos_nao_preenchidos");
        die();
    }

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
                    <h3><a href="inicio.php">INÍCIO</a> / CADASTRAR UM PRODUTO</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>
                <section class="conteudo-center">
                    <form method="post" class="form-cadastrar-produto" id="form-labels-lado-a-lado">
                        <header id="form-cabecalho">
                            <h1>Cadastro de produto</h1>
                            <i class="fa-solid fa-boxes-packing"></i>
                        </header>

                        <h2>Preencha os campos</h2>
                        
                        <label for="descricao">Descrição <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-box"></i>
                                <input type="text" name="descricao" id="descricao" placeholder="Descrição do produto" required>
                            </div>
                        </label>

                        <label for="unidade_medida">Unidade de medida <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-ruler-combined"></i>
                                <select name="unidade_medida" id="unidade_medida" required>
                                    <option value="">Selecione a unidade de medida</option>
                                    <option>Caixa</option>
                                    <option>Galão</option>
                                    <option>KG</option>
                                    <option>Metro</option>
                                    <option>Pacote</option>
                                    <option>Par</option>
                                    <option>Rolo</option>
                                    <option>Unidade</option>
                                </select>
                            </div>
                        </label>

                        <label for="estoque">Estoque inicial <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-boxes-stacked"></i>
                                <input type="text" name="estoque" id="estoque" placeholder="Quanto há em estoque" required>
                            </div>
                        </label>

                        <label for="consumo_diario">Consumo diário <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-user-clock"></i>
                                <input type="text" name="consumo_diario" id="consumo_diario" placeholder="Consumo médio em dias desse produto" required>
                            </div>
                        </label>

                        <label for="prazo_entrega">Prazo de entrega (em dias) <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-truck-fast"></i>
                                <input type="text" name="prazo_entrega" id="prazo_entrega" placeholder="Prazo médio para entrega pelo fornecedor" required>
                            </div>
                        </label>

                        <label for="prazo_oc">Aprovação OC (em dias) <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-calendar-check"></i>
                                <input type="text" name="aprovacao_oc" id="prazo_oc" placeholder="Prazo de aprovação da OC pela gerência" required>
                            </div>
                        </label>

                        <label for="categoria">Categoria <font color="red">*</font>
                            <div>
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <select name="categoria" id="categoria" required>
                                    <option value="">Selecione a categoria</option>
                                    <option>Essencial</option>
                                    <option>Não essencial</option>
                                </select>
                            </div>
                        </label>
                        
                        <div>
                            <button type="submit">Cadastrar</button>
                        </div>
                    </form>
                </section>

                <div id="box-ajuda">
                    <header class="box-ajuda-cabecalho">
                        <h1>Caixa de ajuda</h1>
                        <i class="fa-solid fa-circle-question"></i>
                    </header>
                    <p>
                        <b>Consumo diário</b>: nesse campo você deverá informar a estimativa de uso diário desse produto.<br><br>
                        <b>Prazo de entrega</b>: nesse campo você deve informar o prazo médio que o seu fornecedor leva para entregar o produto até sua operação.<br><br>
                        <b>Apovação da OC</b>: nesse campo você deve informar o prazo médio que a gerência leva para aprovar a OC de um produto.<br><br>
                        O cálculo do estoque mínimo será determinado automaticamente conforme cálculo dos dados informados.<br><br>
                        Cálculo:<br>
                        <b>(Consumos diário + Prazo de entrega) * Tempo de aprovação da OC = Estoque mínimo.</b>
                    </p>

                    <button id="box-ajuda-fechar-btn">Fechar</button>

                </div>

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
        <a href="controle_estoque.php"><button id="btn-atalho" title="Controle de estoque">
            <i class="fa-solid fa-boxes-stacked"></i>
        </button></a>
    </div>

    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>