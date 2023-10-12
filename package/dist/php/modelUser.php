<?php

require_once 'connection.php';

class User{


    function getListagemDistritos(){

        


    }

    function registerUser($nome, $tipo, $telemovel, $nif, $morada, $codP, $local, $email, $pass) {
        global $conn;
        $flag = true;
        $msg = "";
        
        // Prepare the first SQL statement
        $sql = "INSERT INTO user(tipo_user, nome, telemovel, email, nif, morada, codigo_postal) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            // Bind parameters to the statement
            $stmt->bind_param("isisiss", $tipo, $nome, $telemovel, $email, $nif, $morada, $codP);
            
            // Execute the statement
            if ($stmt->execute()) {
                $id = $stmt->insert_id;
                
                // Prepare the second SQL statement
                $sql2 = "INSERT INTO login(id_user, password) VALUES (?, ?)";
                $stmt2 = $conn->prepare($sql2);
                
                if ($stmt2) {
                    // Bind parameters to the second statement
                    $stmt2->bind_param("is", $id, $pass);
                    
                    // Execute the second statement
                    if ($stmt2->execute()) {
                        $msg .= "Registado com sucesso!";
                    } else {
                        $msg .= "Registado com sucesso mas sem credenciais de login!";
                    }
                } else {
                    $msg = "Error in the login statement: " . $stmt2->error;
                    $flag = false;
                }
            } else {
                $msg = "Error in the user statement: " . $stmt->error;
                $flag = false;
            }
            
            // Close the prepared statements
            $stmt->close();
            if (isset($stmt2)) {
                $stmt2->close();
            }
        } else {
            $msg = "Error in the user statement: " . $conn->error;
            $flag = false;
        }
        
        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));
        
        return $resp;
    }
}

?>