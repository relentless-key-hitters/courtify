<?php

require_once 'modelTorneioUser.php';

$torneioUser = new TorneioUser();

if($_POST['op'] == 1) {
    $res = $torneioUser -> getTorneiosAbertosUser();
    echo($res);
}if($_POST['op'] == 2) {
    $res = $torneioUser -> juntarTorneio($_POST['idTorneio']);
    echo($res);
}

?>