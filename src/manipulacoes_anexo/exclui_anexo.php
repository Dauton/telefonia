<?php

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

$buscaIdChamado = new Chamado($pdo);
$dadoChamado = $buscaIdChamado->buscaIdChamado($_GET['id']);

$remove_anexo = new Uploads($pdo);
$remove_anexo->removeAnexo(
    $_GET['id'],
    "../../" . $dadoChamado['anexo']
);

header("Location: ../../editar_chamado.php?id=$_GET[id]&chamado=anexo_removido");
die();