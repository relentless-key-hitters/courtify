<?php

session_start();

require_once '../connection.php';

class Torneio
{

function regTorneioModel($desc, $data, $hora, $nmr, $preco, $nivel, $genero, $imagem, $obs){

    global $conn;
    $msg = "";
    $flag = true;
    $sql = "INSERT INTO torneio (id_clube, descricao, data, hora, num_entradas, preco, nivel, estado, obs, modalidade, genero) VALUES (".$_SESSION['id'].", '".$desc."', '".$data."', '".$hora."', '".$nmr."', '".$preco."', '".$nivel."', 'nc', '".$obs."', , '".$genero."')";

    if ($conn->query($sql) === TRUE) {
        $msg = "Registado com sucesso!";
    } else {
        $flag = false;
        $msg = "Error: " . $sql . "<br>" . $conn->error;
    }
    $resp = $this -> uploads($logo, $id);
    $resp = json_decode($resp, TRUE);
    $resp = json_encode(array(
        "flag" => $flag,
        "msg" => $msg
    ));
      
    $conn->close();

    return($resp);
}
    

function getListaTorneioModel(){

    global $conn;
    $msg = "";

    $sql = "SELECT * FROM torneio WHERE id_clube = ".$_SESSION['id'];
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            $hora = date_create($row['hora']);
            $hora = date_format($hora,"H:i");
            $msg .= "<tr>";
            $msg .= "<th scope='row'>".$row['id']."</th>";
            $msg .= "<th scope='row'><img class='img-thumbnail' style='height: 70px; max-width: 100px;' src='".$row['foto']."'></th>";
            $msg .= "<th scope='row'>".$row['descricao']."</th>";
            $msg .= "<td>".$row['nivel']."</td>";
            $msg .= "<td>".$row['genero']."</td>";
            $msg .= "<td>".$row['data']."</td>";
            $msg .= "<td>".$hora."</td>";
            $msg .= "<td>".$row['num_entradas']."</td>";
            $msg .= "<td>".$row['preco']." €</td>";
            $msg .= "<td><button type='button' class='btn btn-sm' onclick ='getDadosTorneio(".$row['id'].")' style='background-color: gold;'> <i class='text-white ti ti-pencil'></i></button></td>";
            $msg .= " <td><button type='button' class='btn btn-sm' onclick ='removeTorneio(".$row['id'].")' style='background-color: firebrick;'> <i
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
        $msg .= "<td></td>";
        $msg .= "<td></td>";
        $msg .= "</tr>";
    }
    $conn->close();

    return ($msg);
}

function getDadosTorneioModel($id){
    global $conn;
    $msg = "";
    $row = "";

    $sql = "SELECT * FROM torneio WHERE id =".$id;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        $row = $result->fetch_assoc();
    }

    $conn->close();

    return (json_encode($row));

}

function guardaEditTorneioModel($id, $desc, $data, $hora, $nmr, $preco, $nivel, $estado, $imagem, $obs){
        
    global $conn;
    $msg = "";
    $flag = true;
    $sql = "";

    $resp = $this -> uploads($foto);
    $resp = json_decode($resp, TRUE);

    if($resp['flag']){
        $sql = "UPDATE torneio SET desc = '".$desc."' , data = '".$data."' , hora = '".$hora."' , num_entradas = ".$nmr.", preco = ".$preco.", nivel = ".$nivel.", estado = ".$estado.", obs = '".$obs."', foto = '".$resp['target']."' WHERE id =".$id;
    }else{
        $sql = "UPDATE torneio SET desc = '".$desc."' , data = '".$data."' , hora = '".$hora."' , tel = '".$telefone."',email = '".$email."',morada = '".$morada."' WHERE num =".$numOld;        $sql = "UPDATE torneio SET desc = '".$desc."' , data = '".$data."' , hora = '".$hora."' , num_entradas = ".$nmr.", preco = ".$preco.", nivel = ".$nivel.", estado = ".$estado.", obs = '".$obs."' WHERE id =".$id;
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

function removeTorneioModel($id){
    global $conn;
    $msg = "";
    $flag = true;

    $sql = "DELETE FROM torneio WHERE id = ".$id;

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

        $sql = "UPDATE torneio SET foto = '".$diretorio."' WHERE id = ".$id;

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

        $dir = "../images/torneio/".$id."/";
        $dir1 = "images/torneio/".$id."/";
        $flag = false;
        $targetBD = "";
    
        if(!is_dir($dir)){
            if(!mkdir($dir, 0777, TRUE)){
                die ("Erro não é possivel criar o diretório");
            }
        }
      if(array_key_exists('trImagem', $img)){
        if(is_array($img)){
          if(is_uploaded_file($img['trImagem']['tmp_name'])){
            $fonte = $img['trImagem']['tmp_name'];
            $ficheiro = $img['trImagem']['name'];
            $end = explode(".",$ficheiro);
            $extensao = end($end);
    
            $newName = "torneio".date("YmdHis").".".$extensao;
    
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