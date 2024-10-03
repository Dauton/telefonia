<?php

class Validacoes
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public static function validaCampoVazio($valor, $caminho): mixed
    {
        if ($valor === false || empty(trim($valor))) {
            header("Location: $caminho");
            die();
        }
        return $valor;
    }


    public static function validaCampoNumerico($campo, $caminho)
    {
        $valor = filter_input(INPUT_POST, $campo, FILTER_VALIDATE_INT);
        if ($valor === false) {
            header("Location: $caminho");
            die();
        }
        return $valor;
    }

    public static function validaCampoEmail($campo, $caminho): mixed
    {
        $valor = filter_input(INPUT_POST, $campo, FILTER_VALIDATE_EMAIL);
        if ($valor === false) {
            header("Location: $caminho");
            die();
        }
        return $valor;
    }

    public static function validaNomeCompleto($campo, $caminho)
    {
        if (str_word_count($campo) < 2) {
            header("Location: $caminho");
            die();
        }
    }
}
