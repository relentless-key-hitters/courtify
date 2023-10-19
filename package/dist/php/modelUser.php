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
                $sql3 ="INSERT INTO atleta (id_user) VALUES ('".$id."')";
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
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $sql2 = "SELECT login.id_user FROM login WHERE id_user = '".$row['id']."' AND password = '".md5($pass)."'";
                $result2 = $conn->query($sql2);
                if($result2->num_rows > 0){
                    while($row2 = $result2->fetch_assoc()) {
                        $msg = "Login efetuado com sucesso!";
                        $_SESSION['tipo'] = $row['tipo_user'];
                        $_SESSION['id'] = $row['id'];
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

    function contRegisto($dn, $genero, $altura, $peso, $ms, $mi, $fotoPerfil, $bio, $modalidades, $posFutsal, $nivelPadel, $ladoPadel){
        
        global $conn; 
        $arrMod = json_decode($modalidades);  
        $sql = "UPDATE atleta SET data_nasc = '".$dn."', altura = '".$altura."', peso = '".$peso."', ms = '".$ms."', mi = '".$mi."', genero = '".$genero."' WHERE id_user = '".$_SESSION['id']."'";
        $msg = "";
        $result = $conn->query($sql);
        $this -> uploads($fotoPerfil, $_SESSION['id']);
        if ($conn->query($sql) === TRUE) {
            $msg = "Registado com Sucesso";
        } else {
            $flag = false;
            $msg = "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn -> close();
        return ($msg);
    }

}




?>