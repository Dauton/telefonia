<<<<<<< HEAD
<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

// BUSCA O TÍTULO DO CHAMADO PARA ARMAZENAR O ID DO CHAMADO NO LOG...
$buscaIdChamado = new Chamado($pdo);
$dadoChamado = $buscaIdChamado->buscaIdChamado($_GET['id']);

// EXECUTA O ENVIO DA RESPOSTA...
if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $respondeChamado = new Chamado($pdo);
    $respondeChamado->respondeChamado(
        $_GET['id'],
        $_POST['descricao_resposta']
    );

    $armazenaLog = new Logs($pdo);
    $armazenaLog->armazenaLog(
        'Chamados',
        $_SESSION['usuario'],
        'Respondeu o chamado "' . $dadoChamado['titulo'] . '"',
        'Sucesso',
        $_GET['id']
    );

    header("Location: ../../visualiza_chamado.php?id=$_GET[id]&chamado=resposta_enviada");
    die();
}