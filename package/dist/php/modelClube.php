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

    $sql2 = "SELECT (TIME_TO_SEC(TIMEDIFF(marcacao.hora_fim, marcacao.hora_inicio))/3600)*campo.preco_hora AS preco_total, 1 AS pago, 1 AS atual
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
    SELECT (TIME_TO_SEC(TIMEDIFF(marcacao.hora_fim, marcacao.hora_inicio))/3600)*campo.preco_hora AS preco_total, 0 AS pago, 1 AS atual
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
    AND marcacao.pagamento = 0
UNION 

SELECT (TIME_TO_SEC(TIMEDIFF(marcacao.hora_fim, marcacao.hora_inicio))/3600)*campo.preco_hora AS preco_total, 1 AS pago, 0 AS atual
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
    ) AND MONTH(marcacao.data_inicio) =  MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH))
    AND marcacao.pagamento = 1";

    $contPagos = 0;
    $pag = 0;
    $pagAnt = 0;
    $contNaoPagos = 0;
    $result2 = $conn -> query($sql2);
    if($result2 -> num_rows > 0){
        while($row2 = $result2 -> fetch_assoc()){
            if($row2['pago'] == 1){
                if($row2['atual'] == 1){
                    $contPagos ++;
                    $pag += $row2['preco_total'];
                }else{
                    $pagAnt += $row2['preco_total'];
                }
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
        "naoPago" => $contNaoPagos,
        "pagMesAnterior" => $pagAnt 
    ));

    }

    function getMelhoresAtletas(){
        global $conn;
        $sql = "SELECT DISTINCT modalidade.descricao 
        FROM modalidade INNER JOIN comunidade ON
        modalidade.id = comunidade.id_modalidade 
        WHERE comunidade.id_atletaHost =".$_SESSION['id'];
        $arrMod = array();
        $arrayRes = array();
        $result = $conn -> query($sql);
        $msg = "";
        if($result -> num_rows > 0 ){
            while($row = $result -> fetch_assoc()){
                if($row['descricao'] == "Basquetebol"){
                    array_push($arrMod, "info_basquetebol");
                }else if($row['descricao'] == "Futsal"){
                    array_push($arrMod, "info_futsal");
                }else if($row['descricao'] == "Padel"){
                    array_push($arrMod, "info_padel");
                }else{
                    array_push($arrMod, "info_tenis");
                }

            }
        }
            
        for($i = 0; $i < count($arrMod); $i++){
            $limite = 0;
            if(count($arrMod) == 1){
                $limite = 4;
            }else if(count($arrMod) == 2){
                $limite = 2;
            }else{
                $limite = 1;
            }
            $sql2 = "SELECT user.nome, atleta.data_nasc, user.foto, ".$arrMod[$i].".n_jogos, ".$arrMod[$i].".n_vitorias
            FROM user INNER JOIN atleta ON
            user.id = atleta.id_atleta 
            INNER JOIN ".$arrMod[$i]." ON 
            ".$arrMod[$i].".id_atleta = atleta.id_atleta 
            WHERE atleta.id_atleta IN (
                SELECT comunidade_atletas.id_atleta 
                FROM comunidade_atletas INNER JOIN comunidade ON 
                comunidade_atletas.id_comunidade = comunidade.id 
                INNER JOIN user ON 
                comunidade.id_atletaHost = user.id
                WHERE comunidade.id_atletaHost = ".$_SESSION['id']."
            )
            ORDER BY  ".$arrMod[$i].".n_vitorias DESC,
            ".$arrMod[$i].".n_jogos DESC
            LIMIT ".$limite;

            $result2 = $conn -> query($sql2);
            if($result2 -> num_rows > 0 ){
                while($row2 = $result2 -> fetch_assoc()){
                    $msg .= "<tr class='text-center'>
                    <td class='ps-0'>
                      <div class='d-flex align-items-center'>
                        <div class='me-2 pe-1'>
                          <img src='./../../dist/".$row2['foto']."' alt='".$row2['nome']."'
                            class='rounded-circle object-fit-cover' width='50' height='50'>
                        </div>
                        <div>
                          <h6 class='fw-semibold mb-1'>".$row2['nome']."</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class='mb-0 fs-3 fw-semibold text-dark'>".$row2['data_nasc']."</p>
                    </td>
                    <td>
                      <p class='mb-0 fs-3 fw-semibold text-dark'>".$row2['n_jogos']."</p>
                    </td>
                    <td>
                      <p class='fs-3 fw-semibold text-dark mb-0'>".$row2['n_vitorias']."</p>
                    </td>
                    <td>
                      <div id='table-chart'></div>
                    </td>
                  </tr>";
                }
            }
        }

        $conn -> close();
        return($msg);
    }

    function getCampoMaisUsadoAno(){
        global $conn;
        $res = array();
        $sql = "SELECT SUM(temp.horas) AS totalHoras, temp.nome
        FROM (
        SELECT (TIME_TO_SEC(TIMEDIFF(marcacao.hora_fim, marcacao.hora_inicio))/3600) AS horas, campo.nome 
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
            ) AND YEAR(marcacao.data_inicio) =  YEAR(CURRENT_DATE()) 
        )AS temp
        GROUP BY temp.nome
        ORDER BY totalHoras DESC
        LIMIT 1";
        $result = $conn -> query($sql);
        if($result -> num_rows > 0 ){
            while($row = $result -> fetch_assoc()){
                array_push($res, ROUND($row['totalHoras'], 1), $row['nome']);
            }
        }
        $conn -> close();
        return(json_encode($res));

    }


    function getNomeClube() {
        global $conn;
        $nome = "";
        $sql = "SELECT user.nome FROM user INNER JOIN clube ON user.id = clube.id_clube WHERE clube.id_clube = ".$_SESSION['id'];

        $result = $conn -> query($sql);
        if($result -> num_rows > 0 ){
            while($row = $result -> fetch_assoc()){
                $nome .= $row['nome'];
            }
        }
        
        $conn -> close();
        return $nome;
    }

    function getDadosHoje(){
        global $conn;
        $sql = "SELECT COUNT(*) AS contagemHorario, DATE_FORMAT(temp.hora_inicio,'%H:%i') AS hora_inicio, DATE_FORMAT(temp.hora_fim,'%H:%i') AS hora_fim
        FROM (
            SELECT marcacao.hora_inicio, marcacao.hora_fim 
            FROM campo INNER JOIN marcacao 
            ON campo.id = marcacao.id_campo 
            WHERE MONTH(marcacao.data_inicio) =  MONTH(CURRENT_DATE())
            AND marcacao.id_campo IN (
                       SELECT campo.id 
                       FROM campo INNER JOIN campo_clube 
                       ON campo.id = campo_clube.id_campo
                       INNER JOIN clube ON 
                       campo_clube.id_clube = clube.id_clube
                       WHERE clube.id_clube = ".$_SESSION['id']."
                    ) 
        ) AS temp
        GROUP BY temp.hora_inicio
        ORDER BY contagemHorario DESC
        LIMIT 3";
        $res = array(); 
        $result = $conn -> query($sql);
        if($result -> num_rows>0){
            while($row = $result -> fetch_assoc()){
                array_push($res, array($row['hora_inicio'], $row['hora_fim']));
            }
        }
        $nMarcacoesHoje = 0;
        $sql2 = "	SELECT COUNT(*) AS numMarcacoesHoje
        FROM campo INNER JOIN marcacao 
        ON campo.id = marcacao.id_campo 
        WHERE marcacao.data_inicio =  CURRENT_DATE()
        AND marcacao.id_campo IN (
          SELECT campo.id 
          FROM campo INNER JOIN campo_clube 
          ON campo.id = campo_clube.id_campo
          INNER JOIN clube ON 
          campo_clube.id_clube = clube.id_clube
          WHERE clube.id_clube = ".$_SESSION['id'].")";
        $result2 = $conn -> query($sql2);
        if($result2 -> num_rows>0){
            while($row = $result2 -> fetch_assoc()){
                $nMarcacoesHoje = $row['numMarcacoesHoje'];
            }
        }
        $conn -> close();
        return(json_encode(array("HorariosMaisFrequentes" => $res, "numMarcacoesHoje" => $nMarcacoesHoje)));
    }

    function getInfoDefinicoesClube() {
        global $conn;
        $resp = null;

        $sql = "SELECT user.*, clube.* FROM user INNER JOIN clube ON user.id = clube.id_clube WHERE clube.id_clube = ".$_SESSION['id'];

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        
            $resp = array(
                "idClube" => $_SESSION['id'],
                "fotoClube" => $row['foto'],
                "localidadeClube" => $row['localidade'],
                "nomeClube" => $row['nome'],
                "telemovelClube" => $row['telemovel'],
                "emailClube" => $row['email'],
                "nifClube" => $row['nif'],
                "moradaClube" => $row['morada'],
                "codigoPostalClube" => $row['codigo_postal'],
                "anoFundacaoClube" => $row['ano_fundacao'],
                "telefoneClube" => $row['telefone'],
                "descricaoClube" => $row['descricao'],
            );
        }


        return json_encode($resp); 
    }

    function getHorariosDefinicoesClube() {
        global $conn;
        $resp = array();
    
        $sql = "SELECT * FROM horario_clube WHERE id_clube = ".$_SESSION['id']." ORDER BY id_dia ASC";
    
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resp[] = array(
                    "diaSemana" => $row['id_dia'],
                    "horaAbertura" => $row['hora_abertura'],
                    "horaFecho" => $row['hora_fecho']
                );
            }
        }
    
        return json_encode($resp);
    }


}

?>