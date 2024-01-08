<?php

require_once 'modelEquipa.php';

$equipa = new Equipa();

if($_POST['op'] == 1){
    $res = $equipa -> getEquipasUser();
    echo($res);

} else if($_POST['op'] == 2){


    $resp = $equipa -> regEquipaModel(
        $_POST['nomeEquipa'],
        $_FILES,
        $_POST['nmrEquipa'],
        $_POST['nivelEquipa'],
        $_POST['obsEquipa']
    );
   

    echo($resp);

} else if($_POST['op'] == 3){

    $resp = $equipa -> getListaEquipaModel();
    echo($resp);

} else if($_POST['op'] == 4){


    $resp = $equipa -> getDadosEquipaModel($_POST['id']);
    echo($resp);

} else if($_POST['op'] == 5){


    $resp = $equipa -> guardaEditEquipaModel(
        $_POST['nomeEquipa'],
        $_FILES,
        $_POST['nmrEquipa'],
        $_POST['nivelEquipa'],
        $_POST['obsEquipa']

    );
    echo ($resp);

} else if($_POST['op'] == 6){

    $resp = $equipa -> removeEquipaModel($_POST['id']);
    echo($resp);

}
?>