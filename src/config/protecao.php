<?php

// CASO O USUÁRIO NÃO ESTEJA LOGADO, ELE NÃO CONSEGUIRÁ ACESSAR QUALQUER PÁGINA DENTRO DO SISTEMA
if ((!isset($_SESSION['usuario']) === true) && (!isset($_SESSION['senha']) === true)) {

    header("Location: index.php");
    die();
}


// FUNÇÃO DE LIBERAÇÃO DE ACESSO APENAS PARA ADMIN E MASTER
    // RESUMINDO: usuários com perfil de 'Requisitante' tem acesso apenas a tela inicial, abertura de requisição e reset de sua senha;
    // Para acesso completo, apenas usuários com perfil "Admin".


// FUNÇÃO DE LIBERAÇÃO DE ACESSO APENAS PARA ADMIN
function apenasAdmin()
{
    if ($_SESSION['perfil'] != "Admin") {
        header("Location: inicio.php");
        die();
    }
}

// FUNÇÃO DE BLOQUEIO CASO O USUÁRIO ESTEJA DESATIVADO
function usuarioDesativado()
{
    if($_SESSION['status'] != "Ativado") {

        header("Location: index.php?valida_login=usuario_desativado");
        die();

    }
}

// SE FOR O PRIMEIRO ACESSO DESSE USUÁRIO, SERÁ PEDIDO PARA ALTERAR A SENHA
function senhaPrimeiroAcesso()
{
    if($_SESSION['senha_primeiro_acesso'] != "Alterada") {

        header("Location: primeiro_acesso.php");
        die();

    }
}
