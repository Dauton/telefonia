<?php

// EXIBE A DATA ATUAL
function exibeDataAtual()
{

    date_default_timezone_set("America/Sao_Paulo");
    $dataAtual = date("d/m/Y");
    return $dataAtual;

}