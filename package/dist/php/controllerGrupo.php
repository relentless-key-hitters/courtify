<?php

require_once 'modelGrupo.php';

$grupo = new Grupo();

if($_POST['op'] == 1) {
    $res = $grupo -> getMarcacoesAbertasGrupos();
    echo($res);
}

?>