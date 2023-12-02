<?php

require_once 'modelDescobrir.php';

$descobrir = new Descobrir();

if($_POST['op'] == 1) {
    $res = $descobrir -> getMarcacoesAbertasLocalidade();
    echo($res);
} else if($_POST['op'] == 2) {
    $res = $descobrir -> getMarcacoesAbertasModalidades();
    echo($res);
}

?>
