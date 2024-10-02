<?php

    require_once "../config/conexao_bd.php";
    require_once "../../vendor/autoload.php";

    apenasAdmin();

    // ENTREGA A REQUISIÇÃO...
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {

        $usuario_baixa = $_SESSION['nome_usuario'];

        $entregaRequisicao = new Requisicao($pdo);
        $entregaRequisicao->entregaRequisicao($_POST['id'], $usuario_baixa, $_POST['data_baixa_historico']);

        header("Location: ../../gerenciar_requisicoes.php?entrega_requisicao=requisicao_entregue");
        die();
    }