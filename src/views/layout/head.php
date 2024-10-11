<?php

    if(!isset($_SESSION['usuario']))
    {
        header("Location: ../../../index.php");
        die();
    }
    
?>

<meta charset='utf-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<title>Telefonia IDL</title>
<link rel="shortcut icon" type="imagex/png" href="img/id-logo-browser.png">
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta name="desciption" content="Inventário de telefonia e chamados.">
<meta name="author" content="Dauton Pereira Félix, Analista de TI - 2024">
<meta name="theme-color" content="#00384b">
<meta name="google" content="notranslate">
<link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playpen+Sans:wght@500&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/d8ed80570b.js" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel='stylesheet' type='text/css' href='css/toastr.min.css'>