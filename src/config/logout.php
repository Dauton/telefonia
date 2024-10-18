<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

// ARMAZENA O LOGOUT EM LOG...
$armazenaLog = new Logs($pdo);
$armazenaLog->armazenaLog(
    "Acesso",
    "$_SESSION[usuario]",
    "Logout do sistema",
    "Sucesso",
    ''
);

// REALIZA O LOGOUT DO USUÁRIO DESTRUINDO A SESSÃO...
session_start();    
session_destroy();

header("Location: ../../index.php");
die();