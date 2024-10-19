<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

senhaPrimeiroAcesso();

$buscaIdResposta = new Chamado($pdo);
$resposta = $buscaIdResposta->buscaIdResposta(
    $_GET['id']
);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editaResposta = new Chamado($pdo);
    $editaResposta->editaResposta(
        $_GET['id'],
        $_POST['descricao_resposta'],
    );

    header("Location: visualiza_chamado.php?id=$resposta[id_chamado]&chamado=resposta_atualizada");
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
                    <h3><a href="inicio.php">INÍCIO</a> / PAINEL DE CHAMADOS</h3>
                </header>
                <section class="conteudo-center">
                        <table id="table-respostas">
                            <thead>
                                <tr>
                                    <td style="text-align: left">
                                        <h1>Atualizar resposta</h1>
                                    </td>
                                    <td style="text-align: right">
                                        <i class="fa-solid fa-comment-dots"></i>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <form method="post"  class="form-labels-lado-a-lado" id="form-labels-lado-a-lado" autocomplete="off">
                                            <label for="descricao_resposta" id="label-textarea">Atualize a resposta<span style="color: red;"> *</span>
                                                <div>
                                                    <textarea name="descricao_resposta"><?= $resposta['descricao_resposta'] ?></textarea>
                                                </div>
                                            </label>
                                            
                                            <tr>
                                                <td>
                                                    <button type="submit">Atualizar resposta</but>
                                                    <a href="visualiza_chamado.php?id=<?=$resposta['id_chamado']?>"><button type="button" id="btn-cancelar">Cancelar</button></a>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </section>

                <?php
                // EXIBE O RODAPÉ...
                require_once "src/views/layout/rodape.php";
                ?>

            </article>

            <div id="box-ajuda">
                <header class="box-ajuda-cabecalho">
                    <h1>Requisitos de senha</h1>
                    <i class="fa-solid fa-key"></i>
                </header>
                <p>
                    <b>Caracteres</b>: a senha deve conter no mínimo 12 caracteres.<br><br>
                    <b>Letras</b>: a senha deve conter letras maiúsculas e minúsculas.<br><br>
                    <b>Números</b>: a senha deve conter pelo menos um número.<br><br>
                    <b>Resumindo</b>: a senha deve possuir uma combinação de 12 caracteres sendo elas letras maiúsculas, minúsculas e números.
                </p>
                <button id="box-ajuda-fechar-btn">Atualizar</button>

            </div>
        </section>
    </main>

    <div class="btns-atalhos">
        <button type="button" id="btn-atalho" title="Caixa de ajuda"><i class="fa-regular fa-circle-question"></i></button>
        <a href="gerenciar_usuarios.php"><button id="btn-atalho" title="Gerenciar usuários">
                <i class="fa-solid fa-users"></i>
            </button></a>
    </div>


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>