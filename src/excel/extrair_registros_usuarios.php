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
    <title>Excel Registros de acessos</title>
    
    <head>

    <body>
        <?php
        $nome_arquivo = 'REGISTROS_USUARIOS.xls';

        $html = '';
        $html .= '<table border="1">';
        $html .= '<tr style="color: #ffffff; text-align: center; font-family: Calibri">';
        $html .= '<td style="background: #0088ff"><b>ID registro</b></td>';
        $html .= '<td style="background: #0088ff"><b>Usuário</b></td>';
        $html .= '<td style="background: #0088ff"><b>Evento</b></td>';
        $html .= '<td style="background: #0088ff"><b>Data do evento</b></td>';
        $html .= '</tr>';

        try {
            $result_tabela = $pdo->query("SELECT * FROM tb_logs_usuarios ORDER BY id DESC");

            while ($linha_tabela = $result_tabela->fetch(PDO::FETCH_ASSOC)) {
                $html .= '<tr>';
                $html .= '<td>' . $linha_tabela["id"] . '</td>';
                $html .= '<td>' . $linha_tabela["usuario"] . '</td>';
                $html .= '<td>' . $linha_tabela["evento"] . '</td>';
                $html .= '<td>' . $linha_tabela["data_evento"] . '</td>';
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