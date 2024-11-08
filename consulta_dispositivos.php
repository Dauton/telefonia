<?php

require_once "src/config/conexao_bd.php";
require_once "vendor/autoload.php";

senhaPrimeiroAcesso();

if(empty($_SERVER['QUERY_STRING']) || $_SERVER['QUERY_STRING'] === 'busca=' || $_SERVER['QUERY_STRING'] === 'dispositivo=atualizado' || $_SERVER['QUERY_STRING'] === 'dispositivo=cadastrado' || $_SERVER['QUERY_STRING'] === 'dispositivo=excluido') {

    $titulo_tabela_filtrada = "Dispositivos cadastrados";
    $caminho_extracao = "extrair_tudo";

    $dispositivo = new Telefonia($pdo);
    $exibeDispositivos = $dispositivo->exibeDispositivos();
}
elseif (($_SERVER['QUERY_STRING'] ?? '') === 'linhas') {

    $titulo_tabela_filtrada = "Linhas cadastradas";
    $caminho_extracao = "linhas";

    $dispositivo = new Telefonia($pdo);
    $exibeDispositivos = $dispositivo->exibeLinhas();
    
} elseif(($_SERVER['QUERY_STRING'] ?? '') === 'aparelhos') {

    $titulo_tabela_filtrada = "Aparelhos cadastrados";
    $caminho_extracao = "aparelhos";
    
    $dispositivo = new Telefonia($pdo);
    $exibeDispositivos = $dispositivo->exibeAparelhos();

} elseif(($_SERVER['QUERY_STRING'] ?? '') === 'mdm') {

    $titulo_tabela_filtrada = "Aparelhos com MDM";
    $caminho_extracao = "mdm";

    $dispositivo = new Telefonia($pdo);
    $exibeDispositivos = $dispositivo->exibeComMDM();

} elseif(($_SERVER['QUERY_STRING'] ?? '') === 'minha_unidade') {

    $titulo_tabela_filtrada = "Aparelhos da minha unidade";
    $caminho_extracao = "minha_unidade";

    $dispositivo = new Telefonia($pdo);
    $exibeDispositivos = $dispositivo->exibeDispositivosMinhaUnidade();

} elseif(($_SERVER['QUERY_STRING'] ?? '') !== 'mdm' && ($_SERVER['QUERY_STRING'] ?? '') !== 'linha' && ($_SERVER['QUERY_STRING'] ?? '') !== 'aparelho' && ($_SERVER['QUERY_STRING'] ?? '') !== '') {
    
    $titulo_tabela_filtrada = 'Resultado da busca';
    $caminho_extracao = "extrair_tudo";

    $dispositivo = new Telefonia($pdo);
    $exibeDispositivos = $dispositivo->buscaDispositivo($_GET['busca']);

}


$mdm = new Telefonia($pdo);
$totalMDM = $mdm->contagemMDM();

$linha = new Telefonia($pdo);
$totalLinhas = $linha->contagemLinhas();

$aparelho = new Telefonia($pdo);
$totalAparelhos = $aparelho->contagemAparelhos();

$dispositivos = new Telefonia($pdo);
$totalDispositivos = $dispositivos->contagemDispositivos();

$dispositivos = new Telefonia($pdo);
$totalMinhaUnidade = $dispositivos->contagemMinhaUnidade();


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
                    <h3><a href="inicio.php">INÍCIO</a> / CONSULTA DE DISPOSITIVOS</h3>
                </header>
                <section class="conteudo-center">
                    <article class="conteudo-center-boxs">
                        <div class="conteudo-center-box-01">
                            <h1>Alguns atalhos e informações</h1>

                            <?php if($_SESSION['perfil'] === 'INFRAESTRUTURA IDL' || $_SESSION['perfil'] === 'TI SITES') : ?>
                                <a href="cadastrar_dispositivo.php">
                                    <div>
                                        <div id="box-infos-amarela">
                                            <span>
                                                <h4>CADASTRAR DISPOSITIVO</h4>
                                            </span>
                                            <h3>Cadastrar</h3>
                                            <i class="fa-solid fa-square-plus"></i>
                                            <p class="texto-filtro">Clique para abrir</p>
                                        </div>
                                    </div>
                                </a>
                            <?php endif ?>
                            <a href="consulta_dispositivos.php?aparelhos">
                                <div>
                                    <div id="box-infos-azul">
                                        <span>
                                            <h4>APARELHOS</h4>
                                        </span>
                                        <h3><?= $totalAparelhos ?> aparelho(os)</h3>
                                        <i class="fa-solid fa-mobile-screen"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                            <a href="consulta_dispositivos.php?linhas">
                                <div>
                                    <div id="box-infos-verde">
                                        <span>
                                            <h4>LINHAS</h4>
                                        </span>
                                        <h3><?= $totalLinhas ?> linha(as)</h3>
                                        <i class="fa-solid fa-sim-card"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                            <a href="consulta_dispositivos.php?mdm">
                                <div>
                                    <div id="box-infos-roxa">
                                        <span>
                                            <h4>APARELHOS COM MDM</h4>
                                        </span>
                                        <h3><?= $totalMDM; ?> aparelho(os) com MDM</h3>
                                        <i class="fa-solid fa-shield-halved"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                            <a href="consulta_dispositivos.php?minha_unidade">
                                <div>
                                    <div id="box-infos-cinza">
                                        <span>
                                            <h4>MINHA UNIDADE</h4>
                                        </span>
                                        <h3><?= $totalMinhaUnidade; ?> dispositivo(os)</h3>
                                        <i class="fa-solid fa-map-location-dot"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                            <a href="consulta_dispositivos.php">
                                <div>
                                    <div id="box-infos-vermelha">
                                        <span>
                                            <h4>GERAL</h4>
                                        </span>
                                        <h3><?= $totalDispositivos; ?> dispositivo(os)</h3>
                                        <i class="fa-solid fa-globe"></i>
                                        <p class="texto-filtro">Clique para filtrar</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div>
                            <form method="get" action="consulta_dispositivos.php">
                                <header id="form-cabecalho">
                                    <h1>Consulta de dispositivo</h1>
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </header>
                                <h2>Buscar dispositivo</h2>
                                <label for="busca">Buscar
                                    <div>
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <input type="search" name="busca" id="busca" placeholder="Digite alguma informação do dispositivo">
                                    </div>
                                </label>
                                <button type="submit">Buscar</button>
                            </form>
                            
                        </div>
                        <div>
                            
                            <h1><?= $titulo_tabela_filtrada ?>
                            <h6>Total encontrado: <?= count($exibeDispositivos) ?></h6>

                            <table>
                                <thead>
                                    <tr>
                                        <td>Nome usuário</td>
                                        <td>Linha</td>
                                        <td>Status da linha</td>
                                        <td>Tipo do aparelho</td>
                                        <td>Modelo do aparelho</td>
                                        <td>IMEI aparelho</td>
                                        <td>MDM</td>
                                        <td>Unidade</td>
                                        <td>Centro de custos</td>
                                        <td>Ponto focal</td>
                                        <td>Visualizar</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($exibeDispositivos) > 0): ?>
                                        <?php foreach($exibeDispositivos as $dispositivo): ?>
                                            <tr>
                                                <td><?= htmlentities($dispositivo['nome']) ?></td>
                                                <td><?= htmlentities($dispositivo['linha']) ?></td>
                                                <td id="Status"><p><?= htmlentities($dispositivo['status']) ?></p></td>
                                                <td><?= htmlentities($dispositivo['tipo_aparelho']) ?></td>
                                                <td><?= htmlentities($dispositivo['modelo_aparelho']) ?></td>
                                                <td><?= htmlentities($dispositivo['imei_aparelho']) ?></td>
                                                <td><?= htmlentities($dispositivo['gestao_mdm']) ?></td>
                                                <td><?= htmlentities($dispositivo['unidade']) ?></td>
                                                <td><?= htmlentities($dispositivo['centro_custo']) ?></td>
                                                <td><?= htmlentities($dispositivo['ponto_focal']) ?></td>
                                                <td id="status">
                                                    <a href="visualiza_dispositivo.php?id=<?= $dispositivo['id'] ?>"><i class="fa-solid fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="11"><p id="nenhum_resultado_encontrado">Nenhum resultado encontrado para o filtro ou valor informado.</p></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>

                            </table>
                            <p>Não há mais dados a serem exibidos</p>
                        </div>

                    </article>
                </section>

                <?php
                // EXIBE O RODAPÉ...
                require_once "src/views/layout/rodape.php";
                ?>

            </article>
        </section>
        
    </main>

    <div class="btns-atalhos">
        <a href="src/excel/extrair_telefonia.php?<?= $caminho_extracao ?>"><button id="btn-atalho" title="Extrair para Excel">
                <img src="img/logo-excel.png">
            </button></a>
    </div>

    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/toastr.js"></script>

</body>

</html>