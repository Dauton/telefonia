<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

senhaPrimeiroAcesso();
liberacaoIDL();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // VALIDA SE EXISTE ALGUM DADOS DE LINHA OU APARELHO PREENCHIDOS...
    if ($_POST['possui_linha'] === "Não" && $_POST['possui_aparelho'] === "Não") {

        header('Location: cadastrar_dispositivo.php?verifica_campo=nenhum_dado');
        die();
    } else {
        $cadastraDispositivo = new Telefonia($pdo);
        $cadastraDispositivo->cadastraDispositivo(
            $_POST['possui_linha'],
            $_POST['linha'],
            $_POST['operadora'],
            $_POST['servico'],
            $_POST['perfil'],
            $_POST['status'],
            $_POST['data_ativacao'],
            $_POST['sim_card'],

            $_POST['possui_aparelho'],
            $_POST['tipo_aparelho'],
            $_POST['marca_aparelho'],
            $_POST['modelo_aparelho'],
            $_POST['imei_aparelho'],
            $_POST['gestao_mdm'],
            
            $_POST['unidade'],
            $_POST['centro_custo'],
            $_POST['uf'],
            $_POST['canal'],
            $_POST['ponto_focal'],
            $_POST['gestor'],

            $_POST['possui_usuario'],
            $_POST['nome'],
            $_POST['matricula'],
            $_POST['email'],
            $_POST['funcao']
        );

        // ARMAZENA O CADASTRO EM LOG...
        $armazenaLog = new Logs($pdo);
        $armazenaLog->armazenaLog(
            "Telefonia",
            "$_SESSION[usuario]",
            'Cadastrou o aparelho de IMEI "' . $_POST['imei_aparelho'] . '" e a linha "' .  $_POST['linha'] . '" para o usuário "' . $_POST['nome'] . '"',
            "Sucesso",
            ''
        );

        header("Location: consulta_dispositivos.php?dispositivo=cadastrado");
        die();
    }
}

// LISTA TODOS AS MARCAS DE APARELHOS CADASTRADAS...
$marca = new Opcoes($pdo);
$listaMarcasAparelho = $marca->listaOpcoes('MARCA');

// LISTA TODOS OS MODELOS DE APARELHOS CADASTRADOS...
$modelo = new Opcoes($pdo);
$listaModelosAparelho = $modelo->listaOpcoes('MODELO');

// LISTA TODOS AS UNIDADES CADASTRADOS...
$unidade = new Opcoes($pdo);
$listaUnidades = $unidade->listaOpcoes('UNIDADE');

// LISTA TODOS OS CENTROS DE CUSTOS CADASTRADOS...
$cdc = new Opcoes($pdo);
$listaCentrosDeCustos = $cdc->listaOpcoes('CENTRO DE CUSTOS');

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
                    <h3><a href="inicio.php">INÍCIO</a> / CADASTRO DE DISPOSITIVO</h3>
                </header>
                <section class="conteudo-center">
                    <div class="conteudo-center-box-01">
                        <h1>Alguns atalhos</h1>
                        <a href="consulta_dispositivos.php">
                            <div>
                                <div id="box-infos-amarela">
                                    <span>
                                        <h4>CONSULTAR DISPOSITIVO</h4>
                                    </span>
                                    <h3>Consultar</h3>
                                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                                    <p class="texto-filtro">Clique para abrir</p>
                                </div>
                            </div>
                        </a>
                        <a href="cadastrar_opcoes.php">
                            <div>
                                <div id="box-infos-azul">
                                    <span>
                                        <h4>CADASTRAR OPÇÃO</h4>
                                    </span>
                                    <h3>Cadastrar</h3>
                                    <i class="fa-solid fa-gears"></i>
                                    <p class="texto-filtro">Clique para abrir</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <form method="post" class="form-labels-lado-a-lado" id="form-labels-lado-a-lado" autocomplete="off" name="dispositivo">
                        <header id="form-cabecalho">
                            <h1>Cadastro de dispositivo</h1>
                            <i class="fa-solid fa-sim-card"></i>
                            <i class="fa-solid fa-mobile-screen"></i>
                            <i class="fa-solid fa-clipboard-user"></i>
                        </header>

                        <label for="servico">Possui linha?<span style="color: red;"> *</span>
                            <div>
                                <i class="fa-solid fa-sim-card"></i>
                                <select name="possui_linha" id="servico" required>
                                    <option value="">Selecione</option>
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>
                                </select>
                            </div>
                        </label>

                        <section class="form-secao-01">

                            <header class="conteudo-cabecalho">
                                <h3>Informações da linha</h3>
                                <i class="fa-solid fa-sim-card"></i>
                            </header>

                            <label for="linha">Linha<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-phone"></i>
                                    <input type="text" name="linha" id="linha" placeholder="Apenas números Ex: 11912345678">
                                </div>
                            </label>

                            <label for="operadora">Operadora<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-tower-cell"></i>
                                    <select name="operadora" id="operadora">
                                        <option value="">Selecione</option>
                                        <option value="CLARO">CLARO</option>
                                        <option value="OI">OI</option>
                                        <option value="TIM">TIM</option>
                                        <option value="VIVO">VIVO</option>
                                    </select>
                                </div>
                            </label>

                            <label for="servico">Serviço
                                <div>
                                    <i class="fa-solid fa-network-wired"></i>
                                    <select name="servico" id="servico">
                                        <option value="">Selecione</option>
                                        <option value="MOVEL">MOVEL</option>
                                        <option value="BANDA LARGA">BANDA LARGA</option>
                                        <option value="LINK">LINK</option>
                                        <option value="LINK">LINK DEDICADO</option>
                                    </select>
                                </div>
                            </label>

                            <label for="perfil">Perfil
                                <div>
                                    <i class="fa-solid fa-comment-sms"></i>
                                    <input type="text" name="perfil" id="perfil" placeholder="Perfil da linha">
                                </div>
                            </label>

                            <label for="status">Status<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-regular fa-circle-check"></i>
                                    <select name="status">
                                        <option value="">Selecione</option>
                                        <option value="ATIVADO">ATIVADO</option>
                                        <option value="DESATIVADO">DESATIVADO</option>
                                    </select>
                                </div>
                            </label>

                            <label for="data_ativacao">Data da ativação
                                <div>
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <input type="date" name="data_ativacao" id="data_ativacao" placeholder="Data da ativação">
                                </div>
                            </label>

                            <label for="sim_card">ICCID do SIM Card
                                <div>
                                    <i class="fa-solid fa-sim-card"></i>
                                    <input type="text" name="sim_card" id="sim_card" placeholder="Apenas números Ex: 1234567891123456789123">
                                </div>
                            </label>
                        </section>
                        <br>
                        <label for="possui_aparelho">Possui aparelho?<span style="color: red;"> *</span>
                            <div>
                                <i class="fa-solid fa-mobile-screen"></i>
                                <select name="possui_aparelho" id="possui_aparelho" required>
                                    <option value="">Selecione</option>
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>
                                </select>
                            </div>
                        </label>


                        <section class="form-secao-02">

                            <header class="conteudo-cabecalho">
                                <h3>Informações do aparelho</h3>
                                <i class="fa-solid fa-mobile-screen-button"></i>
                            </header>

                            <label for="tipo_aparelho">Tipo equipamento<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-microchip"></i>
                                    <select name="tipo_aparelho" id="tipo_aparelho">
                                        <option value="">Selecione</option>
                                        <option value="CELULAR">CELULAR</option>
                                        <option value="TABLET">TABLET</option>
                                        <option value="MODEM">MODEM</option>
                                    </select>
                                </div>
                            </label>

                            <label for="marca_aparelho">Marca<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-mobile-screen"></i>
                                    <select name="marca_aparelho" id="marca_aparelho">
                                        <option value="">Selecione</option>
                                        <?php foreach ($listaMarcasAparelho as $marca) : ?>
                                            <option value="<?= htmlentities($marca['descricao']) ?>"><?= htmlentities($marca['descricao']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </label>

                            <label for="modelo_aparelho">Modelo<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-mobile-screen"></i>
                                    <select name="modelo_aparelho" id="modelo_aparelho">
                                        <option value="">Selecione</option>
                                        <?php foreach ($listaModelosAparelho as $modelo) : ?>
                                            <option value="<?= htmlentities($modelo['descricao']) ?>"><?= htmlentities($modelo['descricao']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </label>

                            <label for="imei_aparelho">IMEI aparelho<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-mobile-screen"></i>
                                    <input type="text" name="imei_aparelho" id="imei_aparelho" placeholder="Apenas números Ex: 123456789123456">
                                </div>
                            </label>

                            <label for="gestao_mdm">MDM<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-shield-halved"></i>
                                    <select name="gestao_mdm" id="gestao_mdm">
                                        <option value="">Selecione</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                </div>
                            </label>

                        </section>
                        <br>
                        <label for="possui_usuario">Essa linha ou aparelho possui usuário?<span style="color: red;"> *</span>
                            <div>
                                <i class="fa-solid fa-user"></i>
                                <select name="possui_usuario" id="possui_usuario" required>
                                    <option value="">Selecione</option>
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>
                                </select>
                            </div>
                        </label>
                        
                        <section class="form-secao-03">

                            <header class="conteudo-cabecalho">
                                <h3>Informações do usuário</h3>
                                <i class="fa-solid fa-clipboard-user"></i>
                            </header>

                            <label for="nome">Nome<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-user"></i>
                                    <input type="text" name="nome" id="nome" placeholder="Nome do usuário">
                                </div>
                            </label>

                            <label for="matricula">Matrícula
                                <div>
                                    <i class="fa-solid fa-user-tag"></i>
                                    <input type="text" name="matricula" id="matricula" placeholder="Apenas números Ex: 123456">
                                </div>
                            </label>

                            <label for="email">E-mail
                                <div>
                                    <i class="fa-solid fa-envelope"></i>
                                    <input type="text" name="email" id="email" placeholder="E-mail do usuário">
                                </div>
                            </label>

                            <label for="funcao">Função
                                <div>
                                    <i class="fa-solid fa-briefcase"></i>
                                    <input type="text" name="funcao" id="funcao" placeholder="Função do usuário">
                                </div>
                            </label>

                        </section>
                        <br>
                        <section class="form-secao-04">

                            <header class="conteudo-cabecalho">
                                <h3>Informações da unidade</h3>
                                <i class="fa-solid fa-map-location-dot"></i>
                            </header>

                            <label for="unidade">Unidade<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-map-location-dot"></i>
                                    <select name="unidade" id="unidade">
                                        <option value="">Selecione</option>
                                        <?php foreach ($listaUnidades as $unidade) : ?>
                                            <option value="<?= htmlentities($unidade['descricao']) ?>"><?= htmlentities($unidade['descricao']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </label>

                            <label for="centro_custo">Centro de custos<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-wallet"></i>
                                    <select name="centro_custo" id="centro_custo">
                                        <option value="">Selecione</option>
                                        <?php foreach ($listaCentrosDeCustos as $cdc) : ?>
                                            <option value="<?= htmlentities($cdc['descricao']) ?>"><?= htmlentities($cdc['descricao']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </label>

                            <label for="uf">Estado UF<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-earth-americas"></i>
                                    <select name="uf" id="uf">
                                        <option value="">Selecione</option>
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AP">AP</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO">GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MT">MT</option>
                                        <option value="MS">MS</option>
                                        <option value="MG">MG</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PR">PR</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RS">RS</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="SC">SC</option>
                                        <option value="SP">SP</option>
                                        <option value="SE">SE</option>
                                        <option value="TO">TO</option>
                                    </select>
                                </div>
                            </label>

                            <label for="canal">Canal<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-building"></i>
                                    <select name="canal" id="canal">
                                        <option value="">Canal</option>
                                        <option value="ID ARMAZENS GERAIS LTDA">ID ARMAZENS GERAIS LTDA</option>
                                        <option value="ID DO BRASIL LOGÍSTICA LTDA">ID DO BRASIL LOGÍSTICA LTDA</option>
                                        <option value="PROSERV LTDA">PROSERV LTDA</option>
                                    </select>
                                </div>
                            </label>

                            <label for="ponto_focal">Nome do ponto focal<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-house-user"></i>
                                    <input type="text" name="ponto_focal" id="ponto_focal" placeholder="Nome do ponto focal">
                                </div>
                            </label>

                            <label for="gestor">Nome do gestor<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-user-tie"></i>
                                    <input type="text" name="gestor" id="gestor" placeholder="Nome do gestor">
                                </div>
                            </label>
                        </section>

                        <div>
                            <button type="submit">Cadastrar</button>
                        </div>

                    </form>
                </section>

                <?php
                // EXIBE O RODAPÉ...
                require_once "src/views/layout/rodape.php";
                ?>

            </article>

            <div id="box-ajuda">
                <header class="box-ajuda-cabecalho">
                    <h1>Caixa de ajuda</h1>
                    <i class="fa-solid fa-mobile-screen-button"></i>
                </header>
                <p>
                    <b>Linha:</b> Se houver uma linha, os campos "linha" e "operadora" devem ser preenchidos obrigatoriamente.<br><br>
                    <b>Aparelho:</b> Se houver um aparelho, os campos "marca" e "modelo" devem ser preenchidos obrigatoriamente.<br><br>
                    <b>Usuário:</b> Se houver um usuário, todos os campos relacionados serão obrigatórios.<br><br>
                    <b>Localidade:</b> Todos os campos referentes à localidade são de preenchimento obrigatório.<br><br>
                    Para que o cadastro seja bem-sucedido, é necessário incluir pelo menos uma linha ou um aparelho.
                </p>

                <button id="box-ajuda-fechar-btn">Fechar</button>

            </div>
        </section>
    </main>

    <div class="btns-atalhos">
        <button type="button" id="btn-atalho" title="Caixa de ajuda"><i class="fa-regular fa-circle-question"></i></button>
    </div>

    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>