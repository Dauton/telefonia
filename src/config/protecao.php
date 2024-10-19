<?php

// CASO O USUÁRIO NÃO ESTEJA LOGADO, ELE NÃO CONSEGUIRÁ ACESSAR QUALQUER PÁGINA DENTRO DO SISTEMA
if ((!isset($_SESSION['usuario']) === true) && (!isset($_SESSION['senha']) === true)) {

    header("Location: index.php");
    die();
}

// ACESSO LIBERADO APENAS PARA TI SITES E INFRA IDL...
function liberacaoIDL()
{
    if($_SESSION['perfil'] !== 'TI SITES' && $_SESSION['perfil'] !== 'IFRAESTRUTURA IDL') {
        header("Location: ../inicio.php");
        die();
    }
}

// ACESSO LIBERADO APENAS PARA INFRA IDL...
function liberacaoInfraIDL()
{
    if($_SESSION['perfil'] !== 'INFRAESTRUTURA IDL') {
        header("Location: ../inicio.php");
        die();
    }
}

// SE FOR O PRIMEIRO ACESSO DESSE USUÁRIO, SERÁ PEDIDO PARA ALTERAR A SENHA
function senhaPrimeiroAcesso()
{
    if($_SESSION['senha_primeiro_acesso'] != "ALTERADA") {
        header("Location: primeiro_acesso.php");
        die();
    }
}
