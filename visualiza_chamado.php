<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

senhaPrimeiroAcesso();

$chamados = new Chamado($pdo);
$exibeMeusChamados = $chamados->exibeMeusChamados();

$buscaIdChamado = new Chamado($pdo);
$dadoChamado = $buscaIdChamado->buscaIdChamado($_GET['id']);

$respostas = new Chamado($pdo);
$exibeRespostas = $respostas->exibeRespostas();

$historico = new Logs($pdo);
$historico_chamado = $historico->exibeHistoricoChamado($_GET['id']);

$unidade = new Opcoes($pdo);
$listaUnidades = $unidade->listaOpcoes('UNIDADE');

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
                    <h3><a href="inicio.php">INÍCIO</a> / <a href="gerenciar_chamados.php">GERENCIAR CHAMADOS / VISUALIZANDO CHAMADO</a></h3>
                </header>
                <section class="conteudo-center">

                    <h1>Dados do chamado</h1>

                    <table id="table-respostas">
                        <thead id="table-respostas-text-center">
                            <tr>
                                <td>ID chamado</td>
                                <td>Titulo</t>
                                <td>Departamento</td>
                                <td>Categoria</td>
                                <td>Linha inlcuída</td>
                                <td>Aparelho incluído</td>
                                <td>Prioridade</td>
                                <td>Usuário</td>
                                <td>Unidade</td>
                                <td>Data abertura</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody id="table-respostas-text-center">
                            <tr>
                                <td><?= htmlentities($dadoChamado['id']) ?></td>
                                <td><?= htmlentities($dadoChamado['titulo']) ?></td>
                                <td><?= htmlentities($dadoChamado['departamento']) ?></td>
                                <td><?= htmlentities($dadoChamado['categoria']) ?></td>
                                <td><?= htmlentities($dadoChamado['inclui_linha']) ?></td>
                                <td><?= htmlentities($dadoChamado['inclui_aparelho']) ?></td>
                                <td id="status">
                                    <p><?= htmlentities($dadoChamado['prioridade']) ?></p>
                                </td>
                                <td><?= htmlentities($dadoChamado['usuario']) ?></td>
                                <td><?= htmlentities($dadoChamado['unidade_usuario']) ?></td>
                                <td><?= htmlentities($dadoChamado['data_abertura']) ?></td>
                                <td id="status">
                                    <p><?= htmlentities($dadoChamado['status']) ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="11" id="table-textarea">
                                    <textarea readonly><?= htmlentities($dadoChamado['descricao']) ?></textarea>
                                    <?php if(!empty($dadoChamado['anexo'])) :?>
                                    <div>
                                        <a href="<?= htmlentities($dadoChamado['anexo']) ?>" target="_blank"><button type="button" title="Visualizar ou baixar anexo">Arquivo anexado</button></a>
                                    </div>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="11" id="table-textarea" style="text-align: left !important">
                                    <?php if ($dadoChamado['status'] === 'EM ABERTO'): ?>
                                        <button type='button' id='btn-green' title='Fechar chamado'>Fechar chamado</button>
                                        <button type='button' title='Mover chamado'>Mover chamado</button>
                                    <?php elseif ($dadoChamado['status'] === 'FECHADO'): ?>
                                        <form class='form-labels-lado-a-lado' id='form-labels-lado-a-lado' style="padding: 40px 0 0 0" autocomplete='off'>
                                            <header id='form-cabecalho'>
                                                <h1>Motivo de fechamento</h1>
                                                <div>
                                                    <span>Fechado por <b><?= htmlentities($dadoChamado['fechado_por']) ?></b></span>
                                                    <span><?= htmlentities($dadoChamado['data_fechamento']) ?></span>
                                                </div>
                                            </header>
                                            <textarea readonly><?= htmlentities($dadoChamado['motivo_fechamento']) ?></textarea>
                                        </form>
                                        <tr>
                                            <td colspan="11">
                                                <form method='post' action='src/manipulacoes_chamados/reabre_chamado.php?id=<?= $dadoChamado['id'] ?>'>
                                                    <button type='submit' id='btn-green' title='Reabrir chamado'>Reabrir chamado</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div id="box-confirmacao" title="Fechar chamado">

                        <header class="box-ajuda-cabecalho">
                            <h1>Confirmação</h1>
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </header>

                        <h2>Observações</h2>

                        <p>
                            Tem certeza que deseja fechar esse chamado?<br>
                            Você poderá reabri-lo.
                        </p>

                        <br>
                        <form method="post" action="src/manipulacoes_chamados/fecha_chamado.php" id="form-apenas-buttons">
                            <input type="hidden" name="id" value="<?= $dadoChamado['id'] ?>">

                            <label for="motivo_fechamento" #label-textarea>Descreva o motivo do fechamento<span style="color: red;">*</span>
                                <div>
                                    <textarea name="motivo_fechamento"></textarea>
                                </div>
                            </label>

                            <div id="box-confimarcao-btns">
                                <button type="submit" id="btn-blue">Fechar chamado</button>
                                <button type="button" id="btn-cancelar" title="Cancelar fechamento">Cancelar</button>
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
                            Selecione o departamento<br><br>
                        </p>

                        <form method="post" action="src/manipulacoes_chamados/move_chamado.php?id=<?= $dadoChamado['id'] ?>" id="form-apenas-buttons">
                            <label for="departamento">Departamentos<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-building-flag"></i>
                                    <select name="departamento">
                                        <option value="<?= htmlentities($dadoChamado['departamento']) ?>"><?= htmlentities($dadoChamado['departamento']) ?></option>
                                        <?php foreach($listaUnidades as $unidade) : ?>
                                            <option value="<?= htmlentities($unidade['descricao']) ?>"><?= htmlentities($unidade['descricao']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </label>

                            <div id="box-confimarcao-btns">
                                <button type="submit">Mover chamado</button>
                                <button type="button" id="btn-cancelar" title='Cancelar movimento'>Cancelar</button>
                            </div>

                        </form>
                    </div>

                    <?php foreach ($exibeRespostas as $respostas) : ?>

                        <br><h1>Respostas</h1>

                        <table id="table-respostas">
                            <thead>
                                <tr>
                                    <td id="thead-resposta">
                                        <i class="fa-solid fa-comments"></i>
                                        <span><b><?= $respostas['respondido_por'] ?></b></span>
                                        <span><?= $respostas['data_resposta'] ?></span>
                                            
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <form class="form-labels-lado-a-lado" id="form-labels-lado-a-lado" autocomplete="off">
                                            <label id="label-textarea">
                                                <div>
                                                    <textarea readonly><?= htmlentities($respostas['descricao_resposta']) ?></textarea>
                                                </div>
                                            </label>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <?php if($respostas['respondido_por'] === $_SESSION['usuario'] && $dadoChamado['status'] === 'EM ABERTO') : ?>
                                    <td>
                                        <div>
                                            <form method="post" action="src/manipulacoes_chamados/exclui_resposta.php">
                                                <input type="hidden" name="id" value="<?= $respostas['id'] ?>">
                                                <button type="submit" id="btn-red">Excluir resposta</button>
                                            </form>
                                            <a href="editar_resposta.php?id=<?= $respostas['id']?>"><button type="busston">Atualizar resposta</button></a>
                                        </div>
                                    </td>
                                    <?php endif ?>
                                </tr>
                            </tbody>
                        </table>
                    <?php endforeach ?>

                    <?php if ($dadoChamado['status'] === 'EM ABERTO') : ?>

                        <br><h1>Responder chamado</h1>
                        
                        <table id="table-respostas">
                            <thead>
                                <tr>
                                    <td id="thead-resposta">
                                        <i class="fa-solid fa-comment-dots"></i>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <form method="post" action="src/manipulacoes_chamados/envia_resposta.php?id=<?= $dadoChamado['id'] ?>" class="form-labels-lado-a-lado" id="form-labels-lado-a-lado" autocomplete="off">
                                            <label for="descricao_resposta" id="label-textarea">Responda o chamado<span style="color: red;"> *</span>
                                                <div>
                                                    <textarea name="descricao_resposta"></textarea>
                                                </div>
                                            </label>
                                            
                                            <tr>
                                                <td>
                                                    <button type="submit">Enviar resposta</but>
                                                </td>
                                            </tr>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php endif; ?>
                    <br>
                    <h1>Histórico do chamado</h1>
                    
                    <table>
                        <thead>
                            <tr>
                                <td>Usuário</td>
                                <td>Ação realizada</td>
                                <td>Data da ação</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($historico_chamado as $historico) : ?>
                            <tr>
                                <td><?= htmlentities($historico['usuario_log']) ?></td>
                                <td><?= htmlentities($historico['atividade_log']) ?></td>
                                <td><?= htmlentities($historico['data_log']) ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                </section>

                <?php
                // EXIBE O RODAPÉ...
                require_once "src/views/layout/rodape.php";
                ?>

            </article>
        </section>
    </main>

    <div class="btns-atalhos">
        <a href="gerenciar_chamados.php"><button id="btn-atalho" title="Gerenciar chamados">
                <i class="fa-solid fa-headset"></i>
            </button></a>
    </div>

    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>