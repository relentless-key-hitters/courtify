<?php

require_once 'connection.php';

class Equipa
{
    function getEquipasUser(){
        global $conn;
        $sql = "SELECT DISTINCT
        comunidade.id AS idComunidade,
        comunidade.nome AS nomeComunidade,
        comunidade.foto AS fotoComunidade,
        comunidade.id_atletaHost as idAtletaHost,
        tipo_comunidade.descricao AS tipoComunidade,
        modalidade.descricao AS tipoModalidade
        FROM 
        comunidade
        INNER JOIN
        comunidade_atletas ON comunidade.id = comunidade_atletas.id_comunidade
        INNER JOIN
        modalidade ON comunidade.id_modalidade = modalidade.id
        INNER JOIN 
        tipo_comunidade ON comunidade.tipo_comunidade = tipo_comunidade.id
        WHERE comunidade_atletas.id_atleta = " . $_SESSION['id'] . "
        AND comunidade_atletas.estado = 1
        AND comunidade.tipo_comunidade = 2
        LIMIT 12"; 
    }

    function regEquipaModel($nome, $img, $nmr, $nivel, $obs){

        global $conn;
        $msg = "";
        $flag = true;


        $resp = $this -> uploads($logo, $id);
        $resp = json_decode($resp, TRUE);


        if($resp['flag']){
            $sql = "INSERT INTO equipa (id, nome, img, nmr_participantes, nivel, obs) VALUES (NULL, '".$nome."', '".$reps['target']."', '".$nmr."', '".$nivel."', '".$obs."')";
        }else{
            $sql = "INSERT INTO equipa (id, nome, nmr_participantes, nivel, obs) VALUES (NULL, '".$nmr."', '".$nivel."', '".$obs."', '".$nome."')";
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

        $sql = "SELECT * FROM equipa";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['id']."</th>";
                $msg .= "<th scope='row'><img class='img-thumbnail' src='".$row['img']."'></th>";
                $msg .= "<th scope='row'>".$row['nome']."</th>";
                $msg .= "<td>".$row['nmr_participantes']."</td>";
                $msg .= "<td>".$row['nivel']."</td>";
                $msg .= "<td><button type='button' class='btn btn-sm' onclick ='' style='background-color: forestgreen;'> <i class='text-white ti ti-plus'></i></button></td>";
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

        $sql = "SELECT * FROM equipa WHERE id =".$id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            $row = $result->fetch_assoc();
        }

        $conn->close();

        return (json_encode($row));

    }

    function guardaEditEquipaModel($id, $nome, $img, $nmr, $nivel, $obs){
            
        global $conn;
        $msg = "";
        $flag = true;
        $sql = "";

        $resp = $this -> uploads($foto);
        $resp = json_decode($resp, TRUE);

        if($resp['flag']){
            $sql = "UPDATE equipa SET nome = '".$nome."' , img = '".$resp['target']."' , nmr_participantes = '".$nmr."' , nivel = '".$nivel."', obs = '".$obs."' WHERE id =".$id;
        }else{
            $sql = "UPDATE equipa SET nome = '".$nome."' , nmr_participantes = '".$nmr."' , nivel = '".$nivel."', obs = '".$obs."' WHERE id =".$id;
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

        $sql = "DELETE FROM equipa WHERE id = ".$id;

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

            $sql = "UPDATE equipa SET img = '".$diretorio."' WHERE id = ".$id;

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
        if(array_key_exists('imgEquipa', $img)){
            if(is_array($img)){
            if(is_uploaded_file($img['imgEquipa']['tmp_name'])){
                $fonte = $img['imgEquipa']['tmp_name'];
                $ficheiro = $img['imgEquipa']['name'];
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