<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";


$buscaIdChamado = new Chamado($pdo);
$dadoChamado = $buscaIdChamado->buscaIdChamado($_GET['id']);

// EXECUTA A REABERTURA DO CHAMADO...
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $reabreChamado = new Chamado($pdo);
    $reabreChamado->reabreChamado(
        $_GET['id']
    );

    $armazenaLog = new Logs($pdo);
    $armazenaLog->armazenaLog(
        'Chamados',
        $_SESSION['usuario'],
        'Reabriu o chamado "' . $dadoChamado['titulo'] . '"',
        'Sucesso',
        $_GET['id']
    );

    header("Location: ../../visualiza_chamado.php?id=$_GET[id]&chamado=reaberto");
    die();
}