<?php

require_once 'modelEquipa.php';

$equipa = new Equipa();

if($_POST['op'] == 1){
    $res = $equipa -> getEquipasUser();
    echo($res);
}else if($_POST['op'] == 2){
    $res = $equipa -> getEquipasLocalidadeUser();
    echo($res);
}else if($_POST['op'] == 3){
    $pagina = isset($_POST['pagina']) ? intval($_POST['pagina']) : 1;
    $porPagina = 12; // Número de resultados por página
    $offset = ($pagina - 1) * $porPagina;

    $res = $equipa -> getAtletasEquipa($_POST['id'], $offset, $porPagina);
    echo($res);
}else if($_POST['op'] == 4){
    $res = $equipa -> getInfoEquipa($_POST['id']);
    echo($res);
}else if($_POST['op'] == 5){
    $res = $equipa -> getEstatisticasEquipa($_POST['id']);
    echo($res);
}else if($_POST['op'] == 6){
    $res = $equipa -> getTopAltetas($_POST['id']);
    echo($res);
}
?>