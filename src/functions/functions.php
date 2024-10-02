<?php

// EXIBE A DATA ATUAL
function exibeDataAtual()
{

    date_default_timezone_set("America/Sao_Paulo");
    $dataAtual = date("d/m/Y");
    return $dataAtual;

}

// FUNÇÕES PARA VALIDAR A SENHA NAS TELAS DE CRIAÇÃO DE USUÁRIO E RESET DE SENHA.
    // VALIDA A SENHA NO MOMENTO DO RESET DA SENHA DE UM USUÁRIO...
function validacaoResetSenha(PDO $pdo)
{

    $http_referer_erro_senha_curta = $_SERVER['HTTP_REFERER'] . "&verifica_senha=senha_curta";
    $http_referer_erro_letras_maiusculas = $_SERVER['HTTP_REFERER'] . "&verifica_senha=letras_maiusculas";
    $http_referer_erro_numeros = $_SERVER['HTTP_REFERER'] . "&verifica_senha=numeros";
    $http_referer_erro_desigual = $_SERVER['HTTP_REFERER'] . "&verifica_senha=desiguais";

    if(strlen($_POST['senha']) < 12) {
        header("Location: $http_referer_erro_senha_curta");
        die();

    } elseif(!preg_match('/(?=.*[a-z])(?=.*[A-Z])/', $_POST['senha'])) {
        header("Location: $http_referer_erro_letras_maiusculas");
        die();

    } elseif(!preg_match('/([0-1])/', $_POST['senha'])) {
        header("Location: $http_referer_erro_numeros");
        die();

    } elseif($_POST['senha'] != $_POST['repete_senha']) {
        header("Location: $http_referer_erro_desigual");
        die();
    }
}

    // VALIDA A SENHA NA CRIAÇÃO DE UM USUÁRIO...
function validacaoSenha(PDO $pdo)
{
    if(strlen($_POST['senha']) < 12) {
        header("Location: cadastrar_usuario.php?verifica_senha=senha_curta");
        die();

    } elseif(!preg_match('/(?=.*[a-z])(?=.*[A-Z])/', $_POST['senha'])) {
        header("Location: cadastrar_usuario.php?verifica_senha=letras_maiusculas");
        die();

    } elseif(!preg_match('/([0-1])/', $_POST['senha'])) {
        header("Location: cadastrar_usuario.php?verifica_senha=numeros");
        die();

    } elseif($_POST['senha'] != $_POST['repete_senha']) {
        header("Location: cadastrar_usuario.php?verifica_senha=desiguais");
        die();
    }
}

    // VALIDA A SENHA NO MODENTO DO RESET DA SENHA DO USUÁRIO LOGADO...
function validacaoMinhaSenha(PDO $pdo)
{
    if(strlen($_POST['senha']) < 12) {
        header("Location: minha_senha.php?verifica_senha=senha_curta");
        die();

    } elseif(!preg_match('/(?=.*[a-z])(?=.*[A-Z])/', $_POST['senha'])) {
        header("Location: minha_senha.php?verifica_senha=letras_maiusculas");
        die();

    } elseif(!preg_match('/([0-1])/', $_POST['senha'])) {
        header("Location: minha_senha.php?verifica_senha=numeros");
        die();

    } elseif($_POST['senha'] != $_POST['repete_senha']) {
        header("Location: minha_senha.php?verifica_senha=desiguais");
        die();
    }
}

function validacaoSenhaPrimeiroAcesso(PDO $pdo)
{
    if(strlen($_POST['senha']) < 12) {
        header("Location: primeiro_acesso.php?verifica_senha=senha_curta");
        die();

    } elseif(!preg_match('/(?=.*[a-z])(?=.*[A-Z])/', $_POST['senha'])) {
        header("Location: primeiro_acesso.php?verifica_senha=letras_maiusculas");
        die();

    } elseif(!preg_match('/([0-1])/', $_POST['senha'])) {
        header("Location: primeiro_acesso.php?verifica_senha=numeros");
        die();

    } elseif($_POST['senha'] != $_POST['repete_senha']) {
        header("Location: primeiro_acesso.php?verifica_senha=desiguais");
        die();
    }
}


// FUNÇÃO PARA EXIBIR A QUANTIDADE DE REQUISIÇÕES ABERTAS
function exibeQuantidadeRequisicoes(PDO $pdo): int
{
    $sql = "SELECT COUNT(*) FROM tb_requisicoes_historico";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
}


// FUNÇÃO PARA EXIBIR A QUANTIDADE DE REQUISIÇÕES QUE ABRI
function exibeQuantidadeMinhasRequisicoes(PDO $pdo): int
{
    $sql = "SELECT COUNT(*) FROM tb_requisicoes_historico WHERE id_solicitante_historico = :id_usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_usuario', $_SESSION['id_usuario']);
    $stmt->execute();
    return $stmt->fetchColumn();
}

// FUNÇÃO PARA EXIBIR A QUANTIDADE DE REQUISIÇÕES RECUSADAS...
function exibeQuantidadeRequisicoesRecusadas(PDO $pdo) : int   
{
    $sql = "SELECT COUNT(*) FROM tb_requisicoes_historico WHERE status_historico = 'Recusada'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchColumn();
    return $resultado;
}

// FUNÇÃO PARA EXIBIR QUANTIDADE DE REQUISIÇÕES ENTREGUES...
function exibeQuantidadeRequisicoesEntregues(PDO $pdo) : int
{
    $sql = "SELECT COUNT(*) FROM tb_requisicoes_historico WHERE status_historico = 'Entregue'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchColumn();
    return $resultado;
}


// FUNÇÃO QUE FAZ A CONTAGEM DE REQUISIÇÕES EM ABERTO
function exibeQuantidadeRequisicoesEmAberto(PDO $pdo): int
{
    $sql = "SELECT COUNT(*) FROM tb_requisicoes";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchColumn();
    return $resultado;
}

function exibeQuantidadeProdutosCadastrados(PDO $pdo) : int
{
    $sql = "SELECT COUNT(*) FROM tb_produtos";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchColumn();
    return $resultado;
}


// FUNÇÃO QUE EXIBE O RESULTADO DA CONTAGEM DE REQUISIÇÕES EM ABERTO
function exibeNotificacaoRequisicoesEmAberto(PDO $pdo)
{
    $perfil_usuario = $_SESSION['perfil'];
    $exibeQuantidadeRequisicoesEmAberto = exibeQuantidadeRequisicoesEmAberto($pdo);

    if ($exibeQuantidadeRequisicoesEmAberto > 0) {
        if($perfil_usuario === "Admin") {
            return "<div id=\"notificacao\" title='Há $exibeQuantidadeRequisicoesEmAberto requisição(ões) em aberto.'><p>" . $exibeQuantidadeRequisicoesEmAberto . "</p></div>";
        } else {
            return "<i class=\"fa-solid fa-angle-right\"></i>";
        }
    } else {
        return "<i class=\"fa-solid fa-angle-right\"></i>";
    }
}


// FUNÇÃO QUE EXIBE O PRODUTO MAIS REQUISITADO DOS ÚLTIMOS 30 DIAS
function exibeProdutoMaisRequisitado(PDO $pdo): string
{
    $sql = "SELECT descricao_historico, COUNT(*) AS total
            FROM tb_requisicoes_historico
            WHERE data_requisicao_historico >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
            GROUP BY descricao_historico
            ORDER BY total DESC
            LIMIT 1;
            ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchColumn();
    return $resultado;

}


// FUNÇÃO QUE CONTA QUANTOS PRODUTOS CONTÉM EM ESTOQUE UM VALOR ABAIXO DO ESTOQUE MÍNIMO...
function exibeQuantidadeAbaixoDoMinimo(PDO $pdo) : int
{
    $sql = "SELECT COUNT(*) FROM tb_produtos WHERE estoque < estoque_minimo";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result;
}

// FUNÇÃO QUE CONTA QUANTOS PRODUTOS CONTÉM EM ESTOQUE UM VALOR IGUAL AO ESTOQUE MÍNIMO...
function exibeQuantidadeNoEstoqueMinimo(PDO $pdo) : int
{
    $sql = "SELECT COUNT(*) FROM tb_produtos WHERE estoque = estoque_minimo";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchColumn();
    return $resultado;
}

// FUNÇÃO QUE CONTA QUANTOS PRODUTOS CONTÉM EM ESTOQUE UM VALOR MAIOR QUE O ESTOQUE MÍNIMO...
function exibeQuantidadeAcimaDoMinimo(PDO $pdo) : int
{
    $sql = "SELECT COUNT(*) FROM tb_produtos WHERE estoque > estoque_minimo";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchColumn();
    return $resultado;
}

// FUNÇÃO QUE CONTA QUANTOS PRODUTOS JÁ FORAM INVENTARIADOS...
function exibeQuantidadeInventariado(PDO $pdo)
{
    $sql = "SELECT COUNT(*) FROM tb_produtos WHERE status_inv_produto = 'INVENTARIADO'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchColumn();
    return $resultado;
}

// FUNÇÃO QUE CONTA QUANTOS PRODUTOS AINDA NÃO FORAM INVENTARIADOS...
function exibeQuantidadeNãoInventariado(PDO $pdo)
{
    $sql = "SELECT COUNT(*) FROM tb_produtos WHERE status_inv_produto = 'NÃO INVENTARIADO'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchColumn();
    return $resultado;
}

// FUNÇÃO PARA EXIBIR A FOTO DO PERFIL DO USUÁRIO LOGADO...
function exibeFotoPerfilMenuLateral()
{
    if(empty($_SESSION['foto_perfil']))
    {
        // SE NÃO TIVER SIDO ENVIADO UMA FOTO, UM ÍCONE DE USER SERÁ EXIBIDO
        echo "<i class=\"fa-solid fa-circle-user\"></i>";
    } else {
        // SE TIVER SIDO ENVIADO UMA FOTO, ESSA FOTO SERÁ EXIBIDA
        echo "<img src=\"$_SESSION[foto_perfil]\">";
    }
}