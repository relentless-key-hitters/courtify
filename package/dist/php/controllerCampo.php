<?php

require_once 'modelCampo.php';

$campo = new Campo();

if ($_POST['op'] == 1){
    $res = $campo -> getCampo($_POST['localidade']);
    echo($res);
} else if ($_POST['op'] == 2){
    $res = $campo -> getUserLocation();
    echo($res);
} else if ($_POST['op'] == 3){
    $res = $campo -> getModalidadesUtilizadorSelect();
    echo($res);
} else if ($_POST['op'] == 4){
    $res = $campo ->  pesquisarCampos($_POST['stringPesquisa'], $_POST['modalidadePesquisa'], $_POST['dataPesquisa'], $_POST['horaPesquisa']);
    echo($res);
}
?>