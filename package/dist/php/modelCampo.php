<?php
session_start();
require_once 'connection.php';

class Campo {

    function getUserLocation() {
        global $conn;

        $sql = "SELECT distrito.descricao as localidade FROM user INNER JOIN concelho ON user.localidade = concelho.id INNER JOIN distrito_concelho ON concelho.id = distrito_concelho.id_concelho INNER JOIN distrito ON distrito_concelho.id_distrito = distrito.id WHERE user.id = ".$_SESSION['id'];
        $result = $conn->query($sql);
        $localidade = "";

        

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $localidade = $row['localidade'];
            }
        }

        $conn -> close();
        return ($localidade);

    }

    function getModalidadesUtilizadorSelect() {
        global $conn;
        $msg = "<option value='-1' disabled selected style='color: #c9c9c9;'>Modalidade</option>";
        $sql = "SELECT modalidade.id AS idModalidade, modalidade.descricao AS descModalidade FROM modalidade INNER JOIN atleta_modalidade ON modalidade.id = atleta_modalidade.id_modalidade INNER JOIN atleta ON atleta_modalidade.id_atleta = atleta.id_atleta WHERE atleta.id_atleta = " . $_SESSION['id'];
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<option value = '".$row['idModalidade']."'>".$row['descModalidade']."</option>";
            }
        }

        $conn -> close();
        return ($msg);
    }

    function getCampo($localidadeUser) {
        global $conn;
        $msg = "";
        $dados = array();
        
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
        WHERE distrito.descricao LIKE '" . $localidadeUser . "' LIMIT 12";
        $result = $conn->query($sql);

    
        if ($result->num_rows > 0) {
        // output data of each row
            while ($row = $result->fetch_assoc()) {

                $sql2 = " SELECT tipo_campo.descricao AS tipoCampo, modalidade.descricao AS modalidade FROM clube INNER JOIN campo_clube ON clube.id_clube = campo_clube.id_clube 
                INNER JOIN campo ON campo_clube.id_campo = campo.id INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id INNER JOIN tipo_campo ON tipo_campo.id = campo.tipo_campo WHERE clube.id_clube = '".$row['idClube']."'";
                $arrMods = [];
                $arrTipoC = [];
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    // output data of each row
                        while ($row2 = $result2->fetch_assoc()) {
                            array_push($arrMods, $row2['modalidade']);
                            array_push($arrTipoC, $row2['tipoCampo']);
                }} 

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

                $msg .= '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6" id="clube'.$row['idClube'].'">
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
                                    <p id="descricao" class="my-2">' . substr($row['clubeDesc'], 0, 100) .'&nbsp;(...)</p>
                                    <div class="col-lg-12">
                                        <button type="button" class="btn btn-primary w-100" onclick="redirectToCampo(' .$row['idClube']. ')">Marcar</button>
                                    </div>    
                                </div>
                            </div>
                        </div>';

                   
            }        
        }


        $conn->close();

        $data = array('html' => $msg, 'dados' => $dados, 'localidadeUser' => $localidadeUser);
        return json_encode($data);
    }

    function pesquisarCampos($stringPesquisa, $modalidadePesquisa, $dataPesquisa, $horaPesquisa) {
        
        global $conn;
        $msg = "";
        $dados = array();

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
        INNER JOIN tipo_campo ON tipo_campo.id = campo.tipo_campo";

        
        if ($modalidadePesquisa !== -1) {
            $modalidadePesquisa = intval($modalidadePesquisa); 
            $sql .= " WHERE modalidade.id = $modalidadePesquisa";
        }

        
        if ($stringPesquisa != "") {
            $stringPesquisa = $conn->real_escape_string($stringPesquisa); 
            $sql .= " OR (user.nome LIKE '%$stringPesquisa%' OR clube.descricao LIKE '%$stringPesquisa%' OR  concelho.descricao LIKE '%$stringPesquisa%' OR user.morada LIKE '%$stringPesquisa%')";
        }

        $sql .= " LIMIT 12";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $sql2 = " SELECT tipo_campo.descricao AS tipoCampo FROM clube INNER JOIN campo_clube ON clube.id_clube = campo_clube.id_clube 
                INNER JOIN campo ON campo_clube.id_campo = campo.id INNER JOIN tipo_campo ON tipo_campo.id = campo.tipo_campo WHERE clube.id_clube = '".$row['idClube']."'";
                $arrTipoC = [];
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    // output data of each row
                        while ($row2 = $result2->fetch_assoc()) {
                            array_push($arrTipoC, $row2['tipoCampo']);
                }} 
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

                $msg .= '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6" id="clube'.$row['idClube'].'">
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
                        <p id="descricao" class="my-2">' . substr($row['clubeDesc'], 0, 100) .'&nbsp;(...)</p>
                        <div class="col-lg-12">
                                        <button type="button" class="btn btn-primary w-100" onclick="redirectToCampo(' .$row['idClube']. ')">Marcar</button>
                        </div>
                    </div>
                </div>
            </div>';

            }
        }
        $conn -> close();

        $data = array('html' => $msg, 'dados' => $dados);
        return json_encode($data);
        
    }

    function getInfoPagCampo($clubeId) {
        global $conn;

        $clubeInfo = array();

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
            WHERE user.id = ".$clubeId;

        $result = $conn->query($sql);

        if ($result) {
            if ($row = $result->fetch_assoc()) {
                $sql2 = " SELECT DISTINCT modalidade.descricao AS modalidade FROM clube INNER JOIN campo_clube ON clube.id_clube = campo_clube.id_clube 
                INNER JOIN campo ON campo_clube.id_campo = campo.id INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id 
                WHERE clube.id_clube = '".$row['idClube']."'";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0){
                    while ($row2 = $result2->fetch_assoc()){
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
                                                            <i class="ti ti-ball-tennis me-1"></i>' .$row2['modalidade']. '
                                                        </span>

                                                ';
                        } elseif ($row2['modalidade'] == 'Ténis') {
                            $conteudoModalidade .= '

                                                        <span class="me-2 badge bg-success text-white text-dark fs-3 rounded-4 lh-sm py-1 px-2 fw-semibold">
                                                            <i class="ti ti-ball-tennis me-1"></i>' .$row2['modalidade']. '
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
                                        <span class="fs-3">09:30 - 21:30</span>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="d-flex justify-content-between align-items-center border-bottom pb-1 mb-1">
                                        <span class="fs-3 fw-bold">Terça-feira</span>
                                        <span class="fs-3">09:30 - 21:30</span>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="d-flex justify-content-between align-items-center border-bottom pb-1 mb-1">
                                        <span class="fs-3 fw-bold">Quarta-feira</span>
                                        <span class="fs-3">09:30 - 21:30</span>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="d-flex justify-content-between align-items-center border-bottom pb-1 mb-1">
                                        <span class="fs-3 fw-bold">Quinta-feira</span>
                                        <span class="fs-3">09:30 - 21:30</span>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="d-flex justify-content-between align-items-center border-bottom pb-1 mb-1">
                                        <span class="fs-3 fw-bold">Sexta-feira</span>
                                        <span class="fs-3">09:30 - 21:30</span>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="d-flex justify-content-between align-items-center border-bottom pb-1 mb-1">
                                        <span class="fs-3 fw-bold">Sábado</span>
                                        <span class="fs-3">09:30 - 21:30</span>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fs-3 fw-bold">Domingo</span>
                                        <span class="fs-3">09:30 - 21:30</span>
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
        $conn->close();

        return json_encode($clubeInfo);
    }
}