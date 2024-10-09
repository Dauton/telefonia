<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

apenasAdmin();
senhaPrimeiroAcesso();

$chamados = new Chamado($pdo);
$exibeMeusChamados = $chamados->exibeMeusChamados();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editaChamado = new Chamado($pdo);
    $editaChamado->editaChamado(
        $_GET['id'],
        $_POST['titulo'],
        $_POST['departamento'],
        $_POST['categoria'],
        $_POST['prioridade'],
        $_POST['descricao'],
    );
    header("Location: abrir_chamado.php?chamado=atualizado");
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
                <section class="conteudo-center" name="cadastro-usuario">
                    <form method="post" class="form-labels-lado-a-lado" id="form-labels-lado-a-lado" autocomplete="off">
                        <header id="form-cabecalho">
                            <h1>Atualizar chamado</h1>
                            <i class="fa-solid fa-pen-to-square"></i>
                        </header>

                        <section class="form-secao-01" name="form-cadastro-usuario">

                            <h2>Preencha os campos</h2>

                            <label for="titulo">Título do chamado<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-file-pen"></i>
                                    <input type="text" name="titulo" placeholder="Insira o título do chamado" value="<?= htmlentities($dadoChamado['titulo']) ?>">
                                </div>
                            </label>

                            <label for="departamento">Departamento<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-building-flag"></i>
                                    <select name="departamento">
                                        <option value="<?= htmlentities($dadoChamado['departamento']) ?>"><?= htmlentities($dadoChamado['departamento']) ?></option>
                                        <option value="INFRAESTRUTURA IDL">INFRAESTRUTURA IDL</option>
                                        <option value="MOBIT">MOBIT</option>
                                    </select>
                                </div>
                            </label>

                            <label for="categoria">Categoria<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-cube"></i>
                                    <select name="categoria">
                                        <option value="<?= $dadoChamado['categoria'] ?>"><?= htmlentities($dadoChamado['categoria']) ?></option>
                                        <option value="AQUISIÇÃO DE LINHA">AQUISIÇÃO DE LINHA</option>
                                        <option value="AQUISIÇÃO DE APARELHO">AQUISIÇÃO DE APARELHO</option>
                                        <option value="AQUISIÇÃO DE LINHA E APARELHO">AQUISIÇÃO DE LINHA E APARELHO</option>
                                        <option value="CANCELAMENTO DE LINHA">CANCELAMENTO DE LINHA</option>
                                        <option value="TROCA DE NÚMERO OU DDD">TROCA DE NÚMERO OU DDD</option>
                                        <option value="INCLUIR OU REMOVER MDM">INCLUIR OU REMOVER MDM</option>
                                        <option value="NÃO FAZ OU NÃO RECEBE LIGAÇÃO">NÃO FAZ OU NÃO RECEBE LIGAÇÃO</option>
                                        <option value="ROUBO OU PERDA DE LINHA OU APARELHO">ROUBO OU PERDA DE LINHA OU APARELHO</option>
                                        <option value="REPARO DE APARELHO">REPARO DE APARELHO</option>
                                        <option value="ATUALIZAÇÃO DE INVENTÁRIO">ATUALIZAÇÃO DE INVENTÁRIO</option>
                                    </select>
                                </div>
                            </label>

                            <label for="prioridade">Prioridade<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    <select name="prioridade">
                                        <option value="<?= htmlentities($dadoChamado['prioridade']) ?>"><?= htmlentities($dadoChamado['prioridade']) ?></option>
                                        <option value="BAIXA">BAIXA</option>
                                        <option value="MÉDIA">MÉDIA</option>
                                        <option value="ALTA">ALTA</option>
                                        <option value="URGENTE">URGENTE</option>
                                    </select>
                                </div>
                            </label>

                            <label for="descricao" style="width: 70%">Descreva o chamado<span style="color: red;"> *</span>
                                <div>
                                    <textarea name="descricao"><?= htmlentities($dadoChamado['descricao']) ?></textarea>
                                </div>
                            </label>

                            <div>
                                <button type="submit">Atualizar</button>
                                <a href="abrir_chamado.php"><button type="button" id="btn-cancelar">Cancelar</button></a>
                            </div>

                        </section>
                    </form>

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

                            <label for="descricao_resposta" style="width: 70%"></span>
                                <div>
                                    <textarea readonly><?= htmlentities($respostas['descricao_resposta']) ?></textarea>
                                </div>
                            </label>
                        </form>
                    <?php endforeach ?>

                    <form method="post" action="src/manipulacoes_chamados/envia_resposta.php" class="form-labels-lado-a-lado" id="form-labels-lado-a-lado" autocomplete="off">
                        <header id="form-cabecalho">
                            <h1>Adicionar resposta</h1>
                            <i class="fa-regular fa-comment-dots"></i>
                        </header>

                        <section class="form-secao-01">

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

                    <form method="post" action="src/manipulacoes_chamados/fecha_chamado.php">
                        <input type="hidden" name="id" value="<?= $dadoChamado['id'] ?>">
                        <input type="hidden" name="data_fechamento" value="<?= exibeDataAtual() ?>">
                        <button type="submit" id="btn-red">Fechar chamado</button>
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