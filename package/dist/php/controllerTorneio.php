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
        $_POST['trEstado'],
        $_FILES
    );
   
    header('Content-Type: application/json');

    echo json_encode($resp);

} else if($_POST['op'] == 2) {

} 

?>
