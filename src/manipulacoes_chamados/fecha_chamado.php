<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $fechaChamado = new Chamado($pdo);
    $fechaChamado->fechaChamado(
        $_POST['id'],
        $_POST['motivo_fechamento']
    );

    header("Location: ../../abrir_chamado.php?chamado=fechado");
    die();
}