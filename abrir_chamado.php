<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

apenasAdmin();
senhaPrimeiroAcesso();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $abreChamado = new Chamado($pdo);
    $abreChamado->abreChamado(
        $_POST['titulo'],
        $_POST['departamento'],
        $_POST['categoria'],
        $_POST['prioridade'],
        $_POST['descricao']
    );
    header("Location: abrir_chamado.php?chamado=aberto");
    die();
}

$chamados = new Chamado($pdo);
$exibeMeusChamados = $chamados->exibeMeusChamados();

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
                            <h1>Abertura de chamado</h1>
                            <i class="fa-solid fa-user-plus"></i>
                        </header>

                        <section class="form-secao-01" name="form-cadastro-usuario">

                            <h2>Preencha os campos</h2>

                            <label for="titulo">Título do chamado<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-file-pen"></i>
                                    <input type="text" name="titulo" placeholder="Insira o título do chamado">
                                </div>
                            </label>

                            <label for="departamento">Departamento<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-building-flag"></i>
                                    <select name="departamento">
                                        <option value="">Selecione</option>
                                        <option value="INFRAESTRUTURA IDL">INFRAESTRUTURA IDL</option>
                                        <option value="MOBIT">MOBIT</option>
                                    </select>
                                </div>
                            </label>

                            <label for="categoria">Categoria<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-cube"></i>
                                    <select name="categoria">
                                        <option value="">Selecione o perfil</option>
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
                                        <option value="">Selecione</option>
                                        <option value="BAIXA">BAIXA</option>
                                        <option value="MÉDIA">MÉDIA</option>
                                        <option value="ALTA">ALTA</option>
                                        <option value="URGENTE">URGENTE</option>
                                    </select>
                                </div>
                            </label>

                            <label for="descricao" id="label-textarea">Descreva o chamado<span style="color: red;"> *</span>
                                <div>
                                    <textarea name="descricao"></textarea>
                                </div>
                            </label>

                            <div>
                                <button type="submit" name="btn-requisitar">Abrir</but>
                            </div>
                        </section>

                        <h2>Meus chamados</h2>

                        <table>
                            <thead>
                                <tr>
                                    <td>ID chamado</td>
                                    <td>Título</td>
                                    <td>Departamento</td>
                                    <td>Categoria</td>
                                    <td>Prioridade</td>
                                    <td>Usuário</td>
                                    <td>Unidade</td>
                                    <td>Data abertura</td>
                                    <td>Status</td>
                                    <td>Fechado por</td>
                                    <td>Data fechamento</td>
                                    <td>Visualizar</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($exibeMeusChamados as $chamados) : ?>
                                    <tr>
                                        <td><?= htmlentities($chamados['id']) ?></td>
                                        <td><?= htmlentities($chamados['titulo']) ?></td>
                                        <td><?= htmlentities($chamados['departamento']) ?></td>
                                        <td><?= htmlentities($chamados['categoria']) ?></td>
                                        <td id="status">
                                            <p><?= htmlentities($chamados['prioridade']) ?></p>
                                        </td>
                                        <td><?= htmlentities($chamados['usuario']) ?></td>
                                        <td><?= htmlentities($chamados['unidade_usuario']) ?></td>
                                        <td><?= htmlentities($chamados['data_abertura']) ?></td>
                                        <td id="status">
                                            <p><?= htmlentities($chamados['status']) ?></p>
                                        </td>
                                        <td><?= htmlentities($chamados['fechado_por']) ?></td>
                                        <td><?= htmlentities($chamados['data_fechamento']) ?></td>
                                        <td>
                                            <a href="visualiza_chamado.php?id=<?= $chamados['id'] ?>"><i class="fa-solid fa-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
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
                <button id="box-ajuda-fechar-btn">Fechar</button>

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