<?php

require_once "Validacoes.php";

class Opcoes
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // LISTA OPÇÕES NOS SELECTS CONFORME O TIPO...
    public function listaOpcoes(string $tipo) : array
    {
        $sql = "SELECT * FROM tb_cadastros_opcoes WHERE tipo = ? ORDER BY descricao";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $tipo, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // LISTA OS TIPOS DE OPÇÕES...
    public function listaTiposOpcoes() : array
    {
        $sql = "SELECT * FROM tb_tipos_opcoes";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }


    // CADASTRA UMA OPÇÃO...
    public function cadastraOpcao(string $tipo, string $descricao) : void
    {
        // VALIDA SE O CAMPO DA DESCRIÇÃO É NUMERICA CASO O TIPO SELECIONADO SEJA CENTRO DE CUSTOS...
        if($_POST['tipo'] === 'CENTRO DE CUSTOS') {
            Validacoes::validaCampoNumerico($descricao,"../../cadastrar_opcoes.php?verifica_campo=centro_custo_nao_numerico");
        }

        // VALIDA SE TODOS OS CAMPOS FORAM PREENCHIDOS...
        Validacoes::validaCampoVazio($tipo, "cadastrar_opcoes.php?verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($descricao, "cadastrar_opcoes.php?verifica_campo=todos_campos");

        $sql = "INSERT INTO tb_cadastros_opcoes (tipo, descricao) VALUES ( ?,? )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, mb_strtoupper(trim($tipo)), PDO::PARAM_STR);
        $stmt->bindValue(2, mb_strtoupper(trim($descricao)), PDO::PARAM_STR);
        $stmt->execute();
    }

    public function buscaIdOpcao(int $id) : array
    {
        $sql = "SELECT * FROM tb_cadastros_opcoes WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function editaOpcao(string $tipo, string $descricao) : void
    {    
        // VALIDA SE O CAMPO DA DESCRIÇÃO É NUMERICA CASO O TIPO SELECIONADO SEJA CENTRO DE CUSTOS...
        if($_POST['tipo'] === 'CENTRO DE CUSTOS') {
            Validacoes::validaCampoNumerico($descricao,"$_GET[id]&verifica_campo=todos_campos");
        }

        // VALIDA SE TODOS OS CAMPOS FORAM PREENCHIDOS...
        Validacoes::validaCampoVazio($tipo, "$_GET[id]&verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($descricao, "$_GET[id]&verifica_campo=todos_campos");

        $sql = "UPDATE tb_cadastros_opcoes SET tipo = ?, descricao = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, mb_strtoupper(trim($tipo)), PDO::PARAM_STR);
        $stmt->bindValue(2, mb_strtoupper(trim($descricao)), PDO::PARAM_STR);
        $stmt->bindValue(3, $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();

    }

    public function excluiOpcao(int $id) : void
    {
        $sql = "DELETE FROM tb_cadastros_opcoes WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

}
    