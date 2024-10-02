<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

$recuperaStatus = new Inventario($pdo);
$status = $recuperaStatus->recuperaStatusProduto();

$buscNomeInventario = new Inventario($pdo);
$inventario = $buscNomeInventario->buscaNomeInventario($_GET['nome_inventario']);

if($status) {
    header("Location: ../../inventario.php?nome_inventario=$_GET[nome_inventario]&inventario=inventario_nao_finalizado");
    die();

} else {
    $finalizaInventario = new Inventario($pdo);
    $finalizaInventario->finalizaInventario($_GET['nome_inventario']);

    header("Location: ../../painel_inventario.php?inventario=inventario_finalizado");
    die();
}