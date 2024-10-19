<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

// BUSCA O TÍTULO DO CHAMADO PARA ARMAZENAR O ID DO CHAMADO NO LOG...
$buscaIdChamado = new Chamado($pdo);
$dadoChamado = $buscaIdChamado->buscaIdChamado($_POST['id']);

// EXECUTA O FECHAMAENTO DO CHAMADO...
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $fechaChamado = new Chamado($pdo);
    $fechaChamado->fechaChamado(
        $_POST['id'],
        $_POST['motivo_fechamento']
    );

    $armazenaLog = new Logs($pdo);
    $armazenaLog->armazenaLog(
        'Chamados',
        $_SESSION['usuario'],
        'Fechou o chamado "' . $dadoChamado['titulo'] . '"',
        'Sucesso',
        $_POST['id']
    );

    header("Location: ../../visualiza_chamado.php?id=$_POST[id]&chamado=fechado");
    die();
}