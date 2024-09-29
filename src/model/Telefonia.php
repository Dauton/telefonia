<?php

require_once "Validacoes.php";

class Telefonia
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastraDispositivo(string $linha, string $operadora, string $servico, string $perfil, string $status, string $data_ativacao, string $sim_card, string $marca_aparelho, string $modelo_aparelho, string $imei_aparelho, string $gestao_mdm, string $unidade, string $centro_custo, string $uf, string $canal, string $ponto_focal, string $gestor, string $nome, string $matricula, string $email, string $funcao): void
    {
        $sql = "INSERT INTO tb_dispositivos (
            linha, operadora, servico, perfil, status, data_ativacao, sim_card, marca_aparelho, modelo_aparelho, imei_aparelho, gestao_mdm, unidade, centro_custo, uf, canal, ponto_focal, gestor, nome, matricula, email, funcao
        ) VALUES (
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
        )";

        Validacoes::executaValidacoes();

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, trim($linha), PDO::PARAM_STR);
        $stmt->bindValue(2, trim(strtoupper($operadora)), PDO::PARAM_STR);
        $stmt->bindValue(3, trim(strtoupper($servico)), PDO::PARAM_STR);
        $stmt->bindValue(4, trim(strtoupper($perfil)), PDO::PARAM_STR);
        $stmt->bindValue(5, trim(strtoupper($status)), PDO::PARAM_STR);
        $stmt->bindValue(6, trim($data_ativacao), PDO::PARAM_STR);
        $stmt->bindValue(7, trim($sim_card), PDO::PARAM_STR);
        $stmt->bindValue(8, trim(strtoupper($marca_aparelho)), PDO::PARAM_STR);
        $stmt->bindValue(9, trim(strtoupper($modelo_aparelho)), PDO::PARAM_STR);
        $stmt->bindValue(10, trim($imei_aparelho), PDO::PARAM_STR);
        $stmt->bindValue(11, trim(strtoupper($gestao_mdm)), PDO::PARAM_STR);
        $stmt->bindValue(12, trim(strtoupper($unidade)), PDO::PARAM_STR);
        $stmt->bindValue(13, trim($centro_custo), PDO::PARAM_STR);
        $stmt->bindValue(14, trim(strtoupper($uf)), PDO::PARAM_STR);
        $stmt->bindValue(15, trim(strtoupper($canal)), PDO::PARAM_STR);
        $stmt->bindValue(16, trim(strtoupper($ponto_focal)), PDO::PARAM_STR);
        $stmt->bindValue(17, trim(strtoupper($gestor)), PDO::PARAM_STR);
        $stmt->bindValue(18, trim(strtoupper($nome)), PDO::PARAM_STR);
        $stmt->bindValue(19, trim($matricula), PDO::PARAM_STR);
        $stmt->bindValue(20, trim(strtoupper($email)), PDO::PARAM_STR);
        $stmt->bindValue(21, trim(strtoupper($funcao)), PDO::PARAM_STR);
        $stmt->execute();
    }

    public function exibeDispositivos(): array
    {
        $sql = "SELECT * FROM tb_dispositivos";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function buscaIdDispositivo(int $id): array
    {
        $sql = "SELECT * FROM tb_dispositivos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $reslutado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $reslutado;
    }

    public function atualizaDispositivo(int $id, string $linha, string $operadora, string $servico, string $perfil, string $status, string $data_ativacao, string $sim_card, string $marca_aparelho, string $modelo_aparelho, string $imei_aparelho, string $gestao_mdm, string $unidade, string $centro_custo, string $uf, string $canal, string $ponto_focal, string $gestor, string $nome, string $matricula, string $email, string $funcao): void
    {
        $sql =
        "UPDATE tb_dispositivos
         SET linha = ?, operadora = ?, servico = ?, perfil = ?, status = ?, data_ativacao = ?, sim_card = ?, marca_aparelho = ?, modelo_aparelho = ?, imei_aparelho = ?, gestao_mdm = ?, unidade = ?, centro_custo = ?, uf = ?, canal = ?, ponto_focal = ?, gestor = ?, nome = ?, matricula = ?, email = ?, funcao = ?
         WHERE id = ?
        ";

        Validacoes::executaValidacoes();

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, trim($linha), PDO::PARAM_STR);
        $stmt->bindValue(2, trim(strtoupper($operadora)), PDO::PARAM_STR);
        $stmt->bindValue(3, trim(strtoupper($servico)), PDO::PARAM_STR);
        $stmt->bindValue(4, trim(strtoupper($perfil)), PDO::PARAM_STR);
        $stmt->bindValue(5, trim(strtoupper($status)), PDO::PARAM_STR);
        $stmt->bindValue(6, trim($data_ativacao), PDO::PARAM_STR);
        $stmt->bindValue(7, trim($sim_card), PDO::PARAM_STR);
        $stmt->bindValue(8, trim(strtoupper($marca_aparelho)), PDO::PARAM_STR);
        $stmt->bindValue(9, trim(strtoupper($modelo_aparelho)), PDO::PARAM_STR);
        $stmt->bindValue(10, trim($imei_aparelho), PDO::PARAM_STR);
        $stmt->bindValue(11, trim(strtoupper($gestao_mdm)), PDO::PARAM_STR);
        $stmt->bindValue(12, trim(strtoupper($unidade)), PDO::PARAM_STR);
        $stmt->bindValue(13, trim($centro_custo), PDO::PARAM_STR);
        $stmt->bindValue(14, trim(strtoupper($uf)), PDO::PARAM_STR);
        $stmt->bindValue(15, trim(strtoupper($canal)), PDO::PARAM_STR);
        $stmt->bindValue(16, trim(strtoupper($ponto_focal)), PDO::PARAM_STR);
        $stmt->bindValue(17, trim(strtoupper($gestor)), PDO::PARAM_STR);
        $stmt->bindValue(18, trim(strtoupper($nome)), PDO::PARAM_STR);
        $stmt->bindValue(19, trim($matricula), PDO::PARAM_STR);
        $stmt->bindValue(20, trim(strtoupper($email)), PDO::PARAM_STR);
        $stmt->bindValue(21, trim(strtoupper($funcao)), PDO::PARAM_STR);
        $stmt->bindValue(22, $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function excluiDispositivo(int $id) : void
    {
        $sql = "DELETE FROM tb_dispositivos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
