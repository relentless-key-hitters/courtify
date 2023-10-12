<?php

require_once 'connection.php';

class User{


    function getListagemDistritos(){

        


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