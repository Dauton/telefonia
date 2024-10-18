<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

apenasAdmin();

// BUSCA ID DO USUÁRIO PARA ARMAZENAR OS DADOS DO USUÁRIO NO LOG...

$buscaIdUsuario = new Usuario($pdo);
$dadoUsuario = $buscaIdUsuario->buscaIdUsuario($_POST['id']);

// EXCLUI O USUÁRIO SELECIONADO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $excluiUsuario = new Usuario($pdo);
    $excluiUsuario->excluiUsuario($_POST['id_usuario']);

    $armazenaLog = new Logs($pdo);
    $armazenaLog->armazenaLog(
        'Usuarios',
        $_SESSION['usuario  '],
        'Excluiu o usuário "' . $dadoUsuario['usuario'] . '" de nome "' . $dadoUsuario['nome'] . '"',
        'Sucesso',
        ''
    );

    header("Location: ../../gerenciar_usuarios.php?usuario=excluido_com_sucesso");
    die();
}
