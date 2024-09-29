<?php


class Usuario
{
    public function __construct(private PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // EXIBE TODOS OS USUÁRIOS CADASTRADOS
    public function exibeUsuarios(): array
    {
        $sql = "SELECT *, DATE_FORMAT(data_cadastro, '%d/%m/%Y') AS data_cadastro FROM tb_usuarios";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // MÉTODO QUE CADASTRA USUÁRIO
    public function cadastraUsuario(string $nome_usuario, string $usuario, string $senha, string $perfil): void
    {
        // VALIDA SE O NOME INFORMADO ESTÁ COMPLETO...
        if (str_word_count($nome_usuario) < 2) {
            header("Location: cadastrar_usuario.php?verifica_cadastro=erro_no_cadastro");
            die();
        }

        // VERIFICA SE O USUÁRIO INFORMADO JÁ EXISTE NO BANCO DE DADOS...
        $sql = "SELECT * FROM tb_usuarios WHERE usuario = :usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':usuario' => $usuario]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {

            if ($usuario === $resultado['usuario']) {
                header("Location: ../../cadastrar_usuario.php?verifica_cadastro=usuario_ja_cadastrado");
                echo "Esse usuário já está cadastrado";
            }
        }

        // SALVA O CAMINHO DA IMAGEM ESCOLHIDA NA PASTA E O CAMINHO DESSA IMAGEM NO BANCO DE DADOS...
        if (isset($_FILES['foto_perfil']) && !empty($_FILES['foto_perfil']) && !empty($_FILES['foto_perfil']['name'])) {

            $salva_imagem = uniqid() . $_FILES['foto_perfil']['name'];
            move_uploaded_file($_FILES['foto_perfil']['tmp_name'], "img/fotos_perfil/" . $salva_imagem);

            $foto_perfil = "img/fotos_perfil/" . $salva_imagem;
            move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $foto_perfil);
        } else {
            $foto_perfil = "";
        }

        $sql = "INSERT INTO tb_usuarios (nome_usuario, usuario, senha, perfil, foto_perfil, status, cadastrado_por, senha_primeiro_acesso) VALUES (?,?,?,?,?, 'Ativado', ?, 'Pendente')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, ucwords(trim($nome_usuario)), PDO::PARAM_STR);
        $stmt->bindValue(2, trim($usuario), PDO::PARAM_STR);
        $senha = password_hash($senha, PASSWORD_ARGON2ID);
        $stmt->bindValue(3, trim($senha), PDO::PARAM_STR);
        $stmt->bindValue(4, trim($perfil), PDO::PARAM_STR);
        $stmt->bindValue(5, trim($foto_perfil), PDO::PARAM_STR);
        $stmt->bindValue(6, trim($_SESSION['nome_usuario']), PDO::PARAM_STR);
        $stmt->execute();
    }

    // MÉTODO QUE BUSCA O ID DO USUÁRIO SELECIONADO PARA EDIÇÃO
    public function buscaIdUsuario(int $id_usuario): array
    {
        $sql = "SELECT * FROM tb_usuarios WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // MÉTODO QUE EDITA O USUÁRIO SELECIONADO
    public function editaUsuario(int $id_usuario, string $nome_usuario, string $usuario, string $perfil, string $status): void
    {
        // VALIDA SE O NOME INFORMADO ESTÁ COMPLETO...
        if (str_word_count($nome_usuario) < 2) {
            header("Location: cadastrar_usuario.php?verifica_cadastro=erro_no_cadastro");
            die();
        }

        // VERIFICA SE O USUÁRIO INFORMADO JÁ EXISTE NO BANCO DE DADOS...
        $sql = "SELECT * FROM tb_usuarios WHERE usuario = :usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':usuario' => $usuario]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {

            if ($usuario === $resultado['usuario']) {
                header("Location: $_SERVER[HTTP_REFERER]&verifica_cadastro=usuario_ja_cadastrado");
            }
        }

        $sql = "UPDATE tb_usuarios SET nome_usuario = ?, usuario = ?, perfil = ?, status = ? WHERE id_usuario = ?;
                UPDATE tb_requisicoes_historico SET solicitante_historico = ?, baixa_historico = ? WHERE id_solicitante_historico = ?;
                UPDATE tb_requisicoes SET solicitante = ? WHERE id_solicitante = ?;
                UPDATE tb_logs_produtos SET usuario = ? WHERE id_usuario = ?;
            ";

        // ATUALIZA O NOME DO USUÁRIO
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, ucwords(trim($nome_usuario)), PDO::PARAM_STR);
        $stmt->bindValue(2, trim($usuario), PDO::PARAM_STR);
        $stmt->bindValue(3, trim($perfil), PDO::PARAM_STR);
        $stmt->bindValue(4, trim($status), PDO::PARAM_STR);
        $stmt->bindValue(5, trim($id_usuario), PDO::PARAM_INT);

        // ATUALIZA O NOME NAS REQUISIÇÕES
        $stmt->bindValue(6, ucwords(trim($nome_usuario)), PDO::PARAM_STR);
        $stmt->bindValue(7, ucwords(trim($nome_usuario)), PDO::PARAM_STR);
        $stmt->bindValue(8, $id_usuario, PDO::PARAM_INT);

        // ATUALIZA O NOME NO HISTORICO DE REQUISIÇÕES
        $stmt->bindValue(9, ucwords(trim($nome_usuario)), PDO::PARAM_STR);
        $stmt->bindValue(10, $id_usuario, PDO::PARAM_INT);

        // ATUALIZA O NOME NO REGISTRO DE LOGS DE PRODUTOS
        $stmt->bindValue(11, ucwords(trim($nome_usuario)), PDO::PARAM_STR);
        $stmt->bindValue(12, $id_usuario, PDO::PARAM_INT);

        $stmt->execute();
    }

    // MÉTODO QUE RESETA A MINHA SENHA OU DO USUÁRIO SELECIONADO
    public function resetaSenhaUsuario(int $id_usuario, string $senha): void
    {
        $sql = "UPDATE tb_usuarios SET senha = ? WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        $senha = password_hash($senha, PASSWORD_ARGON2ID);
        $stmt->bindValue(1, $senha, PDO::PARAM_STR);
        $stmt->bindValue(2, $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
    }

    // MÉTODO QUE EXCLUI O USUÁRIO SELECIONADO
    public function excluiUsuario(int $id_usuario): void
    {

        // VERIFICA SE EXISTEM REQUISIÇÕES EM ABERTO DESSE USUÁRIO, POIS AO SER EXCLUÍDO, SEU HISTORICO DE REQUISIÇÕES TAMBÉM SERÃO EXCLUÍDOS...
        $sqlVerificaEmAberto = "SELECT COUNT(*) FROM tb_requisicoes_historico WHERE id_solicitante_historico = ? AND status_historico = 'Em aberto'";
        $stmt = $this->pdo->prepare($sqlVerificaEmAberto);
        $stmt->bindValue(1, $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetchColumn();

        if ($resultado <= 0) {

            // EXCLUI AS REQUISIÇÕES DESSE USUÁRIO...
            $sqlDeletaRequisicoes = "DELETE FROM tb_requisicoes_historico WHERE id_solicitante_historico = ?";
            $stmt = $this->pdo->prepare($sqlDeletaRequisicoes);
            $stmt->bindValue(1, $id_usuario, PDO::PARAM_INT);
            $stmt->execute();

            // EXCLUI O USUÁRIO...
            $sqlDeletaUsuario = "DELETE FROM tb_usuarios WHERE id_usuario = ?";
            $stmt = $this->pdo->prepare($sqlDeletaUsuario);
            $stmt->bindValue(1, $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
        } else {

            header("Location: ../../gerenciar_usuarios.php?exclui_usuario=erro_na_exclusao");
            die();
        }
    }
}
