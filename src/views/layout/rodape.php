<?php

    if(!isset($_SESSION['usuario']))
    {
        header("Location: ../../../index.php");
        die();
    }
    
?>

<footer class="conteudo-rodape">
    <small>Inventário de Telefonia - ID DO BRASIL LOGÍSTICA LTDA. - 2024</small>
</footer>