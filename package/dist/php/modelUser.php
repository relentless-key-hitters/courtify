<?php

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
        $sql = "INSERT INTO user(tipo_user, nome, telemovel, email, nif, morada, codigo_postal) VALUES ('".$tipo."', '".$nome."', '".$telemovel."', '".$email."', '".$nif."', '".$morada."', '".$codP."')";
        if ($conn->query($sql) === TRUE) {
            $id = mysqli_insert_id($conn);
            $sql2 ="INSERT INTO login(id_user, password) VALUES ('".$id."', '".$pass."')";
            if($conn->query($sql2) === TRUE){
                $msg .= "Registado com sucesso!";
            }else{
                $msg .= "Registado com sucesso mas sem credenciais de login!"; 
            }
            
        }else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            $flag = false;
        }

        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));
        return ($resp);
    }
}

?>