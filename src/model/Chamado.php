<?php

require_once "Validacoes.php";

class Chamado
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // ABRE UM CHAMADO...
    public function abreChamado(string $titulo, string $departamento, string $categoria, string $prioridade, string $descricao, string $inclui_linha, string $inclui_aparelho, string $anexo): void   
    {
        Validacoes::validaCampoVazio($titulo, "../../abrir_chamado.php?verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($departamento, "../../abrir_chamado.php?verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($categoria, "../../abrir_chamado.php?verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($prioridade, "../../abrir_chamado.php?verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($descricao, "../../abrir_chamado.php?verifica_campo=todos_campos");

        Validacoes::validaArquivoAnexado($anexo, '../abrir_chamado.php?verifica_campo=arquivo_invalido');

        $sql = "INSERT INTO tb_chamados (titulo, departamento, categoria, prioridade, descricao, inclui_linha, inclui_aparelho, anexo, usuario, unidade_usuario, status, fechado_por, data_fechamento) VALUES ( ?,?,?,?,?,?,?,?,?,?,?,?,? )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, trim(mb_strtoupper($titulo)), PDO::PARAM_STR);
        $stmt->bindValue(2, trim(mb_strtoupper($departamento)), PDO::PARAM_STR);
        $stmt->bindValue(3, trim(mb_strtoupper($categoria)), PDO::PARAM_STR);
        $stmt->bindValue(4, trim(mb_strtoupper($prioridade)), PDO::PARAM_STR);
        $stmt->bindValue(5, trim($descricao), PDO::PARAM_STR);
        $stmt->bindValue(6, trim($inclui_linha), PDO::PARAM_STR);
        $stmt->bindValue(7, trim($inclui_aparelho), PDO::PARAM_STR);
        $stmt->bindValue(8, trim($anexo), PDO::PARAM_STR);
        $stmt->bindValue(9, $_SESSION['usuario'], PDO::PARAM_STR);
        $stmt->bindValue(10, $_SESSION['unidade'], PDO::PARAM_STR);
        $stmt->bindValue(11, 'EM ABERTO', PDO::PARAM_STR);
        $stmt->bindValue(12, 'NÃO FECHADO', PDO::PARAM_STR);
        $stmt->bindValue(13, 'NÃO FECHADO', PDO::PARAM_STR);
        $stmt->execute();
    }


    // LISTA TODOS OS CHAMADOS...
    public function exibeTodosChamados() : array
    {
        $sql = "SELECT *, DATE_FORMAT(data_abertura, '%d/%m/%Y às %H:%i') AS data_abertura FROM tb_chamados ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // LISTA TODOS OS MEUS CHAMADOS...
    public function exibeMeusChamados() : array
    {
        $sql = "SELECT *, DATE_FORMAT(data_abertura, '%d/%m/%Y às %H:%i') AS data_abertura FROM tb_chamados WHERE usuario = ? ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $_SESSION['usuario'], PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // BUSCA O ID DO CHAMADO PARA EDIÇÃO...
    public function buscaIdChamado(int $id) : array
    {
        $sql = "SELECT *, DATE_FORMAT(data_abertura, '%d/%m/%Y às %H:%i') AS data_abertura FROM tb_chamados WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // EDITA UM CHAMADO
    public function editaChamado(int $id, string $titulo, string $departamento, string $categoria, string $prioridade, string $descricao, string $inclui_linha, string $inclui_aparelho) : void
    {
        Validacoes::validaCampoVazio($titulo, "../../abrir_chamado.php?id=$_GET[id]&verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($departamento, "../../abrir_chamado.php?id=$_GET[id]&verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($categoria, "../../abrir_chamado.php?id=$_GET[id]&verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($prioridade, "../../abrir_chamado.php?id=$_GET[id]&verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($descricao, "../../abrir_chamado.php?id=$_GET[id]&verifica_campo=todos_campos");

        $sql = "UPDATE tb_chamados SET titulo = ?, departamento = ?, categoria = ?, prioridade = ?, descricao = ?, inclui_linha = ?, inclui_aparelho = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, trim(mb_strtoupper($titulo)), PDO::PARAM_STR);
        $stmt->bindValue(2, trim(mb_strtoupper($departamento)), PDO::PARAM_STR);
        $stmt->bindValue(3, trim(mb_strtoupper($categoria)), PDO::PARAM_STR);
        $stmt->bindValue(4, trim(mb_strtoupper($prioridade)), PDO::PARAM_STR);
        $stmt->bindValue(5, trim($descricao), PDO::PARAM_STR);
        $stmt->bindValue(6, trim($inclui_linha), PDO::PARAM_STR);
        $stmt->bindValue(7, trim($inclui_aparelho), PDO::PARAM_STR);
        $stmt->bindValue(8, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // MOVE O CHAMADO DE DEPARTAMENTO...
    public function moveChamado(int $id, string $departamento) : void
    {

        $sql = "UPDATE tb_chamados SET departamento = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $departamento, PDO::PARAM_STR);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // FECHA O CHAMADO...
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

    // REABRE UM CHAMADO JÁ FECHADO...
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

    // ENVIA UMA RESPOSTA PARA O CHAMADO...
    public function respondeChamado(int $id_chamado, string $descricao_resposta) : void
    {

        Validacoes::validaCampoVazio($descricao_resposta,"../../visualiza_chamado.php?id=$_GET[id]&verifica_campo=resposta_vazia");

        $sql = "INSERT INTO tb_chamados_respostas (id_chamado, descricao_resposta, respondido_por) VALUES ( ?,?,? )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id_chamado, PDO::PARAM_INT);
        $stmt->bindValue(2, trim($descricao_resposta), PDO::PARAM_STR);
        $stmt->bindValue(3, $_SESSION['usuario'], PDO::PARAM_STR);
        $stmt->execute();
    }

    // LISTA TODAS AS RESPOSTAS DO CHAMADO...
    public function exibeRespostas(): array
    {
        $sql = "SELECT *, DATE_FORMAT(data_resposta, '%d/%m/%Y às %H:%i') AS data_resposta FROM tb_chamados_respostas WHERE id_chamado = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $_GET['id']);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // EXCLUI RESPOSTA DO CHAMADO...
    public function excluiResposta(int $id) : void
    {
        $sql = "DELETE FROM tb_chamados_respostas WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

    // BUSCA O ID DA RESPOSTA PARA EDIÇÃO...
    public function buscaIdResposta(int $id) : array
    {
        $sql = "SELECT * FROM tb_chamados_respostas WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // EDITA RESPOSTA DO CHAMADO...
    public function editaResposta(int $id, string $descricao_resposta) : void
    {
        $sql = "UPDATE tb_chamados_respostas SET descricao_resposta = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $descricao_resposta, PDO::PARAM_STR);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // BUSCA CHAMADO...
    public function buscaChamado(string $busca) : array
    {
        $sql = "SELECT *, DATE_FORMAT (data_abertura, '%d/%m/%Y às %H:%i') AS data_abertura FROM tb_chamados WHERE MATCH(titulo, departamento, categoria, usuario, unidade_usuario, status) AGAINST (:busca)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':busca', $busca, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // EXIBE CHAMADOS COM O STATUS 'EM ABERTO'...
    public function exibeChamadosEmAberto() : array
    {
        $sql = "SELECT *, DATE_FORMAT(data_abertura, '%d/%m/%Y às %H:%i') AS data_abertura FROM tb_chamados WHERE status = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, 'EM ABERTO', PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // EXIBE CHAMADOS QUE ESTÃO NA FILA DO MEU DEPARTAMENTO...
    public function exibeChamadosMeuDepartamento() : array
    {
        $sql = "SELECT *, DATE_FORMAT(data_abertura, '%d/%m/%Y às %H:%i') AS data_abertura FROM tb_chamados WHERE departamento = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $_SESSION['unidade'], PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // MÉTODO QUE CONTA OS CHAMADOS EM ABERTO...
    public function contagemChamadosEmAberto(): int
    {
        $sql = "SELECT COUNT(*) FROM tb_chamados WHERE status = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, 'EM ABERTO', PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchColumn();
        return $resultado;
    }

    // MÉTODO QUE CONTA OS CHAMADOS EM MEU DEPARTAMENTO...
    public function contagemChamadosMeuDepartamento(): int 
    {
        $sql = "SELECT COUNT(*) FROM tb_chamados WHERE departamento = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $_SESSION['unidade'], PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchColumn();
        return $resultado;
    }
}