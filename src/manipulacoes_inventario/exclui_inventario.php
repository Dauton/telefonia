<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

$excluiInventario = new Inventario($pdo);
$excluiInventario->excluiInventario($_POST['nome_inventario']);

header("Location: ../../painel_inventario.php?inventario=inventario_excluido");
die();