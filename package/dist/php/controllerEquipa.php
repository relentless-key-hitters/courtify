<?php

require_once 'modelEquipa.php';

$equipa = new Equipa();

if($_POST['op'] == 1){
    $res = $equipa -> getEquipasUser();
    echo($res);
}
?>