<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

$buscaIdOpcao = new Opcoes($pdo);
$dadoOpcao = $buscaIdOpcao->buscaIdOpcao($_POST['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $excluiOpcao = new Opcoes($pdo);
    $excluiOpcao->excluiOpcao($_POST['id']);

    $armazenaLog = new Logs($pdo);
    $armazenaLog->armazenaLog(
        'Opções',
        $_SESSION['usuario'],
        'Excluiu a opção "' . $dadoOpcao['descricao'] . '" do tipo "' . $dadoOpcao['tipo'] . '"',
        'Sucesso',
        ''
    );

    header("Location: ../../cadastrar_opcoes.php?opcao=excluida");
    die();
}
