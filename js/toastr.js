

// MENSAGENS TOASTR...
$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);

    // FUNÇÃO PARA MSG DE SUCESSO
    function exibeMensagemSucesso($url1, $url1, $url2, $mensagem, $titulo_mensagem) {

        if (urlParams.has($url1) && urlParams.get($url1) === $url2) {
            toastr.success($mensagem, $titulo_mensagem);
        }
    }

    // FUNÇÃO PARA MSG DE ERRO
    function exibeMensagemErro($url1, $url1, $url2, $mensagem, $titulo_mensagem) {

        if (urlParams.has($url1) && urlParams.get($url1) === $url2) {
            toastr.error($mensagem, $titulo_mensagem);
        }
    }

    // FUNÇÃO PARA MSG DE INFORMAÇÃO
    function exibeMensagemInfo($url1, $url1, $url2, $mensagem, $titulo_mensagem) {

        if (urlParams.has($url1) && urlParams.get($url1) === $url2) {
            toastr.info($mensagem, $titulo_mensagem);
        }
    }


//MENSAGEM LOGIN...
    // ERRO AO REALIZAR O LOGIN...
    exibeMensagemErro('valida_login', 'valida_login', 'credenciais_invalidas', 'Credenciais inválidas!');
    // ERRO AO REALIZAR O LOGIN...
    exibeMensagemErro('valida_login', 'valida_login', 'usuario_desativado', 'Esse usuário está desativado!');


// MENSAGENS DE MANIPULAÇÃO DE USUÁRIO...
    // SUCESSO NO CADASTRO DE UM USUÁRIO...
    exibeMensagemSucesso('cadastra_usuario', 'cadastra_usuario', 'cadastrado_com_sucesso', 'Usuário cadastrado com sucesso!');
    // ERRO NO CADASTRO DE UM USUÁRIO...
    exibeMensagemErro('verifica_cadastro', 'verifica_cadastro', 'erro_no_cadastro', 'O nome deve ser completo.', "Usuário não criado!");
    // ERRO NO CADASTRO DE UM USUÁRIO...
    exibeMensagemErro('verifica_cadastro', 'verifica_cadastro', 'usuario_ja_cadastrado', 'Esse usuário já está cadastrado.', "Usuário não criado!");
    // SUCESSO NA EDIÇÃO DE UM USUÁRIO...
    exibeMensagemSucesso('edita_usuario', 'edita_usuario', 'editado_com_sucesso', 'Usuário editado com sucesso!');
    // SUCESSO NA EXCLUSÃO DE UM USUÁRIO...
    exibeMensagemSucesso('exclui_usuario', 'exclui_usuario', 'excluido_com_sucesso', "<br>Todas as requisições desse usuário foram excluídas do histórico.", 'Usuário excluido com sucesso!');
    // ERRO NA EXCLUSÃO DE UM USUÁRIO...
    exibeMensagemErro('exclui_usuario', 'exclui_usuario', 'erro_na_exclusao', '<a href="../gerenciar_requisicoes.php"><br>Esse usuário possui requisições em aberto.<br>Entregue ou cancele essas requisições antes de exclui-lo.<br><br>Clique para exibir todas as requisições em aberto</a>', '<a href="../gerenciar_requisicoes.php">Não foi possível excluir esse usuário!</a>');


// MENSAGENS DE VALIDAÇÃO DE SENHA...
    // ERRO NA VALIDAÇÃO DO COMPRIEMENTO DA SENHA INFORMADA...
    exibeMensagemErro('verifica_senha', 'verifica_senha', 'senha_curta', 'O nome deve ser completo!', 'A senha deve conter pelo menos 12 caracteres!', "Erro na validação da senha!");
    // ERRO NA VALIDAÇÃO DE LETRAS MAIUSCULAS NA SENHA INFORMADA...
    exibeMensagemErro('verifica_senha', 'verifica_senha', 'letras_maiusculas', 'O nome deve ser completo!', 'A senha deve conter pelo menos uma letra maiúscula', "Erro na validação da senha!");
    // ERRO NA VALIDAÇÃO DE NÚMEROS NA SENHA INFORMADA...
    exibeMensagemErro('verifica_senha', 'verifica_senha', 'numeros', 'O nome deve ser completo!', 'A senha deve conter pelo menos um número', "Erro na validação da senha!");
    // ERRO NA VALIDAÇÃO DE COMPARAÇÃO DAS DUAS SENHAS INFORMADAS...
    exibeMensagemErro('verifica_senha', 'verifica_senha', 'desiguais', 'O nome deve ser completo!', 'As senhas não conferem!', "Erro na validação da senha!");
    // SUCESSO NO RESET DA SENHA...
    exibeMensagemSucesso('verifica_senha', 'verifica_senha', 'senha_resetada', 'Senha resetada com sucesso!');
    // SUCESSO NO RESET DA SENHA DO PRIMEIRO ACESSO...
    exibeMensagemSucesso('verifica_senha', 'verifica_senha', 'primeiro_acesso', '<br>Agora realize o login com a nova senha e começe a utilizar o sistema!', 'Senha alterada com sucesso!');


// MENSAGEM DE DISPOSITIVO
    // SUCESSO NO CADASTRO DE UM DISPOSITIVO...
    exibeMensagemSucesso('dispositivo', 'dispositivo', 'cadastrado', 'Dispositivo cadastrado com sucesso!');
    // SUCESSO NA EDIÇÃO DE UM DISPOSITIVO...
    exibeMensagemSucesso('dispositivo', 'dispositivo', 'atualizado', 'Dispositivo atualizado com sucesso!');
    // SUCESSO NA EXCLUSÃO DE UM DISPOSITIVO...
    exibeMensagemSucesso('dispositivo', 'dispositivo', 'excluido', 'Dispositivo excluído com sucesso!');

// VALIDA CAMPOS VAZIOS...
    // LINHA
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'campo_linha_vazio', 'O campo da linha deve ser preenchido', 'Erro!');
    // OPERADORA
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'campo_operadora_vazio', 'O campo da operadora deve ser preenchido', 'Erro!');
    // MARCA APARELHO
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'campo_marca_vazio', 'O campo da marca deve ser preenchido', 'Erro!');
    // MODELO APARELHO
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'campo_modelo_vazio', 'O campo do modelo deve ser preenchido', 'Erro!');
    // NOME USUÁRIO
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'campo_nome_vazio', 'O campo do nome do usuário deve ser preenchido', 'Erro!');
    // TODOS OS CAMPOS DA LOCALIDADE
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'campos_localidade', 'Todos os campos da localidade devem ser preenchidos', 'Erro!');


//VALIDA CAMPOS NUMÉRICOS...
    // LINHA
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'linha_nao_numerico', 'O campo da linha deve ser numérico', 'Erro!');
    // IMEI 
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'imei_nao_numerico', 'O campo do IMEI deve ser numérico', 'Erro!');
    // SIM CARD 
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'sim_card_nao_numerico', 'O campo do SIM card deve ser numérico', 'Erro!');
    // CENTRO DE CUSTOS 
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'centro_custo_nao_numerico', 'O campo do centro de custos deve ser numérico', 'Erro!');
    // MATRÍCULA 
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'matricula_nao_numerico', 'O campo da matrícula deve ser numérico', 'Erro!');

// VALIDA EMAIL...
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'email_invalido', 'O e-mail informado não é válido', 'Erro!');


});