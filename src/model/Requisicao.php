<?php

class Requisicao
{

    public function __construct(private PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    // MÉTODO QUE EXIBE REQUISICOES EM ABERTO
    public function exibeRequisicoes(): array
    {
        $sql = "SELECT *, DATE_FORMAT(data_requisicao, '%W, %d/%m/%Y - %H:%i') AS data_requisicao FROM tb_requisicoes";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // MÉTODO QUE EXIBE TODO O HISTORICO DE REQUISILÇOES
    public function exibeHistoricoRequisicoes(): array
    {
        $sql = "SELECT *, DATE_FORMAT(data_requisicao_historico, '%W, %d/%m/%Y às %H:%i')
                AS data_requisicao_historico
                FROM tb_requisicoes_historico
                WHERE data_requisicao_historico >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) 
                ORDER BY id_historico DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // MÉTODO QUE EXIBE MEU HISTORICO DE REQUISICÕES
    public function exibeMinhasRequisicoesHistorico(): array
    {
        $sql = "SELECT id_historico, descricao_historico, unidade_medida_historico, quantidade_historico, solicitante_historico, data_requisicao_historico, status_historico, DATE_FORMAT(data_requisicao_historico, '%W %d/%m/%Y às %H:%i')
                AS data_requisicao_historico
                FROM tb_requisicoes_historico
                WHERE id_solicitante_historico = ?
                AND data_requisicao_historico >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                ORDER BY id_historico DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $_SESSION['id_usuario'], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // MÉTODO QUE EXIBE MINHAS REQUISICOES EM ABERTO
    public function exibeMinhasRequisicoesEmAberto(): array
    {
        $sql = "SELECT id, descricao, unidade_medida, quantidade, solicitante, data_requisicao, status, DATE_FORMAT(data_requisicao, '%W %d/%m/%Y - %H:%i')
                AS data_requisicao
                FROM tb_requisicoes
                WHERE id_solicitante = :id_solicitante AND status = 'EM ABERTO'
                ORDER BY id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id_solicitante", $_SESSION['id_usuario'], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // MÉTODO QUE EXIBE TODOS OS PRODUTOS COM STATUS DE NÃO INVENTARIADO PARA ABERTURA DE REQUISIÇÃO...
    // SE O PRODUTO ESTIVER COM O STATUS DE INVENTÁRIO 'INVENTARIADO' NÃO SERÁ POSSÍVEL ABRIR REQUISIÇÃO DESSE PRODUTO SEM ANTES FINALIZAR O INVENTÁRIO EM ABERTO...
    public function exibeProdutoRequisicao() : array
    {
        $sql = "SELECT * FROM tb_produtos WHERE status_inv_produto = 'NÃO INVENTARIADO'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // VALIDA SE OS CAMPOS INFORMADOS QUE DEVEM SER NÚMEROS SÃO REALMENTE NÚMEROS..
    public function validaValorInteiro(string $valor, string $input, string $caminho): float
    {
        $valor = filter_input(INPUT_POST, $input, FILTER_VALIDATE_FLOAT);
        if ($valor === false) {
            header("Location: $caminho");
            die();
        }
        return $valor;
    }

    // MÉTODO QUE VALIDA SE O VALOR CONTADO É NEGATIVO
    public function validaValorNegativo(string $valor, string $caminho): string
    {
        if ($valor < 0) {
            header("Location: $caminho");
            die();
        }
        return $valor;
    }

    // MÉTODO QUE ABRE REQUISICAO
    public function abreRequisicao(string $descricao, string $unidade_medida, string $quantidade): void
    {

        // CHAMA O MÉTODO validaValorInformado PARA VALIDAR OS CAMPOS QUE DEVEM SER UM NÚMERO INTEIRO...
        $quantidade = $this->validaValorInteiro('quantidade', 'quantidade', '../../requisicao.php?verifica_campos=nao_numerico');

        // CHAMA O MÉTODO validaValorNegativo PARA VALIDAR OS CAMPOS QUE DEVEM SER MAIOR OU IGUAL A 0...
        $quantidade = $this->validaValorNegativo($quantidade, '../../requisicao.php?verifica_campos=numero_negativo');

        // ABRE A REQUISIÇÃO
        $sqlAbreRequisicao = "INSERT INTO tb_requisicoes( descricao, unidade_medida, quantidade, id_solicitante, solicitante, status )
                VALUES ( ?,?,?,?,?, 'EM ABERTO' )";
        $stmt = $this->pdo->prepare($sqlAbreRequisicao);
        $stmt->bindValue(1, trim($descricao), PDO::PARAM_STR);
        $stmt->bindValue(2, trim($unidade_medida), PDO::PARAM_STR);
        $stmt->bindValue(3, trim($quantidade), PDO::PARAM_STR);
        $stmt->bindValue(4, trim($_SESSION['id_usuario']), PDO::PARAM_INT);
        $stmt->bindValue(5, trim($_SESSION['nome_usuario']), PDO::PARAM_STR);
        $stmt->execute();

        // SALVA A REQUISIÇÃO NO HISTORICO DE REQUISIÇÕES
        $sqlSalvaRequisiaoHistorico = "INSERT INTO tb_requisicoes_historico( descricao_historico, unidade_medida_historico, quantidade_historico, id_solicitante_historico, solicitante_historico, status_historico, baixa_historico, data_baixa_historico ) VALUES ( ?,?,?,?,?, 'EM ABERTO', 'Aguardando baixa...', 'Aguardando baixa...' )";
        $stmt = $this->pdo->prepare($sqlSalvaRequisiaoHistorico);
        $stmt->bindValue(1, trim($descricao), PDO::PARAM_STR);
        $stmt->bindValue(2, trim($unidade_medida), PDO::PARAM_STR);
        $stmt->bindValue(3, trim($quantidade), PDO::PARAM_STR);
        $stmt->bindValue(4, trim($_SESSION['id_usuario']), PDO::PARAM_INT);
        $stmt->bindValue(5, trim($_SESSION['nome_usuario']), PDO::PARAM_STR);
        $stmt->execute();

        // RESERVA A QUANTIDADE SOLICITADA NA REQUISIÇÃO, SUBTRAINDO O VALOR EM ESTOQUE DO PRODUTO REQUISITADO PELA QUANTIDADE REQUISITADA.
        $sqlRetiraEstoque = "UPDATE tb_produtos SET estoque = estoque - ? WHERE descricao = ?";
        $stmt = $this->pdo->prepare($sqlRetiraEstoque);
        $stmt->bindValue(1, trim($quantidade), PDO::PARAM_STR);
        $stmt->bindValue(2, trim($descricao), PDO::PARAM_STR);
        $stmt->execute();
    }


    // EXCLUI MINHA REQUISIÇÃO REALIZADA
    public function cancelaMinhaRequisicao(int $id, $quantidade, $descricao): void
    {
        $sql = "DELETE FROM tb_requisicoes WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        // DEVOLVE O VALOR DA QUANTIDADE NA REQUISIÇÃO EM QUESTÃO, SOMANDO O VALOR EM ESTOQUE DO PRODUTO REQUISITADO
        $sqlDevolveEstoque = "UPDATE tb_produtos SET estoque = estoque + ? WHERE descricao = ?";
        $stmt = $this->pdo->prepare($sqlDevolveEstoque);
        $stmt->bindValue(1, $quantidade, PDO::PARAM_STR);
        $stmt->bindValue(2, $descricao, PDO::PARAM_STR);
        $stmt->execute();

        // ALTERA O STATUS DA REQUISIÇÃO EM QUESTÃO PARA "CANCELADA PELO SOLICITANTE"
        $sqlAlteraStatusRequisicao = 
        "UPDATE tb_requisicoes_historico SET status_historico = 'CANCELADA PELO SOLICITANTE' WHERE id_historico = ?";
        $stmt = $this->pdo->prepare($sqlAlteraStatusRequisicao);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }


    // MÉTODO QUE ENTREGA REQUISICAO
    public function entregaRequisicao(int $id, string $baixa, string $data_baixa): void
    {
        // ENTREGA A REQUISIÇÃO
        $sqlEntregaRequisicao = "DELETE FROM tb_requisicoes WHERE id = ?";
        $stmt = $this->pdo->prepare($sqlEntregaRequisicao);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        // ALTERA O STATUS DA REQUISIÇÃO EM QUESTÃO PARA "ENTREGUE"
        $sqlAlteraStatusRequisicao =
            "UPDATE tb_requisicoes SET status = 'Entregue' WHERE id = ?;
         UPDATE tb_requisicoes_historico SET status_historico = 'ENTREGUE' WHERE id_historico = ?
        ";
        $stmt = $this->pdo->prepare($sqlAlteraStatusRequisicao);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->execute();

        // INFORMA QUEM DEU BAIXA NA REQUISIÇÃO
        $sqlDefineBaixador =
            "UPDATE tb_requisicoes_historico SET baixa_historico = ? WHERE id_historico = ?;
         UPDATE tb_requisicoes_historico SET data_baixa_historico = ? WHERE id_historico = ?
        ";
        $stmt = $this->pdo->prepare($sqlDefineBaixador);
        $stmt->bindValue(1, $baixa, PDO::PARAM_STR);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->bindValue(3, $data_baixa, PDO::PARAM_STR);
        $stmt->bindValue(4, $id, PDO::PARAM_INT);
        $stmt->execute();
    }


    // MÉTODO QUE RECUSA REQUISIÇAO
    public function recusaRequisicao(int $id, string $quantidade, string $descricao, string $baixa, string $data_baixa)
    {
        // CANCELA A REQUISIÇÃO
        $sqlRecusaRequisicao = "DELETE FROM tb_requisicoes WHERE id = ?";
        $stmt = $this->pdo->prepare($sqlRecusaRequisicao);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        // DEVOLVE O VALOR DA QUANTIDADE NA REQUISIÇÃO EM QUESTÃO, SOMANDO O VALOR EM ESTOQUE DO PRODUTO REQUISITADO
        $sqlDevolveEstoque = "UPDATE tb_produtos SET estoque = estoque + ? WHERE descricao = ?";
        $stmt = $this->pdo->prepare($sqlDevolveEstoque);
        $stmt->bindValue(1, $quantidade, PDO::PARAM_STR);
        $stmt->bindValue(2, $descricao, PDO::PARAM_STR);
        $stmt->execute();

        // ALTERA O STATUS DA REQUISIÇÃO EM QUESTÃO PARA "RECUSADA"
        $sqlAlteraStatusRequisicao =
            "UPDATE tb_requisicoes SET status = 'Recusada' WHERE id = ?;
         UPDATE tb_requisicoes_historico SET status_historico = 'RECUSADA' WHERE id_historico = ?
        ";
        $stmt = $this->pdo->prepare($sqlAlteraStatusRequisicao);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->execute();

        // INFORMA A DATA E QUEM DEU BAIXA NA REQUISIÇÃO EM QUESTÃO.
        $sqlDefineBaixador =
            "UPDATE tb_requisicoes_historico SET baixa_historico = ? WHERE id_historico = ?;
         UPDATE tb_requisicoes_historico SET data_baixa_historico = ? WHERE id_historico = ?
        ";
        $stmt = $this->pdo->prepare($sqlDefineBaixador);
        $stmt->bindValue(1, $baixa, PDO::PARAM_STR);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->bindValue(3, $data_baixa, PDO::PARAM_STR);
        $stmt->bindValue(4, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
