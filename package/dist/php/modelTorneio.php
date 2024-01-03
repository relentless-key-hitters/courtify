<?php

session_start();

require_once 'connection.php';

class Torneio
{

function regTorneioModel($desc, $data, $hora, $nmr, $preco, $nivel, $estado, $imagem){

    global $conn;
    $msg = "";
    $flag = true;

        $sql = "INSERT INTO torneio (id, id_clube, descricao, data, hora, num_entradas, preco, nivel, estado, foto) VALUES (NULL, NULL, '".$desc."', '".$data."', '".$hora."', '".$nmr."', '".$preco."', ,'".$nivel."'  '".$estado."' ,'".$imagem."')";

        if ($conn->query($sql) === TRUE) {
            $id = mysqli_insert_id($conn);
            $resp = $this ->  uploads($logo, $id);
            $resp = json_decode($resp, TRUE);

            if($resp['flag']){
                $resUpdate = $this -> updateLogo($resp['target'], $id);
                
                $resUpdate = json_decode($resUpdate, TRUE);

                $msg = $resUpdate['msg'];

            }else{
                $msg = "Registado com Sucesso mas sem Imagem";
            }

            
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

        $dir = "../imagens/torneio".$id."/";
        $dir1 = "assets/imagens/torneio".$id."/";
        $flag = false;
        $targetBD = "";
    
        if(!is_dir($dir)){
            if(!mkdir($dir, 0777, TRUE)){
                die ("Erro não é possivel criar o diretório");
            }
        }
      if(array_key_exists('logotipo', $img)){
        if(is_array($img)){
          if(is_uploaded_file($img['logotipo']['tmp_name'])){
            $fonte = $img['logotipo']['tmp_name'];
            $ficheiro = $img['logotipo']['name'];
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
