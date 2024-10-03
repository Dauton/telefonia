<?php

    require_once "../config/conexao_bd.php";
    require_once "../../vendor/autoload.php";

    $registraLog = new Logs($pdo);
    $registraLog->registraLogAcesso($_SESSION['usuario'], 'Saiu do sistema realizando logout!');
    
    // REALIZA O LOG OUT DO USUÁRIO DESTRUINDO A SESSÃO...
    session_start();
    session_unset();
    session_destroy();

    header("Location: ../../index.php");
    die();