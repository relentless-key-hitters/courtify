<?php
session_start();
require_once 'connection.php';

class User{

    function getDistritos(){
        global $conn; 
        $msg = "<option value = '-1' selected disabled >Distrito</option><option disabled>---------------</option>";
        $sql = "SELECT * FROM distrito";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
               $msg .= "<option value = '".$row['id']."'>".$row['descricao']."</option>";
            }
        }

        $conn->close();
        return ($msg);
    }

    function getConcelhos($distrito){
        global $conn; 
        $msg = "<option value = '-1' selected disabled>Escolha um concelho</option><option disabled>---------------</option>";
        $sql = "SELECT concelho.id , concelho.descricao FROM concelho INNER JOIN distrito_concelho ON concelho.id = distrito_concelho.id_concelho WHERE distrito_concelho.id_distrito = '".$distrito."'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
               $msg .= "<option value = '".$row['id']."'>".$row['descricao']."</option>";
            }
        }

        $conn->close();
        return ($msg);
    }

    function registarUser($nome, $tipo, $telemovel, $nif, $morada, $codP, $local, $email, $pass){
        global $conn; 
        $flag = true;
        $msg = "";
        $icon = "success";
        if($local == 'null'){
            $sql = "INSERT INTO user(tipo_user, nome, telemovel, email, nif, morada, codigo_postal) VALUES ('".$tipo."', '".$nome."', '".$telemovel."', '".$email."', '".$nif."', '".$morada."', '".$codP."')";
        }else{
            $sql = "INSERT INTO user(tipo_user, nome, telemovel, email, nif, morada, codigo_postal, localidade) VALUES ('".$tipo."', '".$nome."', '".$telemovel."', '".$email."', '".$nif."', '".$morada."', '".$codP."', '".$local."')";
        }
        $sql2 = "SELECT user.id FROM user WHERE user.email = '".$email."'";
        $sql3 = "SELECT user.id FROM user WHERE user.nif = '".$nif."'";
        $result = $conn->query($sql2);
        $result2 = $conn->query($sql3);

        if ($result->num_rows > 0){
            $msg = "Já existe uma conta com este email associado!"; 
            $icon = "error";
        }else if($result2->num_rows > 0){
            $msg = "Já existe uma conta com este nif associado!"; 
            $icon = "error";
        }else{
            if ($conn->query($sql) === TRUE) {
                $id = mysqli_insert_id($conn);
                $sql2 ="INSERT INTO login(id_user, password) VALUES ('".$id."', '".$pass."')";
                $sql3 ="INSERT INTO atleta (id_atleta) VALUES ('".$id."')";
                if($conn->query($sql2) === TRUE){
                    $msg .= "Registado com sucesso!";
                }else{
                    $msg .= "Registado com sucesso mas sem credenciais de login!"; 
                }
                if($conn->query($sql3) === TRUE){
                }else{
                    $msg .= "ERRO!"; 
                }
                
            }else {
                $msg = "Error: " . $sql . "<br>" . $conn->error;
                $flag = false;
            }
        }

        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg,
            "icon" => $icon
        ));
        $conn->close();
        return ($resp);
    }
    
    function login($email, $pass){
        
        global $conn;
        $sql = "SELECT user.id, user.tipo_user FROM user WHERE email = '".$email."'";
        $result = $conn->query($sql);
        $msg = "";
        $icon = "success";
        $flag = true;
        $title = "Sucesso";
        $flagFirstLogin = false;
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $sql2 = "SELECT login.id_user FROM login WHERE id_user = '".$row['id']."' AND password = '".md5($pass)."'";
                $result2 = $conn->query($sql2);
                if($result2->num_rows > 0){
                    while($row2 = $result2->fetch_assoc()) {
                        $msg = "Login efetuado com sucesso!";
                        $_SESSION['tipo'] = $row['tipo_user'];
                        $_SESSION['id'] = $row['id'];
                        $sql3 = "SELECT sem_login.id_atleta FROM sem_login WHERE id_atleta = '". $row['id']."'";
                        $result3 = $conn->query($sql3);
                        if ($result3->num_rows > 0){
                            $flagFirstLogin = true;
                        } 
                    } 
                }else{
                    $msg = "A palavra-passe e o email não coincidem!";
                    $icon = "error";
                    $title = "Erro";
                    $flag = false;
                }  
        }}else{
            $msg = "Não há nenhuma conta registada com este email.";
            $icon = "error";
            $title = "Erro";
            $flag = false;
        }

        $resp = json_encode(array(
            "flag" => $flag,
            "flagFirstLogin" => $flagFirstLogin, 
            "msg" => $msg,
            "icon" => $icon,
            "title" => $title

        ));
        $conn->close();
        return ($resp); 
    }

    function getModalidades(){

        global $conn; 
        $msg = "";
        $sql = "SELECT id, descricao FROM modalidade";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
               $msg .= "<div class='form-check form-check-inline'>
               <input class='form-check-input success' type='checkbox' id='modalidade".$row['id']."' value='".$row['id']."' onclick='getForm(".$row['id'].")'>
               <label class='form-check-label' for='modalidade".$row['id']."'>".$row['descricao']."</label>
                </div>";
            }
        }

        $conn->close();
        return ($msg);

    }

    function getFutsalInfo(){

        global $conn; 
        $msg = "<option selected disabled>Posição</option>";
        $sql = "SELECT * FROM posicao_futsal";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
               $msg .= "<option value='".$row['id']."'>".$row['descricao']."</option>";
            }
        }

        $conn->close();
        return ($msg);

    }

    function getNivelPadel(){
        global $conn; 
        $msg = "<option selected disabled>Nível</option>";
        $sql = "SELECT * FROM nivel_padel";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
               $msg .= "<option value='".$row['id']."'>".$row['descricao']."</option>";
            }
        }

        $conn->close();
        return ($msg);

    }

    
    function uploads($img, $id){
    
        $dir = "../images/utilizadores/".$id."/";
        $dir1 = "images/utilizadores/".$id."/";
        $flag = false;
        $targetBD = "";
    
        if(!is_dir($dir)){
            if(!mkdir($dir, 0777, TRUE)){
                die ("Erro não é possivel criar o diretório");
            }
        }
        if(array_key_exists('fotoPerfil' , $img)){
        if(is_array($img)){
          if(is_uploaded_file($img['fotoPerfil']['tmp_name'])){
            $fonte = $img['fotoPerfil']['tmp_name'];
            $ficheiro = $img['fotoPerfil']['name'];
            $end = explode(".",$ficheiro);
            $extensao = end($end);
            $newName = "user".date("YmdHis").".".$extensao;
            $target = $dir.$newName;
            $targetBD = $dir1.$newName;
            $flag = move_uploaded_file($fonte, $target);
            
        } 
        }
        }
        return (json_encode(array(
        "flag" => $flag,
        "target" => $targetBD
        )));
    
    }

    function uploads2($img, $id){
    
        $dir = "../images/utilizadores/".$id."/";
        $dir1 = "images/utilizadores/".$id."/";
        $flag = false;
        $targetBD = "";
    
        if(!is_dir($dir)){
            if(!mkdir($dir, 0777, TRUE)){
                die ("Erro não é possivel criar o diretório");
            }
        }
        if(array_key_exists('fotoCapa' , $img)){
        if(is_array($img)){
          if(is_uploaded_file($img['fotoCapa']['tmp_name'])){
            $fonte = $img['fotoCapa']['tmp_name'];
            $ficheiro = $img['fotoCapa']['name'];
            $end = explode(".",$ficheiro);
            $extensao = end($end);
            $newName = "user".date("YmdHis").".".$extensao;
            $target = $dir.$newName;
            $targetBD = $dir1.$newName;
            $flag = move_uploaded_file($fonte, $target);
            
        } 
        }
        }
        return (json_encode(array(
        "flag" => $flag,
        "target" => $targetBD
        )));
    
    }

    function contRegisto($dn, $genero, $altura, $peso, $ms, $mi, $fotoPerfil, $bio, $modalidades, $posFutsal, $nivelPadel, $ladoPadel){
        
        global $conn; 
        $arrMod = json_decode($modalidades);  
        $sql = "UPDATE atleta SET data_nasc = '".$dn."', altura = '".$altura."', peso = '".$peso."', ms = '".$ms."', mi = '".$mi."', genero = '".$genero."', bio = '".$bio."' WHERE id_atleta = '".$_SESSION['id']."'";
        $msg = "";
        $flag = true;
        $respUpdate = $this -> uploads($fotoPerfil, $_SESSION['id']);
        $respUpdate = json_decode($respUpdate, TRUE);
        $icon = "success";
        if ($conn->query($sql) === TRUE){
            $sql2 = "";
            $sql3 = "";
            if($respUpdate['flag']){
                $sql4 = "UPDATE user SET foto = '".$respUpdate['target']."' WHERE id = '". $_SESSION['id']."'";
                if($conn->query($sql4) === FALSE){
                    $flag = false;
                    $icon = "error";
                    $msg = "Não foi possível guardar as alterações na foto de perfil.";
                }
            }
            for($i = 0; $i < sizeof($arrMod) ; $i++){
                $sql2 = "INSERT INTO atleta_modalidade (id_atleta, id_modalidade) VALUES ('".$_SESSION['id']."', '".$arrMod[$i]."')";
                if ($conn->query($sql2) === FALSE){
                    $flag = false;
                    $icon = "error";
                }
                if($arrMod[$i] == '2'){
                    $sql3 = "INSERT INTO info_futsal (id_atleta, id_posicao, n_jogos, n_vitorias, n_golos, n_mvp) VALUES ('".$_SESSION['id']."', '".$posFutsal."', '0', '0', '0', '0')";
                    if ($conn->query($sql3) === FALSE){
                        $flag = false;
                        $icon = "error";
                    }
                }else if($arrMod[$i] =='3'){
                    if($nivelPadel == '3'){
                        $sql3 = "INSERT INTO info_padel (id_atleta, nivel, n_jogos, n_vitorias, n_pontos_set, n_set_ganhos, n_mvp) VALUES ('".$_SESSION['id']."', '".$nivelPadel."', '0', '0' , '0' , '0' , '0')";
                    }else{
                        $sql3 = "INSERT INTO info_padel (id_atleta, id_lado, nivel, n_jogos, n_vitorias, n_pontos_set, n_set_ganhos, n_mvp) VALUES ('".$_SESSION['id']."', '".$ladoPadel."', '".$nivelPadel."', '0', '0', '0', '0' , '0')";
                    }
                    if ($conn->query($sql3) === FALSE){
                        $flag = false;
                        $icon = "error";
                    }
                }else if($arrMod[$i] == '1'){
                    $sql3 = "INSERT INTO info_basquetebol (id_atleta, n_jogos, n_vitorias, n_mvp, n_pontos) VALUES ('".$_SESSION['id']."', '0', '0', '0', '0')";
                    if ($conn->query($sql3) === FALSE){
                        $flag = false;
                        $icon = "error";
                    }
                }else{
                    $sql3 = "INSERT INTO info_tenis (id_atleta, n_jogos, n_vitorias, n_pontos_set, n_set_ganhos, n_mvp) VALUES ('".$_SESSION['id']."', '0', '0', '0', '0', '0')";
                    if ($conn->query($sql3) === FALSE){
                        $flag = false;
                        $icon = "error";
                    }
                }
            }
            if($flag === TRUE){
                $msg = "Registado com Sucesso";
            }
        } else {
            $flag = false;
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            $icon = "error";
        }
        
        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg,
            "icon" => $icon
        ));
        $conn -> close();
        return ($msg);
    }

    function getInfoPerfil(){
        global $conn; 
        $fotoPerfil = "";
        $nome = "";
        $email = "";
        $localizacao = "";
        $bio = "";
        $mod = "";
        $fotoCapa = "";
        $sql = "SELECT user.foto as foto, user.email as email, user.nome as nome, atleta.bio as bio, atleta.fotoCapa as fotoCapa FROM user INNER JOIN atleta ON user.id = atleta.id_atleta WHERE user.id = '".$_SESSION['id']."'";
        $sql2 = "SELECT concelho.descricao as concelho, distrito.descricao as distrito FROM user INNER JOIN concelho ON user.localidade = concelho.id INNER JOIN distrito_concelho ON concelho.id = distrito_concelho.id_concelho INNER JOIN distrito ON distrito_concelho.id_distrito = distrito.id WHERE user.id = '".$_SESSION['id']."'";
        $sql3 = "SELECT atleta_modalidade.id_modalidade as id, modalidade.descricao as descricao FROM atleta_modalidade INNER JOIN modalidade ON atleta_modalidade.id_modalidade = modalidade.id WHERE atleta_modalidade.id_atleta = '".$_SESSION['id']."'";
        $result = $conn->query($sql);
        $result2 = $conn->query($sql2);
        $result3 = $conn->query($sql3);
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $fotoPerfil = "../../dist/".$row['foto']."";
                $nome = $row['nome'];
                $email = $row['email'];
                $bio = $row['bio'];
                if( is_null($row['fotoCapa'])){
                    $fotoCapa = "../../dist/images/profile/backgroundBasic.png";
                }else{
                    $fotoCapa = "../../package/dist/".$row['fotoCapa'];
                }
            }
        }
        if ($result2->num_rows > 0) {
            // output data of each row
            while($row2 = $result2->fetch_assoc()) {
                $localizacao = $row2['concelho'].", ".$row2['distrito'];
            }
            }
        if ($result3->num_rows > 0) {
                // output data of each row
            while($row3 = $result3->fetch_assoc()) {
                if($row3['descricao'] == 'Basquetebol'){
                    $mod .= "<li>
                    <img src='../../dist/images/modalidades/basquetebol.png' alt='Badge 1' class='img-fluid mb-2 rounded'
                      data-toggle='tooltip' data-placement='top' title='".$row3['descricao']."' style='max-width: 45px;'>
                    </li>";
                }else if($row3['descricao'] == 'Futsal'){
                    $mod .= "<li>
                    <img src='../../dist/images/modalidades/futsal.png' alt='Badge 2' class='img-fluid mb-2 rounded'
                      data-toggle='tooltip' data-placement='top' title='".$row3['descricao']."' style='max-width: 45px;'>
                    </li>";
                }else if($row3['descricao'] == 'Padel'){
                    $mod .= "<li>
                    <img src='../../dist/images/modalidades/padel.png' alt='Badge 3' class='img-fluid mb-2 rounded'
                      data-toggle='tooltip' data-placement='top' title='".$row3['descricao']."' style='max-width: 45px;'>
                    </li>";
                }else{
                    $mod .= "<li>
                    <img src='../../dist/images/modalidades/tenis.png' alt='Badge 4' class='img-fluid mb-2 rounded'
                      data-toggle='tooltip' data-placement='top' title='".$row3['descricao']."' style='max-width: 45px;'>
                    </li>";
                }

            }
        }    

        $resp = json_encode(array(
            "fotoPerfil" => $fotoPerfil,
            "fotoCapa" => $fotoCapa,
            "nome" => $nome, 
            "email" => $email,
            "localizacao" => $localizacao,
            "bio" => $bio, 
            "mod" => $mod
        ));
        $conn -> close();
        return ($resp);
        
    }

    function altFotoCapa($fotoCapa) {
        global $conn;
        $respUpdate = $this->uploads2($fotoCapa, $_SESSION['id']);
        $respUpdate = json_decode($respUpdate, TRUE);
        $msg = "";
        $elemento = "";
        $icon = "error";
        $flag = false;
    
        if ($respUpdate['flag']) {
            
            $targetWidth = 1298;
            $targetHeight = 504;
    
            
            $path_parts = pathinfo("../../dist/" . $respUpdate['target']);
            $newFilename = $path_parts['dirname'] . '/' . $path_parts['filename'] . '_resized.' . $path_parts['extension'];
    
            
            $this-> resizeImage("../../dist/" . $respUpdate['target'], $newFilename, $targetWidth, $targetHeight);
    
            $sql = "UPDATE atleta SET fotoCapa = '" . $newFilename . "' WHERE id_atleta = '" . $_SESSION['id'] . "'";
            $elemento = "'../../dist/" . $newFilename;
    
            if ($conn->query($sql) === TRUE) {
                $msg = "Alterada com sucesso!";
                $icon = "success";
                $flag = true;
            } else {
                $msg = "Não foi possível alterar a fotografia de capa!";
            }
        } else {
            $msg = "Não foi possível alterar a fotografia de capa!";
        }
    
        $resp = json_encode(array(
            "msg" => $msg,
            "elemento" => $elemento,
            "icon" => $icon,
            "flag" => $flag
        ));
    
        $conn->close();
        return ($resp);
    }


    function resizeImage($sourceFile, $targetFile, $targetWidth, $targetHeight) {
        
        $imageType = pathinfo($sourceFile, PATHINFO_EXTENSION);
    
        
        if ($imageType == 'jpeg' || $imageType == 'jpg') {
            $sourceImage = imagecreatefromjpeg($sourceFile);
        } elseif ($imageType == 'png') {
            $sourceImage = imagecreatefrompng($sourceFile);
        } else {
            
            return false;
        }
    
        list($sourceWidth, $sourceHeight) = getimagesize($sourceFile);
    
        
        $sourceAspectRatio = $sourceWidth / $sourceHeight;
        $targetAspectRatio = $targetWidth / $targetHeight;
    
        
        $cropWidth = $sourceWidth;
        $cropHeight = $sourceHeight;
    
        
        if ($sourceAspectRatio > $targetAspectRatio) {
            
            $cropWidth = $sourceHeight * $targetAspectRatio;
        } else {
            
            $cropHeight = $sourceWidth / $targetAspectRatio;
        }
    
        
        $cropX = ($sourceWidth - $cropWidth) / 2;
        $cropY = ($sourceHeight - $cropHeight) / 2;
    
        $resizedImage = imagecreatetruecolor($targetWidth, $targetHeight);
    
        
        imagecopyresampled($resizedImage, $sourceImage, 0, 0, $cropX, $cropY, $targetWidth, $targetHeight, $cropWidth, $cropHeight);
    
        
        if ($imageType == 'jpeg' || $imageType == 'jpg') {
            imagejpeg($resizedImage, $targetFile);
        } elseif ($imageType == 'png') {
            imagepng($resizedImage, $targetFile);
        }
    
        
        imagedestroy($sourceImage);
        imagedestroy($resizedImage);
    }

    function getEditInfo(){
        global $conn; 
        $sql = "SELECT * FROM user WHERE user.id = '".$_SESSION['id']."'"; 
        $result = $conn->query($sql);
        $nome = "";
        $nif = "";
        $cp = "";
        $email = "";
        $tel = "";
        $morada = "";
        if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    $nome = $row['nome'];
                    $nif = $row['nif'];
                    $cp = $row['codigo_postal'];
                    $email = $row['email'];
                    $tel = $row['telemovel'];
                    $morada = $row['morada'];
                }
            }
        $resp = json_encode(array(
            "nome" => $nome,
            "nif" => $nif,
            "cp" => $cp,
            "email" => $email,
            "tel" => $tel,
            "morada" => $morada
        ));
        $conn ->close();
        return ($resp);
    }

    function guardaEditInfo($nome, $email, $nif, $cp, $tel, $morada, $local){

        global $conn;
        $flag = true;
        $msg = "";
        $icon ="success";
        $sql = "";
        if($local == 'null'){
            $sql = "UPDATE user SET nome = '".$nome."', email = '".$email."', nif = '".$nif."', morada = '".$morada."', telemovel = '".$tel."', codigo_postal = '".$cp."' WHERE id = '".$_SESSION['id']."'";
        }else{
            $sql = "UPDATE user SET nome = '".$nome."', email = '".$email."', nif = '".$nif."', morada = '".$morada."', telemovel = '".$tel."', codigo_postal = '".$cp."', localidade = '".$local."' WHERE id = '".$_SESSION['id']."'";
        }
        if($conn->query($sql) === TRUE){
            $msg = "Informação alterada com sucesso!";
        }else{
            $msg = "Não foi possível alterar a sua informação.";
            $flag = false;
            $icon = "error";
        }

        $resp = json_encode(array(
            "msg" => $msg,
            "icon" => $icon,
            "flag" => $flag
        ));

        $conn ->close();
        return ($resp);

    }

    function getNotificacoes(){
        global $conn;
        $sql = " SELECT listagem_atletas_marcacao.id_marcacao as idMarcacao FROM listagem_atletas_marcacao INNER JOIN marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao INNER JOIN campo_clube ON marcacao.id_campo = campo_clube.id_campo INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id WHERE listagem_atletas_marcacao.id_atleta = '".$_SESSION['id']."' AND listagem_atletas_marcacao.votacao = 0";
        $result = $conn->query($sql);
        $msg = "";
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<a class='py-6 px-7 d-flex align-items-center dropdown-item' style='cursor: pointer;' onclick = 'getModalVot(".$row['idMarcacao'].")'>
                <span class='me-3'>
                  <img src='../../dist/images/rating/vote.jpg' alt='user' class='rounded-circle object-fit-cover'
                    width='48' height='48' />
                </span>
                <div class='w-75 d-inline-block v-middle'>
                  <h6 class='mb-1 fw-semibold'>Votação Jogo</h6>
                  <span class='d-block'>Tem uma votação pendente.</span>
                </div>
              </a>";
            }
        }
        $conn ->close();
        return ($msg);

    }

    function getModalVot($id){

        global $conn;
        $sql = " SELECT marcacao.data_inicio AS dataMarc, marcacao.hora_inicio AS horaMarc, modalidade.descricao AS modalidade, user.nome AS nomeClube, user.foto as fotoClube FROM listagem_atletas_marcacao INNER JOIN marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao INNER JOIN campo_clube ON marcacao.id_campo = campo_clube.id_campo INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id INNER JOIN clube ON campo_clube.id_clube = clube.id_clube INNER JOIN user ON clube.id_clube = user.id WHERE listagem_atletas_marcacao.id_marcacao = '".$id."'";
        $result = $conn->query($sql);
        $msg = "";
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $mod = "";
                if($row['modalidade'] == "Basquetebol"){
                    $mod = "<span class='badge rounded-pill text-bg-warning mt-2 fs-5'><i
                    class='ti ti-ball-basketball me-1'></i><small>Basquetebol</small></span>";
                }else if($row['modalidade'] == "Futsal"){
                    $mod = "<span class='badge rounded-pill text-bg-warning mt-2 fs-5'><i
                    class='ti ti-ball-football me-1'></i><small>Futsal</small></span>";
                }else if($row['modalidade'] == "Padel"){
                    $mod = "<span class='badge rounded-pill text-bg-warning mt-2 fs-5'><i
                    class='ti ti-ball-tennis me-1'></i><small>Padel</small></span>";
                }else{
                    $mod = "<span class='badge rounded-pill text-bg-warning mt-2 fs-5'><i
                    class='ti ti-ball-tennis me-1'></i><small>Ténis</small></span>";
                }
                $msg .= "
                <div class='d-flex justify-content-center pb-5'>
                <h4 class='fw-semibold fs-9'>Votação</h4>
              </div>
              <div class='container-fluid text-center'>
                <div class='row'>
                  <div class='col-md-4 text-center'>
                    <img src='../../dist/images/backgrounds/racketman.png' alt='Clube 1' class='object-fit-cover'
                      style='max-width: 120px;'>
                      <h1 class='fw-semibold fs-7'>Racket Man</h1>
                  </div>
                  <div class='col-md-4' style='align-items: start;'>
                    <div class='ms-3'>
                      <small class='fs-5'><i class='ti ti-calendar me-1'></i>".$row['dataMarc']."</small><br>
                      <small class='fs-5'><i class='ti ti-clock me-1'></i>".$row['horaMarc']."</small><br>
                      <small class='fs-5'><i class='ti ti-map-pin me-1'></i>".$row['nomeClube']."</small><br>
                      ".$mod."
                    </div>
                  </div>
                  <div class='col-md-4 text-center'>
                    <img src='../../dist/images/backgrounds/demonclass.png' alt='Clube 1' class='object-fit-cover'
                      style='max-width: 120px;'>
                      <h1 class='fw-semibold fs-7'>Demon Class</h1>
                  </div>
                </div>
              </div>
              <h5 class='mt-4 text-center fw-semibold border-top border-2 border-light pt-3 fs-9'>Resultado</h5>
              <div class='d-flex justify-content-between align-items-center' style='margin: 50px;'>
                <div class='d-flex flex-column input-group-lg text-center'>
                    <h6 class='fs-5'>A tua equipa</h6>
                    <input type='number' class='form-control rounded'></input>
                </div>
                <div class='d-flex flex-column input-group-lg text-center'>
                    <h6 class='fs-5'>A equipa adversária</h6>
                    <input type='number' class='form-control rounded'></input>
                </div>
            </div>        
              <h5 class='mt-4 text-center pb-3 fs-11'>MVP</h5>
              <div class='d-flex justify-content-center align-items-center text-center'>
                <div class='row grid gap-2'>
                  <div class='col-2'>
                    <div class='d-flex align-items-center mt-2'>
                      <img src='../../dist/images/profile/boy2.jpg' alt='Participant 2'
                        class='rounded-circle object-fit-cover' width='80' height='80' onclick='toggleImageSelection(this)' data-toggle='tooltip'
                        data-placement='top' title='Rui Paulo'>
                    </div>
                    <div class='d-flex align-items-center mt-2'>
                      <img src='../../dist/images/profile/boy3.jpg' alt='Participant 2'
                        class='rounded-circle object-fit-cover' width='80' height='80' onclick='toggleImageSelection(this)' data-toggle='tooltip'
                        data-placement='top' title='Rui Paulo'>
                    </div>
                  </div>
                  <div class='col-2'>
                    <div class='d-flex align-items-center mt-2'>
                      <img src='../../dist/images/profile/boy6.jpg' alt='Participant 1'
                        class='rounded-circle object-fit-cover' width='80' height='80' onclick='toggleImageSelection(this)' data-toggle='tooltip'
                        data-placement='top' title='Fábio Santos'>
                    </div>
                    <div class='d-flex align-items-center mt-2'>
                      <img src='../../dist/images/profile/boy9.jpg' alt='Participant 2'
                        class='rounded-circle object-fit-cover' width='80' height='80' onclick='toggleImageSelection(this)' data-toggle='tooltip'
                        data-placement='top' title='Paulo Chaves'>
                    </div>
                  </div>
                  <div class='col-2'>
                    <div class='d-flex align-items-center mt-2'>
                      <img src='../../dist/images/profile/boy12.jpg' alt='Participant 1'
                        class='rounded-circle object-fit-cover' width='80' height='80' onclick='toggleImageSelection(this)' data-toggle='tooltip'
                        data-placement='top' title='Gonçalo Nunes'>
    
                    </div>
                    <div class='d-flex align-items-center mt-2'>
                      <img src='../../dist/images/profile/boy10.jpg' alt='Participant 1'
                        class='rounded-circle object-fit-cover' width='80' height='80' onclick='toggleImageSelection(this)' data-toggle='tooltip'
                        data-placement='top' title='Gonçalo Ricardo'>
                    </div>
                  </div>
                  <div class='col-2'>
                  <div class='d-flex align-items-center mt-2'>
                      <img src='../../dist/images/profile/boy11.jpg' alt='Participant 1'
                        class='rounded-circle object-fit-cover' width='80' height='80' onclick='toggleImageSelection(this)' data-toggle='tooltip'
                        data-placement='top' title='Gonçalo Nunes'>
                    </div>
                    <div class='d-flex align-items-center mt-2'>
                      <img src='../../dist/images/profile/boy8.jpg' alt='Participant 1'
                        class='rounded-circle object-fit-cover' width='80' height='80' onclick='toggleImageSelection(this)' data-toggle='tooltip'
                        data-placement='top' title='Gonçalo Ricardo'>
                    </div>
                  </div>
                  <div class='col-2'>
                  <div class='d-flex align-items-center mt-2'>
                      <img src='../../dist/images/profile/boy7.jpg' alt='Participant 1'
                      class='rounded-circle object-fit-cover' width='80' height='80' onclick='toggleImageSelection(this)' data-toggle='tooltip'
                        data-placement='top' title='Gonçalo Nunes'>
    
                    </div>
                    <div class='d-flex align-items-center mt-2'>
                      <img src='../../dist/images/profile/boy5.jpg' alt='Participant 1'
                      class='rounded-circle object-fit-cover' width='80' height='80' onclick='toggleImageSelection(this)' data-toggle='tooltip'
                        data-placement='top' title='Gonçalo Ricardo'>
    
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <h5 class='mt-4 text-center fw-semibold border-top border-2 border-light pt-3 fs-9'>Nº de Pontos</h5>
              <div class='d-flex justify-content-center align-items-center' style='margin: 50px;'>
                <div class='d-flex flex-column input-group-lg text-center'>
                    <h6 class='fs-5'>Pontos que marcaste durante o jogo</h6>
                    <input type='number' class='form-control rounded'></input>
                </div>
            </div>"; 
            
            }
        }
        $conn ->close();
        return ($msg);


    }

    function getMarcacoesNaoConcluidas() {
        global $conn;

        $sql = "";
    }
}


?>