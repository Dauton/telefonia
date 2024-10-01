<?php

class CadastroOpcoes
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // LISTA OS TIPOS DE OPÇÕES NOS SELECTS...
    public function listaOpcoes(string $tipo) : array
    {
        $sql = "SELECT * FROM tb_cadastros_opcoes WHERE tipo = ? ORDER BY descricao";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $tipo, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function listaTiposOpcoes() : array
    {
        $sql = "SELECT * FROM tb_tipos_opcoes";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function cadastraOpcao(string $tipo, string $descricao) : void
    {
        $sql = "INSERT INTO tb_cadastros_opcoes (tipo, descricao) VALUES ( ?,? )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, mb_strtoupper(trim($tipo)), PDO::PARAM_STR);
        $stmt->bindValue(2, mb_strtoupper(trim($descricao)), PDO::PARAM_STR);
        $stmt->execute();
    }

}
    