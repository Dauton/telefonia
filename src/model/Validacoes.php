<?php

class Validacoes
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // MÉTODO QUE VALIDA SE O CAMPO ESTÁ PREENCHIDO...
    public static function validaCampoVazio(string $campo, string $caminho): void
    {

        if($campo === false || $campo === null || $campo === "") {
            header("Location: $caminho");
            die();
        }
    }

    // MÉTODO QUE VALIDA O VALOR INFORMADO EM UM CAMPO NUMÉRICO... 
    public static function validaCampoNumerico(string $campo, string $caminho): mixed
    {
        $valor = filter_input(INPUT_POST, $campo, FILTER_VALIDATE_INT);
        if ($valor === false) {
            header("Location: $caminho");
            die();
        }
        return $valor;
    }

    // MÉTODO QUE VALIDA SE O E-MAIL INFORMADO ESTÁ EM UM FORMATO DE E-MAIL CORRETO...
    public static function validaCampoEmail(string $campo, string $caminho): mixed
    {
        $valor = filter_input(INPUT_POST, $campo, FILTER_VALIDATE_EMAIL);
        if ($valor === false) {
            header("Location: $caminho");
            die();
        }
        return $valor;
    }

    // MÉTODO QUE VALIDA SE A EXTENSÃO DO ARQUIVO ANEXADO É UM DOS PERMITIDOS...
    public static function validaArquivoAnexado(?string $arquivo, string $caminho) : void
    {
        $paphinfo = pathinfo($arquivo, PATHINFO_EXTENSION);

        if(
            $paphinfo != 'doc' &&
            $paphinfo != 'docx' &&
            $paphinfo != 'pdf' &&
            $paphinfo != 'xls' &&
            $paphinfo != 'xlsx' &&
            $paphinfo != 'jpg' &&
            $paphinfo != 'jpeg' &&
            $paphinfo != 'png' &&
            $paphinfo != '' &&
            $paphinfo != null
        ) {

            header("Location: $caminho");
            die();
        }
    }

    // MÉTODO QUE VALIDA SE O NOME DE USUÁRIO POSSUI SOBRENOME...
    public static function validaNomeCompleto(string $campo, string $caminho): void
    {
        if (str_word_count($campo) < 2) {
            header("Location: $caminho");
            die();
        }
    }

    // MÉTODO QUE VALIDA SE A SENHA INFORMADA POSSUI 12 DÍGITOS OU MAIS...
    public static function validaComprimentoSenha(string $senha, string $caminho): void
    {
        if(strlen($senha) < 12) {
            header("Location: $caminho");
            die();
        }
    }

    // MÉTODO QUE VALIDA SE NA SENHA INFORMADA CONTÉM PELO MENOS UM NÚNMERO...
    public static function validaNumeroSenha(string $senha, string $caminho): void
    {
        if(!preg_match("%[0-1]%", $senha)) {
            header("Location: $caminho");
            die();
        }
    }

    // MÉTODO QUE VALIDA SE NA SENHA INFORMA CONTÉM PELO  MENOS UM CARACTERE ESPECIAL...
    public static function validaCaractereEspecialSenha(string $senha, $caminho): void
    {
        if(!strpbrk($senha, "!@#$%¨&*()_-=+{[}]?/:;>.")) {
            header("Location: $caminho");
            die();
        }
    }

    // MÉTODO QUE VALIDA SE A SENHA DE REPETIÇÃO É IDENTICA A SENHA INFORMADA...
    public static function validaSenhaRepeteSenha(string $senha, string $repete_senha, $caminho): void
    {
        if($senha != $repete_senha) {
            header("Location: $caminho");
            die();
        }
    }

    // MÉTODO QUE VALIDA NO MOMENTO DO CADASTRO SE O USUÁRIO INFORMADO JÁ EXISTE...
    public static function validaUsuarioExistenteCadastro(string $usuario, string $caminho, PDO $pdo): void 
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

    // MÉTODO QUE VALIDA NO MOMENTO DA EDIÇÃO SE O USUÁRIO INFORMADO JÁ EXISTE...
    public static function validaUsuarioExistenteEdição(string $usuario, string $caminho, PDO $pdo): void 
    {
        $sqlValidaUsuario = "SELECT * FROM tb_usuarios WHERE usuario = :usuario AND id_usuario != :id_usuario";
        $stmt = $pdo->prepare($sqlValidaUsuario);
        $stmt->bindValue(":usuario", $usuario);
        $stmt->bindValue(":id_usuario", $_GET['id_usuario']);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if($usuario === $resultado['usuario']) {
            header("Location: $caminho");
            die();
        }
    }

    // MÉTODO QUE VALIDA NO MOMENTO DO CADASTRO SE A OPÇÃO INFORMADA JÁ EXISTE...
    public static function validaOpcaoExistenteCadastro(string $descricao, string $caminho, PDO $pdo): void
    {
        $sql = "SELECT * FROM tb_cadastros_opcoes WHERE descricao = :descricao";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":descricao", $descricao);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if($descricao === $resultado['descricao']) {
            header("Location: $caminho");
            die();
        }
    }

    // MÉTODO QUE VALIDA NO MOMENTO DA EDIÇÃO SE A OPÇÃO INFORMADA JÁ EXISTE...
    public static function validaOpcaoExistenteEdicao(string $descricao, string $caminho, PDO $pdo): void
    {
        $sql = "SELECT * FROM tb_cadastros_opcoes WHERE descricao = :descricao and id != :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":descricao", $descricao);
        $stmt->bindValue(":id", $_GET['id']);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if($descricao === $resultado['descricao']) {
            header("Location: $caminho");
            die();
        }
    }
    
}
