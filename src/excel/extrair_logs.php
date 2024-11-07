<?php

global $pdo;

require_once "../config/conexao_bd.php";
require_once "../../vendor/autoload.php";

liberacaoInfraIDL();
senhaPrimeiroAcesso();

if ($_SERVER['QUERY_STRING'] === 'acessos') {

    $sql = "SELECT *, DATE_FORMAT(data_log, '%W, %d/%m/%Y às %m:%i') AS data_log FROM tb_logs WHERE area_log = 'Acesso'";
    $nome_arquivo = 'LOGS_ACESSOS.xls';
} elseif ($_SERVER['QUERY_STRING'] === 'telefonia') {

    $sql = "SELECT *, DATE_FORMAT(data_log, '%W, %d/%m/%Y às %m:%i') AS data_log FROM tb_logs WHERE area_log = 'Telefonia'";
    $nome_arquivo = 'LOGS_TELEFONIA.xls';
} elseif ($_SERVER['QUERY_STRING'] === 'opcoes') {

    $sql = "SELECT *, DATE_FORMAT(data_log, '%W, %d/%m/%Y às %m:%i') AS data_log FROM tb_logs WHERE area_log = 'Opções'";
    $nome_arquivo = 'LOGS_OPCOES.xls';
} elseif ($_SERVER['QUERY_STRING'] === 'usuarios') {

    $sql = "SELECT *, DATE_FORMAT(data_log, '%W, %d/%m/%Y às %m:%i') AS data_log FROM tb_logs WHERE area_log = 'Usuários'";
    $nome_arquivo = 'LOGS_USUARIOS.xls';
} elseif ($_SERVER['QUERY_STRING'] === 'aparelhos') {

    $sql = "SELECT * FROM tb_dispositivos WHERE marca_aparelho != '' AND marca_aparelho != null";
    $nome_arquivo = 'APARELHOS_CADASTRADOS.xls';
} else {
    header('Location: inicio.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Excel Logs</title>

    <head>

    <body>
        <?php

        $html = '';
        $html .= '<table border="1">';
        $html .= '<tr style="color: #ffffff; text-align: center; font-family: Calibri">';
        $html .= '<td style="background: #00384b"><b>ID registro</b></td>';
        $html .= '<td style="background: #00384b"><b>Usuário</b></td>';
        $html .= '<td style="background: #00384b"><b>Atividade</b></td>';
        $html .= '<td style="background: #00384b"><b>Resultado da atividade</b></td>';
        $html .= '<td style="background: #00384b"><b>Data da atividade</b></td>';
        $html .= '</tr>';


        $result_tabela = $pdo->query($sql);

        while ($linha_tabela = $result_tabela->fetch(PDO::FETCH_ASSOC)) {
            $html .= '<tr>';
            $html .= '<td>' . $linha_tabela["id"] . '</td>';
            $html .= '<td>' . $linha_tabela["usuario_log"] . '</td>';
            $html .= '<td>' . $linha_tabela["atividade_log"] . '</td>';
            $html .= '<td>' . $linha_tabela["result_atividade_log"] . '</td>';
            $html .= '<td>' . $linha_tabela["data_log"] . '</td>';
            $html .= '</tr>';
        }

        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$nome_arquivo}\"");
        header("Content-Description: PHP Generated Data");

        echo $html;
        ?>

    </body>

</html>