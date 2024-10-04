<?php

    if(!isset($_SESSION['usuario']))
    {
        header("Location: ../../../index.php");
        die();
    }
    
?>

<header class="cabecalho">
    <i class="fa-solid fa-bars" id="btn-menu"></i>
</header>