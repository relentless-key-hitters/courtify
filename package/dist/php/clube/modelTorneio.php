<?php

session_start();

require_once '../connection.php';

class Torneio {

    function uploads($img, $id){

        $dir = "../../images/torneios/" . $id . "/";
        $dir1 = "../../dist/images/torneios/" . $id . "/";
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

            $newName = "torneio".$id."".date("YmdHis").".".$extensao;

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

    function uploads2($img, $id){

        $dir = "../../images/torneios/" . $id . "/";
        $dir1 = "../../dist/images/torneios/" . $id . "/";
        $flag = false;
        $targetBD = "";

        if(!is_dir($dir)){
            if(!mkdir($dir, 0777, TRUE)){
                die ("Erro não é possivel criar o diretório");
            }
        }
        if(array_key_exists('trImagemEdit', $img)){
        if(is_array($img)){
            if(is_uploaded_file($img['trImagemEdit']['tmp_name'])){
            $fonte = $img['trImagemEdit']['tmp_name'];
            $ficheiro = $img['trImagemEdit']['name'];
            $end = explode(".",$ficheiro);
            $extensao = end($end);

            $newName = "torneio".$id."".date("YmdHis").".".$extensao;

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

    function regTorneioModel($desc, $data, $hora, $nmr, $preco, $nivel, $genero, $imagem, $obs, $trModalidade){

        global $conn;
        $msg = "Torneio registado com sucesso";
        $icon = "success";
        $title = "Sucesso";

        $sql = "INSERT INTO torneio (id_clube, descricao, data, hora, num_entradas, preco, nivel, estado, obs, modalidade, genero) VALUES (?, ?, ?, ?, ?, ?, ?, 'nc', ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssidsiss", $_SESSION['id'], $desc, $data, $hora, $nmr, $preco, $nivel, $obs, $trModalidade, $genero);

        if ($stmt->execute()) {
            $ultimoId = $stmt->insert_id;

            $resp = $this -> uploads($imagem, $ultimoId);
            $resp = json_decode($resp, TRUE);

            if($resp['flag']){
                $sql = "UPDATE torneio SET foto = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $resp['target'], $ultimoId);
                if (!$stmt->execute()) {
                    $msg = "Não foi possível registar o Torneio";
                    $icon = "error";
                    $title = "Erro";
                }
            }
        } else {
            $msg = "Não foi possível registar o Torneio";
            $icon = "error";
            $title = "Erro";
        }

        $resp = json_encode(array(
            "msg" => $msg,
            "icon" => $icon,
            "title" => $title
        ));
        
        $stmt->close();
        $conn->close();

        return($resp);
    }
            
    function getListaTorneioModel(){
        global $conn;
        $msg = "";

        $sql = "SELECT * FROM torneio WHERE id_clube = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_SESSION['id']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $hora = date_create($row['hora']);
                $hora = date_format($hora,"H:i");
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".htmlspecialchars($row['id'])."</th>";
                $msg .= "<th scope='row'><img class='img-thumbnail' style='height: 70px; max-width: 100px;' src='".htmlspecialchars($row['foto'])."'></th>";
                $msg .= "<th scope='row'>".htmlspecialchars($row['descricao'])."</th>";
                $msg .= "<td>".htmlspecialchars($row['nivel'])."</td>";
                $msg .= "<td>" . htmlspecialchars(ucfirst($row['genero'])) . "</td>";
                $msg .= "<td>" . htmlspecialchars(date('d/m/Y', strtotime($row['data']))) . "</td>";
                $msg .= "<td>" . htmlspecialchars(date('H:i\h', strtotime($row['hora']))) . "</td>";
                $msg .= "<td>".htmlspecialchars($row['num_entradas'])."</td>";
                $msg .= "<td>".htmlspecialchars($row['preco'])." €</td>";
                $msg .= "<td><button type='button' class='btn btn-sm btn-warning' onclick ='getDadosTorneio(".htmlspecialchars($row['id']).")' > <i class='text-white ti ti-pencil'></i></button></td>";
                $msg .= " <td><button type='button' class='btn btn-sm' onclick ='removeTorneio(".htmlspecialchars($row['id']).")' style='background-color: firebrick;'> <i class='text-white ti ti-x'></i></button></td>";
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
        $stmt->close();
        $conn->close();

        return $msg;
    }

    function getDadosTorneioModel($id){
        global $conn;

        $msg = "";
        $idTorneio = "";
        $idClube = "";
        $descricao = "";
        $data = "";
        $hora = "";
        $num_entradas = "";
        $preco = "";
        $nivel = "";
        $estado = "";
        $foto = "";
        $obs = "";
        $modalidade = "";
        $genero = "";
        $idModalidade = "";

        $sql = "SELECT 
                torneio.id as id,
                torneio.id_clube as idClube,
                torneio.descricao as descricao,
                torneio.data as data,
                torneio.hora as hora,
                torneio.num_entradas as num_entradas,
                torneio.preco as preco,
                torneio.nivel as nivel,
                torneio.estado as estado,
                torneio.foto as foto,
                torneio.obs as obs,
                torneio.modalidade as idModalidade,
                modalidade.descricao as modalidade,
                torneio.genero as genero
                FROM
                torneio
                INNER JOIN
                modalidade
                ON torneio.modalidade = modalidade.id
                WHERE torneio.id = ".$id;



        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {

                $idTorneio .= $row['id'];
                $idClube .= $row['idClube'];
                $descricao .= $row['descricao'];
                $data .= $row['data'];
                $hora .= $row['hora'];
                $num_entradas .= $row['num_entradas'];
                $preco .= $row['preco'];
                $nivel .= $row['nivel'];
                $estado .= $row['estado'];
                $foto .= $row['foto'];
                $obs .= $row['obs'];
                $modalidade .= $row['modalidade'];
                $genero .= $row['genero'];
                $idModalidade .= $row['idModalidade'];
            }

        }

        $conn->close();

        $resp = json_encode(array(
            "msg" => $msg,
            "id" => $idTorneio,
            "idClube" => $idClube,
            "descricao" => $descricao,
            "data" => $data,
            "hora" => $hora,
            "num_entradas" => $num_entradas,
            "preco" => $preco,
            "nivel" => $nivel,
            "estado" => $estado,
            "foto" => $foto,
            "obs" => $obs,
            "modalidade" => $modalidade,
            "genero" => $genero,
            "idModalidade" => $idModalidade
        ));


        return ($resp);
    }

    function guardaEditTorneioModel($id, $desc, $data, $hora, $nmr, $preco, $gen, $nivel, $imagem, $obs, $modalidade){
            
        global $conn;
        $msg = "Alterações gravadas com sucesso.";
        $icon = "success";
        $title = "Sucesso";
        
        $sql = "UPDATE torneio
                SET id_clube = '".$_SESSION['id']."',
                    descricao = '".$desc."', 
                    data = '".$data."', 
                    hora = '".$hora."', 
                    num_entradas = ".$nmr.",
                    preco = ".$preco.",
                    nivel = '".$nivel."',
                    obs = '".$obs."',
                    modalidade = '".$modalidade."',
                    genero = '".$gen."'
                WHERE id = ".$id;
        

        if ($conn->query($sql) === TRUE) {
            
            $resp = $this -> uploads2($imagem, $id);
            $resp = json_decode($resp, TRUE);

            if($resp['flag']) {
                $sql2 = "UPDATE torneio SET foto = '".$resp['target']."' WHERE id = ".$id;

                if($conn->query($sql2) === FALSE) {
                    $msg = "Erro ao alterar o torneio.";
                    $title = "Erro";
                    $icon = "error";
                }
            }
        } else {
            $msg = "Erro ao alterar o torneio.";
            $title = "Erro";
            $icon = "error";
        }

        $resp = json_encode(array(
            "msg" => $msg,
            "title" => $title,
            "icon" => $icon
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

    function getModalidadesNovoTorneio(){

        global $conn;
        $msg = "<option val='-1' selected disabled>Selecione uma modalidade</option>";
        
        $sql = "SELECT * FROM modalidade";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $msg .= "<option value='" . $row['id'] . "'>" . $row['descricao'] . "</option>";
            }
        }

        $conn->close();

        return($msg);
    }
}


?>