<?php

require_once "Validacoes.php";

class Telefonia
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // MÉTODO QUE EXECUTA AS VALIDAÇÕES...
    public static function executaValidacoes(string $possui_linha, ?string $linha, ?string $operadora, ?string $status, ?string $sim_card, string $possui_aparelho, ?string $tipo_aparelho, ?string $marca_aparelho, ?string $modelo_aparelho, ?string $imei_aparelho, ?string $gestao_mdm, string $unidade, string $centro_custo, string $uf, string $canal, string $ponto_focal, string $gestor, string $possui_usuario, ?string $nome, ?string $matricula, ?string $email): void
    {
        if(!empty($_GET['id']))
        {
            // CASO A VALIDAÇÃO ESTEJA OCORRENDO NO MOMENTO DA VISUALIZAÇÃO DE UM DIDPOSITIVO, SERÁ RETORNADO A PÁGINA DE VISUALIZAÇÃO EM CASO DE ERRO DE VALIDAÇÃO DE ALGUM CAMPO,
            $caminho = "visualiza_dispositivo.php?id=$_GET[id]&";

        } else {
            // CASO ESTEJA NA PÁGINA DE CADASTRO DE UM DISPOSITIVO, SERÁ RETORNADO A PÁGINA DE CADASTRO EM CASO DE ERRO DE VALIDAÇÃO DE ALGUM CAMPO...
            $caminho = "cadastrar_dispositivo.php?";
        }

        // VALIDA CAMPOS VAZIOS E NUMÉRICOS...
        Validacoes::validaCampoVazio($possui_linha, "$caminho" . "verifica_campo=campo_possui_linha");
        Validacoes::validaCampoVazio($possui_aparelho, "$caminho" . "verifica_campo=campo_possui_aparelho");
        Validacoes::validaCampoVazio($possui_usuario, "$caminho" . "verifica_campo=campo_possui_usuario");

        // CASO POSSUA LINHA, OS CAMPOS REFERNETES À LINHA SERÃO VALIDADOS...
        if ($_POST['possui_linha'] === 'SIM') {
            Validacoes::validaCampoVazio($linha, "$caminho" . "verifica_campo=campo_linha_vazio");
            Validacoes::validaCampoVazio($operadora, "$caminho" . "verifica_campo=campo_operadora_vazio");
            Validacoes::validaCampoVazio($status, "$caminho" . "verifica_campo=campo_status_vazio");
            Validacoes::validaCampoNumerico('linha', "$caminho" . "verifica_campo=linha_nao_numerico");

            // VALIDA O CAMPO DO SIM CARD APENAS QUANDO ELE NÃO ESTIVER VAZIO...
            if (!empty($sim_card)) {
                Validacoes::validaCampoNumerico('sim_card', "$caminho" . "verifica_campo=sim_card_nao_numerico");
            }
        }

        // CASO POSSUA APARELHO, OS CAMPOS REFERNETES AO APARELHO SERÃO VALIDADOS...
        if ($_POST['possui_aparelho'] === 'SIM') {
            Validacoes::validaCampoVazio($tipo_aparelho, "$caminho" . "verifica_campo=campo_tipo_vazio");
            Validacoes::validaCampoVazio($marca_aparelho, "$caminho" . "verifica_campo=campo_marca_vazio");
            Validacoes::validaCampoVazio($modelo_aparelho, "$caminho" . "verifica_campo=campo_modelo_vazio");
            Validacoes::validaCampoVazio($imei_aparelho, "$caminho" . "verifica_campo=campo_imei_vazio");
            Validacoes::validaCampoVazio($gestao_mdm, "$caminho" . "verifica_campo=campo_mdm_vazio");
            Validacoes::validaCampoNumerico('imei_aparelho', "$caminho" . "verifica_campo=imei_nao_numerico");
        }
        if ($_POST['possui_usuario'] === 'SIM') {
            Validacoes::validaCampoVazio($nome, "$caminho" . "verifica_campo=campo_nome_vazio");

            // VALIDA O CAMPO DA MATRICULA APENAS QUANDO ELE NÃO ESTIVER VAZIO...
            if (!empty($matricula)) {
                Validacoes::validaCampoNumerico('matricula', "$caminho" . "verifica_campo=matricula_nao_numerico");
            }
        }

        // CASO POSSUA USUÁRIO, OS CAMPOS REFERNETES AO USUÁRIO SERÃO VALIDADOS...
        if ($_POST['possui_linha'] === 'SIM' || $_POST['possui_aparelho'] === 'Sim' || $_POST['possui_usuario'] === 'Sim') {
            Validacoes::validaCampoVazio($unidade, "$caminho" . "verifica_campo=campos_localidade");
            Validacoes::validaCampoVazio($centro_custo, "$caminho" . "verifica_campo=campos_localidade");
            Validacoes::validaCampoVazio($uf, "$caminho" . "verifica_campo=campos_localidade");
            Validacoes::validaCampoVazio($canal, "$caminho" . "verifica_campo=campos_localidade");
            Validacoes::validaCampoVazio($ponto_focal, "$caminho" . "verifica_campo=campos_localidade");
            Validacoes::validaCampoVazio($gestor, "$caminho" . "verifica_campo=campos_localidade");
        }

        // VALIDA CAMPO DE E-MAIL APENAS QUANDO O CAMPO NÃO ESTIVER VAZIO...
        if (!empty($email)) {
            Validacoes::validaCampoEmail('email', "$caminho" . "verifica_campo=email_invalido");
        }

        // VALIDA O CAMPO NUMERICO CENTRO DE CUSTO...
        Validacoes::validaCampoNumerico('centro_custo', "$caminho" . "verifica_campo=centro_custo_nao_numerico");
    }

    // MÉTODO QUE CADASTRA DISPOSITIVO...
    public function cadastraDispositivo(string $possui_linha, string $linha, string $operadora, string $servico, string $perfil, string $status, string $data_ativacao, string $sim_card, string $possui_aparelho, string $tipo_aparelho, string $marca_aparelho, string $modelo_aparelho, string $imei_aparelho, string $gestao_mdm, string $unidade, string $centro_custo, string $uf, string $canal, string $ponto_focal, string $gestor, string $possui_usuario, string $nome, string $matricula, string $email, string $funcao): void
    {

        // CAHAMA O MÉTODO ESTATICO QUE VALIDA OS CAMPOS...
        self::executaValidacoes($possui_linha, $linha, $operadora, $status, $sim_card, $possui_aparelho, $tipo_aparelho, $marca_aparelho, $modelo_aparelho, $imei_aparelho, $gestao_mdm, $unidade, $centro_custo, $uf, $canal, $ponto_focal, $gestor, $possui_usuario, $nome, $matricula, $email);

        $sql = "INSERT INTO tb_dispositivos (
            possui_linha, linha, operadora, servico, perfil, status, data_ativacao, sim_card, possui_aparelho, tipo_aparelho, marca_aparelho, modelo_aparelho, imei_aparelho, gestao_mdm, unidade, centro_custo, uf, canal, ponto_focal, gestor, possui_usuario, nome, matricula, email, funcao, cadastrado_por
        ) VALUES (
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
        )";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $possui_linha, PDO::PARAM_STR);
        $stmt->bindValue(2, trim($linha), PDO::PARAM_STR);
        $stmt->bindValue(3, trim(mb_strtoupper($operadora)), PDO::PARAM_STR);
        $stmt->bindValue(4, trim(mb_strtoupper($servico)), PDO::PARAM_STR);
        $stmt->bindValue(5, trim(mb_strtoupper($perfil)), PDO::PARAM_STR);
        $stmt->bindValue(6, trim(mb_strtoupper($status)), PDO::PARAM_STR);
        $stmt->bindValue(7, trim($data_ativacao), PDO::PARAM_STR);
        $stmt->bindValue(8, trim($sim_card), PDO::PARAM_STR);

        $stmt->bindValue(9, $possui_aparelho, PDO::PARAM_STR);
        $stmt->bindValue(10, trim(mb_strtoupper($tipo_aparelho)), PDO::PARAM_STR);
        $stmt->bindValue(11, trim(mb_strtoupper($marca_aparelho)), PDO::PARAM_STR);
        $stmt->bindValue(12, trim(mb_strtoupper($modelo_aparelho)), PDO::PARAM_STR);
        $stmt->bindValue(13, trim($imei_aparelho), PDO::PARAM_STR);
        $stmt->bindValue(14, trim(mb_strtoupper($gestao_mdm)), PDO::PARAM_STR);
        $stmt->bindValue(15, trim(mb_strtoupper($unidade)), PDO::PARAM_STR);
        $stmt->bindValue(16, trim($centro_custo), PDO::PARAM_STR);
        $stmt->bindValue(17, trim(mb_strtoupper($uf)), PDO::PARAM_STR);
        $stmt->bindValue(18, trim(mb_strtoupper($canal)), PDO::PARAM_STR);
        $stmt->bindValue(19, trim(mb_strtoupper($ponto_focal)), PDO::PARAM_STR);
        $stmt->bindValue(20, trim(mb_strtoupper($gestor)), PDO::PARAM_STR);

        $stmt->bindValue(21, $possui_usuario, PDO::PARAM_STR);
        $stmt->bindValue(22, trim(mb_strtoupper($nome)), PDO::PARAM_STR);
        $stmt->bindValue(23, trim($matricula), PDO::PARAM_STR);
        $stmt->bindValue(24, trim(mb_strtoupper($email)), PDO::PARAM_STR);
        $stmt->bindValue(25, trim(mb_strtoupper($funcao)), PDO::PARAM_STR);
        $stmt->bindValue(26, trim($_SESSION['nome']), PDO::PARAM_STR);

        $stmt->execute();
    }

    // MÉTODO QUE LISTA TODOS OS DISPOSITIVOS...
    public function exibeDispositivos(): array
    {
        $sql = "SELECT * FROM tb_dispositivos ORDER BY ponto_focal DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // MÉTODO QUE LISTA TODOS OS DISPOSITIVOS DA UNIDADE SO USUÁRIO LOGADO...
    public function exibeDispositivosMinhaUnidade(): array
    {
        $sql = "SELECT * FROM tb_dispositivos WHERE unidade = :unidade_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':unidade_usuario', $_SESSION['unidade']);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // MÉTODO QUE LISTA APARELHOS COM MDM...
    public function exibeComMDM(): array
    {
        $sql = "SELECT * FROM tb_dispositivos WHERE gestao_mdm = 'Sim'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // MÉTODO QUE LISTA DISPOSITIVOS COM LINHA...
    public function exibeLinhas(): array
    {
        $sql = "SELECT * FROM tb_dispositivos WHERE linha != '' ORDER BY nome";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // MÉTODO QUE LISTA DISPOSITIVOS COM APARELHOS
    public function exibeAparelhos(): array
    {
        $sql = "SELECT * FROM tb_dispositivos WHERE marca_aparelho != '' ORDER BY nome";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // MÉTODO QUE BUSCA O ID DO DISPOSITIVO NA TELA DE ATUALIZAÇÃO...
    public function buscaIdDispositivo(int $id): array
    {
        $sql = "SELECT *, DATE_FORMAT(data_cadastro, '%d/%m/%Y') AS data_cadastro FROM tb_dispositivos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $reslutado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $reslutado;
    }

    // MÉTODO QUE ATUALIZA O DISPOSITIVO...
    public function atualizaDispositivo(int $id, string $possui_linha, ?string $linha, ?string $operadora, ?string $servico, ?string $perfil, ?string $status, ?string $data_ativacao, ?string $sim_card, string $possui_aparelho, ?string $tipo_aparelho, ?string $marca_aparelho, ?string $modelo_aparelho, ?string $imei_aparelho, ?string $gestao_mdm, string $unidade, string $centro_custo, string $uf, string $canal, string $ponto_focal, string $gestor, string $possui_usuario, ?string $nome, ?string $matricula, ?string $email, ?string $funcao): void
    {

        // CAHAMA O MÉTODO ESTATICO QUE VALIDA OS CAMPOS...
        self::executaValidacoes($possui_linha, $linha, $operadora, $status, $sim_card, $possui_aparelho, $tipo_aparelho, $marca_aparelho, $modelo_aparelho, $imei_aparelho, $gestao_mdm, $unidade, $centro_custo, $uf, $canal, $ponto_focal, $gestor, $possui_usuario, $nome, $matricula, $email);

        $sql =
            "UPDATE tb_dispositivos
         SET possui_linha = ?, linha = ?, operadora = ?, servico = ?, perfil = ?, status = ?, data_ativacao = ?, sim_card = ?, possui_aparelho = ?, tipo_aparelho = ?, marca_aparelho = ?, modelo_aparelho = ?, imei_aparelho = ?, gestao_mdm = ?, unidade = ?, centro_custo = ?, uf = ?, canal = ?, ponto_focal = ?, gestor = ?, possui_usuario = ?, nome = ?, matricula = ?, email = ?, funcao = ?
         WHERE id = ?

        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $possui_linha, PDO::PARAM_STR);
        $stmt->bindValue(2, trim($linha), PDO::PARAM_STR);
        $stmt->bindValue(3, trim(mb_strtoupper($operadora)), PDO::PARAM_STR);
        $stmt->bindValue(4, trim(mb_strtoupper($servico)), PDO::PARAM_STR);
        $stmt->bindValue(5, trim(mb_strtoupper($perfil)), PDO::PARAM_STR);
        $stmt->bindValue(6, trim(mb_strtoupper($status)), PDO::PARAM_STR);
        $stmt->bindValue(7, trim($data_ativacao), PDO::PARAM_STR);
        $stmt->bindValue(8, trim($sim_card), PDO::PARAM_STR);

        $stmt->bindValue(9, $possui_aparelho, PDO::PARAM_STR);
        $stmt->bindValue(10, trim(mb_strtoupper($tipo_aparelho)), PDO::PARAM_STR);
        $stmt->bindValue(11, trim(mb_strtoupper($marca_aparelho)), PDO::PARAM_STR);
        $stmt->bindValue(12, trim(mb_strtoupper($modelo_aparelho)), PDO::PARAM_STR);
        $stmt->bindValue(13, trim($imei_aparelho), PDO::PARAM_STR);
        $stmt->bindValue(14, trim(mb_strtoupper($gestao_mdm)), PDO::PARAM_STR);
        $stmt->bindValue(15, trim(mb_strtoupper($unidade)), PDO::PARAM_STR);
        $stmt->bindValue(16, trim($centro_custo), PDO::PARAM_STR);
        $stmt->bindValue(17, trim(mb_strtoupper($uf)), PDO::PARAM_STR);
        $stmt->bindValue(18, trim(mb_strtoupper($canal)), PDO::PARAM_STR);
        $stmt->bindValue(19, trim(mb_strtoupper($ponto_focal)), PDO::PARAM_STR);
        $stmt->bindValue(20, trim(mb_strtoupper($gestor)), PDO::PARAM_STR);
        
        $stmt->bindValue(21, $possui_usuario, PDO::PARAM_STR);
        $stmt->bindValue(22, trim(mb_strtoupper($nome)), PDO::PARAM_STR);
        $stmt->bindValue(23, trim($matricula), PDO::PARAM_STR);
        $stmt->bindValue(24, trim(mb_strtoupper($email)), PDO::PARAM_STR);
        $stmt->bindValue(25, trim(mb_strtoupper($funcao)), PDO::PARAM_STR);
        $stmt->bindValue(26, $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    // MÉTODO QUE EXCLUI O DISPOSITIVO...
    public function excluiDispositivo(int $id): void
    {
        $sql = "DELETE FROM tb_dispositivos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // MÉTODO QUE CONTA E RETORNA A QUANTIDADE DE DISPOSITIVOS CADASTRADOS...
    public function contagemDispositivos(): int
    {
        $sql = "SELECT COUNT(*) FROM tb_dispositivos";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchColumn();
        return $resultado;
    }

    // MÉTODO QUE CONTA E RETORNA A QUANTIDADE DE LINHAS CADASTRADAS...
    public function contagemLinhas(): int
    {
        $sql = "SELECT COUNT(*) FROM tb_dispositivos WHERE linha != ''";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchColumn();
        return $resultado;
    }

    // MÉTODO QUE CONTA E RETORNA A QUANTIDADE DE APARELHOS CADASTRADOS...
    public function contagemAparelhos(): int
    {
        $sql = "SELECT COUNT(*) FROM tb_dispositivos WHERE marca_aparelho != ''";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchColumn();
        return $resultado;
    }

    // MÉTODO QUE CONTA E RETORNA A QUANTIDADE DE APARELHOS COM MDM...
    public function contagemMDM(): int
    {
        $sql = "SELECT COUNT(*) FROM tb_dispositivos WHERE gestao_mdm = 'Sim'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchColumn();
        return $resultado;
    }

    // MÉTODO QUE CONTA E RETORNA A QUANTIDADE DE DISPOSITIVOS CADASTRADOS EM MINHA UNIDADE...
    public function contagemMinhaUnidade() : int
    {
        $sql = "SELECT COUNT(*) FROM tb_dispositivos WHERE unidade = ? ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $_SESSION['unidade']);
        $stmt->execute();
        $resultado = $stmt->fetchColumn();
        return $resultado;
    }

    // MÉTODO QUE BUSCA UM DISPOSITIVO CONFORME DADO INFORMADO NO CAMPO DE BUSCA
    public function buscaDispositivo($busca): array
    {
        
        $sql = "SELECT * FROM tb_dispositivos 
                WHERE MATCH(linha, operadora, status, tipo_aparelho, marca_aparelho, modelo_aparelho, imei_aparelho, unidade, centro_custo, canal, ponto_focal, gestor, nome, matricula, email, funcao)
                AGAINST (:busca)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':busca', "%$busca%", PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
}
