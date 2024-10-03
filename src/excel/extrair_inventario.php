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
    <title>Excel Inventário</title>
    
    <head>

    <body>
        <?php
        $nome_arquivo = 'INVENTÁRIO_' . $_POST['nome_inventario'] . '.xls';

        $html = '';
        $html .= '<table border="1">';
        $html .= '<tr style="color: #ffffff; text-align: center; font-family: Calibri">';
        $html .= '<td style="background: #0088ff"><b>NOME DO INVENÁRIO</b></td>';
        $html .= '<td style="background: #0088ff"><b>CRIADO POR</b></td>';
        $html .= '<td style="background: #0088ff"><b>DATA DE INÍCIO</b></td>';
        $html .= '<td style="background: #0088ff"><b>DATA DE CONCLUSÃO</b></td>';
        $html .= '<td style="background: #0088ff"><b>DESCRIÇÃO PRODUTO</b></td>';
        $html .= '<td style="background: #0088ff"><b>UNIDADE DE  MEDIDA</b></td>';
        $html .= '<td style="background: #0088ff"><b>ESTOQUE</b></td>';
        $html .= '<td style="background: #0088ff"><b>STATUS DO PRODUTO</b></td>';
        $html .= '<td style="background: #0088ff"><b>INVENTARIADO POR</b></td>';
        $html .= '<td style="background: #0088ff"><b>STATUS DO INVENTÁRIO</b></td>';
        $html .= '</tr>';

        try {
            $result_tabela = $pdo->query("SELECT *, DATE_FORMAT(data_inicio, '%d/%m/%Y') AS data_inicio FROM tb_inventarios WHERE nome_inventario = '$_POST[nome_inventario]'");
            while ($linha_tabela = $result_tabela->fetch(PDO::FETCH_ASSOC)) {
                $html .= '<tr>';
                $html .= '<td>' . $linha_tabela["nome_inventario"] . '</td>';
                $html .= '<td>' . $linha_tabela["criado_por"] . '</td>';
                $html .= '<td>' . $linha_tabela["data_inicio"] . '</td>';
                $html .= '<td>' . $linha_tabela["data_final"] . '</td>';
                $html .= '<td>' . $linha_tabela["descricao"] . '</td>';
                $html .= '<td>' . $linha_tabela["unidade_medida"] . '</td>';
                $html .= '<td>' . $linha_tabela["estoque"] . '</td>';
                $html .= '<td>' . $linha_tabela["status_inv_produto"] . '</td>';
                $html .= '<td>' . $linha_tabela["produto_inv_por"] . '</td>';
                $html .= '<td>' . $linha_tabela["status_inventario"] . '</td>';
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