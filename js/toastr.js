

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
    exibeMensagemSucesso('usuario', 'usuario', 'cadastrado_com_sucesso', 'Usuário cadastrado com sucesso!');
    // ERRO NO CADASTRO DE UM USUÁRIO...
    exibeMensagemErro('usuario', 'usuario', 'nome_incompleto', 'O nome deve ser completo.', "Erro!");
    // ERRO NO CADASTRO DE UM USUÁRIO...
    exibeMensagemErro('usuario', 'usuario', 'usuario_ja_cadastrado', 'Esse usuário já está cadastrado.', "Erro!");
    // SUCESSO NA EDIÇÃO DE UM USUÁRIO...
    exibeMensagemSucesso('usuario', 'usuario', 'editado_com_sucesso', 'Usuário editado com sucesso!');
    // SUCESSO NA EXCLUSÃO DE UM USUÁRIO...
    exibeMensagemSucesso('usuario', 'usuario', 'excluido_com_sucesso', 'Usuário excluido com sucesso!');
    

// MENSAGEM DE MANIPULAÇÃO DE DISPOSITIVO...
    // SUCESSO NO CADASTRO DE UM DISPOSITIVO...
    exibeMensagemSucesso('dispositivo', 'dispositivo', 'cadastrado', 'Dispositivo cadastrado com sucesso!');
    // SUCESSO NA EDIÇÃO DE UM DISPOSITIVO...
    exibeMensagemSucesso('dispositivo', 'dispositivo', 'atualizado', 'Dispositivo atualizado com sucesso!');
    // SUCESSO NA EXCLUSÃO DE UM DISPOSITIVO...
    exibeMensagemSucesso('dispositivo', 'dispositivo', 'excluido', 'Dispositivo excluído com sucesso!');

    
// MENSAGERM DE BUSCA E FILTRO DE DISPOSITIVOS
    // SUCESSO NO FILTRO DE LINHA
    exibeMensagemSucesso('linhas','linhas','', 'Exibindo linhas cadastradas');
    // SUCESSO NO FILTRO DE APARELHOS
    exibeMensagemSucesso('aparelhos','aparelhos','', 'Exibindo aparelhos cadastrados');
    // SUCESSO NO FILTRO DE APARELHOS
    exibeMensagemSucesso('mdm','mdm','', 'Exibindo aparelhos com MDM');
    // SUCESSO NO FILTRO DE APARELHOS
    exibeMensagemErro('busca','busca', 'campo_vazio', 'Preencha com alguma informação do dispositivo.', 'Erro!');


// MENSAGENS DE MANIPULAÇÃO DE OPÇÕES...
    // SUCESSO NO CADASTRO DE UMA OPÇÃO...
    exibeMensagemSucesso('opcao', 'opcao', 'cadastrada', 'Opção cadastrada com sucesso');
    // SUCESSO Na EDIÇÃO DE UMA OPÇÃO...
    exibeMensagemSucesso('opcao', 'opcao', 'editada', 'Opção editada com sucesso');
    // SUCESSO NA EXCLUSÃO DE UMA OPÇÃO...
    exibeMensagemSucesso('opcao', 'opcao', 'excluida', 'Opção excluida com sucesso');

// MENSAGENS DE CHAMADOS...
    // SUCESSO NA ABERTURA DE UM CHAMADO
    exibeMensagemSucesso('chamado', 'chamado', 'aberto', 'Chamado aberto com sucesso!');
    // SUCESSO NA EDIÇÃO DE UM CHAMADO
    exibeMensagemSucesso('chamado', 'chamado', 'atualizado', 'Chamado atualizado com sucesso!');


// MENSAGENS DE VALIDAÇÃO DE SENHA...
    // ERRO NA VALIDAÇÃO DO COMPRIEMENTO DA SENHA INFORMADA...
    exibeMensagemErro('verifica_senha', 'verifica_senha', 'senha_curta', 'A senha deve conter pelo menos 12 caracteres!', "Erro!");
    // ERRO NA VALIDAÇÃO DE LETRAS MAIUSCULAS NA SENHA INFORMADA...
    exibeMensagemErro('verifica_senha', 'verifica_senha', 'letras_maiusculas', 'A senha deve conter pelo menos uma letra maiúscula', "Erro!");
    // ERRO NA VALIDAÇÃO DE NÚMEROS NA SENHA INFORMADA...
    exibeMensagemErro('verifica_senha', 'verifica_senha', 'numeros', 'A senha deve conter pelo menos um número', "Erro!");
    // ERRO NA VALIDAÇÃO DE NÚMEROS NA SENHA INFORMADA...
    exibeMensagemErro('verifica_senha', 'verifica_senha', 'caracteres_especiais', 'A senha deve conter pelo menos um caractere especial', "Erro!");
    // ERRO NA VALIDAÇÃO DE COMPARAÇÃO DAS DUAS SENHAS INFORMADAS...
    exibeMensagemErro('verifica_senha', 'verifica_senha', 'desiguais', 'As senhas não conferem!', "Erro!");
    // SUCESSO NO RESET DA SENHA...
    exibeMensagemSucesso('verifica_senha', 'verifica_senha', 'senha_resetada', 'Senha resetada com sucesso!');
    // SUCESSO NO RESET DA SENHA DO PRIMEIRO ACESSO...
    exibeMensagemSucesso('verifica_senha', 'verifica_senha', 'primeiro_acesso', '<br>Agora realize o login com a nova senha e começe a utilizar o sistema!', 'Senha alterada com sucesso!');


// VALIDAÇÃO CAMPOS VAZIOS...
    // LINHA
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'campo_linha_vazio', 'O campo da linha deve ser preenchido.', 'Erro!');
    // OPERADORA
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'campo_operadora_vazio', 'O campo da operadora deve ser preenchido.', 'Erro!');
    // MARCA APARELHO
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'campo_marca_vazio', 'O campo da marca deve ser preenchido.', 'Erro!');
    // MODELO APARELHO
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'campo_modelo_vazio', 'O campo do modelo deve ser preenchido.', 'Erro!');
    // NOME USUÁRIO
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'campo_nome_vazio', 'O campo do nome do usuário deve ser preenchido.', 'Erro!');
    // TODOS OS CAMPOS DA LOCALIDADE
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'campos_localidade', 'Todos os campos da localidade são de preenchimento obrigatório.', 'Erro!');
    // TODOS OS CAMPOS
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'todos_campos', 'Todos os campos devem ser preenchidos.', 'Erro!');
    // TODOS OS CAMPOS
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'nenhum_dado', 'Não é possível cadastrar um dispositivo vazio.', 'Erro!');


// VALIDAÇÃO CAMPOS NUMÉRICOS...
    // LINHA
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'linha_nao_numerico', 'O campo da linha deve ser numérico.', 'Erro!');
    // IMEI 
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'imei_nao_numerico', 'O campo do IMEI deve ser numérico.', 'Erro!');
    // SIM CARD 
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'sim_card_nao_numerico', 'O campo do SIM card deve ser numérico.', 'Erro!');
    // CENTRO DE CUSTOS 
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'centro_custo_nao_numerico', 'O campo do centro de custos deve ser numérico.', 'Erro!');
    // MATRÍCULA 
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'matricula_nao_numerico', 'O campo da matrícula deve ser numérico.', 'Erro!');


// VALIDAÇÃO DE EMAIL...
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'email_invalido', 'O e-mail informado não é válido.', 'Erro!');


// VALIDAÇÃO SE POSSUI PELO MENOS LINHA OU APARELHO...
    exibeMensagemErro('verifica_campo', 'verifica_campo', 'linha_ou_aparelho', 'O cadastro deve possuir uma linha, um aparelho, ou ambos.', 'Erro!');

});