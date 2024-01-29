<?php

session_start();

require_once '../connection.php';

class Equipa {

    function uploads($img, $id){

        $dir = "../../images/equipas/" . $id . "/";
        $dir1 = "images/equipas/" . $id . "/";
        $flag = false;
        $targetBD = "";

        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, TRUE)) {
                die("Erro não é possivel criar o diretório");
            }
        }
        if (array_key_exists('imagemEq', $img)) {
            if (is_array($img)) {
                if (is_uploaded_file($img['imagemEq']['tmp_name'])) {
                    $fonte = $img['imagemEq']['tmp_name'];
                    $ficheiro = $img['imagemEq']['name'];
                    $end = explode(".", $ficheiro);
                    $extensao = end($end);
                    $newName = "equipa" . $id . "." . $extensao;
                    $target = $dir . $newName;
                    $targetBD = $dir1 . $newName;
                    $flag = move_uploaded_file($fonte, $target);
                }
            }
        }
        return (json_encode(array(
            "flag" => $flag,
            "target" => $targetBD
        )));
    }

    function regEquipaModel($nome, $mod, $desc, $imagem){
        global $conn;
        $msg = "Equipa registada com sucesso.";
        $title = "Sucesso";
        $icon = "success";

        $stmt = $conn->prepare("INSERT INTO comunidade (tipo_comunidade, nome, descricao, id_modalidade, id_atletaHost, estado) VALUES (2, ?, ?, ?, ?, 'fechado')");
        $stmt->bind_param("ssii", $nome, $desc, $mod, $_SESSION['id']);
        $stmt->execute();

        if($stmt->affected_rows > 0) {
            $idEquipaNova = $stmt->insert_id;
            $resp = $this->uploads($imagem, $_SESSION['id']);
            $resp = json_decode($resp, TRUE);
    
            if($resp['flag']){
                $stmt2 = $conn->prepare("UPDATE comunidade SET foto = ? WHERE id = ?");
                $stmt2->bind_param("si", $resp['target'], $idEquipaNova);
                $stmt2->execute();
    
                if($stmt2->affected_rows === 0) {
                    $msg = "Erro ao registar equipa.";
                    $title = "Erro";
                    $icon = "error";
                }
            } else {
                $msg = "Erro ao registar equipa.";
                $title = "Erro";
                $icon = "error";
            }
        } else {
            $msg = "Erro ao registar equipa.";
            $title = "Erro";
            $icon = "error";
        }
    
        $stmt->close();
        $conn->close();
    
        $resp = json_encode(array(
            "msg" => $msg,
            "title" => $title,
            "icon" => $icon
        ));
    
        return($resp);
    }
        
    function getListaEquipaModel(){
        global $conn;
        $msg = "";

        $sql = "SELECT comunidade.*, modalidade.descricao as modalidadeDescricao 
                FROM comunidade 
                INNER JOIN modalidade ON comunidade.id_modalidade = modalidade.id 
                WHERE tipo_comunidade = 2 AND id_atletaHost = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_SESSION['id']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".htmlspecialchars($row['id'])."</th>";
                $msg .= "<th scope='row'><img class='object-fit-cover rounded' style='max-width: 30px;' src='../../dist/".htmlspecialchars($row['foto'])."'></th>";
                $msg .= "<th scope='row'>".htmlspecialchars($row['nome'])."</th>";
                $msg .= "<td>".htmlspecialchars((strlen($row['descricao']) > 30 ? substr($row['descricao'], 0, 24) . '...' : $row['descricao']))."</td>";
                $msg .= "<td>".htmlspecialchars($row['modalidadeDescricao'])."</td>";
                $msg .= "<td><button type='button' class='btn btn-warning btn-sm' onclick ='getDadosEquipa(".htmlspecialchars($row['id']).")'> <i class='text-white ti ti-pencil'></i></button></td>";
                $msg .= " <td><button type='button' class='btn btn-sm' onclick ='removerEquipa(".htmlspecialchars($row['id']).")' style='background-color: firebrick;'> <i class='text-white ti ti-x'></i></button></td>";
                $msg .= "</tr>";
            }
        } else {
            $msg .= "<tr>";
            $msg .= "<td>Sem Registos</td>";
            $msg .= "<th scope='row'></th>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "</tr>";
        }
        $stmt->close();
        $conn->close();

        return ($msg);
    }

    function getDadosEquipaModel($id){
        global $conn;
        $msg = "<option value='-1' selected>Selecione uma opção</option>";
        $row = "";

        $sql = "SELECT * FROM comunidade WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
        // output data of each row
            $row = $result->fetch_assoc();

            $sql2 = "SELECT * from modalidade";

            $result2 = $conn->query($sql2);
            if($result2->num_rows > 0){
                while($row2 = $result2->fetch_assoc()){
                    $msg .= "<option value = ".htmlspecialchars($row2['id']).">".htmlspecialchars($row2['descricao'])."</option>";
                }
            }
        }

        $conn->close();

        $resp = json_encode(array(
            "msg" => $msg,
            "row" => $row
        ));

        return ($resp);

    }

    function guardaEditEquipaModel($id, $nome, $mod, $desc, $imagem) {
        global $conn;
        $msg = "Equipa alterada com sucesso.";
        $title = "Sucesso";
        $icon = "success";
    
        $sql = "UPDATE comunidade SET nome = ?, descricao = ?";
        $types = "ss";  
        $params = array(&$nome, &$desc);
    
        if ($mod != "-1") {
            $sql .= ", id_modalidade = ?";
            $types .= "i";  
            $params[] = &$mod;
        }
    
        $sql .= " WHERE id = ?";
        $types .= "i"; 
        $params[] = &$id;
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
    
        if($stmt->affected_rows > 0) {
            if ($imagem !== null) {
                $resp = $this->uploads($imagem, $_SESSION['id']);
                $resp = json_decode($resp, true);
    
                if($resp['flag']) {
                    $sql2 = "UPDATE comunidade SET foto = ? WHERE id = ?";
                    $stmt2 = $conn->prepare($sql2);
                    $stmt2->bind_param("si", $resp['target'], $id);
                    $stmt2->execute();
    
                    if($stmt2->error) {
                        $msg = "Erro ao alterar a equipa.";
                        $title = "Erro";
                        $icon = "error";
                    }
                    $stmt2->close();
                } else {
                    $msg = "Erro ao alterar a equipa.";
                    $title = "Erro";
                    $icon = "error";
                }
            }
        } else {
            $msg = "Erro ao alterar a equipa.";
            $title = "Erro";
            $icon = "error";
        }
    
        $stmt->close();
        $conn->close();
    
        $response = array(
            "msg" => $msg,
            "title" => $title,
            "icon" => $icon
        );
        return json_encode($response);
    }
    
    function removeEquipaModel($id){
        global $conn;
        $msg = "Equipa removida com sucesso.";
        $title = "Sucesso";
        $icon = "success";

        $sql = "DELETE FROM comunidade_atletas WHERE id_comunidade = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $sql2 = "DELETE FROM comunidade WHERE id = ?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("i", $id);

            if (!$stmt2->execute()) {
                $msg = "Erro ao remover equipa.";
                $title = "Erro";
                $icon = "error";
            }
        } else {
            $msg = "Erro ao remover equipa.";
            $title = "Erro";
            $icon = "error";
        }

        $conn->close();

        $resp = json_encode(array(
            "msg" => $msg,
            "title" => $title,
            "icon" => $icon
        ));
        return($resp);
    }
}


?>