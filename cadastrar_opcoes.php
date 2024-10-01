<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cadastraDispositivo = new CadastroOpcoes($pdo);
    $cadastraDispositivo->cadastraOpcao(
        $_POST['tipo'],
        $_POST['descricao'],
    );

    header("Location: cadastrar_opcoes.php?opcao=cadastrada");
    die();
}

// LISTA TODOS AS MARCAS DE APARELHOS CADASTRADAS...
$tipo = new CadastroOpcoes($pdo);
$listaTipos = $tipo->listaTiposOpcoes();

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
                    <h3><a href="inicio.php">INÍCIO</a> / CADASTRO DE OPÇÕES</h3>
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <a href="requisicao.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </header>
                <section class="conteudo-center">

                    <form method="post" action="">
                        <header id="form-cabecalho">
                            <h1>Cadastrar opções</h1>
                            <i class="fa-solid fa-gears"></i>
                        </header>


                        <label for="tipo">Tipo da opção<span style="color: red;"> *</span>
                            <div>
                                <i class="fa-solid fa-gears"></i>
                                <select id="tipo" name="tipo">    
                                    <option value="">Selecione</option>
                                    <?php foreach($listaTipos as $tipo) : ?>
                                        <option value="<?= htmlentities($tipo['descricao_tipo']) ?>"><?= htmlentities($tipo['descricao_tipo']) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </label>
                        <label for="descricao">Descrição<span style="color: red;"> *</span>
                            <div>
                                <i class="fa-solid fa-mobile-screen"></i>
                                <input type="text" id="descricao" name="descricao" placeholder="Descrição da opção">
                            </div>
                        </label>
                        <div>
                            <button type="submit" name="btn-requisitar">Cadastrar</button>
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
        <a href="consulta_dispositivos.php"><button id="btn-atalho" title="Gerenciar dispositivos">
                <i class="fa-solid fa-house-laptop"></i>
            </button></a>
    </div>


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectPossuiLinha = document.querySelector('select[name="possui_linha"]');
            const selectPossuiAparelho = document.querySelector('select[name="possui_aparelho"]');
            const selectPossuiUsuario = document.querySelector('select[name="possui_usuario"]');

            const secaoLinha = document.querySelector('.form-secao-01');
            const secaoAparelho = document.querySelector('.form-secao-02');
            const secaoUsuario = document.querySelector('.form-secao-03');

            const linha = secaoLinha.querySelector('input[name="linha"]');
            const operadora = secaoLinha.querySelector('select[name="operadora"]');

            const marcaAparelho = secaoAparelho.querySelector('select[name="marca_aparelho"]');
            const modeloAparelho = secaoAparelho.querySelector('input[name="modelo_aparelho"]');
            const imeiAparelho = secaoAparelho.querySelector('input[name="imei_aparelho"]');
            const mdmAparelho = secaoAparelho.querySelector('select[name="gestao_mdm"]');

            const nomeUsuario = secaoUsuario.querySelector('input[name="nome"]');

            secaoLinha.style.display = 'none';
            secaoAparelho.style.display = 'none';
            secaoUsuario.style.display = 'none';

            function toggleSection(select, section, camposObrigatorios) {
                if (select.value === 'Sim') {
                    section.style.display = 'flex';
                } else {
                    section.style.display = 'none';
                }
            }

            selectPossuiLinha.addEventListener('change', function() {
                toggleSection(selectPossuiLinha, secaoLinha, [linha, operadora]);
            });

            selectPossuiAparelho.addEventListener('change', function() {
                toggleSection(selectPossuiAparelho, secaoAparelho, [marcaAparelho, modeloAparelho, imeiAparelho, mdmAparelho]);
            });

            selectPossuiUsuario.addEventListener('change', function() {
                toggleSection(selectPossuiUsuario, secaoUsuario, [nomeUsuario]);
            });
        });
    </script>




</body>

</html>