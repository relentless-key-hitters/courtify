<?php

require_once 'connection.php';

class Estatistica
{

    function estatisticasBasquetebol(){
        global $conn;
        $sql = " SELECT * FROM info_basquetebol";
        $numJogos = array();
        $numVitorias = array();
        $nMvp = array();
        $nPontos = array();
        $result = $conn -> query($sql);
        if($result -> num_rows > 0){
            while($row = $result -> fetch_assoc()){
                array_push($numJogos, $row['n_jogos']);
                array_push($numVitorias, $row['n_vitorias']);
                array_push($nMvp, $row['n_mvp']);
                array_push($nPontos, $row['n_pontos']);
            }
        }
        $resultPercVit = $this -> percVitMedia($numVitorias, $numJogos);
        $conn -> close();
        return($resultPercVit);
    }

    function calcPercVitoriaAtual($array1, $array2){
        $percVitMedia = 0;
        for($i = 0; $i < count($array1); $i++){
            $percVitMedia = $percVitMedia + ($array1[$i] / $array2[$i]);
        }
        $percVitMedia = $percVitMedia / count($array1);
        return($percVitMedia);
    }

    function avalPercVitoria($percNova){
        global $conn;
        $sql = "SELECT percVitorias FROM estatisticas_basquetebol";
        $result = $conn -> query($sql);
        $percAntiga = 0;
        if($result -> num_rows > 0){
            while($row = $result -> fetch_assoc()){
                $percAntiga =  $percAntiga + $row['percVitorias'];
            }
        }
        $flag = false;
        if(($percAntiga - $percNova >= 0.01 )|| ($percNova - $percAntiga >= 0.01)){
           $flag = true;
        }
        return($flag);
    }

    function percVitMedia($array1, $array2){
        global $conn;
        $sql = "";
        $msg = "";
        $percAc = $this -> calcPercVitoriaAtual($array1, $array2);
        if($this->avalPercVitoria($percAc)){
            $sql = "UPDATE estatisticas_basquetebol SET percVitorias = ".$percAc;
            if ($conn->query($sql) === TRUE) {
                $msg = "Alterado com sucesso!";
            }else{
                $msg = "Não foi possivel alterar os valores";
            }
        }
        return($msg);
    }

    function estatisticasFutsal(){

    }

    function estatisticasPadel(){


    }

    function estatisticasTenis(){


    }
}

?>