<?php

require_once 'modelDescobrir.php';

$descobrir = new Descobrir();

if($_POST['op'] == 1) {
    $res = $descobrir -> getMarcacoesAbertas();
    echo($res);
} else {

}



?>
