// TELA DE LOGIN

// AO CLICAR NO OLHO, A SENHA SERÁ EXIBIDA...
$("#mostrar-senha").click(function () {
    $("#senha").attr("type", "text");
    $("#mostrar-senha").fadeToggle(0);
    $("#ocultar-senha").fadeToggle(0);
});

// AO CLICAR NOVAMENTE, A SENHA SERÁ OCULTADA...
$("#ocultar-senha").click(function () {
    $("#senha").attr("type", "password");
    $("#ocultar-senha").fadeToggle(0);
    $("#mostrar-senha").fadeToggle(0);
});

// AO CLICAR NO OLHO, A SENHA SERÁ EXIBIDA...
$("#mostrar-repete-senha").click(function () {
    $("#repete-senha").attr("type", "text");
    $("#mostrar-repete-senha").fadeToggle(0);
    $("#ocultar-repete-senha").fadeToggle(0);
});

// AO CLICAR NOVAMENTE, A SENHA SERÁ OCULTADA...
$("#ocultar-repete-senha").click(function () {
    $("#repete-senha").attr("type", "password");
    $("#ocultar-repete-senha").fadeToggle(0);
    $("#mostrar-repete-senha").fadeToggle(0);
});
//______________________________________________________________________________________


// MENU LATERAL
    // AO CLICAR NO BOTÃO HAMBURGUER O MENU LATERAL SERÁ EXIBIDO, JUNTO COM O FUNDO ESCURO...
var btnMenu = false;
$("#btn-menu, #back-menu").click(function () {
    if (!btnMenu) {
        $(".menu").css({
            "left": "0",
            "transition": "left ease-in-out .2s"
        });

        $("#back-menu").fadeIn(200);
        $("#btn-menu").css({ "color": "#f1f1f1" });
        
        btnMenu = true;

        // AO CLICAR NO BOTÃO DE FECHAR OU NO FUNDO ESCURO ATRÁS DO MENU, O MENU LATERAL SRÁ FECHADO...
    } else {
        $(".menu, #btn-menu").removeAttr('style').css({ "transition": "left ease-in-out .2s" });
        $("#back-menu").fadeOut(200);
        btnMenu = false;
    }
});


    // DROPDOWN DO MENU LATERAL...
$("#menu_02").click(function () {
    $("#menusub_02").slideToggle(200, "linear");
    $("#menusub_03, #menusub_04, #menusub_05, #menusub_06").slideUp(200, "linear");
}); 
$("#menu_03").click(function () {
    $("#menusub_03").slideToggle(200, "linear");
    $("#menusub_02, #menusub_04, #menusub_05, #menusub_06").slideUp(200, "linear");
});
$("#menu_04").click(function () {
    $("#menusub_04").slideToggle(200, "linear");
    $("#menusub_02, #menusub_03, #menusub_05, #menusub_06").slideUp(200, "linear");
});
$("#menu_05").click(function () {
    $("#menusub_05").slideToggle(200, "linear");
    $("#menusub_02, #menusub_03, #menusub_04, #menusub_06").slideUp(200, "linear");
});
$("#menu_06").click(function () {
    $("#menusub_06").slideToggle(200, "linear");
    $("#menusub_02, #menusub_03, #menusub_04, #menusub_05").slideUp(200, "linear");
});

//______________________________________________________________________________________


// REQUISITOS DE SENHA
    // AO CLICAR NO BOTÃO A CAIXA COM OS REQUISITOS DE SENHA SERÁ EXIBIDA...
$("#btn-req-senha").click(function() {
    $(".box-req-senha").fadeToggle(100);
});

    // AO CLICAR NO BOTÃO DE FECHAR, A CAIXA COM OS REQUISITOS DE SENHA SERÁ FEHADA...
$("#btn-close-box-req-senha").click(function() {
    $(".box-req-senha").fadeToggle(100);
});

//_____________________________________________________________________________________

// EXIBIÇÃO DE CAIXA...
    // FUNÇÃO PARA ABRIR CAIXA DE CONFIRMAÇÃO...
function abreCaixa($botao, $caixa)
{
    $($botao).click(function() {
        $($caixa).fadeToggle(100).css({'display': 'flex'});
    });
}
    // FUNÇÃO PARA FECHAR CAIXA DE CONFIRMAÇÃO...
function fechaCaixa($botao, $caixa)
{
    $($botao).click(function() {
        $($caixa).fadeToggle(100);
    });
}

    // ABRE
    // AO PRECIONAR O BOTÃO, A CAIXA DE AJUDA SERÁ EXIBIDA...
abreCaixa("#btn-atalho[title='Caixa de ajuda']", "#box-ajuda");
    // AO PRECIONAR O BOTÃO, A CAIXA DE EXCLUSÃO SERÁ EXIBIDA...
abreCaixa("button[title='Excluir']", "#box-confirmacao[title='Caixa de exclusão']", "css({'display': 'flex'})");
    // AO PRECIONAR O BOTÃO, A CAIXA DE CONFIRMAÇÃO DE MOVIMENTO DE CHAMADO SERÁ EXIBIDA...
abreCaixa("button[title='Mover chamado']", "#box-confirmacao[title='Mover chamado']");
    // AO PRECIONAR O BOTÃO, A CAIXA DE CONFIRMAÇÃO DE FECHAMENTO DE CHAMADO SERÁ EXIBIDA...
abreCaixa("button[title='Fechar chamado']", "#box-confirmacao[title='Fechar chamado']");

    // FECHA
    // AO PRECIONAR O BOTÃO DE FECHAR, A CAIXA DE AJUDA SERÁ FECHADA...
fechaCaixa("#box-ajuda-fechar-btn", "#box-ajuda");
    // AO PRECIONAR O BOTÃO DE CANCELAR, A CAIXA DE EXCLUSÃO SERÁ FECHADA...
fechaCaixa("button[title='Cancelar exclusão']", "#box-confirmacao[title='Caixa de exclusão']");
    // AO PRECIONAR O BOTÃO DE CANCELAR, A CAIXA DE MOVIMENTAÇÃO DE CHAMADO SERÁ FECHADA
fechaCaixa("button[title='Cancelar movimento']", "#box-confirmacao[title='Mover chamado']");
    // AO PRECIONAR O BOTÃO DE CANCELAR, A CAIXA DE FECHAMENTO DE CHAMADO SERÁ FECHADA
fechaCaixa("button[title='Cancelar fechamento']", "#box-confirmacao[title='Fechar chamado']");

//_____________________________________________________________________________________


// PINTA O FUNDO CONFORME O STATUS
function corStatus() {
    let cells = document.querySelectorAll('p');

    cells.forEach(function(cell) {

        // FICA VERDE...
        if (cell.textContent.trim() === "ATIVADO" || cell.textContent.trim() === "FECHADO") {
            cell.style.backgroundColor = '#00a000';

        } // FICA VERMELHO...
        if (cell.textContent.trim() === "DESATIVADO" || cell.textContent.trim() === "URGENTE") {
            cell.style.backgroundColor = '#cc2626';

        } // FICA AMARELO 
        if (cell.textContent.trim() === "MÉDIA") {
            cell.style.backgroundColor = '#ffcc00';

        } // FICA LARANJA...
        if (cell.textContent.trim() === "ALTA") {
            cell.style.backgroundColor = '#ff8c00';

        }  // FICA AZUL...
        if (cell.textContent.trim() === "EM ABERTO" || cell.textContent.trim() === "BAIXA") {
            cell.style.backgroundColor = '#0088ff';

        } 
    });
}
corStatus();

//_____________________________________________________________________________________


// EXIBE A SESSÃO SE A OPÇÃO FOR IGUAL A "Sim", E OCULTA SE FOR IGUAL A "Não"...
document.addEventListener('DOMContentLoaded', function() {
    const selectPossuiLinha = document.querySelector('select[name="possui_linha"]');
    const selectPossuiAparelho = document.querySelector('select[name="possui_aparelho"]');
    const selectPossuiUsuario = document.querySelector('select[name="possui_usuario"]');

    const secaoLinha = document.querySelector('.form-secao-01');
    const secaoAparelho = document.querySelector('.form-secao-02');
    const secaoUsuario = document.querySelector('.form-secao-03');

    function toggleSection(select, section) {
        if (select.value === 'SIM') {
            section.style.display = 'flex';
        } else {
            section.style.display = 'none';
        }
    }

    selectPossuiLinha.addEventListener('change', function() {
        toggleSection(selectPossuiLinha, secaoLinha);
    });

    selectPossuiAparelho.addEventListener('change', function() {
        toggleSection(selectPossuiAparelho, secaoAparelho);
    });

    selectPossuiUsuario.addEventListener('change', function() {
        toggleSection(selectPossuiUsuario, secaoUsuario);
    });

    toggleSection(selectPossuiLinha, secaoLinha);
    toggleSection(selectPossuiAparelho, secaoAparelho);
    toggleSection(selectPossuiUsuario, secaoUsuario);
});

//_____________________________________________________________________________________

