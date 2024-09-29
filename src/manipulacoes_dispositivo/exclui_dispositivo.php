<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $excluiDispositivo = new Telefonia($pdo);
    $excluiDispositivo->excluiDispositivo($_POST['id']);

    header("Location: ../../consulta_dispositivos.php?dispositivo=excluido");
    die();
}
