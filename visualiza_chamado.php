<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

apenasAdmin();
senhaPrimeiroAcesso();

$chamados = new Chamado($pdo);
$exibeMeusChamados = $chamados->exibeMeusChamados();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editaChamado = new Chamado($pdo);
    $editaChamado->moveChamado(
        $_GET['id'],
        $_POST['departamento'],
    );
    header("Location: visualiza_chamado.php?id=$_GET[id]&chamado=movido");
    die();
}

$buscaIdChamado = new Chamado($pdo);
$dadoChamado = $buscaIdChamado->buscaIdChamado($_GET['id']);


$respostas = new Chamado($pdo);
$exibeRespostas = $respostas->exibeRespostas();

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

                        <table>
                            <thead>
                                <tr>
                                    <td>ID chamado</td>
                                    <td>Titulo</t>
                                    <td>Departamento</td>
                                    <td>Categoria</td>
                                    <td>Prioridade</td>
                                    <td>Usuário</td>
                                    <td>Unidade</td>
                                    <td>Data abertura</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= htmlentities($dadoChamado['id']) ?></td>
                                    <td><?= htmlentities($dadoChamado['titulo']) ?></td>
                                    <td><?= htmlentities($dadoChamado['departamento']) ?></td>
                                    <td><?= htmlentities($dadoChamado['categoria']) ?></td>
                                    <td id="status">
                                        <p><?= htmlentities($dadoChamado['prioridade']) ?></p>
                                    </td>
                                    <td><?= htmlentities($dadoChamado['usuario']) ?></td>
                                    <td><?= htmlentities($dadoChamado['unidade_usuario']) ?></td>
                                    <td><?= htmlentities($dadoChamado['data_abertura']) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="10" id="table-textarea"><textarea readonly><?= htmlentities($dadoChamado['descricao']) ?></textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="10" id="table-textarea">
                                        <button type="button" id="btn-red" title="Fechar chamado">Fechar chamado</button>
                                        <button type="button" title="Mover chamado">Mover chamado</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            
                        </div>
                    <div id="box-confirmacao">

                        <header class="box-ajuda-cabecalho">
                            <h1>Confirmação</h1>
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </header>

                        <h2>Observações</h2>

                        <p>
                            Tem certeza que deseja fechar esse chamado?<br><br>
                        </p>

                        <form method="post" action="src/manipulacoes_chamados/fecha_chamado.php" id="form-apenas-buttons">
                            <input type="hidden" name="id" value="<?= $dadoChamado['id'] ?>">

                            <label for="motivo_fechamento">Descreva o motivo do fechamento<span style="color: red;"> *</span>
                                <div>
                                    <textarea name="motivo_fechamento"></textarea>
                                </div>
                            </label>

                            <div id="box-confimarcao-btns">
                                <button type="submit" id="btn-blue">Fechar chamado</button>
                                <button type="button" id="btn-cancelar">Cancelar</button>
                            </div>

                        </form>
                    </div>

                    <div id="box-confirmacao" title="Mover chamado">

                        <header class="box-ajuda-cabecalho">
                            <h1>Confirmação</h1>
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </header>

                        <h2>Confirmação</h2>

                        <p>
                            Selecione o departamento?<br><br>
                        </p>

                        <form method="post" action="" id="form-apenas-buttons">
                            <label for="departamento">Departamentos<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-building-flag"></i>
                                    <select name="departamento">
                                        <option value="<?= htmlentities($dadoChamado['departamento']) ?>"><?= htmlentities($dadoChamado['departamento']) ?></option>
                                        <option value="INFRAESTRUTURA IDL">INFRAESTRUTURA IDL</option>
                                        <option value="MOBIT">MOBIT</option>
                                    </select>
                                </div>
                            </label>

                            <div id="box-confimarcao-btns">
                                <button type="submit" id="btn-blue">Mover chamado</button>
                                <button type="button" id="btn-cancelar" title="Cancelar movimento">Cancelar</button>
                            </div>

                        </form>
                        </div>

                    <?php foreach ($exibeRespostas as $respostas) : ?>
                        <form class="form-labels-lado-a-lado" id="form-labels-lado-a-lado" autocomplete="off">
                            <header id="form-cabecalho">
                                <h1>Resposta</h1>
                                <div>
                                    <span><?= $respostas['usuario_resposta'] ?> - </span>
                                    <span><?= $respostas['data_resposta'] ?></span>
                                </div>
                                <i class="fa-regular fa-comments"></i>
                            </header>
                            <textarea readonly><?= htmlentities($respostas['descricao_resposta']) ?></textarea>
                        </form>
                    <?php endforeach ?>

                    <form method="post" action="src/manipulacoes_chamados/envia_resposta.php" class="form-labels-lado-a-lado" id="form-labels-lado-a-lado" autocomplete="off">
                        <header id="form-cabecalho">
                            <h1>Adicionar resposta</h1>
                            <i class="fa-regular fa-comment-dots"></i>
                        </header>

                        <section style="display: flex;">

                            <h2>Preencha a resposta</h2>

                            <label for="descricao_resposta" style="width: 70%">Resposta<span style="color: red;"> *</span>
                                <div>
                                    <textarea name="descricao_resposta"></textarea>
                                </div>
                            </label>

                            <input type="hidden" name="id" value="<?= $dadoChamado['id'] ?>">

                            <div>
                                <button type="submit">Enviar</but>
                            </div>
                        </section>
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