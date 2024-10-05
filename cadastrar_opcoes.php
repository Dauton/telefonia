<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cadastraDispositivo = new Opcoes($pdo);
    $cadastraDispositivo->cadastraOpcao(
        $_POST['tipo'],
        $_POST['descricao'],
    );

    header("Location: cadastrar_opcoes.php?opcao=cadastrada");
    die();
}

// LISTA TODOS OS TIPOS DISPONÍVEIS...
$tipo = new Opcoes($pdo);
$listaTipos = $tipo->listaTiposOpcoes();

$marca = new Opcoes($pdo);
$listaMarcas = $marca->listaOpcoes('MARCA');

$modelo = new Opcoes($pdo);
$listaModelos = $modelo->listaOpcoes('MODELO');

$unidade = new Opcoes($pdo);
$listaUnidade = $unidade->listaOpcoes('UNIDADE');

$centro_custo = new Opcoes($pdo);
$listaCentroCustos = $centro_custo->listaOpcoes('CENTRO DE CUSTOS');

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
                            <h1>Cadastrar e gerenciar opções</h1>
                            <i class="fa-solid fa-gears"></i>
                        </header>


                        <section style="display: flex;">
                            <label for="tipo">Tipo da opção<span style="color: red;"> *</span>
                                <div>
                                    <i class="fa-solid fa-gears"></i>
                                    <select id="tipo" name="tipo">
                                        <option value="">Selecione</option>
                                        <?php foreach ($listaTipos as $tipo) : ?>
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
                        </section>

                        <section style="display: flex;">
                            <h2>Marcas de aparelho</h2>
                            <table>
                                <thead>
                                    <tr>
                                        <td>Tipo</td>
                                        <td>Descrição</td>
                                        <td>Ação</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listaMarcas as $marca) : ?>
                                        <tr>
                                            <td><?= htmlentities($marca['tipo']) ?></td>
                                            <td><?= htmlentities($marca['descricao']) ?></td>
                                            <td id="status">
                                                <a href="editar_opcao.php?id=<?= $marca['id'] ?>"><i class="fa-solid fa-square-pen"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </section>

                        <section style="display: flex;">
                            <h2>Modelos de aparelho</h2>
                            <table>
                                <thead>
                                    <tr>
                                        <td>Tipo</td>
                                        <td>Descrição</td>
                                        <td>Ação</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listaModelos as $modelo) : ?>
                                        <tr>
                                            <td><?= htmlentities($modelo['tipo']) ?></td>
                                            <td><?= htmlentities($modelo['descricao']) ?></td>
                                            <td id="status">
                                                <a href="editar_opcao.php?id=<?= $modelo['id'] ?>"><i class="fa-solid fa-square-pen"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </section>

                        <section style="display: flex;">
                            <h2>Unidades</h2>
                            <table>
                                <thead>
                                    <tr>
                                        <td>Tipo</td>
                                        <td>Descrição</td>
                                        <td>Ação</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listaUnidade as $unidade) : ?>
                                        <tr>
                                            <td><?= htmlentities($unidade['tipo']) ?></td>
                                            <td><?= htmlentities($unidade['descricao']) ?></td>
                                            <td id="status">
                                                <a href="editar_opcao.php?id=<?= $unidade['id'] ?>"><i class="fa-solid fa-square-pen"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </section>

                        <section style="display: flex;">
                            <h2>Centros de custos</h2>
                            <table>
                                <thead>
                                    <tr>
                                        <td>Tipo</td>
                                        <td>Descrição</td>
                                        <td>Ação</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listaCentroCustos as $centro_custo) : ?>
                                        <tr>
                                            <td><?= htmlentities($centro_custo['tipo']) ?></td>
                                            <td><?= htmlentities($centro_custo['descricao']) ?></td>
                                            <td id="status">
                                                <a href="editar_opcao.php?id=<?= $centro_custo['id'] ?>"><i class="fa-solid fa-square-pen"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
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
                    <h1>Dúvidas</h1>
                    <i class="fa-solid fa-circle-question"></i>
                </header>
                <p>
                    Caso, no momento do cadastro ou edição de um dispositivo, não exista a opção desejada em um campo de seleção, você poderá cadastrá-la aqui.<br><br>
                    No cadastro de dispositivos, existem quatro campos que podem não conter a opção desejada:<br><br>
                    <b> • Marca do aparelho;</b><br>
                    <b> • Modelo do aparelho;</b><br>
                    <b> • Unidade;</b><br>
                    <b> • Centro de custos.</b><br><br>
                    O campo "Unidade" também está presente no cadastro e edição de usuários.
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