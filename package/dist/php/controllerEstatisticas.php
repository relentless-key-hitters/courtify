<?php

require_once 'modelEstatisticas.php';
$estatisticas = new Estatistica();

if ($_POST['op'] == 1){
    $res = $estatisticas -> estatisticasBasquetebol();
    echo($res);
}

?>
