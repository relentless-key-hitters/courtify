<?php
session_start();
require_once 'connection.php';

class Equipa
{
    /*Pedro*/ 
    function getEquipasUser(){
        global $conn;
        $msg = "";
        $sql = "SELECT DISTINCT
        comunidade.id AS idComunidade,
        comunidade.nome AS nomeComunidade,
        comunidade.foto AS fotoComunidade,
        comunidade.id_atletaHost as idAtletaHost,
        tipo_comunidade.descricao AS tipoComunidade,
        modalidade.descricao AS tipoModalidade,
        modalidade.descricao AS tipoModalidade,
        user.nome as nomeClube
        FROM 
        comunidade
        INNER JOIN
        modalidade ON comunidade.id_modalidade = modalidade.id
        INNER JOIN 
        tipo_comunidade ON comunidade.tipo_comunidade = tipo_comunidade.id
        INNER JOIN 
        user ON comunidade.id_atletaHost = user.id
        INNER JOIN 
		  comunidade_atletas ON comunidade.id = comunidade_atletas.id_comunidade
        WHERE comunidade_atletas.id_atleta = ".$_SESSION['id']."
        AND comunidade_atletas.estado = 1
        AND comunidade.tipo_comunidade = 2
        LIMIT 8"; 
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<div class='col-12 col-sm-4 col-md-4 col-lg-3'>
                            <div class='card hover-img shadow'>
                            <div class='d-flex flex-column p-3 align-items-center mt-3'>
                                <a href='./equipa.php?id=" . $row['idComunidade'] . "'><img src='../../dist/" . $row['fotoComunidade'] . "' class='img-fluid' style='max-width: 100px;'></a>
                                <span class='fs-5 fw-bold'>" . $row['nomeComunidade'] . "</span>
                                <a href='./clube.php?id=".$row['idAtletaHost']."'><span class='fs-3'><i class='ti ti-building me-1'></i>" . $row['nomeClube'] . "</span></a>
                                ";
                $msg .= "<a href='./equipa.php?id=" . $row['idComunidade'] . "'>
                                    <button class='btn btn-primary btn-sm mt-3'>Ver</button>
                                </a>";
                if ($row['tipoModalidade'] == "Ténis") {
                    $msg .= "<span class='badge bg-success rounded-pill position-absolute top-0 end-0 mt-2 me-2'><i class='ti ti-ball-tennis me-1'></i>Ténis</span>";
                } else if ($row['tipoModalidade'] == "Futsal") {
                    $msg .= "<span class='badge bg-danger rounded-pill position-absolute top-0 end-0 mt-2 me-2'><i class='ti ti-ball-football me-1'></i>Futsal</span>";
                } else if ($row['tipoModalidade'] == "Basquetebol") {
                    $msg .= "<span class='badge bg-warning rounded-pill position-absolute top-0 end-0 mt-2 me-2'><i class='ti ti-ball-basketball me-1'></i>Basquetebol</span>";
                } else {
                    $msg .= "<span class='badge bg-primary rounded-pill position-absolute top-0 end-0 mt-2 me-2'><i class='ti ti-ball-tennis me-1'></i>Padel</span>";
                }


                $msg .= "</div>
                    </div>
                </div>";
            }
        } else {
            $msg .= "<div class='text-center mt-3 mb-3'><span class='fs-6 fw-bold'>Sem resultados!</span><p>De momento não estás associado a nenhuma Equipa.</p></div>";
        }

        $conn->close();

        return ($msg);
    }
    /*Pedro*/
    function getEquipasLocalidadeUser(){
        global $conn;
        $msg = "";
        $local = "";
        $sql = "SELECT DISTINCT
        comunidade.id AS idComunidade,
        comunidade.nome AS nomeComunidade,
        comunidade.foto AS fotoComunidade,
        comunidade.id_atletaHost as idAtletaHost,
        comunidade.descricao as descricaoEquipa,
        tipo_comunidade.descricao AS tipoComunidade,
        modalidade.descricao AS tipoModalidade,
        comunidade.ranking as ranking,
        user.nome as nomeClube,
        concelho.descricao as localidade
        FROM 
        comunidade
        INNER JOIN
        modalidade ON comunidade.id_modalidade = modalidade.id
        INNER JOIN 
        tipo_comunidade ON comunidade.tipo_comunidade = tipo_comunidade.id
        INNER JOIN 
        user ON comunidade.id_atletaHost = user.id
        INNER JOIN concelho ON user.localidade = concelho.id
        WHERE comunidade.tipo_comunidade = 2
        AND user.localidade = (
		  	SELECT localidade 
		  	FROM user 
		  	WHERE user.id = ".$_SESSION['id']."
		  )";  
        $result= $conn -> query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $local = $row['localidade'];
                $msg .= "<div class='col-12 col-sm-6 col-md-6 col-lg-4'>
                            <div class='card hover-img shadow'>
                                <div class='row mt-3'>
                                    <div class='col-md-4 text-center'>
                                        <div>
                                            <a href='./equipa.php?id=" . $row['idComunidade'] . "'><img src='../../dist/" . $row['fotoComunidade'] . "' class='img-fluid ps-1 pe-1' style='max-width: 100px;'></a>
                                        <div>
                                            <a href='./equipa.php?id=" . $row['idComunidade'] . "'>
                                                <button class='btn btn-primary btn-sm mt-1 mb-1'>Ver</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-8 mt-3'>
                                    <div class= 'row'>
                                        <div class= 'text-center text-sm-center text-md-start text-lg-start col-sm-12 col-md-12'>
                                            <span class='fs-5 fw-bold'>" . $row['nomeComunidade'] . "</span>
                                        </div>
                                        <div class= 'text-center text-sm-center text-md-start text-lg-start col-sm-12 col-md-12'>
                                            <a href='./clube.php?id=".$row['idAtletaHost']."'><span class='fs-3'><span class='fs-3'><i class='ti ti-building me-1'></i>" . $row['nomeClube'] . "</span></a>
                                        </div>
                                    </div>
                                    <div class = 'row mt-2 text-center text-sm-center text-md-start text-lg-start'>
                                        <div class='col-md-12 col-lg-12'>
                                            <span class='fs-2'>" . $row['descricaoEquipa'] . "</span>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                if ($row['tipoModalidade'] == "Ténis") {
                    $msg .= "<span class='badge bg-success rounded-pill position-absolute top-0 end-0 mt-2 me-2'><i class='ti ti-ball-tennis me-1'></i>Ténis</span>";
                } else if ($row['tipoModalidade'] == "Futsal") {
                    $msg .= "<span class='badge bg-danger rounded-pill position-absolute top-0 end-0 mt-2 me-2'><i class='ti ti-ball-football me-1'></i>Futsal</span>";
                } else if ($row['tipoModalidade'] == "Basquetebol") {
                    $msg .= "<span class='badge bg-warning rounded-pill position-absolute top-0 end-0 mt-2 me-2'><i class='ti ti-ball-basketball me-1'></i>Basquetebol</span>";
                } else {
                    $msg .= "<span class='badge bg-primary rounded-pill position-absolute top-0 end-0 mt-2 me-2'><i class='ti ti-ball-tennis me-1'></i>Padel</span>";
                }


                $msg .= "
                    </div>
                </div>";
            }
        } else {
            $msg .= "<div class='text-center mt-3 mb-3'><span class='fs-6 fw-bold'>De momento não existem equipas na tua localidade.Sem resultados!</span><p>De momento não estás associado a nenhum Grupo. Podes criar o teu próprio no botão no canto superior direito, ou juntares-te a Grupos existentes!</p></div>";
        }

        $conn->close();

        return json_encode(array("msg" => $msg , "localidade" => $local));

    }
    /*Pedro*/
    function getAtletasEquipa($id, $offset, $porPagina){
        global $conn;
        $msg = "";

        $offset = max(0, $offset); // Ter a certeza que o offset não é inferior a 0, se sim, mete a 0

        $sqlContagem = "SELECT COUNT(*) AS total FROM user
        INNER JOIN
        comunidade_atletas ON user.id = comunidade_atletas.id_atleta
        WHERE comunidade_atletas.estado = 1
        AND comunidade_atletas.id_comunidade = " . $id;

        $resultadoContagem = $conn->query($sqlContagem);
        $totalRows = $resultadoContagem->fetch_assoc();
        $itemsTotais = $totalRows['total'];

        $sql = "SELECT * 
        FROM
        user
        INNER JOIN
        comunidade_atletas ON user.id = comunidade_atletas.id_atleta
        WHERE comunidade_atletas.estado = 1
        AND comunidade_atletas.id_comunidade = " . $id . "
        ORDER BY nome ASC
        LIMIT " . $offset . ", " . $porPagina;

        $result = $conn->query($sql);

        $paginasTotais = ceil($itemsTotais / $porPagina);
        $paginaAtual = ceil(($offset + 1) / $porPagina);

        $msg .= "<div class='row gap-4'>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<div class='col-2'>
                                <a href='./perfil.php?id=" . $row['id'] . "'><img src='../../dist/" . $row['foto'] . "' data-toggle='tooltip' data-bs-placement='top' title='" . $row['nome'] . "' class='img-fluid rounded-circle border border-1 border-primary' style='max-width: 50px;'></a>
                        </div>";
            }
        }

        $conn->close();
        $data = array('msg' => $msg, 'paginasTotais' => $paginasTotais, 'paginaAtual' => $paginaAtual, 'total' => $itemsTotais);
        return json_encode($data);
    }
    /*Pedro*/
    function getInfoEquipa($id){
        global $conn;
        $sql = "SELECT
        comunidade.nome AS nomeComunidade,
        comunidade.foto AS fotoComunidade,
        comunidade.id_atletaHost as idAtletaHost,
        modalidade.descricao AS tipoModalidade,
        comunidade.descricao AS descricaoComunidade,
        user.nome as nomeClube,
        clube.ano_fundacao as anoFundClube,
        concelho.descricao as localClube
        FROM 
        comunidade
        INNER JOIN
        modalidade ON comunidade.id_modalidade = modalidade.id
        INNER JOIN  
        user ON comunidade.id_atletaHost = user.id
        INNER JOIN 
        clube ON clube.id_clube = user.id
        INNER JOIN 
        concelho ON user.localidade = concelho.id
        WHERE 
        comunidade.id = ".$id;
        $msg = "";
        $msgClube = "";
        $result = $conn -> query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<div class='p-2 d-flex flex-column align-items-center'>";
                if ($row['tipoModalidade'] == "Basquetebol") {
                    $msg .= "<span class='badge rounded-pill position-absolute ms-2 mt-2 top-0 start-0 text-bg-warning'>
                                <i class='ti ti-ball-basketball me-1'></i><small>" . $row['tipoModalidade'] . "</small>
                            </span>";
                } else if ($row['tipoModalidade'] == "Futsal") {
                    $msg .= "<span class='badge rounded-pill position-absolute ms-2 mt-2 top-0 start-0 text-bg-danger mt-2'>
                                <i class='ti ti-ball-football me-1'></i><small>" . $row['tipoModalidade'] . "</small>
                            </span>";
                } else if ($row['tipoModalidade'] == "Ténis") {
                    $msg .= "<span class='badge rounded-pill position-absolute ms-2 mt-2 top-0 start-0 text-bg-success mt-2'>
                                <i class='ti ti-ball-tennis me-1'></i><small>" . $row['tipoModalidade'] . "</small>
                            </span>";
                } else {
                    $msg .= "<span class='badge rounded-pill position-absolute ms-2 mt-2 top-0 start-0 text-bg-primary mt-2'>
                                <i class='ti ti-ball-tennis me-1'></i><small>" . $row['tipoModalidade'] . "</small>
                            </span>";
                }
                $maximoCaracteresDesc = 205;
                $descricao = substr($row['descricaoComunidade'], 0, $maximoCaracteresDesc);
                if (strlen($row['descricaoComunidade']) > $maximoCaracteresDesc) {
                    $ultimoEspaco = strrpos(substr($descricao, 0, $maximoCaracteresDesc), ' ');
                    $descricao = substr($descricao, 0, $ultimoEspaco) . " (...)";
                }

                $msg .= "<img src='../../dist/" .$row['fotoComunidade']. "' class='mt-3 rounded-circle' width='130' height='130' alt='" . $row['nomeComunidade'] . "' />";
                $msg .= "<h5 class='fw-semibold mb-1 pb-2 fs-7'>" . $row['nomeComunidade'] . "</h5>";
                $msg .= "<span class=''>" . $descricao . "</span>";
                $msgClube .= "<span class=''>Equipa pertencente a:</span><br><a href='./clube.php?id=".$row['idAtletaHost']."'><h5 class='fw-semibold mb-1 pb-2 fs-7'>" . $row['nomeClube'] . "</h5>";
                $msgClube .= "<i class='ti ti-building me-1'></i><span class=''>Fundado em " . $row['anoFundClube']. "</span><br>";
                $msgClube .= "<i class='ti ti-map-pin me-1'></i><span class=''>" . $row['localClube']. "</span>";
            }
        }

        $conn -> close();
        return json_encode(array(
            "msgEquipa" => $msg,
            "msgClube" => $msgClube
        ));
    }
    /*Mariana*/
    function getEstatisticasEquipa($id){
        global $conn;
        $sql = "SELECT modalidade.descricao 
        FROM modalidade 
        WHERE modalidade.id = (
            SELECT id_modalidade
            FROM comunidade 
            WHERE id = ".$id.")";
        $result = $conn -> query($sql);
        $res = "";
        if($result -> num_rows>0){
            while($row = $result -> fetch_assoc()){
                if($row['descricao'] == "Basquetebol"){
                    $res = $this -> getEstatisticasEquipaBasqFutsal($id, "info_basquetebol");
                }else if ($row['descricao'] == "Futsal"){
                    $res = $this -> getEstatisticasEquipaBasqFutsal($id, "info_futsal");
                }else if($row['descricao'] == "Padel"){
                    $res = $this -> getEstatisticasEquipaPadelTenis($id, "info_padel");
                }else{
                    $res = $this -> getEstatisticasEquipaPadelTenis($id, "info_tenis");
                }
            }
        }  
        $conn->close();
        return json_encode($res); 
    }
    /*Mariana*/
    function getEstatisticasEquipaPadelTenis($id, $nome){
        global $conn;
        $percVit = 0;
        $percSetsGanhos = 0;
        $percMvp = 0;
        $sql = "SELECT *
        FROM ".$nome."
        WHERE id_atleta IN (
            SELECT id_atleta
            FROM comunidade_atletas
            WHERE id_comunidade = '".$id."'
        )";
        $count = 0;
        $result = $conn ->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $count++;
                if($row['n_jogos']!=0){
                   $percVit += ($row['n_vitorias']/$row['n_jogos']);
                   $percMvp += ($row['n_mvp']/$row['n_jogos']);
                }
                if($row['n_sets']!=0){
                $percSetsGanhos += ($row['n_set_ganhos']/$row['n_sets']);
                }
            }
        }
        $percVit =  round(($percVit / $count)*100, 2, PHP_ROUND_HALF_UP);
        $percMvp =  round(($percMvp / $count)*100, 2, PHP_ROUND_HALF_UP);
        $percSetsGanhos =  round(($percSetsGanhos / $count)*100, 2, PHP_ROUND_HALF_UP);
        return(array($percVit, $percSetsGanhos, $percMvp));
    }
    /*Mariana*/
    function getEstatisticasEquipaBasqFutsal($id, $nome){
        global $conn;
        $percVit = 0;
        $percMvp = 0;
        $sql = "SELECT *
        FROM ".$nome."
        WHERE id_atleta IN (
            SELECT id_atleta
            FROM comunidade_atletas
            WHERE id_comunidade = '".$id."'
        )";
        $count = 0;
        $result = $conn ->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $count++;
                if($row['n_jogos']!=0){
                   $percVit += ($row['n_vitorias']/$row['n_jogos']);
                   $percMvp += ($row['n_mvp']/$row['n_jogos']);
                }
            }
        }
        $percVit = round(($percVit / $count)*100, 2, PHP_ROUND_HALF_UP);
        $percMvp = round(($percMvp / $count)*100, 2, PHP_ROUND_HALF_UP);
        return(array($percVit, $percMvp));
    }
    /*Mariana*/
    function getTopAltetas($id){
        global $conn;
        $msg = "";
        $tabela = "";
        $nome = "";
        $modalidade = "";
        $sql2 = "SELECT modalidade.descricao 
        FROM modalidade INNER JOIN 
        comunidade ON comunidade.id_modalidade = modalidade.id
        WHERE comunidade.id = ".$id;
        $result2 = $conn -> query($sql2);
        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
                $modalidade = $row['descricao'];
                if($row['descricao'] == "Basquetebol"){
                    $tabela.="SELECT user.id, user.nome AS nome, user.foto AS foto,concelho.descricao AS localidade,temp2.ranking, info_basquetebol.n_jogos, info_basquetebol.n_vitorias
                    FROM atleta
                    INNER JOIN 
                    info_basquetebol ON atleta.id_atleta = info_basquetebol.id_atleta
                    INNER JOIN user ON 
                    user.id = atleta.id_atleta
                    INNER JOIN concelho ON 
                    concelho.id = user.localidade,";
                    $nome ="info_basquetebol";
                }else if($row['descricao'] == "Futsal"){
                    $tabela.="SELECT user.id, user.nome AS nome, user.foto AS foto,concelho.descricao AS localidade,posicao_futsal.descricao AS posicao,temp2.ranking, info_futsal.n_jogos, info_futsal.n_vitorias
                    FROM atleta
                    INNER JOIN 
                    info_futsal ON atleta.id_atleta = info_futsal.id_atleta
                    INNER JOIN user ON 
                    user.id = atleta.id_atleta
                    INNER JOIN posicao_futsal ON posicao_futsal.id = info_futsal.id_posicao
                    INNER JOIN concelho ON 
                    concelho.id = user.localidade,";
                    $nome ="info_futsal";
                }else if($row['descricao'] == "Padel"){
                    $tabela.="SELECT user.id, user.nome AS nome, user.foto AS foto,concelho.descricao AS localidade, nivel_padel.descricao AS nivel, lado_atleta.descricao AS lado,temp2.ranking, info_padel.n_jogos, info_padel.n_vitorias
                    FROM atleta
                    INNER JOIN 
                    info_padel ON atleta.id_atleta = info_padel.id_atleta
                    INNER JOIN user ON 
                    user.id = atleta.id_atleta
                    INNER JOIN concelho ON 
                    concelho.id = user.localidade
                    INNER JOIN lado_atleta ON 
                    lado_atleta.id = info_padel.id_lado
                    INNER JOIN nivel_padel ON 
                    nivel_padel.id = info_padel.nivel,";
                    $nome ="info_padel";
                }else{
                    $tabela.="SELECT user.id, user.nome AS nome, user.foto AS foto,concelho.descricao AS localidade,lado_atleta.descricao AS lado,temp2.ranking, info_tenis.n_jogos, info_tenis.n_vitorias
                    FROM atleta
                    INNER JOIN 
                    info_tenis ON atleta.id_atleta = info_tenis.id_atleta
                    INNER JOIN user ON 
                    user.id = atleta.id_atleta
                    INNER JOIN concelho ON 
                    concelho.id = user.localidade
                    INNER JOIN lado_atleta ON 
                    lado_atleta.id = info_tenis.id_lado,";
                    $nome ="info_tenis";
                }
            }
        }

        $sql = $tabela."
        (
           SELECT temp.posicao AS ranking, temp.atleta AS atleta
           FROM (
              SELECT ROW_NUMBER() OVER (ORDER BY ranking DESC) AS posicao, ranking, id_atleta AS atleta
              FROM ".$nome."
              ORDER BY ranking DESC
           )AS temp
        )AS temp2
        WHERE atleta.id_atleta IN (
            SELECT comunidade_atletas.id_atleta
           FROM comunidade_atletas 
           WHERE comunidade_atletas.id_comunidade = ".$id."
        ) 
        AND temp2.atleta = atleta.id_atleta
        ORDER BY ".$nome.".ranking DESC
        LIMIT 4";

        $result = $conn -> query($sql);
        $cont = 1;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $percVit = round(($row['n_vitorias']/$row['n_jogos'])*100, 2, PHP_ROUND_HALF_UP);
                $msg .= "<div class='col-12 col-sm-6 col-md-6 col-lg-3' data-aos='fade-down-right' data-aos-delay='400' data-aos-duration='1500'>
                <div class='card rounded-0 hover-img4'>
                <div class='d-flex flex-column align-items-center justify-content-center'>
                <img src='../../dist/images/equipas/top_atletas_equipa_".$cont.".png' class='position-absolute top-0 start-0 mt-2 ms-2' style='max-width: 40px;'></img>
                    <div class='mt-5'>
                    <a href='./perfil.php?id=" . $row['id'] . "'><img src='../../dist/".$row['foto']."' data-toggle='tooltip' data-bs-placement='top' class='img-fluid rounded-circle ' style='max-width: 70px;' aria-label='".$row['nome']."' data-bs-original-title='António Silva'></a>
                    </div>
                    <div class='p-1 text-center'>
                    <div class=''>
                        <span class='fs-4'>".$row['nome']."</span>
                    </div>
                    <div class=''>
                        <span class='fs-2'><i class='ti ti-map-pin me-1'></i>".$row['localidade']."</span><br>";

                if($modalidade == "Padel"){
                    $msg .= "<span class='fs-2'>Nível:  <span class= 'fw-bolder'>".$row['nivel']."</span></span><br>";
                    $msg .= "<span class='fs-2'>Lado:<span class= 'fw-bolder'>".$row['lado']."</span></span>";
                }else if($modalidade == "Futsal"){
                    $msg .= "<span class='fs-2'>Posição: <span class= 'fw-bolder'>".$row['posicao']."</span></span>";
                }
                    $msg .="</div>
                    </div>
                    <div class='row container mt-2'>
                    <div class='col-md-12 text-center'>
                        <div class='card shadow border border-2 border-light rounded-0'>
                        <span class='fs-2'><i class='ti ti-chart-line'></i> Ranking Geral:</span> <span class='fw-bolder'>".$row['ranking']."</span>
                        <span class='fs-2'><i class='ti ti-bolt fs-5 ms-1'></i> % Vitórias:</span> <span class='fw-bolder'>".$percVit." %</span>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>";
            $cont ++;
            }
        }
        $conn -> close();
        return($msg);
        
    }
}

?>