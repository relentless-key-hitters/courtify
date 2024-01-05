<?php

require_once 'modelEstatisticas.php';
$estatisticas = new Estatistica();

if ($_POST['op'] == 1){
    $res = $estatisticas -> estatisticasBasquetebol();
    echo($res);
}else if ($_POST['op'] == 2){
    $res = $estatisticas -> estatisticasFutsal();
    echo($res);
}else if ($_POST['op'] == 3){
    $res = $estatisticas -> estatisticasPadel();
    echo($res);
}else if ($_POST['op'] == 4){
    $res = $estatisticas -> estatisticasTenis();
    echo($res);
}

?>
