<?php

// EXIBE A DATA ATUAL
function exibeDataAtual()
{

    date_default_timezone_set("America/Sao_Paulo");
    $dataAtual = date("d-m-Y");
    return $dataAtual;

}


function validacaoSenhaPrimeiroAcesso(PDO $pdo)
{
    if(strlen($_POST['senha']) < 12) {
        header("Location: primeiro_acesso.php?verifica_senha=senha_curta");
        die();

    } elseif(!preg_match('/(?=.*[a-z])(?=.*[A-Z])/', $_POST['senha'])) {
        header("Location: primeiro_acesso.php?verifica_senha=letras_maiusculas");
        die();

    } elseif(!preg_match('/([0-1])/', $_POST['senha'])) {
        header("Location: primeiro_acesso.php?verifica_senha=numeros");
        die();

    } elseif($_POST['senha'] != $_POST['repete_senha']) {
        header("Location: primeiro_acesso.php?verifica_senha=desiguais");
        die();
    }
}