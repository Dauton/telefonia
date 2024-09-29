<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

apenasAdmin();

// EXCLUI O USUÁRIO SELECIONADO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $excluiUsuario = new Usuario($pdo);
    $excluiUsuario->excluiUsuario($_POST['id_usuario']);

    // REGISTRA O LOG DE EXCLUSÃO DE USUÁRIO
    $evento = "Excluiu o usuário \"$_POST[usuario]\"";
    $regitraLogUsuario = new Logs($pdo);
    $regitraLogUsuario->registraLogUsuario("$evento");

    header("Location: ../../gerenciar_usuarios.php?exclui_usuario=excluido_com_sucesso");
    die();
}
