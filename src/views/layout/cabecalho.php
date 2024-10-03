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
                <i class="fa-solid fa-circle-question"></i>
                <span>
                    <p>Preebcher</p>
                    <h3>Preencher</h3>
                </span>
            </div>
        </a>
        <a href="">
            <div id="cabecalho-botao-amarelo">
                <i class="fa-solid fa-circle-question"></i>
                <span>
                    <p>Preebcher</p>
                    <h3>Preencher</h3>
                </span>
            </div>
        </a>
    </div>
    <a href="inicio.php"><img src="img/sistema-logo.png"></a>
    <i class="fa-solid fa-bars" id="btn-menu"></i>
</header>