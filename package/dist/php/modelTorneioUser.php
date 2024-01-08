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
                user.nome AS nomeClube,
                torneio.descricao AS descricaoTorneio,
                torneio.`data` AS dataTorneio,
                torneio.hora AS horaTorneio,
                torneio.num_entradas AS numEntradasTorneio,
                torneio.preco AS precoAtletaTorneio,
                torneio.nivel AS nivelTorneio,
                torneio.estado AS estadoTorneio,
                torneio.obs AS observacoesTorneio,
                modalidade.descricao AS modalidadeTorneio
                FROM torneio
                INNER JOIN
                user ON torneio.id_clube = user.id
                INNER JOIN
                modalidade ON torneio.modalidade = modalidade.id
                WHERE torneio.estado = 'nc'
                AND torneio.`data` >= CURDATE()
                ORDER BY torneio.`data` DESC, torneio.hora DESC";

        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if($row['modalidadeTorneio'] == 'Futsal'){
                    if(count($arrayTorneioFutsal) < 2){
                        array_push($arrayTorneioFutsal, $row);
                    }
                } else if($row['modalidadeTorneio'] == 'Basquetebol'){
                    if(count($$arrayTorneioBasquetebol) < 2){
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
}

?>