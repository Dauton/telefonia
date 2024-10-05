<?php

require_once "Validacoes.php";

class Chamado
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function abreChamado(string $titulo, string $departamento, string $prioridade, string $categoria, string $descricao): void   
    {
        
        Validacoes::validaCampoVazio($titulo, "");
        Validacoes::validaCampoVazio($departamento, "");
        Validacoes::validaCampoVazio($prioridade, "");
        Validacoes::validaCampoVazio($categoria, "");
        Validacoes::validaCampoVazio($descricao, "");

        $sql = "INSERT INTO tb_chamados (titulo, departamento, prioridade, categoria, descricao, nome_usuario, unidade_usuario) VALUES ( ?,?,?,?,?,?,? )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, trim(mb_strtoupper($titulo)));
        $stmt->bindValue(2, trim(mb_strtoupper($departamento)));
        $stmt->bindValue(3, trim(mb_strtoupper($prioridade)));
        $stmt->bindValue(4, trim(mb_strtoupper($categoria)));
        $stmt->bindValue(5, trim($descricao));
        $stmt->bindValue(6, $_SESSION['nome']);
        $stmt->bindValue(7, $_SESSION['unidade']);
        $stmt->execute();
    }
}