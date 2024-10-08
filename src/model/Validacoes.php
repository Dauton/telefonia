<?php

class Validacoes
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public static function validaCampoVazio(string $campo, string $caminho): void
    {

        if($campo === false || $campo === null || $campo === "") {
            header("Location: $caminho");
            die();
        }
    }

    public static function validaCampoNumerico(string $campo, string $caminho): mixed
    {
        $valor = filter_input(INPUT_POST, $campo, FILTER_VALIDATE_INT);
        if ($valor === false) {
            header("Location: $caminho");
            die();
        }
        return $valor;
    }

    public static function validaCampoEmail(string $campo, string $caminho): mixed
    {
        $valor = filter_input(INPUT_POST, $campo, FILTER_VALIDATE_EMAIL);
        if ($valor === false) {
            header("Location: $caminho");
            die();
        }
        return $valor;
    }

    public static function validaNomeCompleto(string $campo, string $caminho): void
    {
        if (str_word_count($campo) < 2) {
            header("Location: $caminho");
            die();
        }
    }

    public static function validaComprimentoSenha(string $senha, string $caminho): void
    {
        if(strlen($senha) < 12) {
            header("Location: $caminho");
            die();
        }
    }

    public static function validaNumeroSenha(string $senha, string $caminho): void
    {
        if(!preg_match("%[0-1]%", $senha)) {
            header("Location: $caminho");
            die();
        }
    }

    public static function validaCaractereEspecialSenha(string $senha, $caminho): void
    {
        if(!strpbrk($senha, "!@#$%¨&*()_-=+{[}]?/:;>.")) {
            header("Location: $caminho");
            die();
        }
    }

    public static function validaSenhaRepeteSenha(string $senha, string $repete_senha, $caminho): void
    {
        if($senha != $repete_senha) {
            header("Location: $caminho");
            die();
        }
    }

    public static function validaUsuarioExistenteCadastro(string $usuario, string $caminho, PDO $pdo) 
    {
        $sqlValidaUsuario = "SELECT * FROM tb_usuarios WHERE usuario = :usuario";
        $stmt = $pdo->prepare($sqlValidaUsuario);
        $stmt->bindValue(":usuario", $usuario);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if($usuario === $resultado['usuario']) {
            header("Location: $caminho");
            die();
        }
    }

    public static function validaUsuarioExistenteEdição(string $usuario, string $caminho, PDO $pdo) 
    {
        $sqlValidaUsuario = "SELECT * FROM tb_usuarios WHERE usuario = :usuario AND id_usuario != :id_usuario";
        $stmt = $pdo->prepare($sqlValidaUsuario);
        $stmt->bindValue(":usuario", $usuario);
        $stmt->bindValue(":id_usuario", $_GET['id_usuario']);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if($usuario === $resultado['usuario']) {
            header("Location: editar_usuario.php?id_usuario=$_GET[id_usuario]&usuario=usuario_ja_cadastrado");
            die();
        }
    }
    
}
