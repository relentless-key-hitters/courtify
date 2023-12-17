<?php
session_start();
require_once 'connection.php';

class Campo
{
    
    function getUserLocation()
    {
        $_SESSION['data'] = date('Y-m-d');
        global $conn;

        $sql = "SELECT distrito.descricao as localidade FROM user INNER JOIN concelho ON user.localidade = concelho.id INNER JOIN distrito_concelho ON concelho.id = distrito_concelho.id_concelho INNER JOIN distrito ON distrito_concelho.id_distrito = distrito.id WHERE user.id = " . $_SESSION['id'];
        $result = $conn->query($sql);
        $localidade = "";



        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $localidade = $row['localidade'];
            }
        }

        $conn->close();
        return ($localidade);
    }

    function getModalidadesUtilizadorSelect()
    {
        global $conn;
        $msg = "<option value='-1' disabled selected style='color: #c9c9c9;'>Modalidade</option>";
        $sql = "SELECT modalidade.id AS idModalidade, modalidade.descricao AS descModalidade FROM modalidade INNER JOIN atleta_modalidade ON modalidade.id = atleta_modalidade.id_modalidade INNER JOIN atleta ON atleta_modalidade.id_atleta = atleta.id_atleta WHERE atleta.id_atleta = " . $_SESSION['id'];
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<option value = '" . $row['idModalidade'] . "'>" . $row['descModalidade'] . "</option>";
            }
        }

        $conn->close();
        return ($msg);
    }

    function getCampo($localidadeUser, $offset, $porPagina)
    {
        global $conn;
        $msg = "";
        $dados = array();
    
        $offset = max(0, $offset);

        // Retrieve total count without LIMIT clause
        $sqlCount = "SELECT COUNT(*) AS total FROM user
            INNER JOIN clube ON user.id = clube.id_clube 
            INNER JOIN concelho ON user.localidade = concelho.id
            INNER JOIN distrito_concelho ON concelho.id = distrito_concelho.id_concelho
            INNER JOIN distrito ON distrito_concelho.id_distrito = distrito.id";
        $resultCount = $conn->query($sqlCount);
        $rowCount = $resultCount->fetch_assoc();
        $itemsTotais = $rowCount['total'];

        $sql = "SELECT clube.id_clube AS idClube,  
                user.foto AS fotoClube, 
                user.nome AS nomeClube, 
                clube.descricao AS clubeDesc,  
                user.morada AS moradaClube, 
                concelho.descricao AS descConcelho,
                distrito.descricao AS descDistrito, 
                user.lat as lat, 
                user.lon as lon 
                FROM user 
                INNER JOIN clube ON user.id = clube.id_clube 
                INNER JOIN concelho ON user.localidade = concelho.id
                INNER JOIN distrito_concelho ON concelho.id = distrito_concelho.id_concelho
                INNER JOIN distrito ON distrito_concelho.id_distrito = distrito.id
                LIMIT ".$offset.", ".$porPagina;

        $result = $conn->query($sql);

        $paginasTotais = ceil($itemsTotais / $porPagina);
        $paginaAtual = ceil(($offset + 1) / $porPagina);


        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $sql2 = " SELECT tipo_campo.descricao AS tipoCampo, modalidade.descricao AS modalidade FROM clube INNER JOIN campo_clube ON clube.id_clube = campo_clube.id_clube 
                INNER JOIN campo ON campo_clube.id_campo = campo.id INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id INNER JOIN tipo_campo ON tipo_campo.id = campo.tipo_campo WHERE clube.id_clube = '" . $row['idClube'] . "'";
                $arrMods = [];
                $arrTipoC = [];
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {

                    while ($row2 = $result2->fetch_assoc()) {
                        array_push($arrMods, $row2['modalidade']);
                        array_push($arrTipoC, $row2['tipoCampo']);
                    }
                }

                $rowArray = array(
                    'idClube' => $row['idClube'],
                    'fotoClube' => $row['fotoClube'],
                    'nomeClube' => $row['nomeClube'],
                    'clubeDesc' => $row['clubeDesc'],
                    'moradaClube' => $row['moradaClube'],
                    'descConcelho' => $row['descConcelho'],
                    'latClube' => $row['lat'],
                    'lonClube' => $row['lon'],
                    'modalCamposClube' => $arrMods,
                    'tiposCamposClube' => $arrTipoC
                );

                $dados[] = $rowArray;

                $msg .= '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6" id="clube' . $row['idClube'] . '">
                            <div class="card rounded-2 overflow-hidden hover-img2 " style="height: calc(100% - 2rem);" data-id="' . $row['idClube'] . '">
                                <div class="position-relative">
                                    <a href="clube.php?id=' . $row['idClube'] . '">
                                        <img src="' . $row['fotoClube'] . '" class="card-img-top rounded-0" alt="..." style="min-height: 230px; max-height: 230px;">
                                    </a>
                                </div>
                                <div class="card-body p-4">
                                    <span id="morada"><i class="ti ti-map-pin me-1"></i>' . $row['moradaClube'] . ', </span>
                                    <span id="localidade">' . $row['descConcelho'] . '</span>
                                    <p id="nome" class="d-block my-2 fs-5 text-dark fw-semibold">' . $row['nomeClube'] . '</p>
                                    <p id="descricao" class="my-2">' . substr($row['clubeDesc'], 0, 100) . '&nbsp;(...)</p>
                                    <div class="col-lg-12">
                                        <button type="button" class="btn btn-primary w-100" onclick="redirectToCampo(' . $row['idClube'] . ')">Marcar</button>
                                    </div>    
                                </div>
                            </div>
                        </div>';
            }
        }



        $conn->close();

        $data = array('html' => $msg, 'dados' => $dados, 'localidadeUser' => $localidadeUser, 'paginasTotais' => $paginasTotais, 'paginaAtual' => $paginaAtual);
        return json_encode($data);
    }

    function pesquisarCampos($stringPesquisa, $modalidadePesquisa, $dataPesquisa, $horaPesquisa)
    {

        global $conn;
        $msg = "";
        $dados = array();
        $_SESSION['data'] = $dataPesquisa;

        $sql = "SELECT DISTINCT clube.id_clube AS idClube,  
        user.foto AS fotoClube, 
        user.nome AS nomeClube, 
        clube.descricao AS clubeDesc,  
        user.morada AS moradaClube, 
        concelho.descricao AS descConcelho,
        distrito.descricao AS descDistrito, 
        user.lat as lat, 
        user.lon as lon 
        FROM user 
        INNER JOIN clube ON user.id = clube.id_clube 
        INNER JOIN concelho ON user.localidade = concelho.id
        INNER JOIN distrito_concelho ON concelho.id = distrito_concelho.id_concelho
        INNER JOIN distrito ON distrito_concelho.id_distrito = distrito.id
        INNER JOIN campo_clube ON clube.id_clube = campo_clube.id_clube 
        INNER JOIN campo ON campo_clube.id_campo = campo.id 
        INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id 
        INNER JOIN tipo_campo ON tipo_campo.id = campo.tipo_campo 
        WHERE clube.id_clube NOT IN (
            SELECT clube.id_clube
            FROM marcacao INNER JOIN campo ON marcacao.id_campo =  campo.id
            INNER JOIN campo_clube ON campo.id = campo_clube.id_campo 
            INNER JOIN clube ON clube.id_clube = campo_clube.id_clube
            WHERE marcacao.data_inicio LIKE '" . $dataPesquisa . "' AND campo_clube.id_modalidade = '" . $modalidadePesquisa . "'  AND  marcacao.hora_inicio BETWEEN '" . $horaPesquisa . "' AND ADDTIME('" . $horaPesquisa . "', '01:00:00') OR marcacao.hora_fim BETWEEN '" . $horaPesquisa . "' AND ADDTIME('" . $horaPesquisa . "', '01:00:00')) ";

        if (!empty($stringPesquisa)) {
            $stringPesquisa = $conn->real_escape_string($stringPesquisa);
            $sql .= " AND (user.nome LIKE '%$stringPesquisa%' OR clube.descricao LIKE '%$stringPesquisa%' OR  concelho.descricao LIKE '%$stringPesquisa%' OR user.morada LIKE '%$stringPesquisa%')";
        }
        if ($modalidadePesquisa != 'null') {
            $sql .= " AND modalidade.id = " . $modalidadePesquisa;
        }

        $sql .= " LIMIT 12";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $sql2 = " SELECT tipo_campo.descricao AS tipoCampo FROM clube INNER JOIN campo_clube ON clube.id_clube = campo_clube.id_clube 
                INNER JOIN campo ON campo_clube.id_campo = campo.id INNER JOIN tipo_campo ON tipo_campo.id = campo.tipo_campo WHERE clube.id_clube = '" . $row['idClube'] . "'";
                $arrTipoC = [];
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {

                    while ($row2 = $result2->fetch_assoc()) {
                        array_push($arrTipoC, $row2['tipoCampo']);
                    }
                }
                $rowArray = array(
                    'idClube' => $row['idClube'],
                    'fotoClube' => $row['fotoClube'],
                    'nomeClube' => $row['nomeClube'],
                    'clubeDesc' => $row['clubeDesc'],
                    'moradaClube' => $row['moradaClube'],
                    'descConcelho' => $row['descConcelho'],
                    'latClube' => $row['lat'],
                    'lonClube' => $row['lon'],
                    'tiposCamposClube' => $arrTipoC
                );
                $dados[] = $rowArray;

                $msg .= '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6" id="clube' . $row['idClube'] . '">
                <div class="card rounded-2 overflow-hidden hover-img" style="height: calc(100% - 2rem); cursor: pointer;" data-id="' . $row['idClube'] . '">
                    <div class="position-relative">
                        <a href="clube.php?id=' . $row['idClube'] . '">
                            <img src="' . $row['fotoClube'] . '" class="card-img-top rounded-0" alt="..." style="min-height: 230px; max-height: 230px;">
                        </a>
                    </div>
                    <div class="card-body p-4">
                        <span id="morada"><i class="ti ti-map-pin me-1"></i>' . $row['moradaClube'] . ', </span>
                        <span id="localidade">' . $row['descConcelho'] . '</span>
                        <p id="nome" class="d-block my-2 fs-5 text-dark fw-semibold">' . $row['nomeClube'] . '</p>
                        <p id="descricao" class="my-2">' . substr($row['clubeDesc'], 0, 100) . '&nbsp;(...)</p>
                        <div class="col-lg-12">
                                        <button type="button" class="btn btn-primary w-100" onclick="redirectToCampo(' . $row['idClube'] . ')">Marcar</button>
                        </div>
                    </div>
                </div>
            </div>';
            }
        }
        $conn->close();

        $data = array('html' => $msg, 'dados' => $dados);
        return json_encode($data);
    }

    function getInfoPagCampo($clubeId)
    {
        global $conn;
        $clubeInfo = array();

        $_SESSION['data'] = $_SESSION['data'] ?? date('Y-m-d');
        

        $conteudoModalidade = "";


        $sql = "SELECT
            clube.id_clube AS idClube,
            user.foto AS fotoClube,
            user.nome AS nomeClube,
            clube.descricao AS descClube,
            user.morada AS moradaClube,
            concelho.descricao AS concelhoClube,
            distrito.descricao AS distritoClube,
            user.lat AS latClube,
            user.lon AS lonClube,
            clube.telefone AS numTelefoneClube,
            user.email AS emailClube,
            user.telemovel AS telemovelClube,
            user.codigo_postal as codigoPostalClube
            FROM
            clube INNER JOIN user ON clube.id_clube = user.id 
            INNER JOIN concelho ON user.localidade = concelho.id
            INNER JOIN distrito_concelho ON concelho.id = distrito_concelho.id_concelho
            INNER JOIN distrito ON distrito_concelho.id_distrito = distrito.id
            WHERE user.id = " . $clubeId;

        $result = $conn->query($sql);

        if ($result) {
            if ($row = $result->fetch_assoc()) {
                $sql2 = " SELECT DISTINCT modalidade.descricao AS modalidade FROM clube INNER JOIN campo_clube ON clube.id_clube = campo_clube.id_clube 
                INNER JOIN campo ON campo_clube.id_campo = campo.id INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id 
                WHERE clube.id_clube = '" . $row['idClube'] . "'";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        if ($row2['modalidade'] == 'Futsal') {
                            $conteudoModalidade .= '

                                                        <span class="me-2 badge bg-danger text-white text-dark fs-3 rounded-4 lh-sm py-1 px-2 fw-semibold">
                                                            <i class="ti ti-ball-football me-1"></i>' . $row2['modalidade'] . '
                                                        </span>
  
                                                ';
                        } elseif ($row2['modalidade'] == 'Basquetebol') {
                            $conteudoModalidade .= '
                                                    
                                                        <span class="me-2 badge bg-warning text-white text-dark fs-3 rounded-4 lh-sm py-1 px-2 fw-semibold">
                                                            <i class="ti ti-ball-basketball me-1"></i>' . $row2['modalidade'] . '
                                                        </span>
  
 
                                                ';
                        } elseif ($row2['modalidade'] == 'Padel') {
                            $conteudoModalidade .= '

                                                        <span class="me-2 badge bg-primary text-white text-dark fs-3 rounded-4 lh-sm py-1 px-2 fw-semibold">
                                                            <i class="ti ti-ball-tennis me-1"></i>' . $row2['modalidade'] . '
                                                        </span>

                                                ';
                        } elseif ($row2['modalidade'] == 'Ténis') {
                            $conteudoModalidade .= '

                                                        <span class="me-2 badge bg-success text-white text-dark fs-3 rounded-4 lh-sm py-1 px-2 fw-semibold">
                                                            <i class="ti ti-ball-tennis me-1"></i>' . $row2['modalidade'] . '
                                                        </span>

                                                ';
                        }
                    }
                }



                $servicos = '
                            <div class="d-flex flex-wrap gap-2">
                                <span class=" badge text-dark text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold" style="background-color: #f0f0f0">
                                    <i class="ti ti-parking me-1 fs-3"></i>Estacionamento
                                </span>
                                <span class=" badge text-dark text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold" style="background-color: #f0f0f0">
                                    <i class="ti ti-wifi me-1 fs-3"></i>Wi-Fi
                                </span>
                                <span class=" badge text-dark text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold" style="background-color: #f0f0f0">
                                    <i class="ti ti-bottle me-1 fs-3"></i>Vending Machine
                                </span>
                                <span class=" badge text-dark text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold" style="background-color: #f0f0f0">
                                    <i class="ti ti-hanger me-1 fs-3"></i>Balneários
                                </span>
                                <span class=" badge text-dark text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold" style="background-color: #f0f0f0">
                                    <i class="ti ti-key me-1 fs-3"></i>Cacifos
                                </span>
                                <span class=" badge text-dark text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold" style="background-color: #f0f0f0">
                                    <i class="ti ti-coffee me-1 fs-3"></i>Cafetaria
                                </span>
                                <span class=" badge text-dark text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold" style="background-color: #f0f0f0">
                                    <i class="ti ti-disabled me-1 fs-3"></i>Acessibilidade
                                </span>
                            </div>   
                            ';

                $horario = '
                                <ul class="">
                                <li class="">
                                    <div class="d-flex justify-content-between align-items-center border-bottom pb-1 mb-1">
                                        <span class="fs-3 fw-bold">Segunda-feira</span>
                                        <span class="fs-3">08:00 - 23:30</span>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="d-flex justify-content-between align-items-center border-bottom pb-1 mb-1">
                                        <span class="fs-3 fw-bold">Terça-feira</span>
                                        <span class="fs-3">08:00 - 23:30</span>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="d-flex justify-content-between align-items-center border-bottom pb-1 mb-1">
                                        <span class="fs-3 fw-bold">Quarta-feira</span>
                                        <span class="fs-3">08:00 - 23:30</span>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="d-flex justify-content-between align-items-center border-bottom pb-1 mb-1">
                                        <span class="fs-3 fw-bold">Quinta-feira</span>
                                        <span class="fs-3">08:00 - 23:30</span>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="d-flex justify-content-between align-items-center border-bottom pb-1 mb-1">
                                        <span class="fs-3 fw-bold">Sexta-feira</span>
                                        <span class="fs-3">08:00 - 23:30</span>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="d-flex justify-content-between align-items-center border-bottom pb-1 mb-1">
                                        <span class="fs-3 fw-bold">Sábado</span>
                                        <span class="fs-3">08:00 - 23:30</span>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fs-3 fw-bold">Domingo</span>
                                        <span class="fs-3">08:00 - 23:30</span>
                                    </div>
                                </li>
                                
                            </ul>
                            ';


                $clubeInfo = array(
                    'idClube' => $row['idClube'],
                    'fotoClube' => $row['fotoClube'],
                    'nomeClube' => $row['nomeClube'],
                    'descClube' => $row['descClube'],
                    'moradaClube' => $row['moradaClube'],
                    'concelhoClube' => $row['concelhoClube'],
                    'distritoClube' => $row['distritoClube'],
                    'horarioClube' => $horario,
                    'lat' => $row['latClube'],
                    'lon' => $row['lonClube'],
                    'servicos' => $servicos,
                    'telefoneClube' => $row['numTelefoneClube'],
                    'emailClube' => $row['emailClube'],
                    'telemovelClube' =>  $row['telemovelClube'],
                    'codigoPostalClube' => $row['codigoPostalClube'],
                    'modalidadesClube' => $conteudoModalidade
                );
            }
        }

        $marcacao =  $this->getHorariosCampos($clubeId,  $_SESSION['data']);
        $conn->close();
        $resp = json_encode(array(
            "info_clube" => $clubeInfo,
            "marcacaoClube" => $marcacao
        ));
        return($resp);
    }

    function getHorariosCampos($clube, $data)
    {
        global $conn;
        date_default_timezone_set('UTC');
        $sql = "SELECT campo.id as id_campo, campo.nome as nome_campo, campo.foto as foto, tipo_campo.descricao as tipoCampo
        FROM campo INNER JOIN campo_clube ON campo.id = campo_clube.id_campo INNER JOIN 
        clube ON campo_clube.id_clube = clube.id_clube INNER JOIN tipo_campo ON campo.tipo_campo = tipo_campo.id WHERE clube.id_clube = '" . $clube . "'";
        $marcacao = "";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $marcacao .= "<div class='card' id='campo" . $row['id_campo'] . "' style='width: 100%;'>
                    <div class='p-3'>
                        <div class='d-flex justify-content-end align-items-center'>";
                        if($row['tipoCampo'] == "Exterior") {
                            $marcacao .= " <p class='m-0 p-0 me-2'><span class='fw-semibold'>Tipo:</span> <span class='badge text-dark text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold' style='background-color: #f0f0f0'><i class='ti ti-sun me-1'></i>" . $row['tipoCampo'] . "</span></p>";
                        }else if($row['tipoCampo'] == "Cobertura") {
                            $marcacao .= " <p class='m-0 p-0 me-2'><span class='fw-semibold'>Tipo:</span> <span class='badge text-dark text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold' style='background-color: #f0f0f0'><i class='ti ti-cloud-rain me-1'></i>" . $row['tipoCampo'] . "</span></p>";
                        }else if($row['tipoCampo'] == "Indoor") {
                            $marcacao .= " <p class='m-0 p-0 me-2'><span class='fw-semibold'>Tipo:</span> <span class='badge text-dark text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold' style='background-color: #f0f0f0'><i class='ti ti-home me-1'></i>" . $row['tipoCampo'] . "</span></p>";
                        }
                $marcacao .= "</div>
                        <div class='d-flex justify-content-start align-items-center mt-2'>
                            <div class='d-flex flex-column'>
                                <img src='".$row['foto']."' class='img-fluid rounded border border-1 border-primary' style='width: 200px'>
                                <h6 class='mt-2 mb-0 text-center fw-bolder'>" . $row['nome_campo'] . "</h6>
                            </div>
                        <div class='ms-4 d-flex overflow-y-auto scrollbar'>";
                $horas = array();
                $sql2 = "SELECT temp.hora_inicio,
                    CEIL(TIME_TO_SEC(temp.dif_horas)/1800) AS n_blocos        
                    FROM (
                    SELECT marcacao.hora_inicio AS hora_inicio, TIMEDIFF(marcacao.hora_fim, marcacao.hora_inicio) AS dif_horas
                    FROM marcacao INNER JOIN campo ON marcacao.id_campo = campo.id INNER JOIN campo_clube ON campo.id = campo_clube.id_campo INNER JOIN 
                    clube ON campo_clube.id_clube = clube.id_clube WHERE clube.id_clube = '" . $clube . "' AND marcacao.data_inicio = '" . $_SESSION['data']. "'  AND campo.id = '" . $row['id_campo'] . "'      
                    ) AS temp";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        array_push($horas, array($row2['hora_inicio'], $row2['n_blocos']));
                    }
                }
                $horainicio = 8;
                $minuto = 0;
                $texto = "08:00";
                $texto2 = "08:00:00";
                $horaActual = "";
                $horaActual .= date('H:i:s');
                $dataActual = "";
                $dataActual .= date('Y-m-d');
                if( $_SESSION['data'] == $dataActual){
                    for($k = 0; $k < 32; $k++){
                        if($texto2 >  $horaActual){
                            break;
                        }else{
                            if ($minuto == 30) {
                                $horainicio += 1;
                                $minuto = 0;
                                if ($horainicio < 10) {
                                    $texto = "0" . $horainicio . ":0" . $minuto;
                                    $texto2 = "0" . $horainicio . ":0" . $minuto.":00";
                                } else {
                                    $texto = $horainicio . ":0" . $minuto;
                                    $texto2 = $horainicio . ":0" .$minuto.":00";
                                }
                            } else {
                                $minuto = 30;
                                if ($horainicio < 10) {
                                    $texto = "0" . $horainicio . ":" . $minuto;
                                    $texto2 = "0" . $horainicio . ":" . $minuto.":00";
                                } else {
                                    $texto = $horainicio . ":" . $minuto;
                                    $texto2 = $horainicio . ":" . $minuto.":00";
                                }
                            }
                        }         
                    }    
                }
                for ($i = 0; $i < 32; $i++) {
                    if ($texto2 == '24:00:00'){
                        break;
                    }
                    $flag = true;
                    for ($j = 0; $j < count($horas); $j++) {
                        if ($horas[$j][0] == $texto2){ 
                            $flag = false;
                            for($k = 0; $k < $horas[$j][1]; $k++){
                                $marcacao .= "<button class='btn btn-primary disabled btn-small me-2 mb-sm-2'>" . $texto . "</button>";
                                if ($minuto == 30) {
                                    $horainicio += 1;
                                    $minuto = 0;
                                    if ($horainicio < 10) {
                                        $texto = "0" . $horainicio . ":0" . $minuto;
                                        $texto2 = "0" . $horainicio . ":0" . $minuto.":00";
                                    } else {
                                        $texto = $horainicio . ":0" . $minuto;
                                        $texto2 = $horainicio . ":0" .$minuto.":00";
                                    }
                                } else {
                                    $minuto = 30;
                                    if ($horainicio < 10) {
                                        $texto = "0" . $horainicio . ":" . $minuto;
                                        $texto2 = "0" . $horainicio . ":" . $minuto.":00";
                                    } else {
                                        $texto = $horainicio . ":" . $minuto;
                                        $texto2 = $horainicio . ":" . $minuto.":00";
                                    }
                                }
                            }
                            
                        }
                    }
                    if ($flag) {
                        $txtId = "";
                        $txtId .= $row['id_campo'].".".$texto;
                        $marcacao .= "<button class='btn btn-primary btn-small me-2 mb-sm-2' value = '".$txtId."' onclick = 'marcarCampo(this.value)'>" . $texto . "</button>";
                        if ($minuto == 30) {                      
                            $horainicio += 1;
                            $minuto = 0;    
                            if ($horainicio < 10) {
                                $texto = "0" . $horainicio . ":0" . $minuto;
                                $texto2 = "0" . $horainicio . ":0" . $minuto.":00";
                            } else {
                                $texto = $horainicio . ":0" . $minuto;
                                $texto2 = $horainicio . ":0" .$minuto.":00";
                            }
                        } else {
                            $minuto = 30;
                            if ($horainicio < 10) {
                                $texto = "0" . $horainicio . ":" . $minuto;
                                $texto2 = "0" . $horainicio . ":" . $minuto.":00";
                            } else {
                                $texto = $horainicio . ":" . $minuto;
                                $texto2 = $horainicio . ":" . $minuto.":00";
                            }
                        }
                    }
                    
                }
                $marcacao .= "</div>
                    </div>
                  </div>
                </div>
                </div>";
            }
        }
        return($marcacao);

    }

    function openModalMarcacao($id){

        global $conn;
        $split = array();
        $split = explode(".", $id, 2);
        $id = $split[0];
        $hora = $split[1];
        $sql = "SELECT campo.nome as nome_campo, campo.foto as foto, modalidade.n_participantes_max as numParticipantesMax, campo.preco_hora as preco
        FROM campo INNER JOIN campo_clube ON campo.id = campo_clube.id_campo INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id WHERE campo.id = '" .$id."'";
        $hora2 = "";
        $hora2 .= $hora . ":00";
        $preco = 0;
        $result = $conn->query($sql);
        $textoModal = "";
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {

                $data = new DateTime($_SESSION['data']);
                $stringData = $data -> format('d/m/Y');

                $textoModal .= "<div class='container-fluid text-center'>
                    <div class='row'>
                        <div class='col-md-6 text-center'>
                            <img src='".$row['foto']."' alt='Clube 1' class=' rounded border border-1 border-primary'
                            style='max-width: 220px;'>
                        </div>
                        <div class='col-md-6'>
                            <div class='mt-sm-2'>
                                <small class='fs-5'><i class='ti ti-calendar me-1'></i>". $stringData."</small><br>
                                <small class='fs-5'><i class='ti ti-clock me-1'></i>".$hora."</small><br>
                                <small class='fs-5'><i class='ti ti-map-pin me-1'></i>".$row['nome_campo']."</small><br>
                                <div class='d-flex align-items-center justify-content-center mt-2 d-none' id='espacopreco'>
                                    <div class='bg-light mt-2 rounded p-2 w-50'>
                                        <h5 class='m-0 p-0' id = 'precomarcacao'></h5>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
                <div class ='row'>
                    <div class='col-md-7'>
                    <h5 class='fw-semibold mt-3'>Duração</h5>
                    <select id ='selecthora' class='form-select w-75' onchange = 'getPreco(this.value)' >
                    <option value= '-1'>Selecione a duração</option>
                "
                ;
            $preco =  $row['preco'];
            $sql2 = "SELECT if(marcacao.hora_inicio = ADDTIME('".$hora2."', '00:30:00'), TRUE, FALSE) AS resposta1, 
            if(marcacao.hora_inicio = ADDTIME('".$hora2."', '01:00:00'), TRUE, FALSE) AS resposta2
            FROM campo INNER JOIN marcacao ON marcacao.id_campo = campo.id WHERE campo.id = '".$id."' AND marcacao.data_inicio = '".$_SESSION['data']."'";    
            $result2 = $conn->query($sql2);
            $textoModal .= "<option value='30'>30 minutos</option>";
            if ($result2->num_rows > 0) {

                while ($row2 = $result2->fetch_assoc()) {
                    if($row2['resposta1'] == 0 && $hora2 < "23:30:00"){
                        $textoModal .= "<option value ='60'>60 minutos</option>";
                        if($row2['resposta2'] == 0 && $hora2 < "23:00:00"){
                            $textoModal .= "<option value ='90'>90 minutos</option>";
                        }
                        break;
                    }
                }
            }
            else if ($result2->num_rows == 0) {
                $textoModal .= "<option value ='60'>60 minutos</option>";     
                $textoModal .= "<option value ='90'>90 minutos</option>"; 
            }
            $textoModal .= "</select>
                        </div>
                        <div class='col-md-5 mt-3 d-sm-flex d-md-block justify-content-center gap-2'>
                            <h5 class='fw-semibold m-0 p-0 mb-1'>Tipo</h5>
                            
                            <div class='form-check' data-toggle='tooltip' data-placement='top' title='Convida amigos e permite que outros utilizadores se juntem á tua marcação'>
                                <input class='form-check-input' type='radio' name='exampleRadios' id='aberta' value='aberta' onclick='mostrarAmigosModalMarcacao()'>
                                <label class='form-check-label' for='aberta'>
                                    Aberta
                                </label>
                            </div>
                            <div class='form-check' data-toggle='tooltip' data-placement='top' title='Mantém a marcação fechada'>
                                <input class='form-check-input' type='radio' name='exampleRadios' id='fechada' value='fechada' onclick='esconderAmigos()'>
                                <label class='form-check-label' for='fechada'>
                                    Fechada
                                </label>
                            </div>
                        </div>
                    </div>
            ";
            }
        }
        
        $conn->close();
        $data = array('modal' => $textoModal, 'hora' => $hora, 'idCampo' => $id, 'preco' => $preco);
        return json_encode($data);
    }

    function guardarMarcacao($id, $duracao, $horas, $tipoMarcacao, $arrayAmigos){
        $arrayAmigosDecode = json_decode($arrayAmigos);
        global $conn;
        $flag = true;
        $msg = "";
        $icon ="success";
        $sql = "";
        if($duracao == 30){
            $sql = "INSERT INTO marcacao (id_atleta, id_campo , data_inicio, data_fim, hora_inicio, hora_fim, tipo) VALUES (".$_SESSION['id'].", ".$id.", '".$_SESSION['data']."', '".$_SESSION['data']."', '".$horas.":00', ADDTIME('".$horas.":00', '00:30:00'), '".$tipoMarcacao."')";
        }else if($duracao == 60){
            $sql = "INSERT INTO marcacao (id_atleta, id_campo , data_inicio, data_fim, hora_inicio, hora_fim, tipo) VALUES (".$_SESSION['id'].", ".$id.", '".$_SESSION['data']."', '".$_SESSION['data']."', '".$horas.":00', ADDTIME('".$horas.":00', '01:00:00'), '".$tipoMarcacao."')";
        }else{
            $sql = "INSERT INTO marcacao (id_atleta, id_campo , data_inicio, data_fim, hora_inicio, hora_fim, tipo) VALUES (".$_SESSION['id'].", ".$id.", '".$_SESSION['data']."', '".$_SESSION['data']."', '".$horas.":00', ADDTIME('".$horas.":00', '01:30:00'), '".$tipoMarcacao."')";
        }
        
        if($conn->query($sql) === TRUE){

            $ultimoId = mysqli_insert_id($conn);
            $sql1 = "INSERT INTO listagem_atletas_marcacao (id_marcacao, id_atleta, estado) VALUES (".$ultimoId.", ".$_SESSION['id'].", 1)";
            if ($conn->query($sql1) !== TRUE) {
                $msg = "Não foi possível realizar a sua marcação.";
                $flag = false;
                $icon = "error";
            }

            foreach ($arrayAmigosDecode as $amigoId) {
                $sql2 = "INSERT INTO listagem_atletas_marcacao (id_marcacao, id_atleta, estado) VALUES (".$ultimoId.", ".$amigoId.", 0)";
                
                if ($conn->query($sql2) !== TRUE) {
                    $msg = "Não foi possível realizar a sua marcação.";
                    $flag = false;
                    $icon = "error";
                    break;
                }
            }

            if ($flag === true) {
                $msg = "Marcação feita com sucesso!";
            }
        }else{
            $msg = "Não foi possível realizar a sua marcação.";
            $flag = false;
            $icon = "error";
        }

        $resp = json_encode(array(
            "msg" => $msg,
            "icon" => $icon,
            "flag" => $flag
        ));

        $conn ->close();
        return ($resp);
    }
}
