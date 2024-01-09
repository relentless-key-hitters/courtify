<?php
session_start();
require_once 'connection.php';

class Equipa
{
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
        LIMIT 12"; 
        $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $msg .= "<div class='col-12 col-sm-4 col-md-4 col-lg-2'>
                        <div class='card hover-img shadow'>
                        <div class='d-flex flex-column p-3 align-items-center mt-3'>
                            <a href='./equipa.php?id=" . $row['idComunidade'] . "'><img src='../../dist/" . $row['fotoComunidade'] . "' class='img-fluid' style='max-width: 100px;'></a>
                            <span class='fs-4 fw-bold'>" . $row['nomeComunidade'] . "</span>
                            <a href='./clube.php?id=".$row['idAtletaHost']."'><span class='fs-3'>" . $row['nomeClube'] . "</span></a>
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

    function getEquipasLocalidadeUser(){
        global $conn;
        $msg = "";
        $sql = "SELECT DISTINCT
        comunidade.id AS idComunidade,
        comunidade.nome AS nomeComunidade,
        comunidade.foto AS fotoComunidade,
        comunidade.id_atletaHost as idAtletaHost,
        comunidade.descricao as descricaoEquipa,
        tipo_comunidade.descricao AS tipoComunidade,
        modalidade.descricao AS tipoModalidade,
        comunidade.ranking as ranking,
        user.nome as nomeClube
        FROM 
        comunidade
        INNER JOIN
        modalidade ON comunidade.id_modalidade = modalidade.id
        INNER JOIN 
        tipo_comunidade ON comunidade.tipo_comunidade = tipo_comunidade.id
        INNER JOIN 
        user ON comunidade.id_atletaHost = user.id
        WHERE comunidade.tipo_comunidade = 2
        AND user.localidade = (
		  	SELECT localidade 
		  	FROM user 
		  	WHERE user.id = ".$_SESSION['id']."
		  )";  
        $result= $conn -> query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
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
                                            <span class='fs-4 fw-bold'>" . $row['nomeComunidade'] . "</span>
                                        </div>
                                        <div class= 'text-center text-sm-center text-md-start text-lg-start col-sm-12 col-md-12'>
                                            <a href='./clube.php?id=".$row['idAtletaHost']."'><span class='fs-3'>" . $row['nomeClube'] . "</span></a>
                                        </div>
                                    </div>
                                    <div class = 'row mt-2'>
                                        <div class='text-center text-sm-center text-md-start text-lg-start col-md-7 col-lg-7'>
                                            <span class='fs-2'>" . $row['descricaoEquipa'] . "</span>
                                        </div>
                                        <div class='mt-3 mt-md-0 text-center text-sm-center text-md-start text-lg-start col-md-5 col-lg-4 pe-0'>
                                            <span class='fs-2'>Ranking</span><br>
                                            <div class= 'mt-2 text-center'>
                                                <span class='fs-3'>12</span>
                                            </div>
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

        return ($msg);

    }

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
                   $percVit .= ($row['n_vitorias']/$row['n_jogos']);
                   $percMvp .= ($row['n_mvp']/$row['n_jogos']);
                }
                if($row['n_sets']!=0){
                $percSetsGanhos .= ($row['n_set_ganhos']/$row['n_sets']);
                }
            }
        }
        $percVit =  round(($percVit / $count)*100, 2, PHP_ROUND_HALF_UP);
        $percMvp =  round(($percMvp / $count)*100, 2, PHP_ROUND_HALF_UP);
        $percSetsGanhos =  round(($percSetsGanhos / $count)*100, 2, PHP_ROUND_HALF_UP);
        return(array($percVit, $percSetsGanhos, $percMvp));
    }


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
                   $percVit .= ($row['n_vitorias']/$row['n_jogos']);
                   $percMvp .= ($row['n_mvp']/$row['n_jogos']);
                }
            }
        }
        $percVit = round(($percVit / $count)*100, 2, PHP_ROUND_HALF_UP);
        $percMvp = round(($percMvp / $count)*100, 2, PHP_ROUND_HALF_UP);
        return(array($percVit, $percMvp));
    }
}

?>