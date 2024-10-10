<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $respondeChamado = new Chamado($pdo);
    $respondeChamado->respondeChamado(
        $_POST['id'],
        $_POST['descricao_resposta']
    );

    header("Location: ../../visualiza_chamado.php?id=$_POST[id]&chamado=resposta_enviada");
    die();

}