<?php

require_once 'modelClube.php';

$clube = new Clube();

if ($_POST['op'] == 1){

    $res = $clube -> getInfoClube();
    echo($res);
}

?>