<?php

    global $pdo;
    
    require_once "../config/conexao_bd.php";
    require_once "../../vendor/autoload.php";

    liberacaoInfraIDL();
    senhaPrimeiroAcesso();

    if($_SERVER['QUERY_STRING'] === 'aparelhos') {
        
        $sql = "SELECT * FROM tb_dispositivos WHERE marca_aparelho != '' AND marca_aparelho != null";
        $nome_arquivo = 'APARELHOS_CADASTRADOS.xls';

    } elseif($_SERVER['QUERY_STRING'] === 'linhas') {
        
        $sql = "SELECT * FROM tb_dispositivos WHERE linha != '' AND linha != null";
        $nome_arquivo = 'LINHAS_CADASTRADAS.xls';

    } elseif($_SERVER['QUERY_STRING'] === 'mdm') {
        
        $sql = "SELECT * FROM tb_dispositivos WHERE gestao_mdm = 'SIM'";
        $nome_arquivo = 'APARELHOS_COM_MDM.xls';

    }  elseif($_SERVER['QUERY_STRING'] === 'extrair_tudo') {
        
        $sql = "SELECT * FROM tb_dispositivos";
        $nome_arquivo = 'DISPOSITIVOS_CADASTRADOS.xls';

    } else {
        header('Location: inicio.php');
        die();
    }
    
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Excel Registros de acessos</title>
    
    <head>

    <body>
        <?php

        $html = '';
        $html .= '<table border="1">';
        $html .= '<tr style="color: #ffffff; text-align: center; font-family: Calibri">';
        $html .= '<td style="background: #00384b"><b>LINHA</b></td>';
        $html .= '<td style="background: #00384b"><b>OPERADORA</b></td>';
        $html .= '<td style="background: #00384b"><b>SERVIÇO</b></td>';
        $html .= '<td style="background: #00384b"><b>PERFIL</b></td>';
        $html .= '<td style="background: #00384b"><b>STATUS</b></td>';
        $html .= '<td style="background: #00384b"><b>DATA ATIVAÇÃO</b></td>';
        $html .= '<td style="background: #00384b"><b>SIM CARD</b></td>';
        $html .= '<td style="background: #00384b"><b>TIPO APARELHO</b></td>';
        $html .= '<td style="background: #00384b"><b>MARCA APARELHO</b></td>';
        $html .= '<td style="background: #00384b"><b>MODELO APARELHO</b></td>';
        $html .= '<td style="background: #00384b"><b>IMEI APARELHO</b></td>';
        $html .= '<td style="background: #00384b"><b>GESTÃO MDM</b></td>';
        $html .= '<td style="background: #00384b"><b>UNIDADE</b></td>';
        $html .= '<td style="background: #00384b"><b>CENTRO DE CUSTO</b></td>';
        $html .= '<td style="background: #00384b"><b>UF</b></td>';
        $html .= '<td style="background: #00384b"><b>CANAL</b></td>';
        $html .= '<td style="background: #00384b"><b>PONTO FOCAL</b></td>';
        $html .= '<td style="background: #00384b"><b>GESTOR</b></td>';
        $html .= '<td style="background: #00384b"><b>NOME</b></td>';
        $html .= '<td style="background: #00384b"><b>MATRÍCULA</b></td>';
        $html .= '<td style="background: #00384b"><b>E-MAIL</b></td>';
        $html .= '<td style="background: #00384b"><b>FUNÇÃO</b></td>';


        $html .= '</tr>';

        try {
            $result_tabela = $pdo->query($sql);

            while ($linha_tabela = $result_tabela->fetch(PDO::FETCH_ASSOC)) {
                $html .= '<tr>';
                $html .= '<td>' . $linha_tabela["linha"] . '</td>';
                $html .= '<td>' . $linha_tabela["operadora"] . '</td>';
                $html .= '<td>' . $linha_tabela["servico"] . '</td>';
                $html .= '<td>' . $linha_tabela["perfil"] . '</td>';
                $html .= '<td>' . $linha_tabela["status"] . '</td>';
                $html .= '<td>' . $linha_tabela["data_ativacao"] . '</td>';
                $html .= '<td>*' . $linha_tabela["sim_card"] . '</td>';
                $html .= '<td>' . $linha_tabela["marca_aparelho"] . '</td>';
                $html .= '<td>' . $linha_tabela["tipo_aparelho"] . '</td>';
                $html .= '<td>' . $linha_tabela["modelo_aparelho"] . '</td>';
                $html .= '<td>*' . $linha_tabela["imei_aparelho"] . '</td>';
                $html .= '<td>' . $linha_tabela["gestao_mdm"] . '</td>';
                $html .= '<td>' . $linha_tabela["unidade"] . '</td>';
                $html .= '<td>' . $linha_tabela["centro_custo"] . '</td>';
                $html .= '<td>' . $linha_tabela["uf"] . '</td>';
                $html .= '<td>' . $linha_tabela["canal"] . '</td>';
                $html .= '<td>' . $linha_tabela["ponto_focal"] . '</td>';
                $html .= '<td>' . $linha_tabela["gestor"] . '</td>';
                $html .= '<td>' . $linha_tabela["nome"] . '</td>';
                $html .= '<td>' . $linha_tabela["matricula"] . '</td>';
                $html .= '<td>' . $linha_tabela["email"] . '</td>';
                $html .= '<td>' . $linha_tabela["funcao"] . '</td>';

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