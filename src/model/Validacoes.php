<?php

class Validacoes
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public static function validaCampoVazio($campo, $caminho) : mixed
    {

        $valor = filter_input(INPUT_POST, $campo);

        if($valor === false || empty($valor)) {
            header("Location: $caminho");
            die();
        }
        return $valor;

    }

    public static function validaCampoNumerico($campo, $caminho)
    {
        $valor = filter_input(INPUT_POST, $campo, FILTER_VALIDATE_INT);
        if($valor === false) {
            header("Location: $caminho");
            die();
        }
        return $valor;
    }

    public static function validaCampoEmail($campo, $caminho): mixed
    {
        $valor = filter_input(INPUT_POST, $campo, FILTER_VALIDATE_EMAIL);
        if($valor === false) {
            header("Location: $caminho");
            echo "O e-mail informado não é válido";
            die();
        }
        return $valor;
    }


    public static function executaValidacoes(): void                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
    {
        // VALIDA CAMPOS VAZIOS
        if ($_POST['possui_linha'] === 'Sim') {
            Validacoes::validaCampoVazio('linha', "../../cadastrar_dispositivo.php?verifica_campo=campo_linha_vazio");
            Validacoes::validaCampoVazio('operadora', "../../cadastrar_dispositivo.php?verifica_campo=campo_operadora_vazio");
        }
        if ($_POST['possui_aparelho'] === 'Sim') {
            Validacoes::validaCampoVazio('marca_aparelho', "../../cadastrar_dispositivo.php?verifica_campo=campo_marca_vazio");
            Validacoes::validaCampoVazio('modelo_aparelho', "../../cadastrar_dispositivo.php?verifica_campo=campo_modelo_vazio");
        }
        if ($_POST['possui_usuario'] === 'Sim') {
            Validacoes::validaCampoVazio('nome', "../../cadastrar_dispositivo.php?verifica_campo=campo_nome_vazio");
        }
        if ($_POST['possui_linha'] === 'Sim' || $_POST['possui_aparelho'] === 'Sim' || $_POST['possui_usuario'] === 'Sim') {
            Validacoes::validaCampoVazio('unidade', "../../cadastrar_dispositivo.php?verifica_campo=campos_localidade");
            Validacoes::validaCampoVazio('centro_custo', "../../cadastrar_dispositivo.php?verifica_campo=campos_localidade");
            Validacoes::validaCampoVazio('uf', "../../cadastrar_dispositivo.php?verifica_campo=campos_localidade");
            Validacoes::validaCampoVazio('canal', "../../cadastrar_dispositivo.php?verifica_campo=campos_localidade");
            Validacoes::validaCampoVazio('ponto_focal', "../../cadastrar_dispositivo.php?verifica_campo=campos_localidade");
            Validacoes::validaCampoVazio('gestor', "../../cadastrar_dispositivo.php?verifica_campo=campos_localidade");
        }

        // VALIDA CAMPOS NUMÉRICOS...
        if (isset($_POST['linha']) && trim($_POST['linha'] !== '')) {
            Validacoes::validaCampoNumerico('linha', "../../cadastrar_dispositivo.php?verifica_campo=linha_nao_numerico");
        }
        if (isset($_POST['imei_aparelho']) && trim($_POST['imei_aparelho'] !== '')) {
            Validacoes::validaCampoNumerico('imei_aparelho', "../../cadastrar_dispositivo.php?verifica_campo=imei_nao_numerico");
        }
        if (isset($_POST['sim_card']) && trim($_POST['sim_card'] !== '')) {
            Validacoes::validaCampoNumerico('sim_card', "../../cadastrar_dispositivo.php?verifica_campo=sim_card_nao_numerico");
        }
        if (isset($_POST['centro_custo']) && trim($_POST['centro_custo'] !== '')) {
            Validacoes::validaCampoNumerico('centro_custo', "../../cadastrar_dispositivo.php?verifica_campo=centro_custo_nao_numerico");
        }
        if (isset($_POST['matricula']) && trim($_POST['matricula'] !== '')) {
            Validacoes::validaCampoNumerico('matricula', "../../cadastrar_dispositivo.php?verifica_campo=matricula_nao_numerico");
        }

        // VALIDA CAMPO DE E-MAIL...
        if (!empty($_POST['email'])) {
            Validacoes::validaCampoEmail('email', "../../cadastrar_dispositivo.php?verifica_campo=email_invalido");
        }

        // VALIDA SE POSSUI PELO MENOS LINHA OU APARELHO
        if($_POST['possui_linha'] === 'Não' && $_POST['possui_aparelho'] === 'Não')
        {
            header("Location: ../../cadastrar_dispositivo.php?verifica_campo=linha_ou_aparelho");
            die();
        }
    }

}