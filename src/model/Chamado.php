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
        Validacoes::validaCampoVazio($departamento, "../../abrir_chamado.php?verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($categoria, "../../abrir_chamado.php?verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($prioridade, "../../abrir_chamado.php?verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($descricao, "../../abrir_chamado.php?verifica_campo=todos_campos");

        $sql = "INSERT INTO tb_chamados (titulo, departamento, categoria, prioridade, descricao, usuario, unidade_usuario, status) VALUES ( ?,?,?,?,?,?,?,? )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, trim(mb_strtoupper($titulo)), PDO::PARAM_STR);
        $stmt->bindValue(2, trim(mb_strtoupper($departamento)), PDO::PARAM_STR);
        $stmt->bindValue(3, trim(mb_strtoupper($categoria)), PDO::PARAM_STR);
        $stmt->bindValue(4, trim(mb_strtoupper($prioridade)), PDO::PARAM_STR);
        $stmt->bindValue(5, trim($descricao), PDO::PARAM_STR);
        $stmt->bindValue(6, $_SESSION['usuario'], PDO::PARAM_STR);
        $stmt->bindValue(7, $_SESSION['unidade'], PDO::PARAM_STR);
        $stmt->bindValue(8, 'EM ABERTO', PDO::PARAM_STR);
        $stmt->execute();
    }

    public function exibeTodosChamados() : array
    {
        $sql = "SELECT *, DATE_FORMAT(data_abertura, '%d/%m/%Y/ às %H:%i') AS data_abertura FROM tb_chamados";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
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


    public function buscaIdChamado(int $id) : array
    {
        $sql = "SELECT * FROM tb_chamados WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function editaChamado(int $id, string $titulo, string $departamento, string $categoria, string $prioridade, string $descricao) : void
    {
        Validacoes::validaCampoVazio($titulo, "../../abrir_chamado.php?id=$_GET[id]&verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($departamento, "../../abrir_chamado.php?id=$_GET[id]&verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($categoria, "../../abrir_chamado.php?id=$_GET[id]&verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($prioridade, "../../abrir_chamado.php?id=$_GET[id]&verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($descricao, "../../abrir_chamado.php?id=$_GET[id]&verifica_campo=todos_campos");

        $sql = "UPDATE tb_chamados SET titulo = ?, departamento = ?, categoria = ?, prioridade = ?, descricao = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, trim(mb_strtoupper($titulo, PDO::PARAM_STR)));
        $stmt->bindValue(2, trim(mb_strtoupper($departamento, PDO::PARAM_STR)));
        $stmt->bindValue(3, trim(mb_strtoupper($categoria, PDO::PARAM_STR)));
        $stmt->bindValue(4, trim(mb_strtoupper($prioridade, PDO::PARAM_STR)));
        $stmt->bindValue(5, trim($descricao), PDO::PARAM_STR);
        $stmt->bindValue(6, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}