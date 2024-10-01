<?php

    global $pdo;
    
    require_once "../config/conexao_bd.php";
    require_once "../../vendor/autoload.php";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Excel Historico de Requisições</title>
    
    <head>

    <body>
        <?php
        $nome_arquivo = 'MEU_HISTORICO_DE_REQUISIÇÕES.xls';

        $html = '';
        $html .= '<table border="1">';
        $html .= '<tr style="color: #ffffff; text-align: center; font-family: Calibri">';
        $html .= '<td style="background: #0088ff"><b>Nº REQUISIÇÃO</b></td>';
        $html .= '<td style="background: #0088ff"><b>DESCRIÇÃO</b></td>';
        $html .= '<td style="background: #0088ff"><b>UNIDADE DE MEDIDA</b></td>';
        $html .= '<td style="background: #0088ff"><b>QUANTIDADE</b></td>';
        $html .= '<td style="background: #0088ff"><b>SOLICITANTE</b></td>';
        $html .= '<td style="background: #0088ff"><b>DATA</b></td>';
        $html .= '<td style="background: #0088ff"><b>STATUS</b></td>';
        $html .= '</tr>';

        try {
            $id_usuario = $_SESSION['id_usuario'];
            $result_tabela = $pdo->query("SELECT * FROM tb_requisicoes_historico WHERE id_solicitante_historico = '$id_usuario' ORDER BY id_historico DESC");

            while ($linha_tabela = $result_tabela->fetch(PDO::FETCH_ASSOC)) {
                $html .= '<tr>';
                $html .= '<td>' . $linha_tabela["id_historico"] . '</td>';
                $html .= '<td>' . $linha_tabela["descricao_historico"] . '</td>';
                $html .= '<td>' . $linha_tabela["unidade_medida_historico"] . '</td>';
                $html .= '<td>' . $linha_tabela["quantidade_historico"] . '</td>';
                $html .= '<td>' . $linha_tabela["solicitante_historico"] . '</td>';
                $html .= '<td>' . $linha_tabela["data_requisicao_historico"] . '</td>';
                $html .= '<td>' . $linha_tabela["status_historico"] . '</td>';
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
            exit;
        } catch (PDOException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        }
        ?>

    </body>

</html>