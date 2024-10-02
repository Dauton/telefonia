<?php

    class Inventario
    {
        private PDO $pdo;

        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        // METÓDO QUE CRIA UM INVENTÁRIO...
        public function criaInventario(string $nome_inventario) : void
        {
            $sql = "INSERT INTO tb_inventarios (nome_inventario, criado_por, data_final, descricao, unidade_medida, estoque, diferenca_estoque, status_inv_produto, produto_inv_por, status_inventario) VALUES (?, ?, 'Aguardando...', '', '', '', '', '', '', 'EM ANDAMENTO')";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, ucfirst($nome_inventario . time() . random_int(100, 999)), PDO::PARAM_STR);
            $stmt->bindValue(2, $_SESSION['nome_usuario'], PDO::PARAM_STR);
            $stmt->execute();
        }

        // MÉTODO PARA EXIBIÇÃO DOS INVENTÁRIOS CRIADOS...
        public function exibeInventarios() : array
        {
            $sql = "SELECT 
                    nome_inventario, 
                    MAX(criado_por) AS criado_por,
                    DATE_FORMAT(MIN(data_inicio), '%d/%m/%Y') AS data_inicio, 
                    MAX(data_final) AS data_final, status_inventario
                    FROM tb_inventarios 
                    GROUP BY nome_inventario, status_inventario
                    ORDER BY status_inventario ASC, data_inicio DESC;
                ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // MÉTODO QUE RECUPERA O STATUS DO INVENTÁRIO PARA VERIFICAÇÃO SE HÁ INVENTÁRIO EM ANDAMENTO NO MOMENTO DA CRIAÇÃO DE UM NOVO INVENTÁRIO...
        public function recuperaStatusInv()
        {
            $sql = "SELECT * FROM tb_inventarios WHERE status_inventario = 'EM ANDAMENTO'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // MÉTODO QUE RECUPERA O STATUS DO PRODUTO PARA VERIFICAÇÃO SE HÁ ALGUM PRODUTO NÃO INVENTARIADO NO MOMENTO DA FINALIZAÇÃO DO INVENTÁRIO...
        public function recuperaStatusProduto()
        {
            $sql = "SELECT * FROM tb_produtos WHERE status_inv_produto = 'NÃO INVENTARIADO'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // MÉTODO QUE BUSCA O NOME DO INVENTÁRIO...
        public function buscaNomeInventario(string $nome_inventario)
        {
            $sql = "SELECT * FROM tb_inventarios WHERE nome_inventario = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $nome_inventario, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // MÉTODO QUE EXIBE OS PRODUTOS ORDENANDO PELO STATUS DO INVENTÁRIO DE CADA PRODUTO NO MOMENTO DO INVENTÁRIO... 
        public function exibeProdutosInventario() : array
        {
            $sql = "SELECT * FROM tb_produtos ORDER BY status_inv_produto DESC, categoria ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // MÉTODO QUE VALIDA O CAMPO INFORMADO NA QUANTIDADE CONTADA DO PRODUTO...
        public function validaValorInteiro(string $valor, string $input, string $caminho) : float
        {
            $valor = filter_input(INPUT_POST, $input, FILTER_VALIDATE_FLOAT);
            if($valor === false) {
                header("Location: $caminho");
                die();
            }
            return $valor;
        }

        // MÉTODO QUE VALIDA SE O VALOR CONTADO É NEGATIVO
        public function validaValorNegativo(string $valor, string $caminho) : string
        {
            if($valor < 0) {
                header("Location: $caminho");
                die();
            }
            return $valor;
        }

        // MÉTODO QUE INVENTARIA O PRODUTO E ALTERA O VALOR DESSE PRODUTO NO ESTOQUE...
        public function inventariaProduto(string $nome_invntario, string $criado_por, string $data_inicio, string $data_final, string $descricao, string $unidade_medida, string $estoque, string $diferenca_estoque, string $status_inv_produto, string $status_inventario) : void
        {

            // VALIDA SE O VALOR INFORMADO CONTADO DO ESTOQUE É UM NÚMERO NÃO INTEIRO OU NEGATIVO ...
            $estoque = $this->validaValorInteiro('estoque', 'estoque', "../../inventario.php?nome_inventario=$_GET[nome_inventario]&verifica_campos=numero_negativo");
            $estoque = $this->validaValorNegativo($estoque, "../../inventario.php?nome_inventario=$_GET[nome_inventario]&verifica_campos=numero_negativo");

            $sql = "INSERT INTO tb_inventarios (nome_inventario, criado_por, data_inicio, data_final, descricao, unidade_medida, estoque, diferenca_estoque, status_inv_produto, produto_inv_por, status_inventario) VALUES ( ?,?,?,?,?,?,?,?,?,?,? );
                    UPDATE tb_produtos SET estoque = ?, status_inv_produto = 'INVENTARIADO' WHERE descricao = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $nome_invntario, PDO::PARAM_STR);
            $stmt->bindValue(2, $criado_por, PDO::PARAM_STR);
            $stmt->bindValue(3, $data_inicio, PDO::PARAM_STR);
            $stmt->bindValue(4, $data_final, PDO::PARAM_STR);
            $stmt->bindValue(5, $descricao, PDO::PARAM_STR);
            $stmt->bindValue(6, $unidade_medida, PDO::PARAM_STR);
            $stmt->bindValue(7, $estoque, PDO::PARAM_STR);
            $stmt->bindValue(8, $diferenca_estoque, PDO::PARAM_STR);
            $stmt->bindValue(9, $status_inv_produto, PDO::PARAM_STR);
            $stmt->bindValue(10, $_SESSION['nome_usuario'], PDO::PARAM_STR);
            $stmt->bindValue(11, $status_inventario, PDO::PARAM_STR);
            $stmt->bindValue(12, $_POST['estoque'], PDO::PARAM_STR);
            $stmt->bindValue(13, $descricao, PDO::PARAM_STR);
            $stmt->execute();
        }

        // MÉTODO QUE FINALIZA O INENTÁRIO E RETORNA O STATUS DE INVENTARIOS DE TODOS OS PRODUTOS DO ESTOQUE PARA 'NÃO INVENTARIDO'...
        public function finalizaInventario(string $nome_inventario) : void
        {
            $data_atual = exibeDataAtual();

            $sql = "UPDATE tb_inventarios SET data_final = '$data_atual', status_inventario = 'FINALIZADO' WHERE nome_inventario = ?;
                    UPDATE tb_produtos SET status_inv_produto = 'NÃO INVENTARIADO';
                ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $nome_inventario, PDO::PARAM_STR);
            $stmt->execute();
        }

        // MÉTODO QUE VISUALIZA O UM INVENTÁRIO CONCLUÍDO...
        public function visualizaInventario(string $nome_inventario) : array
        {
            $sql = "SELECT *, DATE_FORMAT(data_inicio, '%d/%m/%Y') AS data_inicio FROM tb_inventarios WHERE nome_inventario = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $nome_inventario, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        // MÉTODO QUE EXCLUI O INVENTARIO EXIBIDO...
        public function excluiInventario(string $nome_inventario) : void
        {
            $sql = "DELETE FROM tb_inventarios WHERE nome_inventario = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $nome_inventario, PDO::PARAM_STR);
            $stmt->execute();
        }

    }