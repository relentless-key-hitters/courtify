<?php
session_start();
require_once 'connection.php';

class Clube{

function getInfoClube(){

    global $conn;
    $sql = "SELECT user.nome, temp.cont_marcacao AS n_marcacoes, temp2.cont_torneios AS n_torneios
    FROM user INNER JOIN clube ON user.id = clube.id_clube, 
    (SELECT COUNT(*) AS cont_marcacao
        FROM marcacao 
        WHERE marcacao.id_campo IN(
            SELECT campo.id 
            FROM campo INNER JOIN campo_clube 
            ON campo.id = campo_clube.id_campo
            INNER JOIN clube ON 
            campo_clube.id_clube = clube.id_clube
            WHERE clube.id_clube = ".$_SESSION['id']."
       ) AND MONTH(marcacao.data_inicio) = MONTH(CURRENT_DATE())
    ) AS temp,
    (SELECT COUNT(*) AS cont_torneios
        FROM torneio 
        WHERE torneio.id_clube = ".$_SESSION['id']."
       AND MONTH(torneio.data) = MONTH(CURRENT_DATE())
    ) AS temp2
    WHERE clube.id_clube = ".$_SESSION['id'];
    $nomeClube = "";
    $nMarcacoesMes = 0;
    $nTorneiosMes = 0;
    $result = $conn -> query($sql);
    if($result -> num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $nomeClube = $row['nome'];
            $nMarcacoesMes = $row['n_marcacoes'];
            $nTorneiosMes = $row['n_torneios'];
        }
    }

    $sql2 = "SELECT (TIME_TO_SEC(TIMEDIFF(marcacao.hora_fim, marcacao.hora_inicio))/3600)*campo.preco_hora AS preco_total, 1 AS pago
    FROM marcacao  
    INNER JOIN campo
    ON campo.id = marcacao.id_campo
    WHERE marcacao.id_campo IN(
       SELECT campo.id 
       FROM campo INNER JOIN campo_clube 
       ON campo.id = campo_clube.id_campo
       INNER JOIN clube ON 
       campo_clube.id_clube = clube.id_clube
       WHERE clube.id_clube = ".$_SESSION['id']."
    ) AND MONTH(marcacao.data_inicio) =  MONTH(CURRENT_DATE())
    AND marcacao.pagamento = 1
    UNION 
    SELECT (TIME_TO_SEC(TIMEDIFF(marcacao.hora_fim, marcacao.hora_inicio))/3600)*campo.preco_hora AS preco_total, 0 AS pago
    FROM marcacao  
    INNER JOIN campo
    ON campo.id = marcacao.id_campo
    WHERE marcacao.id_campo IN(
       SELECT campo.id 
       FROM campo INNER JOIN campo_clube 
       ON campo.id = campo_clube.id_campo
       INNER JOIN clube ON 
       campo_clube.id_clube = clube.id_clube
       WHERE clube.id_clube = ".$_SESSION['id']."
    ) AND MONTH(marcacao.data_inicio) =  MONTH(CURRENT_DATE())
    AND marcacao.pagamento = 0";

    $contPagos = 0;
    $pag = 0;
    $contNaoPagos = 0;
    $result2 = $conn -> query($sql2);
    if($result2 -> num_rows > 0){
        while($row2 = $result2 -> fetch_assoc()){
            if($row2['pago'] == 1){
                $contPagos ++;
                $pag += $row2['preco_total'];
            }else{
                $contNaoPagos ++;
            }
        }
    }
    $conn -> close();
    return json_encode(array(
        "nome" => $nomeClube,
        "numMarc" => $nMarcacoesMes,
        "numTorn" => $nTorneiosMes,
        "totalGanhos" => $pag,
        "pago" => $contPagos, 
        "naoPago" => $contNaoPagos
    ));

    }

}

?>