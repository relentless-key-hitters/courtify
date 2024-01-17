<?php

require_once 'modelClube.php';

$clube = new Clube();

if ($_POST['op'] == 1){
    $res = $clube -> getInfoClube();
    echo($res);
}else if ($_POST['op'] == 2){
    $res = $clube -> getMelhoresAtletas();
    echo($res);
}else if ($_POST['op'] == 3){
    $res = $clube ->  getCampoMaisUsadoAno();
    echo($res);
} else if($_POST['op'] == 4){
    $res = $clube ->  getNomeClube();
    echo($res);
}else if($_POST['op'] == 5){
    $res = $clube ->  getDadosHoje();
    echo($res);
}else if ($_POST['op'] == 6){
    $res = $clube -> getInfoDefinicoesClube();
    echo($res);
}else if ($_POST['op'] == 7){
    $res = $clube -> getHorariosDefinicoesClube();
    echo($res);
}else if ($_POST['op'] == 8){
    $res = $clube -> getGraficoMarcacao();
    echo($res);
}else if ($_POST['op'] == 9){
    $res = $clube -> getGraficoGanhos();
    echo($res);
}else if ($_POST['op'] == 10){
    $res = $clube -> getGraficoGanhos();
    echo($res);
}else if ($_POST['op'] == 11){
    $res = $clube -> getCamposClube();
    echo($res);
}else if ($_POST['op'] == 12){
    $res = $clube -> alterarFotoClube($_FILES);
    echo($res);
} else if($_POST['op'] == 13){
    $res = $clube -> guardarEditClube(
        $_POST['nomeClubeEdit'], 
        $_POST['anoFundacaoClubeEdit'], 
        $_POST['telemovelClubeEdit'], 
        $_POST['telefoneClubeEdit'], 
        $_POST['moradaClubeEdit'], 
        $_POST['descricaoClubeEdit'], 
        $_POST['emailClubeEdit'], 
        $_POST['nifClubeEdit'], 
        $_POST['cpClubeEdit'], 
        $_POST['distritoClubeEdit'],
        $_POST['concelhoClubeEdit'],
        $_POST['latitudeClubeEdit'],
        $_POST['longitudeClubeEdit'],
        $_POST['objHorarios'],
        isset($_POST['passwordAtualClubeEdit']) ? $_POST['passwordAtualClubeEdit'] : null,
        isset($_POST['passwordNovaClubeEdit']) ? $_POST['passwordNovaClubeEdit'] : null,
        isset($_POST['passwordNovaClubeEdit2']) ? $_POST['passwordNovaClubeEdit2'] : null
    );
    echo($res);
}else if($_POST['op'] == 14){
    $res = $clube -> getCamposManutencao();
    echo($res);
}

?>