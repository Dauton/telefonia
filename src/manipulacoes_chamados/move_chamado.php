<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $moveChamado = new Chamado($pdo);
    $moveChamado->moveChamado(
        $_GET['id'],
        $_POST['departamento'],
    );
    
    header("Location: ../../visualiza_chamado.php?id=$_GET[id]&chamado=movido");
    die();
}