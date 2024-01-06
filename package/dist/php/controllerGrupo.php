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
    $pagina = isset($_POST['pagina']) ? intval($_POST['pagina']) : 1;
    $porPagina = 4; // Número de resultados por página
    $offset = ($pagina - 1) * $porPagina;

    $res = $grupo -> getMarcacoesConcluidasGrupo($_POST['idGrupo'], $offset, $porPagina);
    echo($res);
} else if($_POST['op'] == 6) {
    $res = $grupo -> getBadgesGrupo($_POST['idGrupo']);
    echo($res);
} else if($_POST['op'] == 7) {
    $res = $grupo -> getBotoesMenus($_POST['idGrupo']);
    echo($res);
} else if($_POST['op'] == 8) {
    $res = $grupo -> sairGrupo($_POST['idGrupo']);
    echo($res);
} else if($_POST['op'] == 9) {
    $res = $grupo -> juntarGrupo($_POST['idGrupo']);
    echo($res);
} else if($_POST['op'] == 10) {
    $res = $grupo -> getInfoEditGrupo($_POST['idGrupo']);
    echo($res);
} else if($_POST['op'] == 11) {
    $res = $grupo -> guardaEditGrupo($_POST['idGrupo'], $_POST['nomeGrupo'], $_POST['descricaoGrupo'], $_FILES);
    echo($res);
} else if($_POST['op'] == 12) {
    $res = $grupo -> apagarGrupo($_POST['idGrupo']);
    echo($res);
} else if($_POST['op'] == 13) {
    $res = $grupo -> getMembrosGrupo($_POST['idGrupo']);
    echo($res);
} else if($_POST['op'] == 14) {
    $res = $grupo -> removerMembroGrupo($_POST['idUser'], $_POST['idGrupo']);
    echo($res);
} else if($_POST['op'] == 15) {
    $res = $grupo -> registaGrupo($_POST['nome'], $_POST['descricao'], $_POST['modalidade'], $_FILES);
    echo($res);
}

?>