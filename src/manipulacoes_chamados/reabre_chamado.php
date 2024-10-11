<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $reabreChamado = new Chamado($pdo);
    $reabreChamado->reabreChamado(
        $_GET['id']
    );

    header("Location: ../../visualiza_chamado.php?id=$_GET[id]&chamado=reaberto");
    die();
}