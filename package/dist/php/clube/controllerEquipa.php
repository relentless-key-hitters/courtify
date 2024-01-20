<?php

require_once 'modelEquipa.php';


$equipa = new Equipa();
if($_POST['op'] == 1){

    $resp = $equipa -> regEquipaModel(
        $_POST['nomeEq'],
        $_POST['modEq'],
        $_POST['descEq'],
        $_FILES
    );

    echo($resp);

} else if($_POST['op'] == 2){

    $resp = $equipa -> getListaEquipaModel();
    echo($resp);

} else if($_POST['op'] == 3){

    $resp = $equipa -> getDadosEquipaModel($_POST['id']);
    echo($resp);

} else if($_POST['op'] == 4){


    $resp = $equipa -> guardaEditEquipaModel(
        $_POST['idEq'],
        $_POST['nomeEq'],
        $_POST['modEq'],
        $_POST['descEq'],
        isset($_FILES['imagemEq']) ? $_FILES['imagemEq'] : null
    );

    echo ($resp);

} else if($_POST['op'] == 5){

    $resp = $equipa -> removeEquipaModel($_POST['id']);
    echo($resp);

}
?>