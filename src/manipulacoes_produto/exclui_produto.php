<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

apenasAdmin();

// EXCLUI O PRODUTO E ARMAZENA ATIVIDADE EM LOG...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // EXLCUI O USUÁRIO...
    $excluiProduto = new Produtos($pdo);
    $excluiProduto->excluiProduto($_POST['id']);

    // ARMAZENA A EXCLUSAO EM LOG...
    $atividade = "Excluiu o produto \"$_POST[descricao]\"";
    $registraLog = new Logs($pdo);
    $registraLog->registraLogProduto($atividade);

    header("Location: ../../controle_estoque.php?exclui_produto=excluido_com_sucesso");
    die();
}
