<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";


// EXECUTA O FECHAMAENTO DO CHAMADO...
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $fechaChamado = new Chamado($pdo);
    $fechaChamado->fechaChamado(
        $_POST['id'],
        $_POST['motivo_fechamento']
    );

    header("Location: ../../visualiza_chamado.php?id=$_POST[id]&chamado=fechado");
    die();
}