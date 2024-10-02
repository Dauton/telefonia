<?php

    if(!isset($_SESSION['usuario']))
    {
        header("Location: ../../../index.php");
        die();
    }
    
?>

<footer class="conteudo-rodape">
    <small>Controle e Requisição de Insumos - ID DO BRASIL LOGISTICA LTDA - 2024</small>
</footer>