<?php

require_once "../config/conexao_bd.php";
require_once "../functions/functions.php";
require_once "../../src/model/Logs.php";

session_start();

if (isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['senha']) && !empty($_POST['senha'])) {

    $usuario = htmlspecialchars(trim($_POST['usuario']), ENT_QUOTES, 'UTF-8');
    $senha = trim($_POST['senha']);

    // BUSCA O USUÁRIO INFORMADO NO BANCO DE DADOS...
    $sql = "SELECT * FROM tb_usuarios WHERE usuario = :usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":usuario" => $usuario]);
    $resultado = $stmt->fetch();

    if ($resultado) {

        // VERIFICA SE O USUÁRIO INFORMADO ESTÁ ATIVADO, CASO CONTRÁRIO NÃO SERÁ POSSÍVEL REALIZAR O LOGIN...
        if ($resultado['status'] == "ATIVADO") {

            // VERIFICA SE A SENHA INFORMADA PERTENCE AO USUÁRIO INFORMADO E ENCONTRADO...
            if (password_verify($senha, $resultado['senha'])) {

                // SE ENCONTRADO OS DADOS DESSE USUÁRIO É ARMAZENADO NA SESSÃO...
                $_SESSION['usuario'] = $resultado['usuario'];
                $_SESSION['nome'] = $resultado['nome'];
                $_SESSION['matricula'] = $resultado['matricula'];
                $_SESSION['unidade'] = $resultado['unidade'];
                $_SESSION['perfil'] = $resultado['perfil'];
                $_SESSION['senha_primeiro_acesso'] = $resultado['senha_primeiro_acesso'];
                $_SESSION['id_usuario'] = $resultado['id_usuario'];

                // ARMAZENA A TENTATIVA DE ACESSO EM LOG...
                $armazenaLog = new Logs($pdo);
                $armazenaLog->armazenaLog(
                    "Acesso",
                    "$_POST[usuario]",
                    "Acesso ao sistema",
                    "Sucesso",
                    ''
                );

                header("Location: ../../inicio.php");
                die();
                
            } else {

                // ARMAZENA A TENTATIVA DE ACESSO EM LOG...
                $armazenaLog = new Logs($pdo);
                $armazenaLog->armazenaLog(
                    "Acesso",
                    "$_POST[usuario]",
                    "Acesso ao sistema",
                    "Senha incorreta",
                    ''
                );

                header("Location: ../../index.php?valida_login=credenciais_invalidas");
                die();
            }

        } else {

            // ARMAZENA A TENTATIVA DE ACESSO EM LOG...
            $armazenaLog = new Logs($pdo);
            $armazenaLog->armazenaLog(
                "Acesso",
                "$_POST[usuario]",
                "Acesso ao sistema",
                "Usuário desativado",
                ''
            );

            header("Location: ../../index.php?valida_login=usuario_desativado");
            die();
        }

    } else {
            
        // ARMAZENA A TENTATIVA DE ACESSO EM LOG...
        $armazenaLog = new Logs($pdo);
        $armazenaLog->armazenaLog(
            "Acesso",
            "$_POST[usuario]",
            "Acesso ao sistema",
            "Usuário não encontrado",
            ''
        );

        header("Location: ../../index.php?valida_login=credenciais_invalidas");
        die();
    }

} else {
            
    // ARMAZENA A TENTATIVA DE ACESSO EM LOG...
    $armazenaLog = new Logs($pdo);
    $armazenaLog->armazenaLog(
        "Acesso",
        "$_POST[usuario]",
        "Acesso ao sistema",
        "Campo vazio",
        ''
    );
    
    header("Location: ../../index.php?verifica_campos=erro_no_envio");
    die();
}
