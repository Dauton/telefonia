<?php

    require_once "../config/conexao_bd.php";
    require_once "../../vendor/autoload.php";

    apenasAdmin();

    // RECUSA A REQUISIÇÃO
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {

        $usuario_baixa = $_SESSION['nome_usuario'];

        $cancelaRequisicao = new Requisicao($pdo);
        $cancelaRequisicao->recusaRequisicao($_POST['id'], $_POST['quantidade'], $_POST['descricao'], $usuario_baixa, $_POST['data_baixa_historico']);

        header("Location: ../../gerenciar_requisicoes.php?recusa_requisicao=requisicao_recusada");
        die();
    }