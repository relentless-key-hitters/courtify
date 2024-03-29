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
}else if($_POST['op'] == 15){
    session_destroy();
    $res = "Sessão terminada com sucesso!";
    echo($res);
}else if($_POST['op'] == 16){
    $res = $clube -> editarPrecoHoraCampo($_POST['idCampo']);
    echo($res);
}else if($_POST['op'] == 17){
    $res = $clube -> guardarEditPrecoClube($_POST['precoNovo'], $_POST['idCampo']);
    echo($res);
}else if($_POST['op'] == 18){
    $res = $clube -> guardarEditDataManutencaoCampo($_POST['dataNovaManutencaoCampo'], $_POST['idCampo']);
    echo($res);
}else if($_POST['op'] == 19){
    $res = $clube -> alterarFotoCampoClube($_POST['idCampo']);
    echo($res);
}else if($_POST['op'] == 20){
    $res = $clube -> guardaFotoCampo($_POST['idCampo'], $_FILES);
    echo($res);
}else if($_POST['op'] == 21){
    $res = $clube -> getMembros();
    echo($res);
}else if($_POST['op'] == 22){
    $res = $clube -> guardaRemoverMembro($_POST['idMembro'], $_POST['idEquipa']);
    echo($res);
}else if($_POST['op'] == 23){
    $res = $clube -> getReservas();
    echo($res);
}else if($_POST['op'] == 24){
    $res = $clube -> cancelarReserva($_POST['idMarcacao']);
    echo($res);
}else if($_POST['op'] == 25){
    $res = $clube -> getMarcacoesPagamentos();
    echo($res);
}else if($_POST['op'] == 26){
    $res = $clube -> validarPagamento($_POST['idMarcacao']);
    echo($res);
}else if($_POST['op'] == 27){
    $res = $clube -> getMembrosAdicionar();
    echo($res);
}else if($_POST['op'] == 28){
    $res = $clube -> getEquipasSelectAdicionarMembro($_POST['idUser']);
    echo($res);
}else if($_POST['op'] == 29){
    $res = $clube -> guardaAdicionarMembros($_POST['idUser'], $_POST['idEquipa']);
    echo($res);
}

?>