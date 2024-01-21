<?php

require_once 'modelTorneio.php';

$torneio = new Torneio();

if($_POST['op'] == 1){


    $resp = $torneio -> regTorneioModel(
        $_POST['trDesc'],
        $_POST['trData'],
        $_POST['trHora'],
        $_POST['trNmr'],
        $_POST['trPreco'],
        $_POST['trNivel'],
        $_POST['trGen'],
        $_FILES,
        $_POST['trObs'],
        $_POST['trModalidade']
    );
   

    echo($resp);

} else if($_POST['op'] == 2){

    $resp = $torneio -> getListaTorneioModel();
    echo($resp);

} else if($_POST['op'] == 3){


    $resp = $torneio -> getDadosTorneioModel($_POST['id']);
    echo($resp);

} else if($_POST['op'] == 4){


    $resp = $torneio -> guardaEditTorneioModel(
        $_POST['trId'],
        $_POST['trDescEdit'],
        $_POST['trDataEdit'],
        $_POST['trHoraEdit'],
        $_POST['trNmrEdit'],
        $_POST['trPrecoEdit'],
        $_POST['trGenEdit'],
        $_POST['trNivelEdit'],
        $_FILES,
        $_POST['trObsEdit'],
        $_POST['trModalidadeEdit']

    );
    echo ($resp);

} else if($_POST['op'] == 5){

    $resp = $torneio -> removeTorneioModel($_POST['id']); 
    echo($resp);

} else if($_POST['op'] == 6){
    $resp = $torneio -> getModalidadesNovoTorneio();
    echo($resp);
}

?>
