<?php

session_start();

require_once '../connection.php';

class Equipa
{

function regEquipaModel($nome, $mod, $desc, $rank, $estado, $imagem, $tp){

    global $conn;
    $msg = "";
    $flag = true;
    $tp = 2;
    $rank = NULL;

    $resp = $this -> uploads($logo, $id);
    $resp = json_decode($resp, TRUE);

    if($resp['flag']){
        $sql = "INSERT INTO comunidade (id, foto, tipo_comunidade, nome, descricao, id_modalidade, id_atletaHost estado, ranking) VALUES (NULL, '".$resp['target']."', '".$tp."', '".$nome."', '".$desc."', '".$mod."', NULL, '".$estado."', '".$rank."')";
    }else{
        $sql = "INSERT INTO comunidade (id, tipo_comunidade, nome, descricao, id_modalidade, id_atletaHost, estado, ranking) VALUES (NULL, '".$tp."', '".$nome."', '".$desc."', '".$mod."', NULL, '".$estado."', '".$rank."')";
    }

    if ($conn->query($sql) === TRUE) {
        $msg = "Registado com sucesso!";
    } else {
        $flag = false;
        $msg = "Error: " . $sql . "<br>" . $conn->error;
    }

    $resp = json_encode(array(
        "flag" => $flag,
        "msg" => $msg
    ));
      
    $conn->close();

    return($resp);
}
    

function getListaEquipaModel(){

    global $conn;
    $msg = "";

    $sql = "SELECT * FROM comunidade WHERE tipo_comunidade = 2";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            $msg .= "<tr>";
            $msg .= "<th scope='row'>".$row['id']."</th>";
            $msg .= "<th scope='row'><img class='img-thumbnail' src='".$row['foto']."'></th>";
            $msg .= "<th scope='row'>".$row['nome']."</th>";
            $msg .= "<td>".$row['desc']."</td>";
            $msg .= "<td>".$row['estado']."</td>";
            $msg .= "<td>".$row['ranking']."</td>";
            $msg .= "<td><button type='button' class='btn btn-sm' onclick ='getDadosEquipa(".$row['id'].")' style='background-color: gold;'> <i class='text-white ti ti-pencil'></i></button></td>";
            $msg .= " <td><button type='button' class='btn btn-sm' onclick ='removeEquipa(".$row['id'].")' style='background-color: firebrick;'> <i
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
    $msg = "";
    $row = "";

    $sql = "SELECT * FROM comunidade WHERE id = ".$id." AND tipo_comunidade = 2";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        $row = $result->fetch_assoc();
    }

    $conn->close();

    return (json_encode($row));

}

function guardaEditEquipaModel($id, $nome, $desc, $rank, $estado, $imagem, $tp){
        
    global $conn;
    $msg = "";
    $flag = true;
    $sql = "";

    $resp = $this -> uploads($imagem);
    $resp = json_decode($resp, TRUE);

    if($resp['flag']){
        $sql = "UPDATE comunidade SET descricao = '".$desc."' , nome = '".$nome."' , ranking = '".$rank."' , estado = ".$estado.", foto = '".$resp['target']."' WHERE id =".$id."' AND tipo_comunidade = 2";    
    }else{
        $sql = "UPDATE comunidade SET descricao = '".$desc."' , nome = '".$nome."' , ranking = '".$rank."' , estado = '".$estado."' WHERE id = '".$id."' AND tipo_comunidade = 2";       
    }

    if ($conn->query($sql) === TRUE) {
        $msg = "Editado com Sucesso";
    } else {
        $flag = false;
        $msg = "Error: " . $sql . "<br>" . $conn->error;
    }

    $resp = json_encode(array(
        "flag" => $flag,
        "msg" => $msg
    ));
      
    $conn->close();

    return($resp);

}

function removeEquipaModel($id){
    global $conn;
    $msg = "";
    $flag = true;

    $sql = "DELETE FROM comunidade WHERE id = ".$id." AND tipo_comunidade = 2";

    if ($conn->query($sql) === TRUE) {
        $msg = "Removido com Sucesso";
    } else {
        $flag = false;
        $msg = "Error: " . $sql . "<br>" . $conn->error;
    }

    $resp = json_encode(array(
        "flag" => $flag,
        "msg" => $msg
    ));
      
    $conn->close();

    return($resp);
}

    function updateLogo($diretorio, $id){
        global $conn;
        $msg = "";
        $flag = true;

        $sql = "UPDATE comunidade SET foto = '".$diretorio."' WHERE id = ".$id." AND tipo_comunidade = 2";

        if ($conn->query($sql) === TRUE) {
            $msg = "Registado com Sucesso";
        } else {
            $flag = false;
            $msg = "Error: " . $sql . "<br>" . $conn->error;
        }

        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));

        return($resp);
    }

    function uploads($img, $id){

        $dir = "../images/equipa/".$id."/";
        $dir1 = "images/equipa/".$id."/";
        $flag = false;
        $targetBD = "";
    
        if(!is_dir($dir)){
            if(!mkdir($dir, 0777, TRUE)){
                die ("Erro não é possivel criar o diretório");
            }
        }
      if(array_key_exists('imagemEq', $img)){
        if(is_array($img)){
          if(is_uploaded_file($img['imagemEq']['tmp_name'])){
            $fonte = $img['imagemEq']['tmp_name'];
            $ficheiro = $img['imagemEq']['name'];
            $end = explode(".",$ficheiro);
            $extensao = end($end);
    
            $newName = "equipa".date("YmdHis").".".$extensao;
    
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

}


?>