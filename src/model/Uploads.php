<?php

class Uploads
{
    private PDO $pdo;

    public function __construct(PDO $pdo) 
    {
        $this->pdo = $pdo;
    }

    // GRAVA O ARQUIVO NO SERVIDOR E GRAVA SEU CAMINHO/NOME NO BANCO DE DADOS...
    public static function gravaArquivo() : void
    {
        
        $anexo = $_FILES['anexo'];
        $_FILES['anexo'] =  null;
    
        if(!empty($anexo['name'])) {
            $nome = $anexo['name'];
            $tmp_name = $anexo['tmp_name'];
        
            $extensao = pathinfo($nome, PATHINFO_EXTENSION);

            if(!empty($_GET['id'])) {
                $caminho = "../../editar_chamado.php?id=$_GET[id]&verifica_campo=arquivo_invalido";
            } else {
                $caminho = "../../abrir_chamado.php?verifica_campo=arquivo_invalido";
            }

            Validacoes::validaArquivoAnexado($nome, $caminho);

            $novo_nome = uniqid() . uniqid() . '.' . $extensao;
            move_uploaded_file($tmp_name, "uploads/" . $novo_nome);
    
            $_FILES['anexo'] = "uploads/" . $novo_nome;
        }
    }

    // EXCLUI O ARQUIVO DO SERVIDOR...
    public static function excluiArquivo($arquivo) : void
    {
        if(file_exists($arquivo)) {
            unlink($arquivo);
        }
    }

    public function removeAnexo(int $id, ?string $arquivo): void
    {
        $sql = "UPDATE tb_chamados SET anexo = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, null, PDO::PARAM_STR);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->execute();

        Uploads::excluiArquivo($arquivo);
    }

}