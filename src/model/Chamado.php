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

        $sql = "INSERT INTO tb_chamados (titulo, departamento, categoria, prioridade, descricao, usuario, unidade_usuario, status, fechado_por, data_fechamento) VALUES ( ?,?,?,?,?,?,?,?,?,? )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, trim(mb_strtoupper($titulo)), PDO::PARAM_STR);
        $stmt->bindValue(2, trim(mb_strtoupper($departamento)), PDO::PARAM_STR);
        $stmt->bindValue(3, trim(mb_strtoupper($categoria)), PDO::PARAM_STR);
        $stmt->bindValue(4, trim(mb_strtoupper($prioridade)), PDO::PARAM_STR);
        $stmt->bindValue(5, trim($descricao), PDO::PARAM_STR);
        $stmt->bindValue(6, $_SESSION['usuario'], PDO::PARAM_STR);
        $stmt->bindValue(7, $_SESSION['unidade'], PDO::PARAM_STR);
        $stmt->bindValue(8, 'EM ABERTO', PDO::PARAM_STR);
        $stmt->bindValue(9, 'NÃO FECHADO', PDO::PARAM_STR);
        $stmt->bindValue(10, 'NÃO FECHADO', PDO::PARAM_STR);
        $stmt->execute();
    }

    public function exibeTodosChamados() : array
    {
        $sql = "SELECT *, DATE_FORMAT(data_abertura, '%d/%m/%Y/ às %H:%i') AS data_abertura FROM tb_chamados WHERE titulo != ''";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function exibeMeusChamados() : array
    {
        $sql = "SELECT *, DATE_FORMAT(data_abertura, '%d/%m/%Y às %H:%i') AS data_abertura FROM tb_chamados WHERE usuario = ? ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $_SESSION['usuario'], PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }


    public function buscaIdChamado(int $id) : array
    {
        $sql = "SELECT *, DATE_FORMAT(data_abertura, '%d/%m/%Y às %H:%i') AS data_abertura FROM tb_chamados WHERE id = ?";
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
        $stmt->bindValue(1, trim(mb_strtoupper($titulo)), PDO::PARAM_STR);
        $stmt->bindValue(2, trim(mb_strtoupper($departamento)), PDO::PARAM_STR);
        $stmt->bindValue(3, trim(mb_strtoupper($categoria)), PDO::PARAM_STR);
        $stmt->bindValue(4, trim(mb_strtoupper($prioridade)), PDO::PARAM_STR);
        $stmt->bindValue(5, trim($descricao), PDO::PARAM_STR);
        $stmt->bindValue(6, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function moveChamado(int $id, string $departamento) : void
    {

        $sql = "UPDATE tb_chamados SET departamento = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $departamento, PDO::PARAM_STR);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function fechaChamado(int $id, string $motivo_fechamento): void
    {

        Validacoes::validaCampoVazio($motivo_fechamento, "../../visualiza_chamado.php?id=$_POST[id]&verifica_campo=motivo_fechamento_vazio");

        $sql = "UPDATE tb_chamados SET status = ?, fechado_por = ?, motivo_fechamento = ?, data_fechamento = DATE_FORMAT(NOW(), '%d/%m/%Y às %H:%i') WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, trim('FECHADO'), PDO::PARAM_STR);
        $stmt->bindValue(2, trim($_SESSION['usuario']), PDO::PARAM_STR);
        $stmt->bindValue(3, trim($motivo_fechamento), PDO::PARAM_STR);
        $stmt->bindValue(4, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function reabreChamado(int $id) : void 
    {
        $sql = "UPDATE tb_chamados SET status = ?, fechado_por = ?, data_fechamento = ?, motivo_fechamento = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, 'EM ABERTO', PDO::PARAM_STR);
        $stmt->bindValue(2, "NÃO FECHADO", PDO::PARAM_STR);
        $stmt->bindValue(3, "NÃO FECHADO", PDO::PARAM_STR);
        $stmt->bindValue(4, "NÃO FECHADO", PDO::PARAM_STR);
        $stmt->bindValue(5, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function respondeChamado(int $id_chamado, string $descricao_resposta) : void
    {
        $sql = "INSERT INTO tb_chamados_respostas (id_chamado, descricao_resposta, respondido_por) VALUES ( ?,?,? )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id_chamado, PDO::PARAM_INT);
        $stmt->bindValue(2, trim($descricao_resposta), PDO::PARAM_STR);
        $stmt->bindValue(3, $_SESSION['usuario'], PDO::PARAM_STR);
        $stmt->execute();
    }

    public function exibeRespostas(): array
    {
        $sql = "SELECT *, DATE_FORMAT(data_resposta, '%d/%m/%Y às %H:%i') AS data_resposta FROM tb_chamados_respostas WHERE id_chamado = ? ORDER BY data_resposta DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $_GET['id']);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function excluiResposta(int $id) : void
    {
        $sql = "DELETE FROM tb_chamados_respostas WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

    public function buscaIdResposta(int $id) : array
    {
        $sql = "SELECT * FROM tb_chamados_respostas WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function editaResposta(int $id, string $descricao_resposta) : void
    {
        $sql = "UPDATE tb_chamados_respostas SET descricao_resposta = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $descricao_resposta, PDO::PARAM_STR);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}