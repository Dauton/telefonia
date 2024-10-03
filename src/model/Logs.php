<?php

class Logs
{

    public function __construct(private PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // LOG DE PRODUTOS...
    // MÉTODO QUE REGISTRA O LOG DE ATIVIDADE REALIZADA NOS PRODUTOS...
    public function registraLogProduto(string $atividade): void
    {

        $sql = "INSERT INTO tb_logs_produtos(id_usuario, usuario, evento) VALUES (  ?, ?, ? )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $_SESSION['id_usuario'], PDO::PARAM_INT);
        $stmt->bindValue(2, $_SESSION['nome_usuario'], PDO::PARAM_STR);
        $stmt->bindValue(3, $atividade, PDO::PARAM_STR);
        $stmt->execute();
    }

    // MÉTODO QUE EXIBE OS REGISTROS DE ATIVIDADE NOS PRODUTOS DOS ÚLTIMOS 30 DIAS...
    public function exibeRegistrosLogProdutos(): array
    {
        $sql = "SELECT *, DATE_FORMAT(data_evento, '%W, %d/%m/%Y às %H:%i')
                AS data_evento
                FROM tb_logs_produtos
                WHERE data_evento >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                ORDER BY id DESC";
                
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }



    // LOG DE ACESSOS...
    // MÉTODO QUE REGISRRA O LOG DE TENTATIVA DE ACESSO AO SISTEMA...
    public function registraLogAcesso(string $usuario_informado, string $evento) : void
    {
        $sql = "INSERT INTO tb_logs_login (usuario_informado, evento) VALUES ( ?, ? )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $usuario_informado, PDO::PARAM_STR);
        $stmt->bindValue(2, $evento, PDO::PARAM_STR);
        $stmt->execute();
    }

    // MÉTODO QUE EXIBE OS REGISTROS DE TENTATIVAS DE ACESSOS AO SISTEMA DOS ÚLTIMOS 30 DIAS...
    public function exibeRegistrosLogAcessos(): array
    {
        $sql = "SELECT *, DATE_FORMAT(data_evento, '%W, %d/%m/%Y às %H:%i' )
                AS data_evento
                FROM tb_logs_login
                WHERE data_evento >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                ORDER BY id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }


    // MÉTODO QUE EXIBE OS REGISTROS DE CADASTRO, EXCLUSÃO E EDIÇÃO DE UM USUÁRIO DOS ÚLTIMOS 30 DIAS...
    public function exibeRegistrosLogUsuarios() : array
    {
        $sql = "SELECT *, DATE_FORMAT(data_evento, '%W, %d/%m/%Y às %H:%i:%s')
                AS data_evento
                FROM tb_logs_usuarios
                WHERE data_evento >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                ORDER BY id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $resultado;
    }
}
