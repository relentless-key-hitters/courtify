<?php

require_once 'modelGrupo.php';

$grupo = new Grupo();

if($_POST['op'] == 1) {
    $res = $grupo -> getMarcacoesAbertasGrupos();
    echo($res);
} else if($_POST['op'] == 2) {
    $res = $grupo -> getGruposUser();
    echo($res);
} else if($_POST['op'] == 3) {
    $pagina = isset($_POST['pagina']) ? intval($_POST['pagina']) : 1;
    $porPagina = 12; // Número de resultados por página
    $offset = ($pagina - 1) * $porPagina;

    $res = $grupo -> getAtletasGrupo($_POST['idGrupo'], $offset, $porPagina);
    echo($res);
} else if($_POST['op'] == 4) {
    $res = $grupo -> getInfoGrupo($_POST['idGrupo']);
    echo($res);
} else if($_POST['op'] == 5) {
    $res = $grupo -> getMarcacoesConcluidasGrupo($_POST['idGrupo']);
    echo($res);
} else if($_POST['op'] == 6) {
    $res = $grupo -> getBadgesGrupo($_POST['idGrupo']);
    echo($res);
}

?>