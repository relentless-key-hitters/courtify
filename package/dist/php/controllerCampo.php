<?php

require_once 'modelCampo.php';

$campo = new Campo();

if ($_POST['op'] == 1){
    $pagina = isset($_POST['pagina']) ? intval($_POST['pagina']) : 1;
    $porPagina = 4; // Número de resultados por página
    $offset = ($pagina - 1) * $porPagina;

    $res = $campo->getCampo($_POST['localidade'], $offset, $porPagina);
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
}else if ($_POST['op'] == 5){
    $res = $campo -> getInfoPagCampo($_POST['id']);
    echo($res);
}else if ($_POST['op'] == 6){
    $res = $campo -> openModalMarcacao($_POST['id']);
    echo($res);
}else if ($_POST['op'] == 7){
    $res = $campo -> guardarMarcacao($_POST['id'], $_POST['duracao'], $_POST['horas'], $_POST['tipoMarcacao'], $_POST['listaIdsAmigosMarcacao']);
    echo($res);
}
?>