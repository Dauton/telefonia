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
    $("#menusub_03, #menusub_04").slideUp(200, "linear");
}); 
$("#menu_03").click(function () {
    $("#menusub_03").slideToggle(200, "linear");
    $("#menusub_02, #menusub_04").slideUp(200, "linear");
});
$("#menu_04").click(function () {
    $("#menusub_04").slideToggle(200, "linear");
    $("#menusub_02, #menusub_03").slideUp(200, "linear");
});

//______________________________________________________________________________________


// MINHAS REQUISIÇÕES
    // AO CLICAR NO BOTÃO VERDE SUPERIOR, O HISTÓRICO DE REQUISIÇÕES DO USUÁRIO LOGADO SERÁ EXIBIDA...
$("#cabecalho-botao-verde, header div .fa-clock-rotate-left").click(function() {
    $("#botao-verde-box").fadeToggle(100);
});
    // AO CLICAR NO BOTÃO DE FECHAR, O HISTÓRIDO DE REQUISIÇÕES DO USUÁRIO LOGADO SERÁ FECHADA...
$("#btn-close-botao-verde-box").click(function() {
    $("#botao-verde-box").fadeToggle(100);
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


// BOX INFORMATIVO

// AO PRECIONAR O BOTÃO, A CAIXA DE AJUDA SERÁ EXIBIDA...
$("#btn-atalho[title='Caixa de ajuda']").click(function() {
    $("#box-ajuda").fadeToggle(100);
});

// AO PRECIONAR O BOTÃO DE FECHAR, A CAIXA SERÁ FECHADA...
$("#box-ajuda-fechar-btn").click(function() {
    $("#box-ajuda").fadeToggle(100);
});

// BOX CONFIRMACAO

// AO PRECIONAR O BOTÃO, A CAIXA DE CONFIRMAÇÃO SERÁ EXIBIDA...
$("#btn-atalho[title='Excluir'], #btn-finaliza-inv").click(function() {
    $("#box-confirmacao").fadeToggle(100).css({'display': 'flex'});
});

// AO PRECIONAR O BOTÃO DE CANCELAR, A CAIXA SERÁ FECHADA...
$("#box-confirmacao #btn-cancelar").click(function() {
    $("#box-confirmacao").fadeToggle(100);
});
//_____________________________________________________________________________________


// PINTA O FUNDO CONFORME O STATUS
function corStatus() {
    let cells = document.querySelectorAll('p');

    cells.forEach(function(cell) {

        // SE A RLINHA ESTIVER ATIVADA, FICARÁ VERDE..
        if (cell.textContent.trim() === "ATIVADO") {
            cell.style.backgroundColor = '#00a000';

            
        // SE A RLINHA ESTIVER DESATIVADA, FICARÁ VERMELHO...
        } if (cell.textContent.trim() === "DESATIVADO") {
            cell.style.backgroundColor = '#cc2626';

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