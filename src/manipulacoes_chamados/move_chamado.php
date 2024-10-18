<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";


// EXECUTA A MOVIMENTAÇÃO DO CHAMADO...
if($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $moveChamado = new Chamado($pdo);
    $moveChamado->moveChamado(
        $_GET['id'],
        $_POST['departamento'],
    );

    $armazenaLog = new Logs($pdo);
    $armazenaLog->armazenaLog(
        'Chamados',
        $_SESSION['usuario'],
        'Moveu o chamado para o departamento "' . $_POST['departamento'] . '"',
        'Sucesso',
        $_GET['id']
    );
    
    header("Location: ../../visualiza_chamado.php?id=$_GET[id]&chamado=movido");
    die();
}