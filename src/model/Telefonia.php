<?php

require_once "Validacoes.php";

class Telefonia
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastraDispositivo(string $linha, string $operadora, string $servico, string $perfil, string $status, string $data_ativacao, string $sim_card, string $marca_aparelho, string $modelo_aparelho, string $imei_aparelho, string $gestao_mdm, string $unidade, string $centro_custo, string $uf, string $canal, string $ponto_focal, string $gestor, string $nome, string $matricula, string $email, string $funcao): void
    {
        $sql = "INSERT INTO tb_dispositivos (
            linha, operadora, servico, perfil, status, data_ativacao, sim_card, marca_aparelho, modelo_aparelho, imei_aparelho, gestao_mdm, unidade, centro_custo, uf, canal, ponto_focal, gestor, nome, matricula, email, funcao
        ) VALUES (
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
        )";

        // VALIDA CAMPOS VAZIOS
        if ($_POST['possui_linha'] === 'Sim') {
            Validacoes::validaCampoVazio($linha, "../../cadastrar_dispositivo.php?verifica_campo=campo_linha_vazio");
            Validacoes::validaCampoVazio($operadora, "../../cadastrar_dispositivo.php?verifica_campo=campo_operadora_vazio");
        }
        if ($_POST['possui_aparelho'] === 'Sim') {
            Validacoes::validaCampoVazio($marca_aparelho, "../../cadastrar_dispositivo.php?verifica_campo=campo_marca_vazio");
            Validacoes::validaCampoVazio($modelo_aparelho, "../../cadastrar_dispositivo.php?verifica_campo=campo_modelo_vazio");
        }
        if ($_POST['possui_usuario'] === 'Sim') {
            Validacoes::validaCampoVazio($nome, "../../cadastrar_dispositivo.php?verifica_campo=campo_nome_vazio");
        }
        if ($_POST['possui_linha'] === 'Sim' || $_POST['possui_aparelho'] === 'Sim' || $_POST['possui_usuario'] === 'Sim') {
            Validacoes::validaCampoVazio($unidade, "../../cadastrar_dispositivo.php?verifica_campo=campos_localidade");
            Validacoes::validaCampoVazio($centro_custo, "../../cadastrar_dispositivo.php?verifica_campo=campos_localidade");
            Validacoes::validaCampoVazio($uf, "../../cadastrar_dispositivo.php?verifica_campo=campos_localidade");
            Validacoes::validaCampoVazio($canal, "../../cadastrar_dispositivo.php?verifica_campo=campos_localidade");
            Validacoes::validaCampoVazio($ponto_focal, "../../cadastrar_dispositivo.php?verifica_campo=campos_localidade");
            Validacoes::validaCampoVazio($gestor, "../../cadastrar_dispositivo.php?verifica_campo=campos_localidade");
        }

        // VALIDA CAMPOS NUMÉRICOS...
        Validacoes::validaCampoNumerico($linha, "../../cadastrar_dispositivo.php?verifica_campo=linha_nao_numerico");
        Validacoes::validaCampoNumerico($imei_aparelho, "../../cadastrar_dispositivo.php?verifica_campo=imei_nao_numerico");
        Validacoes::validaCampoNumerico($sim_card, "../../cadastrar_dispositivo.php?verifica_campo=sim_card_nao_numerico");
        Validacoes::validaCampoNumerico($centro_custo, "../../cadastrar_dispositivo.php?verifica_campo=centro_custo_nao_numerico");
        Validacoes::validaCampoNumerico($matricula, "../../cadastrar_dispositivo.php?verifica_campo=matricula_nao_numerico");

        // VALIDA CAMPO DE E-MAIL...
        Validacoes::validaCampoEmail($email, "../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=email_invalido");

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, trim($linha), PDO::PARAM_STR);
        $stmt->bindValue(2, trim(mb_strtoupper($operadora)), PDO::PARAM_STR);
        $stmt->bindValue(3, trim(mb_strtoupper($servico)), PDO::PARAM_STR);
        $stmt->bindValue(4, trim(mb_strtoupper($perfil)), PDO::PARAM_STR);
        $stmt->bindValue(5, trim(mb_strtoupper($status)), PDO::PARAM_STR);
        $stmt->bindValue(6, trim($data_ativacao), PDO::PARAM_STR);
        $stmt->bindValue(7, trim($sim_card), PDO::PARAM_STR);
        $stmt->bindValue(8, trim(mb_strtoupper($marca_aparelho)), PDO::PARAM_STR);
        $stmt->bindValue(9, trim(mb_strtoupper($modelo_aparelho)), PDO::PARAM_STR);
        $stmt->bindValue(10, trim($imei_aparelho), PDO::PARAM_STR);
        $stmt->bindValue(11, trim(mb_strtoupper($gestao_mdm)), PDO::PARAM_STR);
        $stmt->bindValue(12, trim(mb_strtoupper($unidade)), PDO::PARAM_STR);
        $stmt->bindValue(13, trim($centro_custo), PDO::PARAM_STR);
        $stmt->bindValue(14, trim(mb_strtoupper($uf)), PDO::PARAM_STR);
        $stmt->bindValue(15, trim(mb_strtoupper($canal)), PDO::PARAM_STR);
        $stmt->bindValue(16, trim(mb_strtoupper($ponto_focal)), PDO::PARAM_STR);
        $stmt->bindValue(17, trim(mb_strtoupper($gestor)), PDO::PARAM_STR);
        $stmt->bindValue(18, trim(mb_strtoupper($nome)), PDO::PARAM_STR);
        $stmt->bindValue(19, trim($matricula), PDO::PARAM_STR);
        $stmt->bindValue(20, trim(mb_strtoupper($email)), PDO::PARAM_STR);
        $stmt->bindValue(21, trim(mb_strtoupper($funcao)), PDO::PARAM_STR);
        $stmt->execute();
    }

    public function exibeDispositivos(): array
    {
        $sql = "SELECT * FROM tb_dispositivos";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function exibeDispositivosMinhaUnidade(): array
    {
        $sql = "SELECT * FROM tb_dispositivos WHERE unidade = :unidade_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':unidade_usuario', $_SESSION['unidade']);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function buscaIdDispositivo(int $id): array
    {
        $sql = "SELECT * FROM tb_dispositivos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $reslutado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $reslutado;
    }

    public function atualizaDispositivo(int $id, string $linha, string $operadora, string $servico, string $perfil, string $status, string $data_ativacao, string $sim_card, string $marca_aparelho, string $modelo_aparelho, string $imei_aparelho, string $gestao_mdm, string $unidade, string $centro_custo, string $uf, string $canal, string $ponto_focal, string $gestor, string $nome, string $matricula, string $email, string $funcao): void
    {
        $sql =
            "UPDATE tb_dispositivos
         SET linha = ?, operadora = ?, servico = ?, perfil = ?, status = ?, data_ativacao = ?, sim_card = ?, marca_aparelho = ?, modelo_aparelho = ?, imei_aparelho = ?, gestao_mdm = ?, unidade = ?, centro_custo = ?, uf = ?, canal = ?, ponto_focal = ?, gestor = ?, nome = ?, matricula = ?, email = ?, funcao = ?
         WHERE id = ?
        ";

        // VALIDA CAMPOS VAZIOS
        Validacoes::validaCampoVazio($linha, "../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=campo_linha_vazio");
        Validacoes::validaCampoVazio($operadora, "../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=campo_operadora_vazio");
        Validacoes::validaCampoVazio($imei_aparelho, "../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=campo_marca_vazio");
        Validacoes::validaCampoVazio($modelo_aparelho, "../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=campo_modelo_vazio");
        Validacoes::validaCampoVazio($nome, "../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=campo_nome_vazio");
        Validacoes::validaCampoVazio($unidade, "../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=campos_localidade");
        Validacoes::validaCampoVazio($centro_custo, "../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=campos_localidade");
        Validacoes::validaCampoVazio($uf, "../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=campos_localidade");
        Validacoes::validaCampoVazio($canal, "../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=campos_localidade");
        Validacoes::validaCampoVazio($ponto_focal, "../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=campos_localidade");
        Validacoes::validaCampoVazio($gestor, "../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=campos_localidade");

        // VALIDA CAMPOS NUMÉRICOS...
        Validacoes::validaCampoNumerico($linha, "../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=linha_nao_numerico");
        Validacoes::validaCampoNumerico($imei_aparelho, "../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=imei_nao_numerico");
        Validacoes::validaCampoNumerico($sim_card, "$../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=sim_card_nao_numerico");
        Validacoes::validaCampoNumerico($centro_custo, "../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=centro_custo_nao_numerico");
        Validacoes::validaCampoNumerico($matricula, "../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=matricula_nao_numerico");

        // VALIDA CAMPO DE E-MAIL...
        Validacoes::validaCampoEmail($email, "../../visualiza_dispositivo.php?id=$_GET[id]&verifica_campo=email_invalido");

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, trim($linha), PDO::PARAM_STR);
        $stmt->bindValue(2, trim(mb_strtoupper($operadora)), PDO::PARAM_STR);
        $stmt->bindValue(3, trim(mb_strtoupper($servico)), PDO::PARAM_STR);
        $stmt->bindValue(4, trim(mb_strtoupper($perfil)), PDO::PARAM_STR);
        $stmt->bindValue(5, trim(mb_strtoupper($status)), PDO::PARAM_STR);
        $stmt->bindValue(6, trim($data_ativacao), PDO::PARAM_STR);
        $stmt->bindValue(7, trim($sim_card), PDO::PARAM_STR);
        $stmt->bindValue(8, trim(mb_strtoupper($marca_aparelho)), PDO::PARAM_STR);
        $stmt->bindValue(9, trim(mb_strtoupper($modelo_aparelho)), PDO::PARAM_STR);
        $stmt->bindValue(10, trim($imei_aparelho), PDO::PARAM_STR);
        $stmt->bindValue(11, trim(mb_strtoupper($gestao_mdm)), PDO::PARAM_STR);
        $stmt->bindValue(12, trim(mb_strtoupper($unidade)), PDO::PARAM_STR);
        $stmt->bindValue(13, trim($centro_custo), PDO::PARAM_STR);
        $stmt->bindValue(14, trim(mb_strtoupper($uf)), PDO::PARAM_STR);
        $stmt->bindValue(15, trim(mb_strtoupper($canal)), PDO::PARAM_STR);
        $stmt->bindValue(16, trim(mb_strtoupper($ponto_focal)), PDO::PARAM_STR);
        $stmt->bindValue(17, trim(mb_strtoupper($gestor)), PDO::PARAM_STR);
        $stmt->bindValue(18, trim(mb_strtoupper($nome)), PDO::PARAM_STR);
        $stmt->bindValue(19, trim($matricula), PDO::PARAM_STR);
        $stmt->bindValue(20, trim(mb_strtoupper($email)), PDO::PARAM_STR);
        $stmt->bindValue(21, trim(mb_strtoupper($funcao)), PDO::PARAM_STR);
        $stmt->bindValue(22, $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function excluiDispositivo(int $id): void
    {
        $sql = "DELETE FROM tb_dispositivos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
