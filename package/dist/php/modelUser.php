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
        if($flag) {
            $resp = json_encode(array(
                "flag" => $flag,
                "flagFirstLogin" => $flagFirstLogin, 
                "msg" => $msg,
                "icon" => $icon,
                "title" => $title,
                "id" => $_SESSION['id']
    
            ));
        } else {
            $resp = json_encode(array(
                "flag" => $flag,
                "flagFirstLogin" => $flagFirstLogin, 
                "msg" => $msg,
                "icon" => $icon,
                "title" => $title
    
            ));
        }
        $conn->close();
    
        return ($resp); 
    }

    function getModalidades(){

        global $conn; 
        $msg = "";
        $sql = "SELECT id, descricao FROM modalidade";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

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

    function getInfoPerfil($id){
        global $conn; 
        $fotoPerfil = "";
        $nome = "";
        $email = "";
        $localizacao = "";
        $bio = "";
        $mod = "";
        $fotoCapa = "";
        $altFotoCapaIcon = "";
        if($id == $_SESSION['id']){
            $altFotoCapaIcon .="<i class='fas fa-pencil-alt text-white fs-6' data-toggle='tooltip' data-placement='top' title='Editar'
            data-bs-toggle='modal' data-bs-target='#vertical-center-modal'></i>";
        }
        $sql = "SELECT user.foto as foto, user.email as email, user.nome as nome, atleta.bio as bio, atleta.fotoCapa as fotoCapa FROM user INNER JOIN atleta ON user.id = atleta.id_atleta WHERE user.id = ".$id;
        $sql2 = "SELECT concelho.descricao as concelho, distrito.descricao as distrito FROM user INNER JOIN concelho ON user.localidade = concelho.id INNER JOIN distrito_concelho ON concelho.id = distrito_concelho.id_concelho INNER JOIN distrito ON distrito_concelho.id_distrito = distrito.id WHERE user.id = ".$id;
        $sql3 = "SELECT atleta_modalidade.id_modalidade as id, modalidade.descricao as descricao FROM atleta_modalidade INNER JOIN modalidade ON atleta_modalidade.id_modalidade = modalidade.id WHERE atleta_modalidade.id_atleta = ".$id;
        $result = $conn->query($sql);
        $result2 = $conn->query($sql2);
        $result3 = $conn->query($sql3);
        if ($result->num_rows > 0) {

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

            while($row2 = $result2->fetch_assoc()) {
                $localizacao = $row2['concelho'].", ".$row2['distrito'];
            }
            }
        if ($result3->num_rows > 0) {

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
            "mod" => $mod,
            "altFotoCapa" => $altFotoCapaIcon
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
        $sql = "SELECT user.*, atleta.bio  FROM user INNER JOIN atleta on user.id = atleta.id_atleta WHERE user.id = '".$_SESSION['id']."'"; 
        $result = $conn->query($sql);
        $nome = "";
        $nif = "";
        $cp = "";
        $email = "";
        $tel = "";
        $morada = "";
        if ($result->num_rows > 0) {

                while($row = $result->fetch_assoc()) {
                    $nome = $row['nome'];
                    $nif = $row['nif'];
                    $cp = $row['codigo_postal'];
                    $email = $row['email'];
                    $tel = $row['telemovel'];
                    $morada = $row['morada'];
                    $bio = $row['bio'];
                }
            }
        $resp = json_encode(array(
            "nome" => $nome,
            "nif" => $nif,
            "cp" => $cp,
            "email" => $email,
            "tel" => $tel,
            "morada" => $morada,
            "bio" => $bio
        ));
        $conn ->close();
        return ($resp);
    }

    function guardaEditInfo($nome, $email, $nif, $cp, $tel, $morada, $local, $bio){

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
        $sql2 = "UPDATE atleta SET bio = '".$bio."' WHERE id_atleta = '".$_SESSION['id']."'";
        if($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE){
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
        $modalidade = "";
        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                $mvp = "";
                $corpo = "";
                $mod = "";
                $modalidade = $row['modalidade'];
                if($row['modalidade'] == "Basquetebol" || $row['modalidade'] == "Futsal"){
                    $mvp = "<div class='col-2'>
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
                  </div>";
                }else{
                    $mvp = "
                    <div class='d-flex justify-content-center gap-4'>
                        <div class='col-3'>
                        <div class='d-flex align-items-center mt-2'>
                        <img src='../../dist/images/profile/boy2.jpg' alt='Participant 2'
                            class='rounded-circle object-fit-cover' width='80' height='80' onclick='toggleImageSelection(this)' data-toggle='tooltip'
                            data-placement='top' title='Rui Paulo'>
                        </div>
                        </div>
                        <div class='col-3'>
                        <div class='d-flex align-items-center mt-2'>
                        <img src='../../dist/images/profile/boy3.jpg' alt='Participant 2'
                            class='rounded-circle object-fit-cover' width='80' height='80' onclick='toggleImageSelection(this)' data-toggle='tooltip'
                            data-placement='top' title='Rui Paulo'>
                        </div>
                    </div>
                    <div class='col-3'>
                        <div class='d-flex align-items-center mt-2'>
                        <img src='../../dist/images/profile/boy6.jpg' alt='Participant 1'
                            class='rounded-circle object-fit-cover' width='80' height='80' onclick='toggleImageSelection(this)' data-toggle='tooltip'
                            data-placement='top' title='Fábio Santos'>
                        </div>
                        </div>
                    </div>";
                }
                if($row['modalidade'] == "Basquetebol"){
                    $mod .= "<span class='badge rounded-pill text-bg-warning mt-2 fs-5'><i
                    class='ti ti-ball-basketball me-1'></i><small>Basquetebol</small></span>";
                    $corpo .= "<h5 class='mt-4 text-center fw-semibold border-top border-2 border-light pt-3 fs-9'>Resultado</h5>
                    <div class='d-flex justify-content-between align-items-center' style='margin: 50px;'>
                      <div class='d-flex flex-column input-group-lg text-center'>
                          <h6 class='fs-5'>A tua equipa</h6>
                          <input type='number' class='form-control rounded' id='resultadoEquipa'></input>
                      </div>
                      <div class='d-flex flex-column input-group-lg text-center'>
                          <h6 class='fs-5'>A equipa adversária</h6>
                          <input type='number' class='form-control rounded' id='resultadoAdvers'></input>
                      </div>
                  </div>        
                    <h5 class='mt-4 text-center pb-3 fs-11'>MVP</h5>
                    <div class='d-flex justify-content-center align-items-center text-center'>
                      <div class='row'>
                   ".$mvp."</div>
                    </div>
                  </div>
                  <h5 class='mt-4 text-center fw-semibold border-top border-2 border-light pt-3 fs-9'>Nº de Pontos</h5>
                    <div class='d-flex justify-content-center align-items-center' style='margin: 50px;'>
                      <div class='d-flex flex-column input-group-lg text-center'>
                          <h6 class='fs-5'>Pontos que marcaste durante o jogo</h6>
                          <input type='number' class='form-control rounded'  id='numPontos'></input>
                      </div>
                  </div>";
                }else if($row['modalidade'] == "Futsal"){
                    $mod = "<span class='badge rounded-pill text-bg-warning mt-2 fs-5'><i
                    class='ti ti-ball-football me-1'></i><small>Futsal</small></span>";
                    $corpo .= "<h5 class='mt-4 text-center fw-semibold border-top border-2 border-light pt-3 fs-9'>Resultado</h5>
                    <div class='d-flex justify-content-between align-items-center' style='margin: 50px;'>
                      <div class='d-flex flex-column input-group-lg text-center'>
                          <h6 class='fs-5'>A tua equipa</h6>
                          <input type='number' class='form-control rounded' id='resultadoEquipa'></input>
                      </div>
                      <div class='d-flex flex-column input-group-lg text-center'>
                          <h6 class='fs-5'>A equipa adversária</h6>
                          <input type='number' class='form-control rounded' id='resultadoAdvers'></input>
                      </div>
                  </div>        
                    <h5 class='mt-4 text-center pb-3 fs-11'>MVP</h5>
                    <div class='d-flex justify-content-center align-items-center text-center'>
                      <div class='row'>
                   ".$mvp."</div>
                    </div>
                  </div>
                  <h5 class='mt-4 text-center fw-semibold border-top border-2 border-light pt-3 fs-9'>Nº de Golos</h5>
                    <div class='d-flex justify-content-center align-items-center' style='margin: 50px;'>
                      <div class='d-flex flex-column input-group-lg text-center'>
                          <h6 class='fs-5'>Golos que marcaste durante o jogo</h6>
                          <input type='number' class='form-control rounded' id='numPontos'></input>
                      </div>
                  </div>";
                }else if($row['modalidade'] == "Padel"){
                    $mod = "<span class='badge rounded-pill text-bg-warning mt-2 fs-5'><i
                    class='ti ti-ball-tennis me-1'></i><small>Padel</small></span>";
                    $corpo .= "<h5 class='mt-4 text-center fw-semibold border-top border-2 border-light pt-3 fs-9'>Resultado</h5>
                    <div class='d-flex align-items-center' style='margin: 50px;'>
                    <div class='col-5'>
                        <h6 class='fs-5 ms-5'>Quantos sets jogaram?</h6>
                    </div>
                    <div class='col-7'>      
                      <select class='form-select w-75' onchange= 'getSets(this.value)'>
                        <option value = '-1'>Seleciona uma opção</option>
                        <option value = '1'>1</option>
                        <option value = '2'>2</option>
                        <option value = '3'>3</option>
                        <option value = '4'>4</option>
                        <option value = '5'>5</option>
                      </select>
                    </div>
                    </div>                     
                    <div id = 'campoResultadoSets'>
                    </div>         
                    <h5 class='mt-4 text-center pb-3 fs-11'>MVP</h5>
                    <div class='d-flex justify-content-center align-items-center text-center'>
                      <div class='row'>
                   ".$mvp."</div>
                    </div>
                  </div>";
                }else{
                    $mod = "<span class='badge rounded-pill text-bg-warning mt-2 fs-5'><i
                    class='ti ti-ball-tennis me-1'></i><small>Ténis</small></span>";
                    $corpo .= "<h5 class='mt-4 text-center fw-semibold border-top border-2 border-light pt-3 fs-9'>Resultado</h5>
                    <div class='d-flex align-items-center' style='margin: 50px;'>
                    <div class='col-5'>
                        <h6 class='fs-5 ms-5'>Quantos sets jogaram?</h6>
                    </div>
                    <div class='col-7'>      
                      <select class='form-select w-75' onchange= 'getSets(this.value)'>
                        <option value = '-1'>Seleciona uma opção</option>
                        <option value = '1'>1</option>
                        <option value = '2'>2</option>
                        <option value = '3'>3</option>
                        <option value = '4'>4</option>
                        <option value = '5'>5</option>
                      </select>
                    </div>
                    </div>                     
                    <div id = 'campoResultadoSets'>
                    </div>         
                    <h5 class='mt-4 text-center pb-3 fs-11'>MVP</h5>
                    <div class='d-flex justify-content-center align-items-center text-center'>
                      <div class='row'>
                   ".$mvp."</div>
                    </div>
                  </div>";
                }

                $data = new DateTime($row['dataMarc']);
                $stringData = $data -> format('d/m/Y');

                $hora = new DateTime($row['horaMarc']);
                $stringHora = $hora->format('H:i');

                $msg .= "
                <div class='d-flex justify-content-center pb-5'>
                <h4 class='fw-semibold fs-9'>Votação</h4>
              </div>
              <div class='container-fluid'>
                <div class='row'>
                  <div class='col-md-6 text-center'>
                    <img src='".$row['fotoClube']."' alt='Clube 1' class='img-fluid rounded border border-1 border-primary'
                      style='max-width: 300px;'>
                  </div>
                  <div class='col-md-6' style='align-items: start;'>
                    <div class='mb-3'>
                      <small class='fs-5'><i class='ti ti-calendar me-1'></i>".$stringData."</small><br>
                      <small class='fs-5'><i class='ti ti-clock me-1'></i>".$stringHora."</small><br>
                      <small class='fs-5'><i class='ti ti-map-pin me-1'></i>".$row['nomeClube']."</small><br>
                      ".$mod."
                    </div>
                  </div>
                </div>
              </div>".$corpo; 
            }
        }
        $resp = json_encode(array(
            "msg" => $msg,
            "modalidade" => $modalidade
        ));

        $conn ->close();
        return ($resp);


    }

    function getMarcacoesNaoConcluidas() {
        
        global $conn;
        $contador = 0;
        $msg = "";
        $arrayHorasMarcacoesCalendario = array();

        $sql = "SELECT
        marcacao.data_inicio AS dataMarc, 
        marcacao.hora_inicio AS horaMarcInicio,
        marcacao.hora_fim AS horaMarcFim,  
        modalidade.descricao AS modalidade, 
        user.id AS idClube,
        user.nome AS nomeClube, 
        user.foto as fotoClube, 
        user.nome AS nomeClube, 
		campo.foto AS fotoCampo,
		campo.nome AS nomeCampo,
        listagem_atletas_marcacao.votacao as estadoVotacao 
        FROM listagem_atletas_marcacao 
        INNER JOIN marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao 
        INNER JOIN campo_clube ON marcacao.id_campo = campo_clube.id_campo 
        INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id 
        INNER JOIN clube ON campo_clube.id_clube = clube.id_clube 
        INNER JOIN user ON clube.id_clube = user.id
        INNER JOIN campo ON campo_clube.id_campo = campo.id
		WHERE listagem_atletas_marcacao.id_atleta = '".$_SESSION['id']."'
        AND listagem_atletas_marcacao.votacao = 2 ORDER BY marcacao.data_inicio ASC";

        $result = $conn->query($sql);
        $horaA = "";
        $msgA = "";
        $diaA = "";
    
        if ($result->num_rows > 0) {
            $flag = false;
            while($row = $result->fetch_assoc()) {
                $currentDate = "";
                $currentDate .= date("Y-m-d");
                $rowDate = $row['dataMarc'];
                if($contador < 2 && $currentDate < $rowDate) {
                    if($contador == 0) {

                        $data = new DateTime($row['dataMarc']);
                        $stringData = $data -> format('d/m/Y');

                        $hora = new DateTime($row['horaMarcInicio']);
                        $stringHora = $hora->format('H:i');

                        $msgA = "<div class='col-lg-12'>
                        <div class='card card-hover align-items-center shadow' style='margin: 20px 40px;'>
                            <img src='".$row['fotoCampo']."' class='card-img-top' alt='".$row['nomeCampo']."'>
                            <div class='p-3'>
                                <h5 class='card-title fs-7'><i class='ti ti-map-pin me-1'></i>".$row['nomeCampo']."</h5>
                                <div class='d-flex justify-content-around'>
                                    <p class='card-text fs-6'><i class='ti ti-calendar me-1'></i>".$stringData."</p>
                                    <p class='card-text fs-6'>&nbsp;&nbsp;&nbsp;</p> 
                                    <p class='card-text fs-6'><i class='ti ti-clock me-1'></i>".$stringHora."</p>
                                </div>
                                <a href='./clube.php?id=".$row['idClube']."'>
                                        <p class='card-text fs-4 mb-2'><i class='ti ti-building me-1 fs-5 mt-1'></i>".$row['nomeClube']."</p>
                                </a>
                                <a href='#' class='btn btn-primary'>Mais Info</a>
                            </div>
                        </div>
                    </div>";
                    $horaA = $row['horaMarcInicio'];
                    $diaA = $row['dataMarc'];
                    } else {
                        $flag = true;
                        if(($horaA < $row['horaMarcInicio'] && $diaA == $row['dataMarc']) ||  $diaA != $row['dataMarc']) {
                            
                            $data = new DateTime($row['dataMarc']);
                            $stringData = $data -> format('d/m/Y');

                            $hora = new DateTime($row['horaMarcInicio']);
                            $stringHora = $hora->format('H:i');
                            
                            $msg .= $msgA;
                            $msg .= "<div class='col-lg-12'>
                            <div class='card card-hover align-items-center shadow' style='margin: 20px 40px;'>
                                <img src='".$row['fotoCampo']."' class='card-img-top' alt='".$row['nomeCampo']."'>
                                <div class='p-3'>
                                    <h5 class='card-title fs-7'><i class='ti ti-map-pin me-1'></i>".$row['nomeCampo']."</h5>
                                    <div class='d-flex justify-content-between'>
                                        <p class='card-text fs-6'><i class='ti ti-calendar me-1'></i>".$stringData."</p> 
                                        <p class='card-text fs-6'><i class='ti ti-clock me-1'></i>".$stringHora."</p>
                                    </div>
                                    <a href='./clube.php?id=".$row['idClube']."'>
                                        <p class='card-text fs-4 mb-2'><i class='ti ti-building me-1 fs-5 mt-1'></i>".$row['nomeClube']."</p>
                                    </a>
                                    <a href='#' class='btn btn-primary'>Mais Info</a>
                                </div>
                            </div>
                        </div>";
                        }else{

                            $data = new DateTime($row['dataMarc']);
                            $stringData = $data -> format('d/m/Y');

                            $hora = new DateTime($row['horaMarcInicio']);
                            $stringHora = $hora->format('H:i');

                            $msg .= "<div class='col-lg-12'>
                            <div class='card card-hover align-items-center shadow' style='margin: 20px 40px;'>
                                <img src='".$row['fotoCampo']."' class='card-img-top' alt='".$row['nomeCampo']."'>
                                <div class='p-3'>
                                    <h5 class='card-title fs-7'><i class='ti ti-map-pin me-1'></i>".$row['nomeCampo']."</h5>
                                    <div class='d-flex justify-content-between'>
                                        <p class='card-text fs-6'><i class='ti ti-calendar me-1'></i>".$stringData."</p> 
                                        <p class='card-text fs-6'><i class='ti ti-clock me-1'></i>".$stringHora."</p>
                                    </div>
                                    <a href='./clube.php?id=".$row['idClube']."'>
                                        <p class='card-text fs-4 mb-2'><i class='ti ti-building me-1 fs-5 mt-1'></i>".$row['nomeClube']."</p>
                                    </a>
                                    <a href='#' class='btn btn-primary'>Mais Info</a>
                                </div>
                            </div>
                        </div>"; 
                            $msg .= $msgA;
                        }
                        
                    }
                    $contador++; 
                } 
                array_push($arrayHorasMarcacoesCalendario, array($row['horaMarcInicio'], $row['horaMarcFim'], $row['dataMarc'], $row['nomeClube']));       
            }
            if(!$flag){
                $msg.= $msgA;;
            }

        } else {
            $msg .= "<div class='col-lg-12'>
                            <h4 class='mt-5'>Sem jogos próximos!</h4>
                            <p class='p-3'>Quando procederes á marcação de jogos em campos, os mesmo irão aparecer aqui. De momento, não existe nenhuma marcação registada no teu nome ou em que sejas participante.</p>
                        </div>";
        }
        $resp = json_encode(array(
            "msg" => $msg,
            "arrayCalendario" => $arrayHorasMarcacoesCalendario
        ));

        $conn ->close();
        return ($resp);
        
    }

    function  votacaoBasqFuts($id, $modalidade, $resEquipa, $resAdver, $numPontos){
        global $conn;
        $sql = "";
        $sql2 = "";
        $msg = "";
        if($modalidade == "Basquetebol"){
            $sql .= "SELECT * FROM info_basquetebol WHERE id_atleta = ".$_SESSION['id'];
        }else {
            $sql .= "SELECT * FROM info_futsal WHERE id_atleta = ".$_SESSION['id'];
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($resEquipa > $resAdver){
                    if($modalidade == "Basquetebol"){
                        $sql2 .= "UPDATE info_basquetebol SET n_jogos = ".$row['n_jogos']." + 1 , n_vitorias = ".$row['n_vitorias']." + 1, n_pontos = ".$row['n_pontos']." + ".$numPontos." WHERE id_atleta = ".$_SESSION['id'];
                    }else {
                        $sql2 .= "UPDATE info_futsal SET n_jogos = ".$row['n_jogos']." + 1 , n_vitorias = ".$row['n_vitorias']." + 1, n_golos = ".$row['n_golos']." + ".$numPontos." WHERE id_atleta = ".$_SESSION['id'];
                    }
                }else{
                    if($modalidade == "Basquetebol"){
                        $sql2 .= "UPDATE info_basquetebol SET n_jogos = ".$row['n_jogos']." + 1 , n_pontos = ".$row['n_pontos']." + ".$numPontos." WHERE id_atleta = ".$_SESSION['id'];
                    }else {
                        $sql2 .= "UPDATE info_futsal SET n_jogos = ".$row['n_jogos']." + 1, n_golos = ".$row['n_golos']." + ".$numPontos." WHERE id_atleta = ".$_SESSION['id'];
                    }
                } 
            }
        }
        $sql3 = "UPDATE listagem_atletas_marcacao SET votacao = 1 WHERE id_marcacao = ".$id." AND id_atleta = ".$_SESSION['id'];
        if($conn -> query($sql2)=== TRUE && $conn -> query($sql3)=== TRUE){
            $msg .= "Votação feita com sucesso!";
        }else{
            $flag = false;
            $msg = "Error: " . $sql2 . "<br>" . $conn->error;
            $icon = "error";
        }
        $conn ->close();
        return ($msg);
    }

    function votacaoPadelTenis($id, $modalidade, $resultados){
        global $conn;
        $sql = "";
        $sql2 = "";
        $msg = "";
        $arrRes = json_decode($resultados);
        $nVit = 0;
        $nDerr = 0;
        $nSets = sizeof($arrRes);
        $nPontosSet = 0;
        for($i = 0; $i < sizeof($arrRes); $i++){
            if($arrRes[$i][0] > $arrRes[$i][1]){
                $nVit++;
                $nPontosSet = $nPontosSet + $arrRes[$i][0];
            }else{
                $nDerr++;
                $nPontosSet = $nPontosSet + $arrRes[$i][0];
            }
        }
        if($modalidade == "Padel"){
            $sql .= "SELECT * FROM info_padel WHERE id_atleta = ".$_SESSION['id'];
        }else {
            $sql .= "SELECT * FROM info_tenis WHERE id_atleta = ".$_SESSION['id'];
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($nVit >  $nDerr){
                    if($modalidade == "Padel"){
                        $sql2 .= "UPDATE info_padel SET n_jogos = ".$row['n_jogos']." + 1 , n_vitorias = ".$row['n_vitorias']." + 1, n_pontos_set = ".$row['n_pontos_set']." + ".$nPontosSet.", n_set_ganhos = ".$row['n_set_ganhos']." + ".$nVit.", n_sets =".$row['n_sets']." + ".$nSets." WHERE id_atleta = ".$_SESSION['id'];
                    }else {
                        $sql2 .= "UPDATE info_tenis SET n_jogos = ".$row['n_jogos']." + 1 , n_vitorias = ".$row['n_vitorias']." + 1, n_pontos_set = ".$row['n_pontos_set']." + ".$nPontosSet.", n_set_ganhos = ".$row['n_set_ganhos']." + ".$nVit." , n_sets =".$row['n_sets']." + ".$nSets." WHERE id_atleta = ".$_SESSION['id'];
                    }

                }else{
                    if($modalidade == "Padel"){
                        $sql2 .= "UPDATE info_padel SET n_jogos = ".$row['n_jogos']." + 1 , n_pontos_set = ".$row['n_pontos_set']." + ".$nPontosSet.", n_set_ganhos = ".$row['n_set_ganhos']." + ".$nVit.", n_sets =".$row['n_sets']." + ".$nSets." WHERE id_atleta = ".$_SESSION['id'];
                    }else {
                        $sql2 .= "UPDATE info_tenis SET n_jogos = ".$row['n_jogos']." + 1 , n_pontos_set = ".$row['n_pontos_set']." + ".$nPontosSet.", n_set_ganhos = ".$row['n_set_ganhos']." + ".$nVit.", n_sets =".$row['n_sets']." + ".$nSets." WHERE id_atleta = ".$_SESSION['id'];
                    }
                }
            }
        }
        $sql3 = "UPDATE listagem_atletas_marcacao SET votacao = 1 WHERE id_marcacao = ".$id." AND id_atleta = ".$_SESSION['id'];
        if($conn -> query($sql2)=== TRUE && $conn -> query($sql3)=== TRUE){
            $msg .= "Votação feita com sucesso!";
        }else{
            $flag = false;
            $msg = "Error: " . $sql2 . "<br>" . $conn->error;
            $msg = "Error: " . $sql3 . "<br>" . $conn->error;
            $icon = "error";
        }
        $conn ->close();
        return ($msg);
    }

    function getPerfilNavbar() {
        global $conn;
        $fotoPerfil = "";
        $email = "";
        $nome = "";

        $sql = "SELECT user.foto as foto, user.email as email, user.nome as nome FROM user INNER JOIN atleta ON user.id = atleta.id_atleta WHERE user.id = ".$_SESSION['id'];

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                $fotoPerfil = "../../dist/".$row['foto']."";
                $email = $row['email'];
                $nome = $row['nome'];
            }
        }

        $conn -> close();
        $resp = json_encode(array("fotoPerfil" => $fotoPerfil, "nome" => $nome, "email" => $email, "id" => $_SESSION['id']));
        return($resp);
    }

    function getEstatisticas($id){
        global $conn; 
        $sql = "SELECT modalidade.descricao as modalidade FROM modalidade INNER JOIN atleta_modalidade ON modalidade.id = atleta_modalidade.id_modalidade WHERE atleta_modalidade.id_atleta = '".$id."'";
        $result = $conn->query($sql);
        $arrEst = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row['modalidade'] == 'Basquetebol'){
                    $resp = $this -> getEstatisticasBasquetebol($id);
                    array_push($arrEst, $resp);
                }else if($row['modalidade'] == 'Futsal'){
                    $resp = $this -> getEstatisticasFutsal($id);
                    array_push($arrEst, $resp);
                }else if($row['modalidade'] == 'Padel'){
                    $resp = $this -> getEstatisticasPadel($id);
                    array_push($arrEst, $resp);
                }else{
                    $resp = $this -> getEstatisticasTenis($id);
                    array_push($arrEst, $resp);
                }
            }
        }
        $resp = json_encode( $arrEst);
        $conn -> close();
        return($resp);
    }

    function getEstatisticasPadel($id){
        global $conn; 
        $sql = "SELECT * FROM info_padel WHERE id_atleta = '".$id."'";
        $result = $conn->query($sql);
        $percVitorias1 = 0;
        $percVitorias = "";
        $nJogos = 0;
        $nPontos = 0;
        $nSetsGanhos = 0;
        $nMvp = 0;
        $percSetsGanhos = 0;
        $mediaPontosSet = 0;
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row['n_jogos'] != 0){
                    $percVitorias1 = round(( $row['n_vitorias']/$row['n_jogos'] )*100 , 1 , PHP_ROUND_HALF_DOWN) ;
                    $percVitorias = $percVitorias1 ."%";
                }else{
                    $percVitorias .= "0 %";
                }
                if($row['n_sets'] != 0){
                $percSetsGanhos = round(( $row['n_set_ganhos']/$row['n_sets'] )*100 , 1 , PHP_ROUND_HALF_DOWN) ;
                $mediaPontosSet = round(( $row['n_pontos_set']/$row['n_sets'] ), 1 , PHP_ROUND_HALF_DOWN);
                }
                $nJogos = $row['n_jogos'];
                $nPontos = $row['n_pontos_set'];
                $nSetsGanhos = $row['n_set_ganhos'];
                $nMvp = $row['n_mvp'];
            }
        }
        $resp = array("modalidade" => "Padel" ,"percVitorias" => $percVitorias, "nJogos" => $nJogos, "nPontos" => $nPontos, "nSetsGanhos" => $nSetsGanhos, "nMvp" => $nMvp , "percSets" => $percSetsGanhos, "mediaPontosSet" => $mediaPontosSet);
        return($resp);
    }

    function getEstatisticasTenis($id){
        global $conn; 
        $sql = "SELECT * FROM info_tenis WHERE id_atleta = '".$id."'";
        $result = $conn->query($sql);
        $percVitorias1 = 0;
        $percVitorias = "";
        $nJogos = 0;
        $nPontos = 0;
        $nSetsGanhos = 0;
        $nMvp = 0;
        $percSetsGanhos = 0;
        $mediaPontosSet = 0;
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row['n_jogos'] != 0){
                    $percVitorias1 = round(( $row['n_vitorias']/$row['n_jogos'] )*100 , 1 , PHP_ROUND_HALF_DOWN);
                    $percVitorias = $percVitorias1 ."%";
                }else{
                    $percVitorias .= "0 %";
                }
                if($row['n_sets'] != 0){
                $percSetsGanhos = round(( $row['n_set_ganhos']/$row['n_sets'] )*100 , 1 , PHP_ROUND_HALF_DOWN);
                $mediaPontosSet = round(( $row['n_pontos_set']/$row['n_sets'] ), 1 , PHP_ROUND_HALF_DOWN);
                }
                $nJogos = $row['n_jogos'];
                $nPontos = $row['n_pontos_set'];
                $nSetsGanhos = $row['n_set_ganhos'];
                $nMvp = $row['n_mvp'];
            }
        }
        $resp = array("modalidade" => "Ténis" ,"percVitorias" => $percVitorias, "nJogos" => $nJogos, "nPontos" => $nPontos, "nSetsGanhos" => $nSetsGanhos, "nMvp" => $nMvp, "percSets" => $percSetsGanhos, "mediaPontosSet" => $mediaPontosSet);
        return($resp);
    }

    function getEstatisticasBasquetebol($id){
        global $conn; 
        $sql = "SELECT * FROM info_basquetebol WHERE id_atleta = '".$id."'";
        $result = $conn->query($sql);
        $percVitorias1 = 0;
        $percVitorias = "";
        $nJogos = 0;
        $nPontos = 0;
        $nMvp = 0;
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row['n_jogos'] != 0){
                    $percVitorias1 = round(( $row['n_vitorias']/$row['n_jogos'] )*100 , 1 , PHP_ROUND_HALF_DOWN) ;
                }
                $percVitorias = $percVitorias1 ."%";
                $nJogos = $row['n_jogos'];
                $nPontos = $row['n_pontos'];
                $nMvp = $row['n_mvp'];
            }
        }
        $resp = array("modalidade" => "Basquetebol" ,"percVitorias" => $percVitorias, "nJogos" => $nJogos, "nPontos" => $nPontos, "nMvp" => $nMvp);
        return($resp);
    }

    function getEstatisticasFutsal($id){
        global $conn; 
        $sql = "SELECT * FROM info_futsal WHERE id_atleta = '".$id."'";
        $result = $conn->query($sql);
        $percVitorias1 = 0;
        $percVitorias = "";
        $nJogos = 0;
        $nGolos = 0;
        $nMvp = 0;
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row['n_jogos'] != 0){
                    $percVitorias1 = round(( $row['n_vitorias']/$row['n_jogos'] )*100 , 1 , PHP_ROUND_HALF_DOWN) ;
                }
                $percVitorias = $percVitorias1 ."%";
                $nJogos = $row['n_jogos'];
                $nGolos = $row['n_golos'];
                $nMvp = $row['n_mvp'];
            }
        }
        $resp = array("modalidade" => "Futsal" ,"percVitorias" => $percVitorias, "nJogos" => $nJogos, "nGolos" => $nGolos, "nMvp" => $nMvp);
        return($resp);
    }
   



}


?>