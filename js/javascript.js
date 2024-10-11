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
    $("#menusub_03, #menusub_04, #menusub_05").slideUp(200, "linear");
}); 
$("#menu_03").click(function () {
    $("#menusub_03").slideToggle(200, "linear");
    $("#menusub_02, #menusub_04, #menusub_05").slideUp(200, "linear");
});
$("#menu_04").click(function () {
    $("#menusub_04").slideToggle(200, "linear");
    $("#menusub_02, #menusub_03, #menusub_05").slideUp(200, "linear");
});
$("#menu_05").click(function () {
    $("#menusub_05").slideToggle(200, "linear");
    $("#menusub_02, #menusub_03, #menusub_04").slideUp(200, "linear");
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


// MUDA COR CONFORME QUANTIDADE EM ESTOQUE X ESTOQUE MÍNIMO
document.addEventListener("DOMContentLoaded", function() {
    var estoqueCells = document.querySelectorAll('#estoque');
    var estoqueMinimoCells = document.querySelectorAll('#estoque_minimo');

    estoqueCells.forEach(function(estoqueCell, index) {
        var estoque = parseInt(estoqueCell.innerText);
        var estoqueMinimo = parseInt(estoqueMinimoCells[index].innerText);

        // SE O VALOR EM ESTOQUE FOR MENOR DO QUE O VALOE DE ESTOQUE MÍNIMO, O FUNDO DO VALOR EM ESTOQUE FICARÁ VERMELHO...
        if (estoque < estoqueMinimo) {
            estoqueCell.style.backgroundColor = '#ffb4b4';
            estoqueCell.style.fontWeight = 'bold';
            estoqueCell.style.boxShadow = '0 0 .2em #808080';

        }

        // SE O VALOR EM ESTOQUE FOR MAIOR QUE O VALOR DO ESTOQUE MÍNIMO, O FUNDO DO VALOR EM ESTOQUE FICARÁ VERDE...
        if (estoque > estoqueMinimo) {
            estoqueCell.style.backgroundColor = '#b4ffb4';
            estoqueCell.style.fontWeight = 'bold';
            estoqueCell.style.boxShadow = '0 0 .2em #808080';
        }

        // SE O VALOR EM ESTOQUE FOR IGUAL AO VALOR DO ESTOQUE MÍNIMO, O FUNDO DO VALOR EM ESTOQUE FICARÁ AMARELO...
        if (estoque === estoqueMinimo) {
            estoqueCell.style.backgroundColor = '#fcffb4';
            estoqueCell.style.fontWeight = 'bold';
            estoqueCell.style.boxShadow = '0 0 .2em #808080';
        }
    });
});


// FUNÇÃO QUE FILTRA A TABELA PRA EXIBIR APENAS AS REQUISIÇÕES COM STATUS "RECUSADA"
function filtrarRecusadas() {

    var linhas = document.querySelectorAll("#tabela tbody tr");

    linhas.forEach(function(linha) {
        var status = linha.cells[6].innerText;
        if (status === "RECUSADA") {
            linha.classList.remove("hidden");
        } else {    
            linha.classList.add("hidden");
        }
    });
}

// FUNÇÃO QUE FILTRA A TABELA PRA EXIBIR APENAS AS REQUISIÇÕES COM STATUS "EM ABERTO"
function filtrarEmAberto() {

    var linhas = document.querySelectorAll("#tabela tbody tr");

    linhas.forEach(function(linha) {
        var status = linha.cells[6].innerText;
        if (status === "EM ABERTO") {
            linha.classList.remove("hidden");
        } else {
            linha.classList.add("hidden");
        }
    });
}

// FUNÇÃO QUE FILTRA A TABELA PRA EXIBIR APENAS AS REQUISIÇÕES COM STATUS "ENTREGUE"
function filtrarEntregues() {

    var linhas = document.querySelectorAll("#tabela tbody tr");

    linhas.forEach(function(linha) {
        var status = linha.cells[6].innerText;
        if (status === "ENTREGUE") {
            linha.classList.remove("hidden");
        } else {
            linha.classList.add("hidden");
        }
    });
}

// FUNÇÃO QUE REMOVE O FILTRO E VOLTA A EXIBIR TODAS AS REQUISIÇÕES
function exibirTodas() {
    var linhas = document.querySelectorAll("#tabela tbody tr");
    linhas.forEach(function(linha) {
        linha.classList.remove("hidden");
    });
}

// ADICIONA FILTRO AO ESTOQUE, ABAIXO DO ESTOQUE MÍNIMO, NO ESTOQUE MÍNIMO E ABAIXO DO ESTOQUE MÍNIMO
document.addEventListener('DOMContentLoaded', () => {
    const tabela = document.querySelector('table tbody');
    
    const filtrarTabela = (tipo) => {
        const linhas = tabela.querySelectorAll('tr');
        linhas.forEach(linha => {
            const estoque = parseInt(linha.querySelector('#estoque').textContent, 10);
            const estoqueMinimo = parseInt(linha.querySelector('#estoque_minimo').textContent, 10);

            let mostrar = false;
            
            switch(tipo) {
                case 'abaixo-do-minimo':
                    mostrar = estoque < estoqueMinimo;
                    break;
                case 'no-estoque-minimo':
                    mostrar = estoque === estoqueMinimo;
                    break;
                case 'acima-do-minimo':
                    mostrar = estoque > estoqueMinimo;
                    break;
                default:
                    mostrar = true;
            }

            linha.style.display = mostrar ? '' : 'none';
        });
    };

    document.getElementById('filtro-abaixo-do-minimo').addEventListener('click', () => filtrarTabela('abaixo-do-minimo'));
    document.getElementById('filtro-no-estoque-minimo').addEventListener('click', () => filtrarTabela('no-estoque-minimo'));
    document.getElementById('filtro-acima-do-minimo').addEventListener('click', () => filtrarTabela('acima-do-minimo'));
    document.getElementById('filtro-todos-produtos').addEventListener('click', () => filtrarTabela(''));

    filtrarTabela(''); 
});


// FUNÇÕES DA CALCULADORA
function insert(num) {
    var numero = document.getElementById('resultado').innerHTML;
    document.getElementById('resultado').innerHTML = numero + num;
}

function clean() {
    document.getElementById('resultado').innerHTML = "";
}

function back() {
    var resultado = document.getElementById('resultado').innerHTML;
    document.getElementById('resultado').innerHTML = resultado.substring(0, resultado.length -1);
}

function calcular()
{
    var resultado = document.getElementById('resultado').innerHTML;
    if(resultado) {
        document.getElementById('resultado').innerHTML = eval(resultado);
    } else {
        document.getElementById('resultado').innerHTML = "";
    }
}

$("#btn-atalho[title=Calculadora]").click(function() 
{
    $(".calculadora").fadeToggle(100).css({"display": "flex"});
});
$("#limpar").click(function() 
{
    $(".calculadora").fadeToggle(100);
});


// EXIBE A DIFERENÇA QUANTIDADE VS ESTOQUE NO MOMENTO DO INVENTÁRIO DO PRODUTO..
document.addEventListener('DOMContentLoaded', function () {

    const estoqueInputs = document.querySelectorAll('.estoque-input');
    const diferencaInputs = document.querySelectorAll('.diferenca-input');

    function atualizarDiferenca() {
        estoqueInputs.forEach((input, index) => {

            const quantidade = parseFloat(input.getAttribute('value')) || 0;
            const estoque = parseFloat(input.value) || 0;
            const diferenca = estoque - quantidade;
            diferencaInputs[index].value = diferenca.toFixed(0);
        });
    }
    estoqueInputs.forEach(input => {
        input.addEventListener('input', atualizarDiferenca);
    });
    atualizarDiferenca();
});

document.addEventListener('DOMContentLoaded', function() {
    const selectPossuiLinha = document.querySelector('select[name="possui_linha"]');
    const selectPossuiAparelho = document.querySelector('select[name="possui_aparelho"]');
    const selectPossuiUsuario = document.querySelector('select[name="possui_usuario"]');

    const secaoLinha = document.querySelector('.form-secao-01');
    const secaoAparelho = document.querySelector('.form-secao-02');
    const secaoUsuario = document.querySelector('.form-secao-03');

    const linha = secaoLinha.querySelector('input[name="linha"]');
    const operadora = secaoLinha.querySelector('select[name="operadora"]');

    const marcaAparelho = secaoAparelho.querySelector('select[name="marca_aparelho"]');
    const modeloAparelho = secaoAparelho.querySelector('input[name="modelo_aparelho"]');
    const imeiAparelho = secaoAparelho.querySelector('input[name="imei_aparelho"]');
    const mdmAparelho = secaoAparelho.querySelector('select[name="gestao_mdm"]');

    const nomeUsuario = secaoUsuario.querySelector('input[name="nome"]');

    secaoLinha.style.display = 'none';
    secaoAparelho.style.display = 'none';
    secaoUsuario.style.display = 'none';

    function toggleSection(select, section) {
        if (select.value === 'Sim') {
            section.style.display = 'flex';
        } else {
            section.style.display = 'none';
        }
    }

    selectPossuiLinha.addEventListener('change', function() {
        toggleSection(selectPossuiLinha, secaoLinha, [linha, operadora]);
    });

    selectPossuiAparelho.addEventListener('change', function() {
        toggleSection(selectPossuiAparelho, secaoAparelho, [marcaAparelho, modeloAparelho, imeiAparelho, mdmAparelho]);
    });

    selectPossuiUsuario.addEventListener('change', function() {
        toggleSection(selectPossuiUsuario, secaoUsuario, [nomeUsuario]);
    });
});