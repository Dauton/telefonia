<?php

    require_once "../config/conexao_bd.php";
    require_once "../../vendor/autoload.php";

    apenasAdmin();

    // RECUSA A REQUISIÇÃO
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {

        $cancelaRequisicao = new Requisicao($pdo);
        $cancelaRequisicao->cancelaMinhaRequisicao($_POST['id'], $_POST['quantidade'], $_POST['descricao']);

        header("Location: ../../inicio.php?cancela_requisicao=requisicao_cancelada");
        die();
    }