<?php

class Logs
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function armazenaLog(string $area_log, string $usuario_log, string $atividade_log, string $result_atividade_log, string $id_chamado) : void
    {

        $sql = "INSERT INTO tb_logs ( area_log, usuario_log, atividade_log, result_atividade_log, id_chamado ) VALUES ( ?,?,?,?,? )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $area_log, PDO::PARAM_STR);
        $stmt->bindValue(2, $usuario_log, PDO::PARAM_STR);
        $stmt->bindValue(3, $atividade_log, PDO::PARAM_STR);
        $stmt->bindValue(4, $result_atividade_log, PDO::PARAM_STR);
        $stmt->bindValue(5, $id_chamado, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function exibeHistoricoChamado(string $id_chamado) : array
    {
        $sql = "SELECT *, DATE_FORMAT(data_log, '%d/%m/%Y às %m:%i') AS data_log FROM tb_logs WHERE area_log = 'Chamados' AND id_chamado = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id_chamado, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

}