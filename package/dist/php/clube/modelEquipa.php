<?php

session_start();

require_once '../connection.php';

class Equipa {

    function uploads($img, $id)
    {

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

        $sql = "INSERT INTO comunidade (tipo_comunidade, nome, descricao, id_modalidade, id_atletaHost, estado) VALUES (2, '".$nome."', '".$desc."', ".$mod.", ".$_SESSION['id'].", 'fechado')";

        if($conn -> query($sql) === TRUE) {

            $idEquipaNova = mysqli_insert_id($conn);
            $resp = $this -> uploads($imagem, $_SESSION['id']);
            $resp = json_decode($resp, TRUE);

            if($resp['flag']){
                $sql2 = "UPDATE comunidade SET foto = '".$resp['target']."' WHERE id = ".$idEquipaNova;

                if($conn -> query($sql2) === FALSE) {
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

        $conn -> close();

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

        $sql = "SELECT comunidade.*, modalidade.descricao as modalidadeDescricao FROM comunidade INNER JOIN modalidade ON comunidade.id_modalidade = modalidade.id WHERE tipo_comunidade = 2 AND id_atletaHost =".$_SESSION['id'];
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['id']."</th>";
                $msg .= "<th scope='row'><img class='object-fit-cover rounded' style='max-width: 30px;' src='../../dist/".$row['foto']."'></th>";
                $msg .= "<th scope='row'>".$row['nome']."</th>";
                $msg .= "<td>".(strlen($row['descricao']) > 30 ? substr($row['descricao'], 0, 24) . '...' : $row['descricao'])."</td>";
                $msg .= "<td>".$row['modalidadeDescricao']."</td>";
                $msg .= "<td><button type='button' class='btn btn-warning btn-sm' onclick ='getDadosEquipa(".$row['id'].")'> <i class='text-white ti ti-pencil'></i></button></td>";
                $msg .= " <td><button type='button' class='btn btn-sm' onclick ='removerEquipa(".$row['id'].")' style='background-color: firebrick;'> <i
                class='text-white ti ti-x'></i></button></td>";
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
        $conn->close();

        return ($msg);
    }

    function getDadosEquipaModel($id){
        global $conn;
        $msg = "<option value='-1' selected>Selecione uma opção</option>";
        $row = "";

        $sql = "SELECT * FROM comunidade WHERE id = ".$id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            $row = $result->fetch_assoc();

            $sql2 = "SELECT * from modalidade";

            $result2 = $conn->query($sql2);
            if($result2->num_rows > 0){
                while($row2 = $result2->fetch_assoc()){
                    $msg .= "<option value = ".$row2['id'].">".$row2['descricao']."</option>";
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
    
        $sql = "UPDATE comunidade SET nome = '".$nome."', descricao = '".$desc."'";
        

        if ($mod != "-1") {
            $sql .= ", id_modalidade = ".$mod;
        }
    
        $sql .= " WHERE id = ".$id;
    
        if($conn->query($sql) === TRUE) {
            if ($imagem !== null) {
                $resp = $this->uploads($imagem, $_SESSION['id']);
                $resp = json_decode($resp, TRUE);
    
                if($resp['flag']) {
                    $sql2 = "UPDATE comunidade SET foto = '".$resp['target']."' WHERE id = ".$id;
    
                    if($conn->query($sql2) === FALSE) {
                        $msg = "Erro ao alterar a equipa.";
                        $title = "Erro";
                        $icon = "error";
                    }
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
    
        $conn->close();
    
        $resp = json_encode(array(
            "msg" => $msg,
            "title" => $title,
            "icon" => $icon
        ));
    
        return $resp;
    }
    
    

    function removeEquipaModel($id){
        global $conn;
        $msg = "Equipa removida com sucesso.";
        $title = "Sucesso";
        $icon = "success";

        $sql = "DELETE FROM comunidade_atletas WHERE id_comunidade = ".$id;

        if ($conn->query($sql) === TRUE) {

            $sql2 = "DELETE FROM comunidade WHERE id = ".$id;

            if ($conn->query($sql2) === FALSE) {
                $msg = "Erro ao remover equipa.";
                $title = "Erro";
                $icon = "error";
            }


        } else {
            $msg = "Equipa removida com sucesso.";
            $title = "Sucesso";
            $icon = "success";
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