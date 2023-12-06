<?php

session_start();

require_once 'connection.php';

class Descobrir {
    //TODO - AINDA VERIFICAR ATLETA HOST NA FOTO
    function getMarcacoesAbertasLocalidade() {
        global $conn;
        $msg = "";
        $localidadeUserLogin = "";

        $sql1 = "SELECT concelho.descricao as localidadeUser from concelho
        INNER JOIN user ON concelho.id = user.localidade WHERE user.id = " . $_SESSION['id'];

        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $localidadeUserLogin = $row1['localidadeUser'];

                $_SESSION['localidadeUser'] = $localidadeUserLogin;
        
                
            }
        }


        $sql = "SELECT
                    (SELECT COUNT(*) as contagemMarcacoes
                    FROM marcacao
                    INNER JOIN listagem_atletas_marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao
                    INNER JOIN campo ON marcacao.id_campo = campo.id
                    INNER JOIN campo_clube ON campo.id = campo_clube.id_campo
                    INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id
                    INNER JOIN clube ON campo_clube.id_clube = clube.id_clube
                    INNER JOIN user AS user_clube ON clube.id_clube = user_clube.id
                    INNER JOIN user AS user_atleta ON listagem_atletas_marcacao.id_atleta = user_atleta.id
                    INNER JOIN tipo_campo ON campo.tipo_campo = tipo_campo.id
                    INNER JOIN concelho ON user_clube.localidade = concelho.id
                    WHERE marcacao.tipo = 'aberta'
                    AND listagem_atletas_marcacao.votacao = '2'
                    AND listagem_atletas_marcacao.id_atleta != ".$_SESSION['id']."
                    AND concelho.descricao = '".$localidadeUserLogin."'
                    ) AS num_rows,
                    marcacao.id AS idMarcacao,
                    user_atleta.id AS idAtletaHost,
                    user_atleta.foto AS fotoAtletaHost,
                    user_atleta.nome AS nomeAtletaHost,
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
                    user_clube.nome AS nomeClubeMarcacao
                FROM
                marcacao
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
                user AS user_clube ON clube.id_clube = user_clube.id
                INNER JOIN
    			user AS user_atleta ON listagem_atletas_marcacao.id_atleta = user_atleta.id
                INNER JOIN 
                tipo_campo ON campo.tipo_campo = tipo_campo.id
                INNER JOIN
                concelho ON user_clube.localidade = concelho.id
                WHERE marcacao.tipo = 'aberta'
                AND listagem_atletas_marcacao.votacao = '2'
                AND listagem_atletas_marcacao.id_atleta != ".$_SESSION['id']."
                AND concelho.descricao = '".$localidadeUserLogin."'
                ORDER BY marcacao.data_inicio ASC;";

        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

              $data = new DateTime($row['dataInicioMarcacao']);
              $stringData = $data -> format('d/m/Y');

              $hora = new DateTime($row['horaInicioMarcacao']);
              $stringHora = $hora->format('H:i');

              $contagem = $row['num_rows'];
              $msg .=  "<div class='item' id='marcacao".$row['idMarcacao']."' style='max-width: 400px;'>
                            <div class='mt-1'>
                                <div class='card pt-5 pb-2 px-3 hover-img'>
                                <span class='badge rounded-pill position-absolute top-0 start-0 mt-2 ms-2 text-dark' style='background-color: #f0f0f0'>
                                    <i class='ti ti-map-pin me-1'></i>
                                    ".$row['localidadeClubeMarcacao']."
                                </span>";
                                if($row['modalidadeMarcacao'] == "Ténis") {
                                    $msg .= "<span class='badge rounded-pill text-bg-success position-absolute top-0 end-0 mt-2 me-2'>
                                                <i class='ti ti-ball-tennis me-1'></i>
                                                <small>".$row['modalidadeMarcacao']."</small>
                                            </span>";
                                }else if($row['modalidadeMarcacao'] == "Padel") {
                                    $msg .= "<span class='badge rounded-pill text-bg-primary position-absolute top-0 end-0 mt-2 me-2'>
                                                <i class='ti ti-ball-tennis me-1'></i>
                                                <small>".$row['modalidadeMarcacao']."</small>
                                            </span>";
                                }else if($row['modalidadeMarcacao'] == "Futsal") {
                                    $msg .= "<span class='badge rounded-pill text-bg-danger position-absolute top-0 end-0 mt-2 me-2'>
                                                <i class='ti ti-ball-football me-1'></i>
                                                <small>".$row['modalidadeMarcacao']."</small>
                                            </span>";
                                }else if($row['modalidadeMarcacao'] == "Basquetebol") {
                                    $msg .= "<span class='badge rounded-pill text-bg-warning position-absolute top-0 end-0 mt-2 me-2'>
                                                <i class='ti ti-ball-basketball me-1'></i>
                                                <small>".$row['modalidadeMarcacao']."</small>
                                            </span>";
                                }
                                $msg .= "<div class='row'>
                                    <div class='col-md-6'>
                                    <img src='".$row['fotoCampoMarcacao']."' alt='Clube 1' class='img-fluid rounded border border-1 border-primary' style='height: 100px; width: 250px;'>
                                    </div>
                                    <div class='col-md-6'>
                                    <div class='text-center mt-sm-2'>
                                        <small class='fs-5'><i class='ti ti-calendar me-1'></i>".$stringData."</small><br>
                                        <small class='fs-5'><i class='ti ti-clock me-1'></i>".$stringHora."</small><br>
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
                                        <a href='./clube.php?id=".$row['idClubeMarcacao']."'><span class='fs-4'>".$row['nomeClubeMarcacao']."</span></a>
                                    </div>
                                    </div>
                                </div>
                                <div class='mt-2 mb-2'>
                                <span class='fs-3'>Participantes</span>
                            </div>
                            <div class='row mt-1'>
                                <div class='col-md-2'>
                                    <a href='./perfil.php?id=".$row['idAtletaHost']."'><img src='../../dist/".$row['fotoAtletaHost']."' alt='Participant 2' class='rounded-circle border border-2 border-success' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='".$row['nomeAtletaHost']." (Host)' style='cursor: pointer;'></a>
                                </div>";
                                
            $sql1 = "SELECT listagem_atletas_marcacao.id_marcacao AS idMarcacao, 
                    listagem_atletas_marcacao.id_atleta AS idAtleta, 
                    user.nome AS nomeAmigo,
                    user.foto AS fotoAmigo
                    FROM
                    listagem_atletas_marcacao
                    INNER JOIN
                    user ON listagem_atletas_marcacao.id_atleta = user.id
                    WHERE id_marcacao = ".$row['idMarcacao'];
            $result1 = $conn->query($sql1);
            
            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                    if($row1['idAtleta'] != $row['idAtletaHost']) {

                        $msg .= "<div class='col-md-2'>
                                    <img src='../../dist/".$row1['fotoAmigo']."' alt='".$row1['nomeAmigo']."' class='rounded-circle' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='".$row1['nomeAmigo']."' style='cursor: pointer;'>
                                </div>";
                    }
                }
            }

            $msg .= "</div>
                            <div class='row'>
                                <div class='col-md-12 mt-4'>
                                    <button type='button' class='btn btn-primary w-100'>Mais Informação</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>";
            }
        } else {
            $msg .= "<div class='text-center'>
                <span class='fs-8'>Sem Resultados!</span>
            </div>
            ";
        }

        $conn->close();
        $resp = json_encode(array("msg" => $msg, "localidadeUser" => $localidadeUserLogin, "contagem" => $contagem));
        return ($resp);
    }
    //TODO - AINDA VERIFICAR ATLETA HOST NA FOTO
    function getMarcacoesAbertasModalidades() {
        global $conn;
        $msg = "";

        $sql = "SELECT
                    (SELECT COUNT(*) as contagemMarcacoes
                    FROM marcacao
                    INNER JOIN listagem_atletas_marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao
                    INNER JOIN campo ON marcacao.id_campo = campo.id
                    INNER JOIN campo_clube ON campo.id = campo_clube.id_campo
                    INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id
                    INNER JOIN clube ON campo_clube.id_clube = clube.id_clube
                    INNER JOIN user AS user_clube ON clube.id_clube = user_clube.id
                    INNER JOIN user AS user_atleta ON listagem_atletas_marcacao.id_atleta = user_atleta.id
                    INNER JOIN tipo_campo ON campo.tipo_campo = tipo_campo.id
                    INNER JOIN concelho ON user_clube.localidade = concelho.id
                    WHERE marcacao.tipo = 'aberta'
                    AND listagem_atletas_marcacao.votacao = '2'
                    AND listagem_atletas_marcacao.id_atleta != ".$_SESSION['id']."
                    ) AS num_rows,
                    marcacao.id AS idMarcacao,
                    user_atleta.id AS idAtletaHost,
                    user_atleta.foto AS fotoAtletaHost,
                    user_atleta.nome AS nomeAtletaHost,
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
                    user_clube.nome AS nomeClubeMarcacao
                FROM
                marcacao
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
                user AS user_clube ON clube.id_clube = user_clube.id
                INNER JOIN
    			user AS user_atleta ON listagem_atletas_marcacao.id_atleta = user_atleta.id
                INNER JOIN 
                tipo_campo ON campo.tipo_campo = tipo_campo.id
                INNER JOIN
                concelho ON user_clube.localidade = concelho.id
                WHERE marcacao.tipo = 'aberta'
                AND listagem_atletas_marcacao.votacao = '2'
                AND listagem_atletas_marcacao.id_atleta != ".$_SESSION['id']."
                AND modalidade.id IN (SELECT modalidade.id
                                        FROM
                                        modalidade
                                        INNER JOIN
                                        atleta_modalidade ON modalidade.id = atleta_modalidade.id_modalidade
                                        INNER JOIN
                                        atleta
                                        ON
                                        atleta_modalidade.id_atleta = atleta.id_atleta
                                        WHERE atleta.id_atleta = " . $_SESSION['id'].") ORDER BY marcacao.data_inicio ASC;";

        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

              $data = new DateTime($row['dataInicioMarcacao']);
              $stringData = $data -> format('d/m/Y'); 

              $hora = new DateTime($row['horaInicioMarcacao']);
              $stringHora = $hora->format('H:i');

              $contagem = $row['num_rows'];
              $msg .=  "<div class='item' id='marcacao".$row['idMarcacao']."' style='max-width: 400px;'>
                            <div class='mt-1'>
                                <div class='card pt-5 pb-2 px-3 hover-img'>
                                <span class='badge rounded-pill position-absolute top-0 start-0 mt-2 ms-2 text-dark' style='background-color: #f0f0f0'>
                                    <i class='ti ti-map-pin me-1'></i>
                                    ".$row['localidadeClubeMarcacao']."
                                </span>";
                                if($row['modalidadeMarcacao'] == "Ténis") {
                                    $msg .= "<span class='badge rounded-pill text-bg-success position-absolute top-0 end-0 mt-2 me-2'>
                                                <i class='ti ti-ball-tennis me-1'></i>
                                                <small>".$row['modalidadeMarcacao']."</small>
                                            </span>";
                                }else if($row['modalidadeMarcacao'] == "Padel") {
                                    $msg .= "<span class='badge rounded-pill text-bg-primary position-absolute top-0 end-0 mt-2 me-2'>
                                                <i class='ti ti-ball-tennis me-1'></i>
                                                <small>".$row['modalidadeMarcacao']."</small>
                                            </span>";
                                }else if($row['modalidadeMarcacao'] == "Futsal") {
                                    $msg .= "<span class='badge rounded-pill text-bg-danger position-absolute top-0 end-0 mt-2 me-2'>
                                                <i class='ti ti-ball-football me-1'></i>
                                                <small>".$row['modalidadeMarcacao']."</small>
                                            </span>";
                                }else if($row['modalidadeMarcacao'] == "Basquetebol") {
                                    $msg .= "<span class='badge rounded-pill text-bg-warning position-absolute top-0 end-0 mt-2 me-2'>
                                                <i class='ti ti-ball-basketball me-1'></i>
                                                <small>".$row['modalidadeMarcacao']."</small>
                                            </span>";
                                }
                                $msg .= "<div class='row'>
                                    <div class='col-md-6'>
                                    <img src='".$row['fotoCampoMarcacao']."' alt='Clube 1' class='img-fluid rounded border border-1 border-primary' style='height: 100px; width: 250px;'>
                                    </div>
                                    <div class='col-md-6'>
                                    <div class='text-center mt-sm-2'>
                                        <small class='fs-5'><i class='ti ti-calendar me-1'></i>".$stringData."</small><br>
                                        <small class='fs-5'><i class='ti ti-clock me-1'></i>".$stringHora."</small><br>
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
                                        <a href='./clube.php?id=".$row['idClubeMarcacao']."'><span class='fs-4'>".$row['nomeClubeMarcacao']."</span></a>
                                    </div>
                                    </div>
                                </div>
                                <div class='mt-2 mb-2'>
                                    <span class='fs-3'>Participantes</span>
                                </div>
                                <div class='row mt-1'>
                                    <div class='col-md-2'>
                                        <a href='./perfil.php?id=".$row['idAtletaHost']."'><img src='../../dist/".$row['fotoAtletaHost']."' alt='Participant 2' class='rounded-circle border border-2 border-success' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='".$row['nomeAtletaHost']." (Host)' style='cursor: pointer;'></a>
                                    </div>";
                                    
                $sql1 = "SELECT listagem_atletas_marcacao.id_marcacao AS idMarcacao, 
                        listagem_atletas_marcacao.id_atleta AS idAtleta, 
                        user.nome AS nomeAmigo,
                        user.foto AS fotoAmigo
                        FROM
                        listagem_atletas_marcacao
                        INNER JOIN
                        user ON listagem_atletas_marcacao.id_atleta = user.id
                        WHERE id_marcacao = ".$row['idMarcacao'];
                $result1 = $conn->query($sql1);
                
                if ($result1->num_rows > 0) {
                    while ($row1 = $result1->fetch_assoc()) {
                        if($row1['idAtleta'] != $row['idAtletaHost']) {

                            $msg .= "<div class='col-md-2'>
                                        <img src='../../dist/".$row1['fotoAmigo']."' alt='".$row1['nomeAmigo']."' class='rounded-circle' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='".$row1['nomeAmigo']."' style='cursor: pointer;'>
                                    </div>";
                        }
                    }
                }

                $msg .= "</div>
                                <div class='row'>
                                    <div class='col-md-12 mt-4'>
                                        <button type='button' class='btn btn-primary w-100'>Mais Informação</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>";

            }
        } else {
            $msg .= "<div class='text-center'>
                <span class='fs-8'>Sem Resultados!</span>
            </div>
            ";
        }

        $conn->close();
        $resp = json_encode(array("msg" => $msg, "contagem" => $contagem));
        return ($resp);
    }

}