<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

apenasAdmin();

// EXCLUI O USUÁRIO SELECIONADO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $excluiUsuario = new Usuario($pdo);
    $excluiUsuario->excluiUsuario($_POST['id_usuario']);

    header("Location: ../../gerenciar_usuarios.php?usuario=excluido_com_sucesso");
    die();
}
