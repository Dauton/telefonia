<?php

    global $pdo;
    
    require_once "../config/conexao_bd.php";
    require_once "../../vendor/autoload.php";

    apenasAdmin();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Excel Historico de Requisições</title>
    
    <head>

    <body>
        <?php
        $nome_arquivo = 'ESTOQUE_ATUAL.xls';

        $html = '';
        $html .= '<table border="1">';
        $html .= '<tr style="color: #ffffff; text-align: center; font-family: Calibri">';
        $html .= '<td style="background: #0088ff"><b>DESCRIÇÃO</b></td>';
        $html .= '<td style="background: #0088ff"><b>UNIDADE DE MEDIDA</b></td>';
        $html .= '<td style="background: #0088ff"><b>EM ESTOQUE</b></td>';
        $html .= '<td style="background: #0088ff"><b>CONSUMO DIÁRIO</b></td>';
        $html .= '<td style="background: #0088ff"><b>PRAZO DE ENTREGA</b></td>';
        $html .= '<td style="background: #0088ff"><b>PRAZO DE APROVAÇÃO DA OC</b></td>';
        $html .= '<td style="background: #0088ff"><b>ESTOQUE MÍNIMO</b></td>';
        $html .= '<td style="background: #0088ff"><b>CATEGORIA</b></td>';
        $html .= '<td style="background: #0088ff"><b>ÚLTIMA MODIFICAÇÃO</b></td>';
        $html .= '</tr>';

        try {
            $result_tabela = $pdo->query("SELECT * FROM tb_produtos");

            while ($linha_tabela = $result_tabela->fetch(PDO::FETCH_ASSOC)) {
                $html .= '<tr>';
                $html .= '<td>' . $linha_tabela["descricao"] . '</td>';
                $html .= '<td>' . $linha_tabela["unidade_medida"] . '</td>';
                $html .= '<td>' . $linha_tabela["estoque"] . '</td>';
                $html .= '<td>' . $linha_tabela["consumo_diario"] . '</td>';
                $html .= '<td>' . $linha_tabela["prazo_entrega"] . '</td>';
                $html .= '<td>' . $linha_tabela["aprovacao_oc"] . '</td>';
                $html .= '<td>' . $linha_tabela["estoque_minimo"] . '</td>';
                $html .= '<td>' . $linha_tabela["categoria"] . '</td>';
                $html .= '<td>' . $linha_tabela["ultima_modificacao"] . '</td>';
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