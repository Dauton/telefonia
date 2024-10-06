<?php

require_once "Validacoes.php";
class Chamado
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function abreChamado(string $titulo, string $departamento, string $categoria, string $prioridade, string $descricao): void   
    {
        
        Validacoes::validaCampoVazio($titulo, "../../abrir_chamado.php?verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($departamento, "");
        Validacoes::validaCampoVazio($categoria, "");
        Validacoes::validaCampoVazio($prioridade, "");
        Validacoes::validaCampoVazio($descricao, "");

        $sql = "INSERT INTO tb_chamados (titulo, departamento, categoria, prioridade, descricao, usuario, unidade_usuario, status) VALUES ( ?,?,?,?,?,?,?, 'EM ABERTO' )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, trim(mb_strtoupper($titulo)));
        $stmt->bindValue(2, trim(mb_strtoupper($departamento)));
        $stmt->bindValue(3, trim(mb_strtoupper($categoria)));
        $stmt->bindValue(4, trim(mb_strtoupper($prioridade)));
        $stmt->bindValue(5, trim($descricao));
        $stmt->bindValue(6, $_SESSION['usuario']);
        $stmt->bindValue(7, $_SESSION['unidade']);
        $stmt->execute();
    }

    public function exibeMeusChamados() : array
    {
        $sql = "SELECT *, DATE_FORMAT(data_abertura, ' %d/%m/%Y às %H:%i ') AS data_abertura FROM tb_chamados WHERE usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $_SESSION['usuario'], PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

}