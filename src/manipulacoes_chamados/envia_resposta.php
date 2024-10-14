<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";


// EXECUTA O ENVIO DA RESPOSTA...
if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $respondeChamado = new Chamado($pdo);
    $respondeChamado->respondeChamado(
        $_GET['id'],
        $_POST['descricao_resposta']
    );

    header("Location: ../../visualiza_chamado.php?id=$_GET[id]&chamado=resposta_enviada");
    die();

}