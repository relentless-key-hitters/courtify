<?php

session_start();

require_once 'connection.php';

class Descobrir {

    function getMarcacoesAbertas() {
        global $conn;
        $msg = "";

        $sql = "SELECT marcacao.id AS idMarcacao,
                marcacao.id_atleta AS idAtletaHost,
                marcacao.data_inicio AS dataInicioMarcacao,
                marcacao.data_fim AS dataFimMarcacao,
                marcacao.hora_inicio AS horaInicioMarcacao,
                marcacao.hora_fim AS horaFimMarcacao,
                marcacao.tipo AS tipoMarcacao,
                clube.id_clube AS idClubeMarcacao,
                marcacao.id_campo AS idCampoMarcacao,
                campo.foto AS fotoCampoMarcacao,
                campo.nome AS nomeCampoMarcacao,
                campo.morada AS moradaCampoMarcacao,
                campo.preco_hora AS precoHoraCampoMarcacao,
                tipo_campo.descricao AS tipoCampoMarcacao,
                concelho.descricao AS localidadeClubeMarcacao,
                modalidade.descricao AS modalidadeMarcacao,
                user.nome as nomeClubeMarcacao
                FROM marcacao
                INNER JOIN 
                listagem_atletas_marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao
                INNER JOIN
                campo ON marcacao.id_campo = campo.id
                INNER JOIN
                campo_clube ON campo.id = campo_clube.id_campo
                INNER JOIN
                modalidade ON campo_clube.id_modalidade = modalidade.id
                INNER JOIN
                clube ON campo_clube.id_clube = clube.id_clube
                INNER JOIN
                user ON clube.id_clube = user.id
                INNER JOIN 
                tipo_campo ON campo.tipo_campo = tipo_campo.id
                INNER JOIN
                concelho ON user.localidade = concelho.id LIMIT 5;";

        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $msg .=  "<div class='item' style='max-width: 400px;'>
                            <div class='mt-1'>
                                <div class='card pt-5 pb-2 px-3 hover-img'>
                                <span class='badge rounded-pill position-absolute top-0 start-0 mt-2 ms-2 text-dark' style='background-color: #f0f0f0'>
                                    <i class='ti ti-map-pin me-1'></i>
                                    ".$row['localidadeClubeMarcacao']."
                                </span>
                                <span class='badge rounded-pill text-bg-primary position-absolute top-0 end-0 mt-2 me-2'>
                                    <i class='ti ti-ball-tennis me-1'></i>
                                    <small>".$row['modalidadeMarcacao']."</small>
                                </span>
                                <div class='row'>
                                    <div class='col-md-6'>
                                    <img src='".$row['fotoCampoMarcacao']."' alt='Clube 1' class='img-fluid rounded border border-1 border-primary' style='height: 100px; width: 250px;'>
                                    </div>
                                    <div class='col-md-6'>
                                    <div class='text-center mt-sm-2'>
                                        <small class='fs-5'><i class='ti ti-calendar me-1'></i>".$row['dataInicioMarcacao']."</small><br>
                                        <small class='fs-5'><i class='ti ti-clock me-1'></i>".$row['horaInicioMarcacao']."</small><br>
                                        <small class='fs-5'><i class='ti ti-map-pin me-1'></i>".$row['nomeCampoMarcacao']."</small><br>
                                        <div class='d-flex align-items-center justify-content-center mt-2 d-none' id='espacopreco'>
                                        <div class='bg-light mt-2 rounded p-2 w-50'>
                                            <h5 class='m-0 p-0' id='precomarcacao'></h5>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-12'>
                                    <div class='mt-2'>
                                        <i class='ti ti-building me-1 fs-5 mt-1'></i>
                                        <span class='fs-4'>".$row['nomeClubeMarcacao']."</span>
                                    </div>
                                    </div>
                                </div>
                                <div class='mt-2 mb-2'>
                                    <span class='fs-3'>Participantes</span>
                                </div>
                                <div class='row mt-1'>
                                    <div class='col-md-2'>
                                        <img src='../../dist/images/profile/boy4.jpg' alt='Participant 2' class='rounded-circle border border-2 border-success' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='Gonçalo Ricardo' style='cursor: pointer;'>
                                    </div>
                                    <div class='col-md-2'>
                                        <img src='../../dist/images/profile/boy2.jpg' alt='Participant 2' class='rounded-circle' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='Gonçalo Ricardo' style='cursor: pointer;'>
                                    </div>
                                    <div class='col-md-2'>
                                        <img src='../../dist/images/profile/boy3.jpg' alt='Participant 2' class='rounded-circle' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='Gonçalo Ricardo' style='cursor: pointer;'>
                                    </div>
                                    <div class='col-md-2'>
                                        <div class='lugar-livre' data-toggle='tooltip' data-placement='top' title='Junta-te!' style='cursor: pointer;'>

                                        </div>
                                    </div>
                                    <div class='col-md-2'>
                                        <div class='lugar-livre' data-toggle='tooltip' data-placement='top' title='Junta-te!' style='cursor: pointer;'>

                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-12 mt-4'>
                                        <button type='button' class='btn btn-primary w-100'>Mais Informação</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>";

            }
        }

        $conn->close();
        return ($msg);
    }

}