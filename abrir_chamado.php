<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

senhaPrimeiroAcesso();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // GRAVA O ARQUIVO ANEXADO...
    Uploads::gravaArquivo();

    $abreChamado = new Chamado($pdo);
    $abreChamado->abreChamado(
        $_POST['titulo'],
        $_POST['departamento'],
        $_POST['categoria'],
        $_POST['prioridade'],
        $_POST['descricao'],
        $_POST['inclui_linha'],
        $_POST['inclui_aparelho'],
        $_FILES['anexo']
    );

    $armazenaLog = new Logs($pdo);
    $armazenaLog->armazenaLog(
        'Chamados',
        $_SESSION['usuario'],
        'Abriu o chamado "' . $dadoChamado['titulo'] . '"',
        'Sucesso',
        ''
    );
    
    header("Location: abrir_chamado.php?chamado=aberto");
    die();
}


$chamados = new Chamado($pdo);
$exibeMeusChamados = $chamados->exibeMeusChamados();

$unidade = new Opcoes($pdo);
$listaUnidades = $unidade->listaOpcoes('UNIDADE');

$linha = new Telefonia($pdo);
$listaLinhas = $linha->exibeLinhas();

$aparelho = new Telefonia($pdo);
$listaAparelhos = $aparelho->exibeAparelhos();

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
                    <form method="post" class="form-labels-lado-a-lado" id="form-labels-lado-a-lado" autocomplete="off" enctype="multipart/form-data" multiple>
                        <header id="form-cabecalho">
                            <h1>Abertura de chamado</h1>
                            <i class="fa-solid fa-user-plus"></i>
                        </header>

                        <section class="form-secao-01" name="form-cadastro-usuario">

                            <h2>Preencha os campos</h2>

                            <label for="titulo">Título do chamado<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-file-pen"></i>
                                    <input type="text" name="titulo"  id="titulo" placeholder="Insira o título do chamado">
                                </div>
                            </label>

                            <label for="departamento">Departamento<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-building-flag"></i>
                                    <select name="departamento" id="departamento">
                                        <option value="">Selecione</option>
                                        <?php foreach($listaUnidades as $unidade) : ?>
                                            <option value="<?= htmlentities($unidade['descricao']) ?>"><?= htmlentities($unidade['descricao']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </label>

                            <label for="categoria">Categoria<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-cube"></i>
                                    <select name="categoria" id="categoria">
                                        <option value="">Selecione o perfil</option>
                                        <option value="AQUISIÇÃO DE LINHA">AQUISIÇÃO DE LINHA</option>
                                        <option value="AQUISIÇÃO DE APARELHO">AQUISIÇÃO DE APARELHO</option>
                                        <option value="AQUISIÇÃO DE LINHA E APARELHO">AQUISIÇÃO DE LINHA E APARELHO</option>
                                        <option value="CANCELAMENTO DE LINHA">CANCELAMENTO DE LINHA</option>
                                        <option value="TROCA DE NÚMERO OU DDD">TROCA DE NÚMERO OU DDD</option>
                                        <option value="TROCA DE PERFIL">TROCA DE PERFIL</option>
                                        <option value="ATIVAR / DESATIVAR LINHA">ATIVAR / DESATIVAR LINHA</option>
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
                                    <select name="prioridade"  id="prioridade">
                                        <option value="">Selecione</option>
                                        <option value="BAIXA">BAIXA</option>
                                        <option value="MÉDIA">MÉDIA</option>
                                        <option value="ALTA">ALTA</option>
                                        <option value="URGENTE">URGENTE</option>
                                    </select>
                                </div>
                            </label>
                                            
                            <label for="inclui_linha">Incluir linha (opcional)
                                <div>
                                    <i class="fa-solid fa-sim-card"></i>
                                    <select name="inclui_linha"  id="inclui_linha">
                                        <option value="">Selecione a linha</option>
                                        <?php foreach($listaLinhas as $linha): ?>
                                            <option value="<?= htmlentities($linha['nome']) . " " .  htmlentities($linha['linha'])?>"><?= htmlentities($linha['nome']) . " - " . htmlentities($linha['linha']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </label>

                            <label for="inclui_aparelho">Incluir aparelho (opcional)
                                <div>
                                    <i class="fa-solid fa-mobile-screen-button"></i>
                                    <select name="inclui_aparelho"  id="inclui_aparelho">
                                        <option value="">Selecione o IMEI</option>
                                        <?php foreach($listaAparelhos as $aparelho): ?>
                                            <option value="<?= htmlentities($aparelho['nome']) . " " .  htmlentities($aparelho['imei_aparelho']) ?>"><?= htmlentities($aparelho['nome']) . " - IMEI: " . htmlentities($aparelho['imei_aparelho']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </label>

                            <label for="descricao" id="label-textarea">Descreva o chamado<span style="color: red;"> *</span>
                                <div>
                                    <textarea name="descricao" id="descricao"></textarea>
                                </div>
                            </label>
                            
                            <label for="arquivo">Anexar (.doc, .docx, .pdf, .xls, .xlsx, .jpg, .jpeg, ou .png) opcional
                                <div>
                                    <input type="file" name="anexo" id="anexo" accept=".doc,.docx,.pdf,.xls,.xlsx,.jpg,.jpeg,.png">
                                </div>
                            </label>

                            <div>
                                <button type="submit">Abrir</but>
                            </div>
                        </section>

                        <h2>Meus chamados</h2>

                        <table>
                            <thead>
                                <tr>
                                    <td>Título</td>
                                    <td>Departamento</td>
                                    <td>Categoria</td>
                                    <td>Prioridade</td>
                                    <td>Usuário</td>
                                    <td>Unidade</td>
                                    <td>Data abertura</td>
                                    <td>Status</td>
                                    <td>Atualizar</td>
                                    <td>Visualizar</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($exibeMeusChamados as $chamados) : ?>
                                    <tr>
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
                                        <td>
                                            <?php if($chamados['status'] === 'EM ABERTO') :?>
                                                <a href="editar_chamado.php?id=<?= $chamados['id'] ?>" title="Atualizar esse chamado"><i class="fa-solid fa-square-pen"></i></a>
                                            <?php endif ?>
                                        </td>
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
        </section>
    </main>

    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>