<?php

require_once 'modelClube.php';

$clube = new Clube();

if ($_POST['op'] == 1){
    $res = $clube -> getInfoClube();
    echo($res);
}else if ($_POST['op'] == 2){
    $res = $clube -> getMelhoresAtletas();
    echo($res);
}else if ($_POST['op'] == 3){
    $res = $clube ->  getCampoMaisUsadoAno();
    echo($res);
} else if($_POST['op'] == 4){
    $res = $clube ->  getNomeClube();
    echo($res);
}else if($_POST['op'] == 5){
    $res = $clube ->  getDadosHoje();
    echo($res);
}else if ($_POST['op'] == 6){
    $res = $clube -> getInfoDefinicoesClube();
    echo($res);
}else if ($_POST['op'] == 7){
    $res = $clube -> getHorariosDefinicoesClube();
    echo($res);
}

?>