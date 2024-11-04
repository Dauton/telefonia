<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

liberacaoIDL();

// BUSCA O ID DO DISPOSITIVO PARA ARMAZENAR OS DADOS DO DISPOSITIVOS NO LOG...
$buscaIdDispositivo = new Telefonia($pdo);
$dadoDispositivo = $buscaIdDispositivo->buscaIdDispositivo($_POST['id']);

// EXCLUI O DISPOSITIVO..
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $excluiDispositivo = new Telefonia($pdo);
    $excluiDispositivo->excluiDispositivo($_POST['id']);

    $armazenaLog = new Logs($pdo);
    $armazenaLog->armazenaLog(
        'Telefonia',
        $_SESSION['usuario'],
        'Excluiu o aparelho de IMEI "' . $dadoDispositivo['imei_aparelho'] . '" e a linha "' .  $dadoDispositivo['linha'] . '" para o usuário "' . $dadoDispositivo['nome'] . '"',
        'Sucesso',
        ''
    );

    header("Location: ../../consulta_dispositivos.php?dispositivo=excluido");
    die();
}
