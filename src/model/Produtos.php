<?php

class Produtos
{

    public function __construct(private PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // EXIBE TODOS OS PRODUTOS DO ESTOQUE
    public function exibeProdutos(): array
    {
        $sql = "SELECT *, DATE_FORMAT(ultima_modificacao, '%d/%m/%Y às %H:%i') AS ultima_modificacao FROM tb_produtos ORDER BY categoria";
        $stmt = $this->pdo->query($sql);
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // VALIDA SE OS CAMPOS INFORMADOS QUE DEVEM SER NÚMEROS SÃO REALMENTE NÚMEROS...
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

    // CADASTRA UM NOVO PRODUTO NO ESTOQUE
    public function cadastraProduto(string $descricao, string $unidade_medida, string $estoque, string $consumo_diario, string $prazo_entrega, string $aprovacao_oc, string $categoria): void
    {

        // CHAMA O MÉTODO validaValorInformado PARA VALIDAR OS CAMPOS QUE DEVEM SER UM NÚMERO INTEIRO...
        $estoque = $this->validaValorInteiro('estoque', 'estoque', "../../cadastrar_produto.php?verifica_campos=nao_numerico");
        $consumo_diario = $this->validaValorInteiro("consumo_diario", "consumo_diario", "../../cadastrar_produto.php?verifica_campos=nao_numerico");
        $prazo_entrega = $this->validaValorInteiro("prazo_entrega", "prazo_entrega", "../../cadastrar_produto.php?verifica_campos=nao_numerico");
        $aprovacao_oc = $this->validaValorInteiro("aprovacao_oc", "aprovacao_oc", "../../cadastrar_produto.php?verifica_campos=nao_numerico");

        // CHAMA O MÉTODO validaValorNegativo PARA VALIDAR OS CAMPOS QUE DEVEM SER MAIOR OU IGUAL A 0...
        $estoque = $this->validaValorNegativo($estoque, '../../cadastrar_produto.php?verifica_campos=numero_negativo');
        $consumo_diario = $this->validaValorNegativo($consumo_diario, '../../cadastrar_produto.php?verifica_campos=numero_negativo');
        $prazo_entrega = $this->validaValorNegativo($prazo_entrega, '../../cadastrar_produto.php?verifica_campos=numero_negativo');
        $aprovacao_oc = $this->validaValorNegativo($aprovacao_oc, '../../cadastrar_produto.php?verifica_campos=numero_negativo');

        // O ESTOQUE MÍNIMO SERÁ O RESULTADO DO CALCULO DO CONSUMO DIÁRIO INFORMADO + O PRAZO DE ENTREGA INFORMADO MULTIPLICADO PELO PRAZO DE APROVAÇÃO DA OC PELA GERÊNCIA INFORMADO...
        $estoque_minimo = ($consumo_diario + $prazo_entrega) * $aprovacao_oc;

        $sql = "INSERT INTO tb_produtos (descricao,unidade_medida, estoque, consumo_diario, prazo_entrega, aprovacao_oc, estoque_minimo, categoria, status_inv_produto) VALUES (?,?,?,?,?,?, '$estoque_minimo', ?, 'NÃO INVENTARIADO')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, ucwords(trim($descricao)), PDO::PARAM_STR);
        $stmt->bindValue(2, trim($unidade_medida), PDO::PARAM_STR);
        $stmt->bindValue(3, trim($estoque), PDO::PARAM_STR);
        $stmt->bindValue(4, trim($consumo_diario), PDO::PARAM_STR);
        $stmt->bindValue(5, trim($prazo_entrega), PDO::PARAM_STR);
        $stmt->bindValue(6, trim($aprovacao_oc), PDO::PARAM_STR);
        $stmt->bindValue(7, trim($categoria), PDO::PARAM_STR);
        $stmt->execute();
    }

    // BUSCA O ID DO PRODUTO SELECIOADO PARA EDIÇÃO
    public function buscaIdProduto(int $id): array
    {
        $sql = "SELECT * FROM tb_produtos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // EDITA O PRODUTO SELECIONADO DO ESTOQUE
    public function editaProduto(int $id, string $descricao, string $unidade_medida, string $estoque, string $consumo_diario, string $prazo_entrega, string $aprovacao_oc, string $categoria): void
    {

        // CHAMA O MÉTODO validaValorInformado PARA VALIDAR OS CAMPOS QUE DEVEM SER UM NÚMERO INTEIRO...
        $estoque = $this->validaValorInteiro('estoque', 'estoque', "../../editar_produto.php?id=$_GET[id]&verifica_campos=nao_numerico");
        $consumo_diario = $this->validaValorInteiro("consumo_diario", "consumo_diario", "../../editar_produto.php?id=$_GET[id]&verifica_campos=nao_numerico");
        $prazo_entrega = $this->validaValorInteiro("prazo_entrega", "prazo_entrega", "../../editar_produto.php?id=$_GET[id]&verifica_campos=nao_numerico");
        $aprovacao_oc = $this->validaValorInteiro("aprovacao_oc", "aprovacao_oc", "../../editar_produto.php?id=$_GET[id]&verifica_campos=nao_numerico");

        // CHAMA O MÉTODO validaValorNegativo PARA VALIDAR OS CAMPOS QUE DEVEM SER MAIOR OU IGUAL A 0...
        $estoque = $this->validaValorNegativo($estoque, "../../editar_produto.php?id=$_GET[id]&verifica_campos=numero_negativo");
        $consumo_diario = $this->validaValorNegativo($consumo_diario, "../../editar_produto.php?id=$_GET[id]&verifica_campos=numero_negativo");
        $prazo_entrega = $this->validaValorNegativo($prazo_entrega, "../../editar_produto.php?id=$_GET[id]&verifica_campos=numero_negativo");
        $aprovacao_oc = $this->validaValorNegativo($aprovacao_oc, "../../editar_produto.php?id=$_GET[id]&verifica_campos=numero_negativo");

        // O ESTOQUE MÍNIMO SERÁ O RESULTADO DO CALCULO DO CONSUMO DIÁRIO INFORMADO + O PRAZO DE ENTREGA INFORMADO MULTIPLICADO PELO PRAZO DE APROVAÇÃO DA OC PELA GERÊNCIA INFORMADO...
        $estoque_minimo = ($consumo_diario + $prazo_entrega) * $aprovacao_oc;

        $sqlAtualizaProduto = "UPDATE tb_produtos SET descricao = ?, unidade_medida = ?, estoque = ?, consumo_diario = ?, prazo_entrega = ?, aprovacao_oc = ?, estoque_minimo = '$estoque_minimo', categoria = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sqlAtualizaProduto);
        $stmt->bindValue(1, ucwords(trim($descricao)), PDO::PARAM_STR);
        $stmt->bindValue(2, trim($unidade_medida), PDO::PARAM_STR);
        $stmt->bindValue(3, trim($estoque), PDO::PARAM_STR);
        $stmt->bindValue(4, trim($consumo_diario), PDO::PARAM_STR);
        $stmt->bindValue(5, trim($prazo_entrega), PDO::PARAM_STR);
        $stmt->bindValue(6, trim($aprovacao_oc), PDO::PARAM_STR);
        $stmt->bindValue(7, trim($categoria), PDO::PARAM_STR);
        $stmt->bindValue(8, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // EXCLUI O PRODUTO DO ESTOQUE
    public function excluiProduto(int $id): void
    {
        $sql = "DELETE FROM tb_produtos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
