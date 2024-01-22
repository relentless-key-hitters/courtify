<?php
session_start();
require_once 'connection.php';

class TorneioUser {
    function getTorneiosAbertosUser(){
        
        global $conn;
        $msg = "";
        $arrayTorneioFutsal = array();
        $arrayTorneioBasquetebol = array();
        $arrayTorneioPadel = array();
        $arrayTorneioTenis = array();
        

        $sql = "SELECT 
                torneio.id AS idTorneio,
                torneio.foto AS fotoTorneio,
                torneio.id_clube AS idClube,
                user_clube.nome AS nomeClube,
                torneio.descricao AS descricaoTorneio,
                torneio.`data` AS dataTorneio,
                torneio.hora AS horaTorneio,
                torneio.num_entradas AS numEntradasTorneio,
                torneio.preco AS precoAtletaTorneio,
                torneio.nivel AS nivelTorneio,
                torneio.estado AS estadoTorneio,
                torneio.obs AS observacoesTorneio,
                torneio.genero as generoTorneio,
                modalidade.descricao AS modalidadeTorneio,
                temp.contagem AS contagemAtletasTorneio
            FROM 
                torneio
            INNER JOIN
                user AS user_clube ON torneio.id_clube = user_clube.id
            INNER JOIN
                modalidade ON torneio.modalidade = modalidade.id,
                (SELECT COUNT(*) AS contagem, 
                        torneio_atleta.id_torneio AS torneioId 
                        FROM torneio_atleta 
                        INNER JOIN torneio ON torneio_atleta.id_torneio = torneio.id 
                        
                        UNION
                        
                        SELECT 0 AS contagem, 
                        torneio.id AS torneioId 
                        FROM torneio
                        WHERE torneio.id NOT IN (
                        SELECT DISTINCT torneio_atleta.id_torneio FROM torneio_atleta)) AS temp
            WHERE 
                torneio.estado = 'nc'
                AND MONTH(torneio.`data`) = MONTH(CURDATE())
                AND YEAR(torneio.`data`) = YEAR(CURDATE())
                AND NOT EXISTS (
                    SELECT 1 FROM torneio_atleta WHERE torneio_atleta.id_torneio = torneio.id AND torneio_atleta.id_atleta = ".$_SESSION['id']."
                )
                AND temp.torneioId = torneio.id
                AND temp.contagem != torneio.num_entradas
            ORDER BY 
                torneio.`data` DESC, torneio.hora DESC;";      

        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if($row['modalidadeTorneio'] == 'Futsal'){
                    if(count($arrayTorneioFutsal) < 2){
                        array_push($arrayTorneioFutsal, $row);
                    }
                } else if($row['modalidadeTorneio'] == 'Basquetebol'){
                    if(count($arrayTorneioBasquetebol) < 2){
                        array_push($arrayTorneioBasquetebol, $row);
                    }
                } else if($row['modalidadeTorneio'] == 'Padel'){
                    if(count($arrayTorneioPadel) < 2){
                        array_push($arrayTorneioPadel, $row);
                    }
                } else{
                    if(count($arrayTorneioTenis) < 2){
                        array_push($arrayTorneioTenis, $row);
                    }
                }
            }



        } else {
            $msg = "Nenhum torneio encontrado";
        }

        $conn->close();

        $resp = json_encode(array(
            "arrayTorneioFutsal" => $arrayTorneioFutsal,
            "arrayTorneioBasquetebol" => $arrayTorneioBasquetebol,
            "arrayTorneioPadel" => $arrayTorneioPadel,
            "arrayTorneioTenis" => $arrayTorneioTenis,
        ));


        return ($resp);
    }

    function juntarTorneio($idTorneio) {

        global $conn;
        $title = "";
        $icon = "";
        $msg = "";

        $sql = "INSERT INTO torneio_atleta (id_torneio, id_atleta) VALUES ('" . $idTorneio . "', '" . $_SESSION['id'] . "')";
        
        if ($conn->query($sql) === TRUE) {
            $title = "Sucesso";
            $icon = "success";
            $msg = "Juntaste-te a este Torneio com sucesso.";
        } else {
            $title = "Erro";
            $icon = "error";
            $msg = "Não foi possível juntares-te a este Torneio. Tenta novamente mais tarde.";
        }

        $conn->close();

        $resp = json_encode(array(
            "title" => $title,
            "icon" => $icon,
            "msg" => $msg
        ));

        return ($resp);
    }
}

?>