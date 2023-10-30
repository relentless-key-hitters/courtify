<?php

require_once 'modelUser.php';

$user = new User();

if ($_POST['op'] == 1){
    $res = $user -> registarUser($_POST['nome'], $_POST['tipo'],  $_POST['telemovel'],  $_POST['nif'],  $_POST['morada'],  $_POST['codP'],  $_POST['local'], $_POST['email'], $_POST['pass']);
    echo($res);
}else if ($_POST['op'] == 2){
    $res = $user -> getDistritos();
    echo($res);
}else if ($_POST['op'] == 3){
    $res = $user -> getConcelhos($_POST['distrito']);
    echo($res);
}else if ($_POST['op'] == 4){
    $res = $user -> login($_POST['email'], $_POST['pass']);
    echo($res);
}else if ($_POST['op'] == 5){
    $res = $user -> getModalidades();
    echo($res);
}else if ($_POST['op'] == 6){
    $res = $user -> getFutsalInfo();
    echo($res);
}else if ($_POST['op'] == 7){
    $res = $user -> getNivelPadel();
    echo($res);
}else if ($_POST['op'] == 8){
    $res = $user -> contRegisto($_POST['dataNascimento'],$_POST['genero'],$_POST['altura'],$_POST['peso'],$_POST['ms'],$_POST['mi'],$_FILES,$_POST['bio'],$_POST['modalidades'],$_POST['posFutsal'],$_POST['nivelPadel'],$_POST['ladoPadel']);
    echo($res);
}else if ($_POST['op'] == 9){
    session_destroy();
    $res = "Sessão terminada com sucesso!";
    echo($res);
}else if ($_POST['op'] == 10){
    $res = $user -> getInfoPerfil();
    echo($res);  
}else if ($_POST['op'] == 11){
    $res = $user -> altFotoCapa($_FILES);
    echo($res);  
}
?>