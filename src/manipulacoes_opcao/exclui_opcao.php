<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $excluiOpcao = new Opcoes($pdo);
    $excluiOpcao->excluiOpcao($_POST['id']);

    header("Location: ../../cadastrar_opcoes.php?opcao=excluida");
    die();
}
