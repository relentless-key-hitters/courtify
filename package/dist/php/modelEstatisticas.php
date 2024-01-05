<?php

require_once 'connection.php';

class Estatistica
{
/*Estatísticas gerais Basquebol */
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
        $this -> percGeral($numVitorias, $numJogos, "percVitorias", 0.01, "estatisticas_basquetebol");
        $this -> percGeral($nMvp, $numJogos, "percMvp", 0.01, "estatisticas_basquetebol");
        $this -> percGeral($nPontos, $numJogos, "mediaPontosJogo", 0.5, "estatisticas_basquetebol");
        $conn -> close();
    }

/*Estatísticas gerais Futsal */
    function estatisticasFutsal(){
        global $conn;
        $sql = " SELECT * FROM info_futsal";
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
                array_push($nPontos, $row['n_golos']);
            }
        }
        $this -> percGeral($numVitorias, $numJogos, "percVitorias", 0.01, "estatisticas_futsal");
        $this -> percGeral($nMvp, $numJogos, "percMvp", 0.01, "estatisticas_futsal");
        $this -> percGeral($nPontos, $numJogos, "mediaPontosJogo", 0.5, "estatisticas_futsal");
        $conn -> close();
    }
 /*Estatísticas gerais Padel */
    function estatisticasPadel(){
        global $conn;
        $sql = " SELECT * FROM info_padel";
        $numJogos = array();
        $numVitorias = array();
        $nMvp = array();
        $nPontosSet = array();
        $nSetsGanhos = array();
        $nSets = array();
        $result = $conn -> query($sql);
        if($result -> num_rows > 0){
            while($row = $result -> fetch_assoc()){
                array_push($numJogos, $row['n_jogos']);
                array_push($numVitorias, $row['n_vitorias']);
                array_push($nMvp, $row['n_mvp']);
                array_push($nPontosSet, $row['n_pontos_set']);
                array_push($nSetsGanhos, $row['n_set_ganhos']);
                array_push($nSets, $row['n_sets']);
            }
        }
        $this -> percGeral($numVitorias, $numJogos, "percVitorias", 0.01, "estatisticas_padel");
        $this -> percGeral($nMvp, $numJogos, "percMvp", 0.01, "estatisticas_padel");
        $this -> percGeral($nSetsGanhos, $nSets, "percSetsGanhos", 0.1, "estatisticas_padel");
        $this -> percGeral($nPontosSet, $nSets, "mediaPontosSet", 0.5, "estatisticas_padel");
        $this -> percGeral($nPontosSet, $numJogos, "mediaPontosJogo", 0.5, "estatisticas_padel");
        $conn -> close();
    }
 /*Estatísticas gerais Ténis */
    function estatisticasTenis(){
        global $conn;
        $sql = " SELECT * FROM info_tenis";
        $numJogos = array();
        $numVitorias = array();
        $nMvp = array();
        $nPontosSet = array();
        $nSetsGanhos = array();
        $nSets = array();
        $result = $conn -> query($sql);
        if($result -> num_rows > 0){
            while($row = $result -> fetch_assoc()){
                array_push($numJogos, $row['n_jogos']);
                array_push($numVitorias, $row['n_vitorias']);
                array_push($nMvp, $row['n_mvp']);
                array_push($nPontosSet, $row['n_pontos_set']);
                array_push($nSetsGanhos, $row['n_set_ganhos']);
                array_push($nSets, $row['n_sets']);
            }
        }
        $this -> percGeral($numVitorias, $numJogos, "percVitorias", 0.01, "estatisticas_tenis");
        $this -> percGeral($nMvp, $numJogos, "percMvp", 0.01, "estatisticas_tenis");
        $this -> percGeral($nSetsGanhos, $nSets, "percSetsGanhos", 0.1, "estatisticas_tenis");
        $this -> percGeral($nPontosSet, $nSets, "mediaPontosSet", 0.5, "estatisticas_tenis");
        $this -> percGeral($nPontosSet, $numJogos, "mediaPontosJogo", 0.5, "estatisticas_tenis");
        $conn -> close();
    }

    /*Cálculo de valor a avaliar com valores atuais de todos os atletas*/
    function calcPercAtual($array1, $array2){
        $percVitMedia = 0;
        for($i = 0; $i < count($array1); $i++){
            $percVitMedia = $percVitMedia + ($array1[$i] / $array2[$i]);
        }
        $percVitMedia = $percVitMedia / count($array1);
        return($percVitMedia);
    }

    /*Avaliação de valor atual com valor antigo. Cálculo da variação de valor e análise de relevância da sua alteração.*/
    function avalPerc($percNova, $variavel, $variancia, $nomeTabela){
        global $conn;
        $sql = "SELECT ".$variavel." FROM ".$nomeTabela;
        $result = $conn -> query($sql);
        $percAntiga = 0;
        if($result -> num_rows > 0){
            while($row = $result -> fetch_assoc()){
                $percAntiga =  $percAntiga + $row[$variavel];
            }
        }
        $flag = false;
        if(($percAntiga - $percNova >= $variancia )|| ($percNova - $percAntiga >= $variancia)){
           $flag = true;
        }
        return($flag);
    }

    function percGeral($array1, $array2, $variavel, $variancia, $nomeTabela){
        global $conn;
        $sql = "";
        $msg = "";
        $percAc = $this -> calcPercAtual($array1, $array2);
        if($this->avalPerc($percAc, $variavel, $variancia, $nomeTabela)){
            $sql = "UPDATE ".$nomeTabela." SET ".$variavel." = ".$percAc;
            $conn->query($sql);
        }
        return($msg);
    }
}

?>