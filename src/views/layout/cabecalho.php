<?php

    if(!isset($_SESSION['usuario']))
    {
        header("Location: ../../../index.php");
        die();
    }
    
?>

<header class="cabecalho">
    <div>
        <a>
            <div id="cabecalho-botao-verde">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span>
                    <p>Exibir meu historico de</p>
                    <h3>Requisições</h3>
                </span>
            </div>
        </a>
        <a href="requisicao.php">
            <div id="cabecalho-botao-amarelo">
                <i class="fa-solid fa-basket-shopping"></i>
                <span>
                    <p>Abrir uma nova</p>
                    <h3>Requisição</h3>
                </span>
            </div>
        </a>
    </div>
    <a href="inicio.php"><img src="img/sistema-logo.png"></a>
    <i class="fa-solid fa-bars" id="btn-menu"></i>
</header>