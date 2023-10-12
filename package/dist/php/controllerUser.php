<?php

require_once 'modelUser.php';

$user = new User();

if ($_POST['op'] == 1){
    $res = $user -> registarUser($_POST['nome'], $_POST['tipo'],  $_POST['telemovel'],  $_POST['nif'],  $_POST['morada'],  $_POST['codP'],  $_POST['local'], $_POST['email'], $_POST['pass']);
    echo($res);
}

?>