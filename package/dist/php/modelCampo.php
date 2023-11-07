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
        
        $sql = "SELECT campo.id AS idCampo, modalidade.descricao as campoModalidade, campo.id AS campoId, campo.foto AS fotoCampo, campo.nome AS campoNome, campo.descricao AS campoDesc, tipo_campo.descricao AS tipoCampoDesc, campo.morada AS moradaCampo, concelho.descricao AS descConcelho FROM campo INNER JOIN tipo_campo ON campo.tipo_campo = tipo_campo.id INNER JOIN concelho on campo.localidade = concelho.id INNER JOIN modalidade ON campo.modalidade = modalidade.id INNER JOIN atleta_modalidade ON modalidade.id = atleta_modalidade.id_modalidade INNER JOIN atleta ON atleta_modalidade.id_atleta = atleta.id_atleta WHERE atleta.id_atleta = ".$_SESSION['id']."  LIMIT 12";
        $result = $conn->query($sql);

    
        if ($result->num_rows > 0) {
        // output data of each row
            while ($row = $result->fetch_assoc()) {

                $rowArray = array(  
                    'idCampo' => $row['idCampo'],
                    'campoModalidade' => $row['campoModalidade'],
                    'campoId' => $row['campoId'],
                    'fotoCampo' => $row['fotoCampo'],
                    'campoNome' => $row['campoNome'],
                    'campoDesc' => $row['campoDesc'],
                    'tipoCampoDesc' => $row['tipoCampoDesc'],
                    'moradaCampo' => $row['moradaCampo'],
                    'descConcelho' => $row['descConcelho']
                    
                );
                $dados[] = $rowArray;

                $msg .= '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="card rounded-2 overflow-hidden hover-img" style="height: calc(100% - 2rem);" data-id="' . $row['idCampo'] . '">
                                <div class="position-relative">
                                    <a href="javascript:void(0)">
                                        <img src="' . $row['fotoCampo'] . '" class="card-img-top rounded-0" alt="..." style="min-height: 230px; max-height: 230px;">
                                    </a>';
                                    switch ($row['campoModalidade']) {
                                        case "Futsal":
                                            $msg .= '<span class="badge bg-danger text-white text-dark fs-2 rounded-4 lh-sm mb-9 ms-9 py-1 px-2 fw-semibold position-absolute bottom-0 start-0">';
                                            $msg .= '<i class="ti ti-ball-football me-1"></i>';
                                            break;
                                        case "Ténis":
                                            $msg .= '<span class="badge bg-success text-white text-dark fs-2 rounded-4 lh-sm mb-9 ms-9 py-1 px-2 fw-semibold position-absolute bottom-0 start-0">';
                                            $msg .= '<i class="ti ti-ball-tennis me-1"></i>';
                                            break;
                                        case "Padel":
                                            $msg .= '<span class="badge bg-primary text-white text-dark fs-2 rounded-4 lh-sm mb-9 ms-9 py-1 px-2 fw-semibold position-absolute bottom-0 start-0">';
                                            $msg .= '<i class="ti ti-ball-tennis me-1"></i>';
                                            break;
                                        case "Basquetebol":
                                            $msg .= '<span class="badge bg-warning text-white text-dark fs-2 rounded-4 lh-sm mb-9 ms-9 py-1 px-2 fw-semibold position-absolute bottom-0 start-0">';
                                            $msg .= '<i class="ti ti-ball-basketball me-1"></i>';
                                            break;
                                    }
                                    $msg .= $row['campoModalidade'] . '</span>
                                    <span class="badge bg-white text-dark fs-2 rounded-4 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">';
                                    switch ($row['tipoCampoDesc']) {
                                        case "Exterior":
                                            $msg .= '<i class="ti ti-sun me-1"></i>';
                                            break;
                                        case "Cobertura":
                                            $msg .= '<i class="ti ti-building-cottage me-1"></i>';
                                            break;
                                        case "Indoor":
                                            $msg .= '<i class="ti ti-home me-1"></i>';
                                            break;
                                    }
                                    $msg .= $row['tipoCampoDesc'] . '</span>
                                </div>
                                <div class="card-body p-4">
                                    <span id="morada"><i class="ti ti-map-pin me-1"></i>' . $row['moradaCampo'] . ', </span>
                                    <span id="localidade">' . $row['descConcelho'] . '</span>
                                    <p id="nome" class="d-block my-2 fs-5 text-dark fw-semibold">' . $row['campoNome'] . '</p>
                                    <p id="descricao" class="my-2">' . $row['campoDesc'] . '</p>
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
        $localidadeUser = "";
        $dados = array();

        $sql = "SELECT campo.id AS idCampo,
                modalidade.descricao AS campoModalidade, 
                campo.id AS campoId, 
                campo.foto AS fotoCampo, 
                campo.nome AS campoNome, 
                campo.descricao AS campoDesc, 
                tipo_campo.descricao AS tipoCampoDesc, 
                campo.morada AS moradaCampo, 
                campo_concelho.descricao AS descConcelhoCampo,
                user_concelho.descricao AS descConcelhoUser
            FROM 
                campo 
            INNER JOIN tipo_campo ON campo.tipo_campo = tipo_campo.id 
            INNER JOIN concelho AS campo_concelho ON campo.localidade = campo_concelho.id
            INNER JOIN modalidade ON campo.modalidade = modalidade.id 
            INNER JOIN atleta_modalidade ON modalidade.id = atleta_modalidade.id_modalidade 
            INNER JOIN atleta ON atleta_modalidade.id_atleta = atleta.id_atleta
            INNER JOIN user ON atleta.id_atleta = user.id
            INNER JOIN concelho AS user_concelho ON user.localidade = user_concelho.id";

        
        if ($modalidadePesquisa !== -1) {
            $modalidadePesquisa = intval($modalidadePesquisa); 
            $sql .= " WHERE modalidade.id = $modalidadePesquisa";
        }

        
        if ($stringPesquisa != "") {
            $stringPesquisa = $conn->real_escape_string($stringPesquisa); 
            $sql .= " OR (campo.nome LIKE '%$stringPesquisa%' OR campo.descricao LIKE '%$stringPesquisa%' OR campo_concelho.descricao LIKE '%$stringPesquisa%' OR campo.morada LIKE '%$stringPesquisa%')";
        }

        $sql .= " LIMIT 12";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $localidadeUser = $row['descConcelhoUser'];

                $rowArray = array(
                    'idCampo' => $row['idCampo'],
                    'campoModalidade' => $row['campoModalidade'],
                    'campoId' => $row['campoId'],
                    'fotoCampo' => $row['fotoCampo'],
                    'campoNome' => $row['campoNome'],
                    'campoDesc' => $row['campoDesc'],
                    'tipoCampoDesc' => $row['tipoCampoDesc'],
                    'moradaCampo' => $row['moradaCampo'],
                    'descConcelho' => $row['descConcelhoCampo']
                    
                );
                $dados[] = $rowArray;

                $msg .= '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="card rounded-2 overflow-hidden hover-img" style="height: calc(100% - 2rem);" data-id="' . $row['idCampo'] . '">
                                <div class="position-relative">
                                    <a href="javascript:void(0)">
                                        <img src="' . $row['fotoCampo'] . '" class="card-img-top rounded-0" alt="..." style="min-height: 230px; max-height: 230px;">
                                    </a>';
                                    switch ($row['campoModalidade']) {
                                        case "Futsal":
                                            $msg .= '<span class="badge bg-danger text-white text-dark fs-2 rounded-4 lh-sm mb-9 ms-9 py-1 px-2 fw-semibold position-absolute bottom-0 start-0">';
                                            $msg .= '<i class="ti ti-ball-football me-1"></i>';
                                            break;
                                        case "Ténis":
                                            $msg .= '<span class="badge bg-success text-white text-dark fs-2 rounded-4 lh-sm mb-9 ms-9 py-1 px-2 fw-semibold position-absolute bottom-0 start-0">';
                                            $msg .= '<i class="ti ti-ball-tennis me-1"></i>';
                                            break;
                                        case "Padel":
                                            $msg .= '<span class="badge bg-primary text-white text-dark fs-2 rounded-4 lh-sm mb-9 ms-9 py-1 px-2 fw-semibold position-absolute bottom-0 start-0">';
                                            $msg .= '<i class="ti ti-ball-tennis me-1"></i>';
                                            break;
                                        case "Basquetebol":
                                            $msg .= '<span class="badge bg-warning text-white text-dark fs-2 rounded-4 lh-sm mb-9 ms-9 py-1 px-2 fw-semibold position-absolute bottom-0 start-0">';
                                            $msg .= '<i class="ti ti-ball-basketball me-1"></i>';
                                            break;
                                    }
                                    $msg .= $row['campoModalidade'] . '</span>
                                    <span class="badge bg-white text-dark fs-2 rounded-4 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">';
                                    switch ($row['tipoCampoDesc']) {
                                        case "Exterior":
                                            $msg .= '<i class="ti ti-sun me-1"></i>';
                                            break;
                                        case "Cobertura":
                                            $msg .= '<i class="ti ti-building-cottage me-1"></i>';
                                            break;
                                        case "Indoor":
                                            $msg .= '<i class="ti ti-home me-1"></i>';
                                            break;
                                    }
                                    $msg .= $row['tipoCampoDesc'] . '</span>
                                </div>
                                <div class="card-body p-4">
                                    <span id="morada"><i class="ti ti-map-pin me-1"></i>' . $row['moradaCampo'] . ', </span>
                                    <span id="localidade">' . $row['descConcelhoCampo'] . '</span>
                                    <p id="nome" class="d-block my-2 fs-5 text-dark fw-semibold">' . $row['campoNome'] . '</p>
                                    <p id="descricao" class="my-2">' . $row['campoDesc'] . '</p>
                                </div>
                            </div>
                        </div>';

            }
        } else {
            $msg .= "<h3 class='text-center'>Sem resultados encontrados</h3>";
        }

        $conn -> close();

        $data = array('html' => $msg, 'dados' => $dados, 'localidadeUser' => $localidadeUser);
        return json_encode($data);
        
    }

    
}