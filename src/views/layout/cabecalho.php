<?php

    if(!isset($_SESSION['usuario']))
    {
        header("Location: ../../../index.php");
        die();
    }
    
?>

<header class="cabecalho">
    <a href="inicio.php"><img src="img/sistema-logo.png"></a>
    <i class="fa-solid fa-bars" id="btn-menu"></i>
</header>