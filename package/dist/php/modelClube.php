<?php
session_start();
require_once 'connection.php';

class Clube{


    function uploads($img, $id)
    {

        $dir = "../images/utilizadores/" . $id . "/";
        $dir1 = "../../dist/images/utilizadores/" . $id . "/";
        $flag = false;
        $targetBD = "";

        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, TRUE)) {
                die("Erro não é possivel criar o diretório");
            }
        }
        if (array_key_exists('fotoClubeEditNova', $img)) {
            if (is_array($img)) {
                if (is_uploaded_file($img['fotoClubeEditNova']['tmp_name'])) {
                    $fonte = $img['fotoClubeEditNova']['tmp_name'];
                    $ficheiro = $img['fotoClubeEditNova']['name'];
                    $end = explode(".", $ficheiro);
                    $extensao = end($end);
                    $newName = "clube" . date("YmdHis") . "." . $extensao;
                    $target = $dir . $newName;
                    $targetBD = $dir1 . $newName;
                    $flag = move_uploaded_file($fonte, $target);
                }
            }
        }
        return (json_encode(array(
            "flag" => $flag,
            "target" => $targetBD
        )));
    }

    function uploads2($img, $id, $nomeClube)
    {

        $dir = "../images/clubes/". strtolower(str_replace(' ', '_', $nomeClube)) ."/";

        $dir1 = "../../dist/images/clubes/".strtolower(str_replace(' ', '_', $nomeClube))."/";
        $flag = false;
        $targetBD = "";

        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, TRUE)) {
                die("Erro não é possivel criar o diretório");
            }
        }
        if (array_key_exists('fotoCampoEditNova', $img)) {
            if (is_array($img)) {
                if (is_uploaded_file($img['fotoCampoEditNova']['tmp_name'])) {
                    $fonte = $img['fotoCampoEditNova']['tmp_name'];
                    $ficheiro = $img['fotoCampoEditNova']['name'];
                    $end = explode(".", $ficheiro);
                    $extensao = end($end);
                    $newName = "campo" . $id . "." . $extensao;
                    $target = $dir . $newName;
                    $targetBD = $dir1 . $newName;
                    $flag = move_uploaded_file($fonte, $target);
                }
            }
        }
        return (json_encode(array(
            "flag" => $flag,
            "target" => $targetBD
        )));
    }

    function getDistritos($concelhoClube)
    {

        global $conn;
        $msg = "<option value = '-1' selected disabled >Distrito</option><option disabled>---------------</option>";
        $msg2 = "";
        $idDistrito = 0;
        $sql = "SELECT 
                distrito.id AS idDistrito
                FROM
                distrito
                INNER JOIN distrito_concelho ON distrito.id = distrito_concelho.id_distrito
                INNER JOIN concelho ON distrito_concelho.id_concelho = concelho.id
                WHERE concelho.id = ".$concelhoClube;

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();
            
            $idDistrito = $row['idDistrito'];

            $msg2 = $this -> getConcelhos($idDistrito, $concelhoClube);

            $sql2 = "SELECT
            distrito.id as idDistrito, 
            distrito.descricao as descricaoDistrito 
            FROM distrito";

            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    if($row2['idDistrito'] == $idDistrito){
                        $msg .= "<option selected value = '" . $row2['idDistrito'] . "'>" . $row2['descricaoDistrito'] . "</option>";
                    }else{
                        $msg .= "<option value = '" . $row2['idDistrito'] . "'>" . $row2['descricaoDistrito'] . "</option>";
                    }
                }
            }
        }

        return json_encode(array('msg' => $msg, 'msg2' => $msg2));
    }

    function getConcelhos($distrito, $concelho)
    {
        global $conn;
        $msg = "<option value = '-1' selected disabled>Escolha um concelho</option><option disabled>---------------</option>";
        
        $sql = "SELECT concelho.id , concelho.descricao FROM concelho INNER JOIN distrito_concelho ON concelho.id = distrito_concelho.id_concelho WHERE distrito_concelho.id_distrito = '" . $distrito . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                if($row['id'] == $concelho){
                    $msg .= "<option selected value = '" . $row['id'] . "'>" . $row['descricao'] . "</option>";
                }else{
                    $msg .= "<option value = '" . $row['id'] . "'>" . $row['descricao'] . "</option>";
                }
            }
        }

        return ($msg);
    }

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
                      <p class='mb-0 fs-3 fw-semibold text-dark'>".date("d/m/Y", strtotime($row2['data_nasc']))."</p>
                    </td>
                    <td>
                      <p class='mb-0 fs-3 fw-semibold text-dark'>".$row2['n_jogos']."</p>
                    </td>
                    <td>
                      <p class='fs-3 fw-semibold text-dark mb-0'>".$row2['n_vitorias']."</p>
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
        $arraySelects = array();

        $sql = "SELECT user.*, clube.* FROM user INNER JOIN clube ON user.id = clube.id_clube WHERE clube.id_clube = ".$_SESSION['id'];

        

        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $arraySelects = $this -> getDistritos($row['localidade']);

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
                "arraySelects" => $arraySelects
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

    function getGraficoMarcacao(){
        global $conn;
        $sql = "SELECT temp.cont_marcacao AS n_marcacoes, MONTH(CURRENT_DATE()) AS mes
        FROM 
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
        ) AS temp
        UNION
        SELECT temp.cont_marcacao AS n_marcacoes, MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH)) AS mes
            FROM 
            (SELECT COUNT(*) AS cont_marcacao
                FROM marcacao 
                WHERE marcacao.id_campo IN(
                    SELECT campo.id 
                    FROM campo INNER JOIN campo_clube 
                    ON campo.id = campo_clube.id_campo
                    INNER JOIN clube ON 
                    campo_clube.id_clube = clube.id_clube
                    WHERE clube.id_clube = ".$_SESSION['id']."
            ) AND MONTH(marcacao.data_inicio) = MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH))
        ) AS temp
        UNION
        SELECT temp.cont_marcacao AS n_marcacoes, MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 2 MONTH)) AS mes
            FROM 
            (SELECT COUNT(*) AS cont_marcacao
                FROM marcacao 
                WHERE marcacao.id_campo IN(
                    SELECT campo.id 
                    FROM campo INNER JOIN campo_clube 
                    ON campo.id = campo_clube.id_campo
                    INNER JOIN clube ON 
                    campo_clube.id_clube = clube.id_clube
                    WHERE clube.id_clube = ".$_SESSION['id']."
            ) AND MONTH(marcacao.data_inicio) = MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 2 MONTH))
        ) AS temp
        UNION
        SELECT temp.cont_marcacao AS n_marcacoes, MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 3 MONTH)) AS mes
            FROM 
            (SELECT COUNT(*) AS cont_marcacao
                FROM marcacao 
                WHERE marcacao.id_campo IN(
                    SELECT campo.id 
                    FROM campo INNER JOIN campo_clube 
                    ON campo.id = campo_clube.id_campo
                    INNER JOIN clube ON 
                    campo_clube.id_clube = clube.id_clube
                    WHERE clube.id_clube = ".$_SESSION['id']."
            ) AND MONTH(marcacao.data_inicio) = MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 3 MONTH))
        ) AS temp
        UNION
        SELECT temp.cont_marcacao AS n_marcacoes, MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 4 MONTH)) AS mes
            FROM 
            (SELECT COUNT(*) AS cont_marcacao
                FROM marcacao 
                WHERE marcacao.id_campo IN(
                    SELECT campo.id 
                    FROM campo INNER JOIN campo_clube 
                    ON campo.id = campo_clube.id_campo
                    INNER JOIN clube ON 
                    campo_clube.id_clube = clube.id_clube
                    WHERE clube.id_clube = ".$_SESSION['id']."
            ) AND MONTH(marcacao.data_inicio) = MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 4 MONTH))
        ) AS temp";
        $result = $conn->query($sql);
        $arrGraficoMarc = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($arrGraficoMarc, array($row['n_marcacoes'], $row['mes']));
            }
        }

        $conn -> close();
        return(json_encode($arrGraficoMarc));
    }

    function getGraficoGanhos(){
        global $conn;
        $sql = "SELECT SUM(temp.preco_total) AS total, MONTH(CURRENT_DATE()) AS mes
                FROM(
                SELECT (TIME_TO_SEC(TIMEDIFF(marcacao.hora_fim, marcacao.hora_inicio))/3600)*campo.preco_hora AS preco_total
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
                )AS temp
                UNION 
                SELECT SUM(temp.preco_total) AS total, MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH)) AS mes
                FROM(
                SELECT (TIME_TO_SEC(TIMEDIFF(marcacao.hora_fim, marcacao.hora_inicio))/3600)*campo.preco_hora AS preco_total
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
                    AND marcacao.pagamento = 1
                )AS temp
                UNION 
                SELECT SUM(temp.preco_total) AS total, MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 2 MONTH)) AS mes
                FROM(
                SELECT (TIME_TO_SEC(TIMEDIFF(marcacao.hora_fim, marcacao.hora_inicio))/3600)*campo.preco_hora AS preco_total
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
                    ) AND MONTH(marcacao.data_inicio) =  MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 2 MONTH))
                    AND marcacao.pagamento = 1
                )AS temp
                UNION 
                SELECT SUM(temp.preco_total) AS total, MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 3 MONTH)) AS mes
                FROM(
                SELECT (TIME_TO_SEC(TIMEDIFF(marcacao.hora_fim, marcacao.hora_inicio))/3600)*campo.preco_hora AS preco_total
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
                    ) AND MONTH(marcacao.data_inicio) =  MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 3 MONTH))
                    AND marcacao.pagamento = 1
                )AS temp
                UNION 
                SELECT SUM(temp.preco_total) AS total, MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 4 MONTH)) AS mes
                FROM(
                SELECT (TIME_TO_SEC(TIMEDIFF(marcacao.hora_fim, marcacao.hora_inicio))/3600)*campo.preco_hora AS preco_total
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
                    ) AND MONTH(marcacao.data_inicio) =  MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 4 MONTH))
                    AND marcacao.pagamento = 1
                )AS temp";
        $result = $conn->query($sql);
        $arrGraficoGanhos = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($arrGraficoGanhos, array($row['total'], $row['mes']));
            }
        }

        $conn -> close();
        return(json_encode($arrGraficoGanhos));

    }

    function getCamposClube(){
        global $conn;
        $sql = " SELECT tipo_campo.descricao as descricaoTipoCampo, campo.id, campo.nome, campo.foto, campo.preco_hora, modalidade.descricao
        FROM campo INNER JOIN campo_clube 
        ON campo.id = campo_clube.id_campo
        INNER JOIN clube ON 
        campo_clube.id_clube = clube.id_clube
        INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id
        INNER JOIN tipo_campo ON campo.tipo_campo = tipo_campo.id
        WHERE clube.id_clube = ".$_SESSION['id']."";
        $msg = "";
        $result = $conn -> query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr class=''>
                <td><img class='img-fluid rounded border' data-toggle='tooltip' data-placement='top' title='Alterar' style='cursor: pointer; height: 70px; max-width: 100px;' onclick='alterarFotoCampoClube(".$row['id'].")' src='".$row['foto']."' onmouseover='this.classList.add(\"border-primary\"), this.classList.add(\"border-2\")' onmouseout='this.classList.remove(\"border-primary\"), this.classList.remove(\"border-2\")'>
                </td>
                <td>".$row['nome']."</td>
                <td>".$row['descricao']."</td>
                <td>".str_replace('.', ',', ROUND($row['preco_hora'], 2))."€ <button type='button' class='ms-2 btn btn-warning btn-sm' data-toggle='tooltip' data-placement='top' title='Alterar' onclick='editarPrecoHoraCampo(".$row['id'].")'><i class='ti ti-pencil'></i></button></td>
                <td>".$row['descricaoTipoCampo']."</td>
                </tr>";
            }
        }
        $conn -> close();
         
        return($msg);

    }

    function alterarFotoClube($fotoClubeEditNova) {
        global $conn;
        $respUpdate = $this->uploads($fotoClubeEditNova, $_SESSION['id']);
        $respUpdate = json_decode($respUpdate, TRUE);
        $sql = "UPDATE user SET foto = '" . $respUpdate['target'] . "' WHERE id = " . $_SESSION['id'];
        $msg = "";
        $icon = "success";
        $title = "Sucesso";
        if ($conn->query($sql) === TRUE) {
            $msg = "Foto de perfil alterada com sucesso!";
        } else {
            $msg = "Não foi possível alterar a sua foto de perfil";
            $icon = "error";
            $title = "Erro";
        }
        $conn->close();
        return json_encode(array("msg" => $msg, "icon" => $icon, "title" => $title));
        
    }

    function guardarEditClube(
        $nome, 
        $anoFundacaoClubeEdit, 
        $telemovelClubeEdit, 
        $telefoneClubeEdit, 
        $moradaClubeEdit, 
        $descricaoClubeEdit, 
        $emailClubeEdit, 
        $nifClubeEdit, 
        $cpClubeEdit, 
        $distritoClubeEdit, 
        $concelhoClubeEdit,
        $lat,
        $lon,
        $objHorarios,
        $passwordAtual,
        $passwordNova,
        $passwordNova2
    ) 
    {
        global $conn;
        $msg = "";
        $icon = "success";
        $title = "Sucesso";
        

        $objHorarios = json_decode($objHorarios);

        $sql = "UPDATE 
                user 
                SET 
                localidade = '".$concelhoClubeEdit."', 
                nome = '".$nome."', 
                telemovel = ".$telemovelClubeEdit.", 
                email = '".$emailClubeEdit."',
                nif = ".$nifClubeEdit.",
                morada = '".$moradaClubeEdit."', 
                codigo_postal = '".$cpClubeEdit."',
                lat = ".$lat.",
                lon = ".$lon." 
                WHERE id = " . $_SESSION['id'];

        $sql2 = "UPDATE 
                clube 
                SET 
                ano_fundacao = '".$anoFundacaoClubeEdit."', 
                telefone = '".$telefoneClubeEdit."', 
                descricao = '".$descricaoClubeEdit."'
                WHERE id_clube = " . $_SESSION['id'];

        foreach ($objHorarios as $dia => $horario) {
            $id = $horario->id;
            $abertura = $horario->abertura;
            $fecho = $horario->fecho;
        
            $sql3 = "UPDATE 
                horario_clube 
                SET 
                hora_abertura = '".$abertura."', 
                hora_fecho = '".$fecho."' 
                WHERE id_dia = ".$id."
                AND id_clube = " . $_SESSION['id'];
                
        }

        if ($passwordAtual !== null && $passwordNova !== null && $passwordNova2 !== null) {
            $passwordAtualClube = "";
        
            $sql4 = "SELECT `password`  
                FROM `login` 
                WHERE id_user = " . $_SESSION['id'];
        
            $result4 = $conn->query($sql4);
        
            if ($result4->num_rows > 0) {
                while ($row4 = $result4->fetch_assoc()) {
                    $passwordAtualClube = $row4['password'];
                }
            }
        
            if (md5($passwordAtual) !== $passwordAtualClube) {
                $msg = "Password atual inválida";
                $icon = "error";
                $title = "Erro";
                return json_encode(array("msg" => $msg, "icon" => $icon, "title" => $title));
            }
        
            
            if ($passwordNova !== $passwordNova2) {
                $msg = "As novas passwords não coincidem";
                $icon = "error";
                $title = "Erro";
                return json_encode(array("msg" => $msg, "icon" => $icon, "title" => $title));
            }
        
            $sql5 = "UPDATE 
                `login` 
                SET 
                `password` = '".md5($passwordNova)."' 
                WHERE id_user = " . $_SESSION['id'];

            if (!$conn->query($sql5) === TRUE) {
                $msg = "As novas passwords não coincidem";
                $icon = "error";
                $title = "Erro";
                return json_encode(array("msg" => $msg, "icon" => $icon, "title" => $title));
            }
        }
               
                

        if($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3)) {
            $msg = "Informações alteradas com sucesso!";
        } else {
            $msg = "Não foi possível alterar as informações";
            $icon = "error";
            $title = "Erro";
        }

        $conn->close();

        return json_encode(array("msg" => $msg, "icon" => $icon, "title" => $title));
    }

    function getCamposManutencao(){
        global $conn;
        $sql = "SELECT SUM(temp.horas) AS total_horas, temp.nome AS nome, temp.ultima_manutencao AS ultima_manutencao, temp.id AS id 
                        FROM (
                        SELECT (TIME_TO_SEC(TIMEDIFF(marcacao.hora_fim, marcacao.hora_inicio))/3600) AS horas, campo.nome, campo.ultima_manutencao, campo.id
                            FROM marcacao
                            INNER JOIN campo
                            ON campo.id = marcacao.id_campo
                            WHERE marcacao.id_campo IN (
                            SELECT campo.id 
                            FROM campo INNER JOIN campo_clube 
                            ON campo.id = campo_clube.id_campo
                            INNER JOIN clube ON 
                            campo_clube.id_clube = clube.id_clube
                            INNER JOIN marcacao ON 
                            campo.id = marcacao.id_campo
                            INNER JOIN listagem_atletas_marcacao ON
                            marcacao.id = listagem_atletas_marcacao.id_marcacao
                            WHERE clube.id_clube = ".$_SESSION['id']."
                            AND listagem_atletas_marcacao.votacao != 2
                            AND marcacao.data_inicio > campo.ultima_manutencao
                            ) 
                                AND marcacao.data_inicio > campo.ultima_manutencao
                        )AS temp
                        GROUP BY temp.nome

                UNION
                SELECT 0 AS total_horas, campo.nome AS nome, campo.ultima_manutencao AS ultima_manutencao,  campo.id AS id 
                FROM
                campo INNER JOIN campo_clube ON campo.id = campo_clube.id_campo
                WHERE campo.id NOT IN(
                SELECT campo.id 
                            FROM campo INNER JOIN campo_clube 
                            ON campo.id = campo_clube.id_campo
                            INNER JOIN clube ON 
                            campo_clube.id_clube = clube.id_clube
                            INNER JOIN marcacao ON 
                            campo.id = marcacao.id_campo
                            INNER JOIN listagem_atletas_marcacao ON
                            marcacao.id = listagem_atletas_marcacao.id_marcacao
                            WHERE clube.id_clube = ".$_SESSION['id']."
                            AND listagem_atletas_marcacao.votacao != 2
                            AND marcacao.data_inicio > campo.ultima_manutencao
                )AND campo_clube.id_clube = ".$_SESSION['id'];
        $msg = "";
        $result = $conn -> query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr class=''>
                <td>".$row['nome']."</td>
                <td>".str_replace('.', ',', ROUND($row['total_horas'], 1))."h</td>
                <td>".date("d/m/Y", strtotime($row['ultima_manutencao']))."</td>";
                
                $patamar = ROUND(($row['total_horas'] / 200)*100, 0);
                if($patamar < 35){
                    $msg.="<td><div class='progress' role='progressbar' aria-valuenow='25' aria-valuemin='0' aria-valuemax='200'>
                    <div class='progress-bar bg-success' style='width: ".$patamar."%'></div>
                  </div></td>
                    ";
                }else if($patamar < 70){
                    $msg.="<td><div class='progress' role='progressbar' aria-valuenow='25' aria-valuemin='0' aria-valuemax='200'>
                    <div class='progress-bar bg-warning' style='width: ".$patamar."%'></div>
                  </div></td>
                    ";
                }else{
                    if($patamar == 100){
                        $msg.="<td><div class='progress' role='progressbar' aria-valuenow='25' aria-valuemin='0' aria-valuemax='200'>
                        <div class='progress-bar bg-danger' style='width: 100%'></div>
                      </div></td>
                        ";
                    }
                    else{
                        $msg.="<td><div class='progress' role='progressbar' aria-valuenow='25' aria-valuemin='0' aria-valuemax='200'>
                        <div class='progress-bar bg-danger' style='width: ".$patamar."%'></div>
                      </div></td>
                        ";
                    }
                }

                $msg .= "<td><button type='button' class=' btn btn-warning btn-sm' onclick='editarDataManutencaoCampo(".$row['id'].")'>Alterar</td></tr>";

            }
        }
        $conn -> close(); 
        return($msg);

    }

    function editarPrecoHoraCampo($idCampo) {

        global $conn;
        $msg = "";
        $sql = "SELECT preco_hora FROM campo WHERE id = ".$idCampo;

        $result = $conn->query($sql);
        if ($result) {
            while($row = $result->fetch_assoc()) {
                $msg = "<div class='modal-header'>
                        <div class='d-flex'>
                            <img src='../../dist/images/logos/favicon.ico' alt='' height='40' width='40' class='mt-2 ms-2'>
                            <h1 class='mb-0 mt-2 ms-2 fs-6 p-1' id='modalAlterarPrecoLabel'>Edição de Preço</h1>
                        </div>
                        
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Fechar'></button>
                    </div>
                    <div class='modal-body' >
                        <div class='row'>
                        <div class='col-lg-4'>
                            <label for='precoCampoClubeAtual' class='form-label'>Preço Atual</label>
                            <input type='text' class='form-control' disabled value='".$row['preco_hora']."€'>
                        </div>
                        <div class='col-lg-8'>
                            <label for='precoCampoClubeAtual' class='form-label'>Novo Preço</label>
                            <input type='text' class='form-control' id='precoCampoClubeNovo'>
                        </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-primary' data-bs-dismiss='modal' onclick='guardarEditPrecoClube(".$idCampo.")'>Salvar</button>
                        <button type='button' class='btn btn-light' data-bs-dismiss='modal'>Fechar</button>
                    </div>";
            }
        }

        $conn -> close();

        return($msg);
    }

    function guardarEditPrecoClube($precoNovo, $idCampo) {

        global $conn;
        $sql = "UPDATE campo SET preco_hora = ".$precoNovo." WHERE id = ".$idCampo;
        $title = "Successo";
        $msg = "Alterado com sucesso!";
        $icon = "success";

        if (!$conn->query($sql)) {
            $title = "Erro";
            $msg = "Não foi possível alterar o preço!";
            $icon = "error";
        }


        $conn -> close();

        $resp = json_encode(array(
            'title' => $title,
            'msg' => $msg,
            'icon' => $icon
        ));

        return($resp);
    }

    function guardarEditDataManutencaoCampo($dataNovaManutencaoCampo, $idCampo) {

        global $conn;
        $sql = "UPDATE campo SET ultima_manutencao = '".$dataNovaManutencaoCampo."' WHERE id = ".$idCampo;
        $title = "Successo";
        $msg = "Alterado com sucesso!";
        $icon = "success";

        if (!$conn->query($sql)) {
            $title = "Erro";
            $msg = "Não foi possível alterar a data!";
            $icon = "error";
        }

        $conn -> close();

        $resp = json_encode(array(
            'title' => $title,
            'msg' => $msg,
            'icon' => $icon
        ));

        return($resp);
    }

    function alterarFotoCampoClube($id){

        global $conn;
        $sql = "SELECT campo.foto FROM campo WHERE id = ".$id;
        $result = $conn-> query($sql);
        $img = "";
        if($result -> num_rows>0){
            while ($row = $result -> fetch_assoc()){
                $img .= $row['foto'];
            }
        }
        return($img);
    }

    function guardaFotoCampo($id, $foto){
        
        global $conn;

        $sql2 = "SELECT user.nome FROM clube INNER JOIN campo_clube ON clube.id_clube = campo_clube.id_clube 
        INNER JOIN user ON user.id = clube.id_clube WHERE campo_clube.id_campo = ".$id;
        $result= $conn -> query($sql2);
        $nomeClube = "";
        if($result -> num_rows > 0){
            while($row = $result -> fetch_assoc()){
                $nomeClube.= $row['nome'];
            }
        }
        $respUpdate = $this->uploads2($foto, $id, $nomeClube);
        $respUpdate = json_decode($respUpdate, TRUE);
        $sql = "UPDATE campo SET foto = '" . $respUpdate['target'] . "' WHERE id = " .$id;
        $msg = "";
        $icon = "success";
        $title = "Sucesso";
        if ($conn->query($sql) === TRUE) {
            $msg = "Foto de campo alterada com sucesso!";
        } else {
            $msg = "Não foi possível alterar a foto do campo";
            $icon = "error";
            $title = "Erro";
        }
        $conn->close();
        return json_encode(array("msg" => $msg, "icon" => $icon, "title" => $title));

    }

    function getMembros(){
        global $conn;
        $sql = "SELECT comunidade.id, modalidade.descricao, comunidade.nome
        FROM comunidade INNER JOIN modalidade ON 
        modalidade.id = comunidade.id_modalidade 
        WHERE comunidade.id_atletaHost = ".$_SESSION['id'];
        $result = $conn -> query($sql);
        $tabela= "";
        $msg = "";
        if($result -> num_rows >0){
            while($row = $result -> fetch_assoc()){
                if($row['descricao'] == "Basquetebol"){
                    $tabela = "info_basquetebol";
                }else if($row['descricao'] == "Futsal"){
                    $tabela = "info_futsal";
                }else if($row['descricao'] == "Padel"){
                    $tabela = "info_padel";
                }else{
                    $tabela = "info_tenis";
                }
                $sql2 = "SELECT user.nome,user.id, user.foto, user.email, atleta.data_nasc, temp.n_jogos, user.nif
                FROM user 
                INNER JOIN atleta ON user.id = atleta.id_atleta 
                INNER JOIN comunidade_atletas ON atleta.id_atleta = comunidade_atletas.id_atleta
                INNER JOIN comunidade ON comunidade_atletas.id_comunidade = comunidade.id,
                (SELECT ".$tabela.".n_jogos, ".$tabela.".id_atleta 
                FROM ".$tabela."
                WHERE ".$tabela.".id_atleta IN (
                SELECT user.id
                FROM user 
                INNER JOIN atleta ON user.id = atleta.id_atleta 
                INNER JOIN comunidade_atletas ON atleta.id_atleta = comunidade_atletas.id_atleta
                INNER JOIN comunidade ON comunidade_atletas.id_comunidade = comunidade.id
                WHERE comunidade.id = ".$row['id']."
                )
                )AS temp
                WHERE comunidade.id = ".$row['id']."
                AND temp.id_atleta = atleta.id_atleta 
                GROUP BY atleta.id_atleta ";
                $result2 = $conn -> query($sql2); 
                if($result2 -> num_rows >0){
                    while($row2 = $result2 -> fetch_assoc()){
                        $msg .= "<tr class='text-center'>
                        <td>".$row2['nif']."</td>
                        <td><img src='../../dist/".$row2['foto']."' alt='Thumbnail 1'
                            class='object-fit-cover rounded-2' width='30' height='30'></td>
                        <td>".$row2['nome']."</td>
                        <td>".date('d/m/Y', strtotime($row2['data_nasc']))."</td>
                        <td>".$row2['email']."</td>
                        <td>".$row2['n_jogos']."</td>
                        <td>".$row['nome']."</td>
                        <td><button type='button' class='btn btn-sm ti ti-x text-white'
                            style='background-color: firebrick;' onclick=\"removerMembroEquipa(".$row2['id'].", ".$row['id'].", '".$row['nome']."')\"></button></td>
                    </tr>";
                    }
                }
            }
        }

        $conn -> close();
        return($msg);
    }

    function guardaRemoverMembro($idMembro, $idEquipa){
        global $conn;
        $sql = "DELETE FROM comunidade_atletas WHERE id_comunidade = ".$idEquipa." AND id_atleta = ".$idMembro."";
        $title = "Successo";
        $msg = "Alterado com sucesso!";
        $icon = "success";

        if (!$conn->query($sql)) {
            $title = "Erro";
            $msg = "Não foi possível alterar a data!";
            $icon = "error";
        }

        $conn -> close();

        $resp = json_encode(array(
            'title' => $title,
            'msg' => $msg,
            'icon' => $icon
        ));

        return($resp);
    }

    function getReservas(){
        global $conn;
        $sql = "SELECT marcacao.id, marcacao.data_inicio, marcacao.hora_inicio, marcacao.hora_fim, user.nome as nomeAtleta, campo.nome AS nomeCampo
        FROM marcacao INNER JOIN campo ON 
        marcacao.id_campo = campo.id 
        INNER JOIN atleta ON marcacao.id_atleta = atleta.id_atleta
        INNER JOIN user ON atleta.id_atleta = user.id
        INNER JOIN listagem_atletas_marcacao ON 
        listagem_atletas_marcacao.id_marcacao = marcacao.id
        WHERE campo.id IN (
            SELECT campo.id
            FROM campo INNER JOIN campo_clube ON 
            campo.id = campo_clube.id_campo
            WHERE campo_clube.id_clube = ".$_SESSION['id']."
        )AND listagem_atletas_marcacao.votacao = 2
        ORDER BY marcacao.data_inicio ASC";
        $msg = "";
        $horaInicio = "";
        $horaFim = "";
        $result = $conn -> query($sql);
        if($result -> num_rows >0){
            while($row = $result -> fetch_assoc()){
                $horaInicio = date_create($row['hora_inicio']);
                $horaFim = date_create($row['hora_fim']);
                $horaInicio = date_format($horaInicio,"H:i");
                $horaFim = date_format($horaFim,"H:i");
                $msg .= "<tr class=''>
                    <td class='fw-bolder'>".$row['id']."</td>
                    <td>".$row['nomeAtleta']."</td>
                    <td>".date('d/m/Y', strtotime($row['data_inicio']))."</td>
                    <td>".$horaInicio."h - ".$horaFim."h</td>
                    <td>".$row['nomeCampo']."</td>
                    <td><button type='button' class='btn btn-sm ti ti-x text-white'
                        style='background-color: firebrick;' onclick='modalCancelarReserva(".$row['id'].")'></button></td>
                </tr>";
            }
        }
        $conn -> close();
        return($msg);
    }

    function cancelarReserva($idMarcacao){
        global $conn;
        $sql = "DELETE FROM listagem_atletas_marcacao WHERE id_marcacao =".$idMarcacao;
        $title = "Successo";
        $msg = "Reserva cancelada com sucesso!";
        $icon = "success";
        if ($conn->query($sql)) {
            $sql2 = "DELETE FROM marcacao WHERE id =".$idMarcacao;
            if (!$conn->query($sql2)) {
                $title = "Erro";
                $msg = "Não foi possível cancelar a reserva!";
                $icon = "error";
            }
        }else{
            $title = "Erro";
            $msg = "Não foi possível cancelar a reserva!";
            $icon = "error";
        }
        $conn -> close();
        $resp = json_encode(array(
            'title' => $title,
            'msg' => $msg,
            'icon' => $icon
        ));

        return($resp);
    }

    function getMarcacoesPagamentos(){
        global $conn;
        $sql = "SELECT (TIME_TO_SEC(TIMEDIFF(marcacao.hora_fim, marcacao.hora_inicio))/3600)*campo.preco_hora AS preco_total, marcacao.id, marcacao.data_inicio, marcacao.hora_inicio, marcacao.hora_fim, user.nome AS nomeUser, campo.nome AS nomeCampo, marcacao.pagamento AS pagamento
        FROM marcacao INNER JOIN campo ON 
        marcacao.id_campo = campo.id 
        INNER JOIN atleta ON marcacao.id_atleta = atleta.id_atleta
        INNER JOIN user ON atleta.id_atleta = user.id
        INNER JOIN listagem_atletas_marcacao ON 
        listagem_atletas_marcacao.id_marcacao = marcacao.id
        WHERE campo.id IN (
            SELECT campo.id
            FROM campo INNER JOIN campo_clube ON 
            campo.id = campo_clube.id_campo
            WHERE campo_clube.id_clube = ".$_SESSION['id']."
        )AND listagem_atletas_marcacao.votacao != 2
        GROUP BY marcacao.id
        ORDER BY marcacao.data_inicio DESC
        ";
        $msg = "";
        $horaInicio = "";
        $horaFim = "";
        $result = $conn -> query($sql);
        if($result -> num_rows >0){
            while($row = $result -> fetch_assoc()){
                $horaInicio = date_create($row['hora_inicio']);
                $horaFim = date_create($row['hora_fim']);
                $horaInicio = date_format($horaInicio,"H:i");
                $horaFim = date_format($horaFim,"H:i");
                $pagamento = "";
                if($row['pagamento'] == 0){
                    $pagamento .= "Pendente <i class='ti ti-alert-circle-filled' style='color: firebrick;'></i>";
                }else{
                    $pagamento .= "Feito";
                }
                $msg .= "<tr class=''>
                    <td>".$row['nomeUser']."</td>
                    <td>".$row['data_inicio']."</td>
                    <td>".$horaInicio." - ".$horaFim."</td>
                    <td>".$row['nomeCampo']."</td>
                    <td>".ROUND($row['preco_total'], 2)." €</td>
                    <td>".$pagamento."</td>";
                if($row['pagamento'] == 0){
                    $msg .="<td><button type='button' class='btn btn-sm ti ti-check text-white'
                    style='background-color: forestgreen;' onclick= 'getModalPagamento(".$row['id'].")'></button></td>
                    </tr>";
                }else{
                    $msg .="<td><button type='button'  disabled class='btn btn-sm ti ti-check text-white'
                    style='background-color: forestgreen;'></button></td>
                    </tr>";
                }
                
            }
        }
        $conn -> close();
        return($msg);
    }

    function validarPagamento($idMarcacao){
        global $conn;
        $sql = "UPDATE marcacao SET pagamento = 1 WHERE id =".$idMarcacao;
        $title = "Successo";
        $msg = "Pagamento validado com sucesso!";
        $icon = "success";
        if (!$conn->query($sql)) {
            $title = "Erro";
            $msg = "Não foi possível validar o pagamento!";
            $icon = "error";
        }
        $conn -> close();
        $resp = json_encode(array(
            'title' => $title,
            'msg' => $msg,
            'icon' => $icon
        ));

        return($resp);
    }

    function getMembrosAdicionar() {
        global $conn;
        $msg = "";

        $sql = "SELECT DISTINCT user.id, user.foto, user.nome, concelho.descricao AS concelho
        FROM
        user
        INNER JOIN
        concelho
        ON
        user.localidade = concelho.id
        INNER JOIN atleta_modalidade ON
        user.id = atleta_modalidade.id_atleta
        
        WHERE user.tipo_user = 1
        AND atleta_modalidade.id_modalidade IN (
        SELECT campo_clube.id_modalidade 
        FROM
        campo_clube
        INNER JOIN
        clube ON campo_clube.id_clube
        WHERE campo_clube.id_clube = ".$_SESSION['id']."
        )
        ORDER BY user.nome ASC;";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $msg .= "<li class='p-1 mb-1 bg-hover-light-black'>
                <div class='d-flex justify-content-between align-items-center'>
                    <div class='d-flex align-items-center gap-3'>
                        <i class='ti ti-user fs-6' data-toggle='tooltip' data-bs-placement='top' title='Atleta'></i>
                        <a href='../horizontal/perfil.php?id=" . $row['id'] . "'><img src='../../dist/" . $row['foto'] . "' class='rounded-circle border border-1 border-primary' width='40' height='40'></a>
                        <a href='../horizontal/perfil.php?id=" . $row['id'] . "'><span class='fs-4 text-black fw-normal d-block'>" . $row['nome'] . "</span></a>
                        <span class='d-none d-md-block'><i class='ti ti-map-pin me-1'></i>" . $row['concelho'] . "</span>
                    </div>
                    <div class='d-flex align-items-center'>
                        <button class='btn btn-primary btn-sm' onclick='adicionarMembroEquipa(" . $row['id'] . ")'>Adicionar</button>
                    </div>
                </div>   
            </li>";
            }
        }

        $conn -> close();

        return($msg);
    }

    function getEquipasSelectAdicionarMembro($idUser) {
        global $conn;
        $msg = "<option val='-1' selected disabled>Selecione uma equipa</option>";
        $flag = false;

        $sql = "SELECT comunidade.nome, comunidade.id
        FROM comunidade 
        WHERE comunidade.id NOT IN 
        (
            SELECT comunidade.id
            FROM comunidade 
            INNER JOIN comunidade_atletas ON 
            comunidade_atletas.id_comunidade = comunidade.id
            WHERE comunidade_atletas.id_atleta = ".$idUser."
        
        ) AND comunidade.id_atletaHost = ".$_SESSION['id'];

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                $flag = true;
            }
        } else {
            $msg = "Este atleta já se encontra inscrito em todas as suas equipas!";
        }

        $conn -> close();

        $resp = json_encode(array(
            "msg" => $msg,
            "flag" => $flag
        ));
        
        return($resp);
    }

    function guardaAdicionarMembros($idUser, $idEquipa) {
        global $conn;
        $msg = "Membro adicionado com sucesso";
        $title = "Sucesso";
        $icon = "success";

        $sql = "INSERT INTO comunidade_atletas (id_atleta, id_comunidade) VALUES (".$idUser.", ".$idEquipa.")";

        if ($conn->query($sql) === FALSE) {
            $msg = "Não foi possível adicionar este Membro a esta equipa.";
            $title = "Erro";
            $icon = "error";
        }

        $conn -> close();

        $resp = json_encode(array(
            "title" => $title,
            "msg" => $msg,
            "icon" => $icon
        ));
        
        return($resp);

    }
}
?>