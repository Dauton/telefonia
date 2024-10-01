<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

$buscaIdUsuario = new Telefonia($pdo);
$dadoDispositivo = $buscaIdUsuario->buscaIdDispositivo($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editaUsuario = new Telefonia($pdo);
    $editaUsuario->atualizaDispositivo(
        $_GET['id'],
        $_POST['linha'],
        $_POST['operadora'],
        $_POST['servico'],
        $_POST['perfil'],
        $_POST['status'],
        $_POST['data_ativacao'],
        $_POST['sim_card'],
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
        $_POST['nome'],
        $_POST['matricula'],
        $_POST['email'],
        $_POST['funcao']
    );

    header("Location: consulta_dispositivos.php?dispositivo=atualizado");
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

    <style>
        form section {
            display: flex;
        }
    </style>

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
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>
                <section class="conteudo-center">
                    <form method="post" class="form-labels-lado-a-lado" id="form-labels-lado-a-lado" autocomplete="off">
                        <header id="form-cabecalho">
                            <h1>Visualização e atualização de dispositivo</h1>
                            <i class="fa-solid fa-sim-card"></i>
                            <i class="fa-solid fa-mobile-screen"></i>
                            <i class="fa-solid fa-clipboard-user"></i>
                        </header>

                        <h1>Atualize algum campo caso necessário</h1>

                        <section class="form-secao-01">

                            <h2>Informações da linha</h2>
                            <label for="linha">Linha<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-phone"></i>
                                    <input type="number" min='0' name="linha" placeholder="Apenas números Ex: 11912345678" value="<?= htmlentities($dadoDispositivo['linha']) ?>">
                                </div>
                            </label>

                            <label for="operadora">Operadora<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-tower-cell"></i>
                                    <select name="operadora">
                                        <option value="<?= htmlentities($dadoDispositivo['operadora']) ?>"><?= htmlentities($dadoDispositivo['operadora']) ?></option>
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
                                    <select name="servico">
                                        <option value="<?= htmlentities($dadoDispositivo['servico']) ?>"><?= htmlentities($dadoDispositivo['servico']) ?></option>
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
                                    <input type="text" name="perfil" id="perfil" placeholder="Perfil da linha" value="<?= htmlentities($dadoDispositivo['perfil']) ?>">
                                </div>
                            </label>
                            <label for="perfil">Status
                                <div>
                                    <i class="fa-regular fa-circle-check"></i>
                                    <select name="status">
                                        <option value="<?= htmlentities($dadoDispositivo['status']) ?>"><?= htmlentities($dadoDispositivo['status']) ?></option>
                                        <option value="ATIVADO">ATIVADO</option>
                                        <option value="DESATIVADO">DESATIVADO</option>
                                    </select>
                                </div>
                            </label>

                            <label for="data_ativacao">Data da ativação
                                <div>
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <input type="date" name="data_ativacao" id="data_ativacao" placeholder="Data da ativação" value="<?= htmlentities($dadoDispositivo['data_ativacao']) ?>">
                                </div>
                            </label>

                            <label for="sim_card">ICCID do SIM Card
                                <div>
                                    <i class="fa-solid fa-sim-card"></i>
                                    <input type="text" name="sim_card" id="sim_card" placeholder="Apenas números Ex: 123456789123456789" value="<?= htmlentities($dadoDispositivo['sim_card']) ?>">
                                </div>
                            </label>

                        </section>

                        <section class="form-secao-02">

                            <h2>Informações do aparelho</h2>

                            <label for="marca_aparelho">Marca<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-mobile-screen"></i>
                                    <select name="marca_aparelho">
                                        <option value="<?= htmlentities($dadoDispositivo['marca_aparelho']) ?>"><?= htmlentities($dadoDispositivo['marca_aparelho']) ?></option>
                                        <option value="IPHONE">IPHONE</option>
                                        <option value="LG">LG</option>
                                        <option value="Motorola">MOTOROLA</option>
                                        <option value="Samsung">SAMSUNG</option>
                                        <option value="Xiaomi">XIAOMI</option>
                                    </select>
                                </div>
                            </label>

                            <label for="modelo_aparelho">Modelo<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-mobile-screen"></i>
                                    <input type="text" name="modelo_aparelho" id="modelo_aparelho" placeholder="Modelo do aparelho" value="<?= htmlentities($dadoDispositivo['modelo_aparelho']) ?>">
                                </div>
                            </label>

                            <label for="imei_aparelho">IMEI aparelho
                                <div>
                                    <i class="fa-solid fa-mobile-screen"></i>
                                    <input type="text" name="imei_aparelho" id="imei_aparelho" placeholder="IMEI do aparelho" value="<?= htmlentities($dadoDispositivo['imei_aparelho']) ?>">
                                </div>
                            </label>

                            <label for="gestao_mdm">MDM
                                <div>
                                    <i class="fa-solid fa-shield-halved"></i>
                                    <select name="gestao_mdm">
                                        <option value="<?= htmlentities($dadoDispositivo['gestao_mdm']) ?>"><?= htmlentities($dadoDispositivo['gestao_mdm']) ?></option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                </div>
                            </label>

                        </section>

                        <section class="form-secao-03">

                            <h2>Informações do usuário</h2>

                            <label for="nome">Nome<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-user"></i>
                                    <input type="text" name="nome" placeholder="Nome do usuário" value="<?= htmlentities($dadoDispositivo['nome']) ?>">
                                </div>
                            </label>

                            <label for="matricula">Matrícula
                                <div>
                                    <i class="fa-solid fa-user-tag"></i>
                                    <input type="text" name="matricula" id="matricula" placeholder="Matrícula do usuário" value="<?= htmlentities($dadoDispositivo['matricula']) ?>">
                                </div>
                            </label>

                            <label for="email">E-mail
                                <div>
                                    <i class="fa-solid fa-envelope"></i>
                                    <input type="text" name="email" id="email" placeholder="E-mail do usuário" value="<?= htmlentities($dadoDispositivo['email']) ?>">
                                </div>
                            </label>

                            <label for="funcao">Função
                                <div>
                                    <i class="fa-solid fa-briefcase"></i>
                                    <input type="text" name="funcao" id="funcao" placeholder="Função do usuário" value="<?= htmlentities($dadoDispositivo['funcao']) ?>">
                                </div>
                            </label>

                        </section>

                        <section class="form-secao-04">

                            <h2>Informações da localidade</h2>

                            <label for="unidade">Unidade<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-regular fa-map"></i>
                                    <select name="unidade">
                                        <option value="<?= htmlentities($dadoDispositivo['unidade']) ?>"><?= htmlentities($dadoDispositivo['unidade']) ?></option>
                                        <option value="CDARCEX">CDARCEX</option>
                                        <option value="CDAMBEX">CDAMBEX</option>
                                    </select>
                                </div>
                            </label>

                            <label for="centro_custo">Centro de custos<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-wallet"></i>
                                    <select name="centro_custo">
                                        <option value="<?= htmlentities($dadoDispositivo['centro_custo']) ?>"><?= htmlentities($dadoDispositivo['centro_custo']) ?></option>
                                        <option value="219002">219002</option>
                                        <option value="204303">204303</option>
                                    </select>
                                </div>
                            </label>

                            <label for="uf">Estado UF<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-earth-americas"></i>
                                    <select name="uf">
                                        <option value="<?= htmlentities($dadoDispositivo['uf']) ?>"><?= htmlentities($dadoDispositivo['uf']) ?></option>
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
                                    <select name="canal">
                                        <option value="<?= htmlentities($dadoDispositivo['canal']) ?>"><?= htmlentities($dadoDispositivo['canal']) ?></option>
                                        <option value="ID ARMAZENS GERAIS LTDA">ID ARMAZENS GERAIS LTDA</option>
                                        <option value="ID DO BRASIL LOGÍSTICA LTDA">ID DO BRASIL LOGÍSTICA LTDA</option>
                                        <option value="PROSERV LTDA">PROSERV LTDA</option>
                                    </select>
                                </div>
                            </label>

                            <label for="gestor">Nome do ponto focal<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-house-user"></i>
                                    <input type="text" name="ponto_focal" id="ponto_focal" placeholder="Nome do ponto focal" value="<?= htmlentities($dadoDispositivo['ponto_focal']) ?>">
                                </div>
                            </label>

                            <label for="gestor">Nome do gestor<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-user-tie"></i>
                                    <input type="text" name="gestor" id="gestor" placeholder="Nome do gestor" value="<?= htmlentities($dadoDispositivo['gestor']) ?>">
                                </div>
                            </label>
                        </section>

                        <div>
                            <button type="submit">Atualizar</button>
                            <a href="consulta_dispositivos.php"><button type="button" id="btn-cancelar">Cancelar</button></a>
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
                    <h1>Requisitos de senha</h1>
                    <i class="fa-solid fa-mobile-screen-button"></i>
                </header>
                <p>
                    <b>Caracteres</b>: a senha deve conter no mínimo 12 caracteres.<br><br>
                    <b>Letras</b>: a senha deve conter letras maiúsculas e minúsculas.<br><br>
                    <b>Números</b>: a senha deve conter pelo menos um número.<br><br>
                    <b>Resumindo</b>: a senha deve possuir uma combinação de 12 caracteres sendo elas letras maiúsculas, minúsculas e números.
                </p>

                <button id="box-ajuda-fechar-btn">Fechar</button>

            </div>
        </section>
    </main>

    <div class="btns-atalhos">
        <button type="button" id="btn-atalho" title="Caixa de ajuda"><i class="fa-regular fa-circle-question"></i></button>
        <button id="btn-atalho" title="Excluir" title="Gerenciar usuários">
            <i class="fa-solid fa-trash-can"></i>
        </button>

        <div id="box-confirmacao">

            <header class="box-ajuda-cabecalho">
                <h1>Confirmação</h1>
                <i class="fa-solid fa-triangle-exclamation"></i>
            </header>

            <h2>Observações</h2>
            <p>
                Tem certeza que deseja excluir esse dispositivo?<br><br>
                Essa ação não poderá ser desfeita.
            </p>

            <div id="box-confimarcao-btns">
                <form action="src/manipulacoes_dispositivo/exclui_dispositivo.php" method="post">
                    <input type="hidden" name="id" value="<?= $dadoDispositivo['id'] ?>">
                    <button type="submit" title="Excluir esse dispositivo">Excluir</button>
                </form>
                <button type="button" id="btn-cancelar">Cancelar</button>
            </div>

        </div>

    </div>


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>