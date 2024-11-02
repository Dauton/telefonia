<?php

require_once "Validacoes.php";

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
    public function cadastraUsuario(string $nome, string $matricula, string $unidade, string $cargo, string $perfil, string $usuario, string $senha, string $repete_senha, PDO $pdo): void
    {

        // VALIDA OS CAMPOS...
        Validacoes::validaCampoVazio($nome, "../../cadastrar_usuario.php?verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($matricula, "../../cadastrar_usuario.php?verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($unidade, "../../cadastrar_usuario.php?verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($cargo, "../../cadastrar_usuario.php?verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($perfil, "../../cadastrar_usuario.php?verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($usuario, "../../cadastrar_usuario.php?verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($senha, "../../cadastrar_usuario.php?verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($repete_senha, "../../cadastrar_usuario.php?verifica_campo=todos_campos");
        Validacoes::validaNomeCompleto($nome, "../../cadastrar_usuario.php?usuario=nome_incompleto");
        Validacoes::validaCampoNumerico('matricula', "../../cadastrar_usuario.php?verifica_campo=matricula_nao_numerico");
        Validacoes::validaUsuarioExistenteCadastro($usuario, "../../cadastrar_usuario.php?usuario=usuario_ja_cadastrado", $pdo);

        Validacoes::validaComprimentoSenha($senha, '../../cadastrar_usuario.php?verifica_senha=senha_curta');
        Validacoes::validaNumeroSenha($senha, '../../cadastrar_usuario.php?verifica_senha=numeros');
        Validacoes::validaCaractereEspecialSenha($senha, '../../cadastrar_usuario.php?verifica_senha=caracteres_especiais');
        Validacoes::validaSenhaRepeteSenha($senha, $repete_senha, '../../cadastrar_usuario.php?verifica_senha=desiguais');

        $sql = "INSERT INTO tb_usuarios (nome, matricula, unidade, cargo, perfil, usuario, senha, cadastrado_por, status, senha_primeiro_acesso) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, mb_strtoupper(trim($nome)), PDO::PARAM_STR);
        $stmt->bindValue(2, trim($matricula), PDO::PARAM_STR);
        $stmt->bindValue(3, mb_strtoupper(trim($unidade)), PDO::PARAM_STR);
        $stmt->bindValue(4, mb_strtoupper(trim($cargo)), PDO::PARAM_STR);
        $stmt->bindValue(5, mb_strtoupper(trim($perfil)), PDO::PARAM_STR);
        $stmt->bindValue(6, mb_strtolower(trim($usuario)), PDO::PARAM_STR);
        $senha = password_hash($senha, PASSWORD_ARGON2ID);
        $stmt->bindValue(7, trim($senha), PDO::PARAM_STR);
        $stmt->bindValue(8, $_SESSION['nome']);
        $stmt->bindValue(9, 'ATIVADO');
        $stmt->bindValue(10, 'PENDENTE');
        $stmt->execute();
    }

    // MÉTODO QUE BUSCA O ID DO USUÁRIO SELECIONADO PARA EDIÇÃO
    public function buscaIdUsuario(int $id_usuario): array
    {
        $sql = "SELECT * FROM tb_usuarios WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // MÉTODO QUE EDITA O USUÁRIO SELECIONADO
    public function editaUsuario(string $nome, string $matricula, string $unidade, string $cargo, string $perfil, string $usuario, string $status, PDO $pdo): void
    {
        $sql = "UPDATE tb_usuarios SET nome = ?, matricula = ?, unidade = ?, cargo = ?, perfil = ?, usuario = ?, status = ? WHERE id_usuario = ?";

        // VALIDA SE EXISTE ALGUM CAMPO NÃO PREENCHIDO...
        Validacoes::validaCampoVazio($nome, "../../editar_usuario.php?id_usuario=$_GET[id_usuario]&verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($matricula, "../../editar_usuario.php?id_usuario=$_GET[id_usuario]&verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($unidade, "../../editar_usuario.php?id_usuario=$_GET[id_usuario]&verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($cargo, "../../editar_usuario.php?id_usuario=$_GET[id_usuario]&verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($perfil, "../../editar_usuario.php?id_usuario=$_GET[id_usuario]&verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($usuario, "../../editar_usuario.php?id_usuario=$_GET[id_usuario]&verifica_campo=todos_campos");
        Validacoes::validaCampoVazio($status, "../../editar_usuario.php?id_usuario=$_GET[id_usuario]&verifica_campo=todos_campos");
        Validacoes::validaNomeCompleto($nome, "../../cadastrar_usuario.php?usuario=nome_incompleto");
        Validacoes::validaCampoNumerico('matricula', "../../cadastrar_usuario.php?verifica_campo=matricula_nao_numerico");
        Validacoes::validaUsuarioExistenteEdição($usuario,"editar_usuario.php?id_usuario=$_GET[id_usuario]&usuario=usuario_ja_cadastrado", $pdo);
        Validacoes::validaNomeCompleto($nome, "../../editar_usuario.php?id_usuario=$_GET[id_usuario]&verifica_campo=nome_incompleto");

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, mb_strtoupper(trim($nome)), PDO::PARAM_STR);
        $stmt->bindValue(2, trim($matricula), PDO::PARAM_STR);
        $stmt->bindValue(3, mb_strtoupper(trim($unidade)), PDO::PARAM_STR);
        $stmt->bindValue(4, mb_strtoupper(trim($cargo)), PDO::PARAM_STR);
        $stmt->bindValue(5, mb_strtoupper(trim($perfil)), PDO::PARAM_STR);
        $stmt->bindValue(6, mb_strtolower(trim($usuario)), PDO::PARAM_STR);
        $stmt->bindValue(7, trim($status), PDO::PARAM_STR);
        $stmt->bindValue(8, $_GET['id_usuario'], PDO::PARAM_INT);

        $stmt->execute();
    }

    // MÉTODO QUE RESETA A MINHA SENHA OU DO USUÁRIO SELECIONADO
    public function resetaSenhaUsuario(int $id_usuario, string $senha, string $senha_primeiro_acesso): void
    {
            // VALIDA A MINHA SENHA
        if($_GET['id_usuario'] === null) {
            Validacoes::validaComprimentoSenha($senha, "minha_senha.php?verifica_senha=senha_curta");
            Validacoes::validaNumeroSenha($senha, "minha_senha.php?verifica_senha=numeros");
            Validacoes::validaCaractereEspecialSenha($senha, "minha_senha.php?verifica_senha=caracteres_especiais");
            Validacoes::validaSenhaRepeteSenha($senha, $_POST['repete_senha'], "minha_senha.php?verifica_senha=desiguais");
        } else {
            // VALIDA A SENHA DE OUTRO USUÁRIO
            Validacoes::validaComprimentoSenha($senha, "$_SERVER[HTTP_REFERER]&verifica_senha=senha_curta");
            Validacoes::validaNumeroSenha($senha, "$_SERVER[HTTP_REFERER]&verifica_senha=numeros");
            Validacoes::validaCaractereEspecialSenha($senha, "$_SERVER[HTTP_REFERER]&verifica_senha=caracteres_especiais");
            Validacoes::validaSenhaRepeteSenha($senha, $_POST['repete_senha'], "$_SERVER[HTTP_REFERER]&verifica_senha=desiguais");
        }

        $sql = "UPDATE tb_usuarios SET senha = ?, senha_primeiro_acesso = ? WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        $senha = password_hash($senha, PASSWORD_ARGON2ID);
        $stmt->bindValue(1, $senha, PDO::PARAM_STR);
        $stmt->bindValue(2, $senha_primeiro_acesso, PDO::PARAM_STR);
        $stmt->bindValue(3, $id_usuario, PDO::PARAM_INT);

        $stmt->execute();
    }

    // MÉTODO QUE EXCLUI O USUÁRIO SELECIONADO
    public function excluiUsuario(int $id_usuario): void
    {
        // EXCLUI O USUÁRIO...
        $sqlDeletaUsuario = "DELETE FROM tb_usuarios WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sqlDeletaUsuario);
        $stmt->bindValue(1, $id_usuario, PDO::PARAM_INT);

        $stmt->execute();
    }
}
