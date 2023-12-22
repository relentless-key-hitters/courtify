<?php

require_once 'modelUser.php';

$user = new User();

if ($_POST['op'] == 1){
    $res = $user -> registarUser($_POST['nome'], $_POST['tipo'],  $_POST['telemovel'],  $_POST['nif'],  $_POST['morada'],  $_POST['codP'],  $_POST['local'], $_POST['email'], $_POST['pass']);
    echo($res);
}else if ($_POST['op'] == 2){
    $res = $user -> getDistritos();
    echo($res);
}else if ($_POST['op'] == 3){
    $res = $user -> getConcelhos($_POST['distrito']);
    echo($res);
}else if ($_POST['op'] == 4){
    $res = $user -> login($_POST['email'], $_POST['pass']);
    echo($res);
}else if ($_POST['op'] == 5){
    $res = $user -> getModalidades();
    echo($res);
}else if ($_POST['op'] == 6){
    $res = $user -> getFutsalInfo();
    echo($res);
}else if ($_POST['op'] == 7){
    $res = $user -> getNivelPadel();
    echo($res);
}else if ($_POST['op'] == 8){
    $res = $user -> contRegisto($_POST['dataNascimento'],$_POST['genero'],$_POST['altura'],$_POST['peso'],$_POST['ms'],$_POST['mi'],$_FILES,$_POST['bio'],$_POST['modalidades'],$_POST['posFutsal'],$_POST['nivelPadel'],$_POST['ladoPadel']);
    echo($res);
}else if ($_POST['op'] == 9){
    session_destroy();
    $res = "Sessão terminada com sucesso!";
    echo($res);
}else if ($_POST['op'] == 10){
    $res = $user -> getInfoPerfil($_POST['idUser']);
    echo($res);  
}else if ($_POST['op'] == 11){
    $res = $user -> altFotoCapa($_FILES);
    echo($res);  
}else if ($_POST['op'] == 12){
    $res = $user -> getEditInfo();
    echo($res);  
}else if ($_POST['op'] == 13){
    $res = $user -> guardaEditInfo($_POST['nome'], $_POST['email'], $_POST['nif'], $_POST['cp'], $_POST['tel'], $_POST['morada'], $_POST['local'], $_POST['bio']);
    echo($res);  
}else if($_POST['op'] == 14){
    $res = $user -> getNotificacoes();
    echo($res);
}else if($_POST['op'] == 15){
    $res = $user -> getModalVot($_POST['id']);
    echo($res);
}else if($_POST['op'] == 16){
    $res = $user -> getMarcacoesNaoConcluidas();
    echo($res);
}else if($_POST['op'] == 17){
    $res = $user -> votacaoBasqFuts($_POST['id'], $_POST['modalidade'], $_POST['resEquipa'], $_POST['resAdver'], $_POST['numPontos'], $_POST['idMvp']);
    echo($res);
}else if($_POST['op'] == 18){
    $res = $user -> votacaoPadelTenis($_POST['id'], $_POST['modalidade'],  $_POST['resultados'], $_POST['idMvp']);
    echo($res);
}else if($_POST['op'] == 19){
    $res = $user ->  getPerfilNavbar();
    echo($res);
}else if($_POST['op'] == 20){
    $res = $user -> getEstatisticas($_POST['id']);
    echo($res);
}else if($_POST['op'] == 21){
    $res = $user -> getNotificacaoConviteMarcacao();
    echo($res);
}else if($_POST['op'] == 22){
    $res = $user -> getModalConviteMarcacao($_POST['id']);
    echo($res);
}else if($_POST['op'] == 23){
    $res = $user -> aceitarConvite($_POST['idMarcacao']);
    echo($res);
}else if($_POST['op'] == 24){
    $res = $user -> rejeitarConvite($_POST['idMarcacao']);
    echo($res);
}else if($_POST['op'] == 25){
    $res = $user -> adicionarAmigo($_POST['idAmigo']);
    echo($res);
}else if($_POST['op'] == 26){
    $res = $user -> notificacaoPedidoAmizade();
    echo($res);
}else if($_POST['op'] == 27){
    $res = $user -> aceitarPedido($_POST['id']);
    echo($res);
}else if($_POST['op'] == 28){
    $res = $user -> rejeitarPedido($_POST['id']);
    echo($res);
}else if($_POST['op'] == 29){
    $pagina = isset($_POST['pagina']) ? intval($_POST['pagina']) : 1;
    $porPagina = 4; // Número de resultados por página
    $offset = ($pagina - 1) * $porPagina;

    $res = $user -> getJogosRecentes($_POST['idUser'], $offset, $porPagina);
    echo($res);
}else if($_POST['op'] == 30){
    $res = $user -> getModalRemoverAmizade($_POST['idAmigo']);
    echo($res);
}else if($_POST['op'] == 31){
    $res = $user -> removerAmizade($_POST['idAmigo']);
    echo($res);
}else if($_POST['op'] == 32){
    $res = $user -> getComunidades($_POST['userId']);
    echo($res);
}else if($_POST['op'] == 33){
    $res = $user -> getAtletasPesquisaNavbar();
    echo($res);
}else if($_POST['op'] == 34){
    $res = $user -> getGraficos($_POST['userId']);
    echo($res);
}



?>