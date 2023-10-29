<?php

require_once 'modelCampo.php';

$campo = new Campo();

if ($_POST['op'] == 1){
    $res = $campo -> getCampo();
    echo($res);
}

?>