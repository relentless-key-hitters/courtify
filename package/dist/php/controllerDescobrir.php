<?php

require_once 'modelDescobrir.php';

$descobrir = new Descobrir();

if($_POST['op'] == 1) {
    $res = $descobrir -> getMarcacoesAbertasLocalidade();
    echo($res);
} else if($_POST['op'] == 2) {
    $res = $descobrir -> getMarcacoesAbertasModalidades();
    echo($res);
} else if($_POST['op'] == 3) {
    $res = $descobrir -> juntarMarcacao($_POST['idMarcacao']);
    echo($res);
} else if($_POST['op'] == 4) {
    $res = $descobrir -> getMarcacoesAbertasAmigos();
    echo($res);
}else if($_POST['op'] == 5){
    $res = $descobrir -> getModalJuntarMarcacao($_POST['idMarcacao']);
    echo($res);
}

?>
