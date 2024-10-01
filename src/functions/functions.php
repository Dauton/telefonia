<?php

// EXIBE A DATA ATUAL
function exibeDataAtual()
{

    date_default_timezone_set("America/Sao_Paulo");
    $dataAtual = date("d/m/Y");
    return $dataAtual;

}

// FUNÇÕES PARA VALIDAR A SENHA NAS TELAS DE CRIAÇÃO DE USUÁRIO E RESET DE SENHA.
    // VALIDA A SENHA NO MOMENTO DO RESET DA SENHA DE UM USUÁRIO...
function validacaoResetSenha(PDO $pdo)
{

    $http_referer_erro_senha_curta = $_SERVER['HTTP_REFERER'] . "&verifica_senha=senha_curta";
    $http_referer_erro_letras_maiusculas = $_SERVER['HTTP_REFERER'] . "&verifica_senha=letras_maiusculas";
    $http_referer_erro_numeros = $_SERVER['HTTP_REFERER'] . "&verifica_senha=numeros";
    $http_referer_erro_desigual = $_SERVER['HTTP_REFERER'] . "&verifica_senha=desiguais";

    if(strlen($_POST['senha']) < 12) {
        header("Location: $http_referer_erro_senha_curta");
        die();

    } elseif(!preg_match('/(?=.*[a-z])(?=.*[A-Z])/', $_POST['senha'])) {
        header("Location: $http_referer_erro_letras_maiusculas");
        die();

    } elseif(!preg_match('/([0-1])/', $_POST['senha'])) {
        header("Location: $http_referer_erro_numeros");
        die();

    } elseif($_POST['senha'] != $_POST['repete_senha']) {
        header("Location: $http_referer_erro_desigual");
        die();
    }
}

    // VALIDA A SENHA NA CRIAÇÃO DE UM USUÁRIO...
function validacaoSenha(PDO $pdo)
{
    if(strlen($_POST['senha']) < 12) {
        header("Location: cadastrar_usuario.php?verifica_senha=senha_curta");
        die();

    } elseif(!preg_match('/(?=.*[a-z])(?=.*[A-Z])/', $_POST['senha'])) {
        header("Location: cadastrar_usuario.php?verifica_senha=letras_maiusculas");
        die();

    } elseif(!preg_match('/([0-1])/', $_POST['senha'])) {
        header("Location: cadastrar_usuario.php?verifica_senha=numeros");
        die();

    } elseif($_POST['senha'] != $_POST['repete_senha']) {
        header("Location: cadastrar_usuario.php?verifica_senha=desiguais");
        die();
    }
}

    // VALIDA A SENHA NO MODENTO DO RESET DA SENHA DO USUÁRIO LOGADO...
function validacaoMinhaSenha(PDO $pdo)
{
    if(strlen($_POST['senha']) < 12) {
        header("Location: minha_senha.php?verifica_senha=senha_curta");
        die();

    } elseif(!preg_match('/(?=.*[a-z])(?=.*[A-Z])/', $_POST['senha'])) {
        header("Location: minha_senha.php?verifica_senha=letras_maiusculas");
        die();

    } elseif(!preg_match('/([0-1])/', $_POST['senha'])) {
        header("Location: minha_senha.php?verifica_senha=numeros");
        die();

    } elseif($_POST['senha'] != $_POST['repete_senha']) {
        header("Location: minha_senha.php?verifica_senha=desiguais");
        die();
    }
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