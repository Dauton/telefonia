<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";


// BUSCA O ID DO CHAMADO DA RESPOSTA PARA REDIRECIONAMENTO A PÁGINA DO CHAMADO NO CABECALHO HTTP...
$buscaIdResposta = new Chamado($pdo);
$resposta = $buscaIdResposta->buscaIdResposta(
    "$_POST[id]"
);


// EXECUTA A EXCLUSÃO DA RESPOSTA
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $excluiResposta = new Chamado($pdo);
    $excluiResposta->excluiResposta($_POST['id']);
    
    header("Location: ../../visualiza_chamado.php?id=$resposta[id_chamado]&chamado=resposta_excluida");
    die();

}