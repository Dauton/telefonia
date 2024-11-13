<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

senhaPrimeiroAcesso();

$buscaIdChamado = new Chamado($pdo);
$dadoChamado = $buscaIdChamado->buscaIdChamado($_GET['id']);

// SE O CHAMADO JÁ ESTIVER FECHADO OU O CHAMADO NÃO PERTENCER AO USUÁRIO LOGADO, NÃO SERÁ POSSIVEL EDITA-LO...
if ($dadoChamado['status'] === 'FECHADO' || $dadoChamado['usuario'] != $_SESSION['usuario']) {
    header("Location: abrir_chamado.php");
    die();
}

// EXECUTA A EDIÇÃO DO CHAMADO...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $anexo = $_FILES['anexo'];
    $caminhoArquivo =  null;

    if(!empty($anexo['name'])) {

        $nome = $anexo['name'];
        $tmp_name = $anexo['tmp_name'];
    
        $extensao = pathinfo($nome, PATHINFO_EXTENSION);
        $novo_nome = uniqid() . '.' . $extensao;
        move_uploaded_file($tmp_name, "uploads/" . $novo_nome);

        $caminhoArquivo = "uploads/" . $novo_nome;
    }
    
    $editaChamado = new Chamado($pdo);
    $editaChamado->editaChamado(
        $_GET['id'],
        $_POST['titulo'],
        $_POST['departamento'],
        $_POST['categoria'],
        $_POST['prioridade'],
        $_POST['descricao'],
        $_POST['inclui_linha'],
        $_POST['inclui_aparelho'],
        $caminhoArquivo
    );

    // SE NÃO FOR ADICIONADO NEM UM ANEXO NA EDIÇÃO, O ANEXO PERMANECERÁ SENDO O JÁ ANEXADO...
    if ($_POST['anexo'] === '' || $_POST['anexo'] === null) {

        $_POST['anexo'] === $dadoChamado['anexo'];
    }

    header("Location: abrir_chamado.php?id=$dadoChamado[id]&chamado=atualizado");
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
                <section class="conteudo-center" name="cadastro-usuario">
                    <form method="post" class="form-labels-lado-a-lado" id="form-labels-lado-a-lado" autocomplete="off" enctype="multipart/form-data" multiple>
                        <header id="form-cabecalho">
                            <h1>Atualização de chamado</h1>
                            <i class="fa-solid fa-user-plus"></i>
                        </header>

                        <section class="form-secao-01" name="form-cadastro-usuario">

                            <h2>Atualize algum campo</h2>

                            <label for="titulo">Título do chamado<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-file-pen"></i>
                                    <input type="text" name="titulo" id="titulo" value="<?= htmlentities($dadoChamado['titulo']) ?>" placeholder="Insira o título do chamado">
                                </div>
                            </label>

                            <label for="departamento">Departamento<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-building-flag"></i>
                                    <select name="departamento" id="departamento">
                                        <option value="<?= htmlentities($dadoChamado['departamento']) ?>"><?= htmlentities($dadoChamado['departamento']) ?></option>
                                        <?php foreach ($listaUnidades as $unidade) : ?>
                                            <option value="<?= htmlentities($unidade['descricao']) ?>"><?= htmlentities($unidade['descricao']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </label>

                            <label for="categoria">Categoria<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-cube"></i>
                                    <select name="categoria" id="categoria">
                                        <option value="<?= htmlentities($dadoChamado['categoria']) ?>"><?= htmlentities($dadoChamado['categoria']) ?></option>
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
                                    <select name="prioridade" id="prioridade">
                                        <option value="<?= htmlentities($dadoChamado['prioridade']) ?>"><?= htmlentities($dadoChamado['prioridade']) ?></option>
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
                                    <select name="inclui_linha" id="inclui_linha">
                                        <option value="<?= htmlentities($dadoChamado['inclui_linha']) ?>"><?= htmlentities($dadoChamado['inclui_linha']) ?></option>
                                        <?php foreach ($listaLinhas as $linha): ?>
                                            <option value="<?= htmlentities($linha['nome']) . " - LINHA: " . htmlentities($linha['linha']) ?>"><?= htmlentities($linha['nome']) . " - LINHA: " . htmlentities($linha['linha']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </label>

                            <label for="inclui_aparelho">Incluir aparelho (opcional)
                                <div>
                                    <i class="fa-solid fa-mobile-screen-button"></i>
                                    <select name="inclui_aparelho" id="inclui_aparelho">
                                        <option value="<?= htmlentities($dadoChamado['inclui_aparelho']) ?>"><?= htmlentities($dadoChamado['inclui_aparelho']) ?></option>
                                        <?php foreach ($listaAparelhos as $aparelho): ?>
                                            <option value="<?= htmlentities($aparelho['nome']) . " - IMEI: " .  htmlentities($aparelho['imei_aparelho']) ?>"><?= htmlentities($aparelho['nome']) . " - IMEI: " . htmlentities($aparelho['imei_aparelho']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </label>

                            <label for="descricao" id="label-textarea">Descreva o chamado<span style="color: red;"> *</span>
                                <div>
                                    <textarea name="descricao" id="descricao"><?= htmlentities($dadoChamado['descricao']) ?></textarea>
                                </div>
                            </label>

                            <label id="label-textarea">
                                <a href="<?= htmlentities($dadoChamado['anexo']) ?>" target="_blank"><button type="button">Arquivo anexado</button></a>
                            </label>

                            <label for="anexo">Alterar anexo (o arquivo anexado será substituído)
                                <div>
                                    <input type="file" name="anexo" id="anexo" accept=".doc,.docx,.pdf,.xls,.xlsx,.jpg,.jpeg,.png">
                                </div>
                            </label>

                            <div>
                                <button type="submit">Atualizar</button>
                                <a href="<?= $_SERVER['HTTP_REFERER'] ?>"><button type="button" id="btn-cancelar">Cancelar</button></a>
                            </div>

                        </section>
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