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
}

?>