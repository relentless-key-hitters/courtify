<?php
session_start();
require_once 'connection.php';

class Campo {

    function getCampo() {
        global $conn;
        $msg = "";
        $dados = array();
        
        $sql = "SELECT campo.id AS idCampo, modalidade.descricao as campoModalidade, campo.id AS campoId, campo.foto AS fotoCampo, campo.nome AS campoNome, campo.descricao AS campoDesc, tipo_campo.descricao AS tipoCampoDesc, campo.morada AS moradaCampo, concelho.descricao AS descConcelho FROM campo INNER JOIN tipo_campo ON campo.tipo_campo = tipo_campo.id INNER JOIN concelho on campo.localidade = concelho.id INNER JOIN modalidade ON campo.modalidade = modalidade.id LIMIT 12";
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

                $msg .= '<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="card rounded-2 overflow-hidden hover-img" data-id="' . $row['idCampo'] . '">
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
                                    <div class="d-flex align-items-center gap-4">
                                        <button class="btn btn-small btn-primary">16:30</button>
                                        <button class="btn btn-small btn-primary">17:00</button>
                                        <button class="btn btn-small btn-primary">17:30</button>
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
}