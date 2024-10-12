<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $excluiResposta = new Chamado($pdo);
    $excluiResposta->excluiResposta($_POST['id']);
    
    header("Location: $_SERVER[HTTP_REFERER]&chamado=resposta_excluida");
    die();

}