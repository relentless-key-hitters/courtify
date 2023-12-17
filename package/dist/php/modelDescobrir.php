<?php

session_start();

require_once 'connection.php';

class Descobrir
{

    function getMarcacoesAbertasAmigos()
    {
        global $conn;
        $msg = "";
        $contagem = 0;

        $sql = "SELECT DISTINCT
                    marcacao.id AS idMarcacao,
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
                user AS user_atleta ON marcacao.id_atleta = user_atleta.id
                INNER JOIN 
                tipo_campo ON campo.tipo_campo = tipo_campo.id
                INNER JOIN
                concelho ON user_clube.localidade = concelho.id
                WHERE marcacao.tipo = 'aberta'
                AND listagem_atletas_marcacao.votacao = '2'
                AND marcacao.id NOT IN (
                        SELECT listagem_atletas_marcacao.id_marcacao 
                        FROM listagem_atletas_marcacao 
                        WHERE listagem_atletas_marcacao.id_atleta  = ".$_SESSION['id']."
                    )
                AND marcacao.id_atleta != ".$_SESSION['id']."
                AND marcacao.id_atleta IN (
                        SELECT amigo.id_atleta1
                        FROM amigo 
                        WHERE (amigo.id_atleta1 = ".$_SESSION['id']."
                        OR amigo.id_atleta2 = ".$_SESSION['id'].")
                        AND  amigo.id_atleta1 != ".$_SESSION['id']."
                        AND amigo.estado = 1
                        UNION 
                        SELECT amigo.id_atleta2
                        FROM amigo 
                        WHERE (amigo.id_atleta2 = ".$_SESSION['id']."
                        OR amigo.id_atleta1 = ".$_SESSION['id'].")
                        AND amigo.id_atleta2 != ".$_SESSION['id']."
                        AND amigo.estado = 1
                    )
                AND modalidade.id IN (SELECT modalidade.id
                                        FROM
                                        modalidade
                                        INNER JOIN
                                        atleta_modalidade ON modalidade.id = atleta_modalidade.id_modalidade
                                        INNER JOIN
                                        atleta
                                        ON
                                        atleta_modalidade.id_atleta = atleta.id_atleta
                                        WHERE atleta.id_atleta = ".$_SESSION['id'].") ORDER BY marcacao.data_inicio, marcacao.hora_inicio ASC";


        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['idAtletaHost'] != $_SESSION['id']) {
                    $data = new DateTime($row['dataInicioMarcacao']);
                    $stringData = $data->format('d/m/Y');

                    $hora = new DateTime($row['horaInicioMarcacao']);
                    $stringHora = $hora->format('H:i');

                    $contagem++;
                    $msg .=  "<div class='item' id='marcacao" . $row['idMarcacao'] . "'>
                                <div class='mt-1'>
                                    <div class='card pt-5 pb-2 px-3 hover-img'>
                                    <span class='fs-4 text-dark position-absolute top-0 start-50 mt-2'>Nº: <span class='fw-bolder'>" . $row['idMarcacao'] . "</span></span>
                                    <span class='badge rounded-pill position-absolute top-0 start-0 mt-2 ms-2 text-dark' style='background-color: #f0f0f0'>
                                        <i class='ti ti-map-pin me-1'></i>
                                        " . $row['localidadeClubeMarcacao'] . "
                                    </span>";
                    if ($row['modalidadeMarcacao'] == "Ténis") {
                        $msg .= "<span class='badge rounded-pill text-bg-success position-absolute top-0 end-0 mt-2 me-2'>
                                                    <i class='ti ti-ball-tennis me-1'></i>
                                                    <small>" . $row['modalidadeMarcacao'] . "</small>
                                                </span>";
                    } else if ($row['modalidadeMarcacao'] == "Padel") {
                        $msg .= "<span class='badge rounded-pill text-bg-primary position-absolute top-0 end-0 mt-2 me-2'>
                                                    <i class='ti ti-ball-tennis me-1'></i>
                                                    <small>" . $row['modalidadeMarcacao'] . "</small>
                                                </span>";
                    } else if ($row['modalidadeMarcacao'] == "Futsal") {
                        $msg .= "<span class='badge rounded-pill text-bg-danger position-absolute top-0 end-0 mt-2 me-2'>
                                                    <i class='ti ti-ball-football me-1'></i>
                                                    <small>" . $row['modalidadeMarcacao'] . "</small>
                                                </span>";
                    } else if ($row['modalidadeMarcacao'] == "Basquetebol") {
                        $msg .= "<span class='badge rounded-pill text-bg-warning position-absolute top-0 end-0 mt-2 me-2'>
                                                    <i class='ti ti-ball-basketball me-1'></i>
                                                    <small>" . $row['modalidadeMarcacao'] . "</small>
                                                </span>";
                    }
                    $msg .= "<div class='row'>
                                        <div class='col-md-6'>
                                        <img src='" . $row['fotoCampoMarcacao'] . "' alt='Clube 1' class='img-fluid rounded border border-1 border-primary' style='height: 100px; width: 250px;'>
                                        </div>
                                        <div class='col-md-6'>
                                        <div class='text-center mt-sm-2'>
                                            <small class='fs-5'><i class='ti ti-calendar me-1'></i>" . $stringData . "</small><br>
                                            <small class='fs-5'><i class='ti ti-clock me-1'></i>" . $stringHora . "</small><br>
                                            <small class='fs-5'><i class='ti ti-map-pin me-1'></i>" . $row['nomeCampoMarcacao'] . "</small><br>
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
                                            <a href='./clube.php?id=" . $row['idClubeMarcacao'] . "'><span class='fs-4'>" . $row['nomeClubeMarcacao'] . "</span></a>
                                        </div>
                                        </div>
                                    </div>
                                    <div class='mt-2 mb-2'>
                                        <span class='fs-3'>Participantes</span>
                                    </div>
                                    <div class='mt-1 d-flex overflow-y-auto' style='min-height: 70px'>
                                        <div class='col-md-2 mb-2'>
                                            <a href='./perfil.php?id=" . $row['idAtletaHost'] . "'><img src='../../dist/" . $row['fotoAtletaHost'] . "' alt='" . $row['nomeAtletaHost'] . "' class='rounded-circle border border-2 border-success' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='" . $row['nomeAtletaHost'] . " (Host)' style='cursor: pointer;'></a>
                                        </div>";

                    $sql1 = "SELECT listagem_atletas_marcacao.id_marcacao AS idMarcacao, 
                            listagem_atletas_marcacao.id_atleta AS idAtleta, 
                            user.nome AS nomeAmigo,
                            user.foto AS fotoAmigo
                            FROM
                            listagem_atletas_marcacao
                            INNER JOIN
                            user ON listagem_atletas_marcacao.id_atleta = user.id
                            WHERE id_marcacao = " . $row['idMarcacao'] ."
                            AND listagem_atletas_marcacao.estado = 1";
                    $result1 = $conn->query($sql1);

                    if ($result1->num_rows > 0) {
                        while ($row1 = $result1->fetch_assoc()) {
                            if ($row1['idAtleta'] != $row['idAtletaHost']) {
                                if($row1['idAtleta'] == $_SESSION['id']) {
                                    $msg .= "<div class='col-md-2 mb-2'>
                                        <a href='./perfil.php?id=" . $row1['idAtleta'] . "'><img src='../../dist/" . $row1['fotoAmigo'] . "' alt='" . $row1['nomeAmigo'] . " (Tu)' class='rounded-circle border border-2 border-primary' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='" . $row1['nomeAmigo'] . " (Tu)' style='cursor: pointer;'></a>
                                    </div>";
                                } else {
                                    $msg .= "<div class='col-md-2 mb-2'>
                                    <a href='./perfil.php?id=" . $row1['idAtleta'] . "'><img src='../../dist/" . $row1['fotoAmigo'] . "' alt='" . $row1['nomeAmigo'] . "' class='rounded-circle' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='" . $row1['nomeAmigo'] . "' style='cursor: pointer;'></a>
                                    </div>";
                                }
                            }
                        }
                    }

                    $sql2 = "SELECT
                    modalidade.n_participantes_max,
                    COUNT(listagem_atletas_marcacao.id_marcacao) AS num_atletas_inscritos
                  FROM
                    modalidade
                  INNER JOIN
                    campo_clube ON modalidade.id = campo_clube.id_modalidade
                  INNER JOIN
                    marcacao ON campo_clube.id_campo = marcacao.id_campo
                  LEFT JOIN
                    listagem_atletas_marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao
                  WHERE
                    marcacao.id = ".$row['idMarcacao']."
                  AND 
                    listagem_atletas_marcacao.estado = 1
                  GROUP BY
                    modalidade.n_participantes_max;";

                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            for($i = 0; $i < ($row2['n_participantes_max'] - $row2['num_atletas_inscritos']); $i++) {
                                $msg .= "<div class='col-md-2 mb-2'>
                                            <div class='lugar-livre' data-toggle='tooltip' data-placement='top' title='Junta-te!' style='cursor: pointer;'>
                                        
                                            </div>
                                        </div>";
                            }
                        }
                    }

                    $msg .= "</div>
                                    <div class='row'>
                                        <div class='col-md-12 mt-4'>
                                            <button type='button' class='btn btn-success w-100' onclick='getModalJuntarMarcacao(" . $row['idMarcacao'] . ")'>Juntar</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>";
                }
            }
        } else {
            $contagem = 0;
            $msg .= "<div class='text-center mt-3 mb-3'><span class='fs-6 fw-bold'>Sem resultados!</span><p>De momento não existem marcações abertas que se apliquem a este contexto. Verifica mais tarde!</p></div>";
        }

        $conn->close();
        $resp = json_encode(array("msg" => $msg, "contagem" => $contagem));
        return ($resp);
    }

    function getMarcacoesAbertasLocalidade()
    {
        global $conn;
        $msg = "";
        $localidadeUserLogin = "";
        $contagem = 0;

        $sql1 = "SELECT concelho.descricao as localidadeUser from concelho
        INNER JOIN user ON concelho.id = user.localidade WHERE user.id = " . $_SESSION['id'];

        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $localidadeUserLogin = $row1['localidadeUser'];

                $_SESSION['localidadeUser'] = $localidadeUserLogin;
            }
        }


        $sql = "SELECT DISTINCT
                    marcacao.id AS idMarcacao,
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
                user AS user_atleta ON marcacao.id_atleta = user_atleta.id
                INNER JOIN 
                tipo_campo ON campo.tipo_campo = tipo_campo.id
                INNER JOIN
                concelho ON user_clube.localidade = concelho.id
                WHERE marcacao.tipo = 'aberta'
                AND listagem_atletas_marcacao.votacao = '2'
                AND listagem_atletas_marcacao.id_atleta != " . $_SESSION['id'] . "
                AND concelho.descricao = '" . $localidadeUserLogin . "'
                AND marcacao.id_atleta != " . $_SESSION['id'] . "
                AND marcacao.id NOT IN (
                    SELECT listagem_atletas_marcacao.id_marcacao 
                    FROM listagem_atletas_marcacao 
                    WHERE listagem_atletas_marcacao.id_atleta  = ".$_SESSION['id']." 
                ) 
                AND modalidade.id IN (SELECT modalidade.id
                                        FROM
                                        modalidade
                                        INNER JOIN
                                        atleta_modalidade ON modalidade.id = atleta_modalidade.id_modalidade
                                        INNER JOIN
                                        atleta
                                        ON
                                        atleta_modalidade.id_atleta = atleta.id_atleta
                                        WHERE atleta.id_atleta = " . $_SESSION['id'] . ") ORDER BY marcacao.data_inicio, marcacao.hora_inicio ASC;";


        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['idAtletaHost'] != $_SESSION['id']) {

                    $data = new DateTime($row['dataInicioMarcacao']);
                    $stringData = $data->format('d/m/Y');

                    $hora = new DateTime($row['horaInicioMarcacao']);
                    $stringHora = $hora->format('H:i');

                    $contagem++;
                    $msg .=  "<div class='item' id='marcacao" . $row['idMarcacao'] . "'>
                            <div class='mt-1'>
                                <div class='card pt-5 pb-2 px-3 hover-img' height='300px'>
                                <span class='fs-4 text-dark position-absolute top-0 start-50 mt-2'>Nº: <span class='fw-bolder'>" . $row['idMarcacao'] . "</span></span>
                                <span class='badge rounded-pill position-absolute top-0 start-0 mt-2 ms-2 text-dark' style='background-color: #f0f0f0'>
                                    <i class='ti ti-map-pin me-1'></i>
                                    " . $row['localidadeClubeMarcacao'] . "
                                </span>";
                    if ($row['modalidadeMarcacao'] == "Ténis") {
                        $msg .= "<span class='badge rounded-pill text-bg-success position-absolute top-0 end-0 mt-2 me-2'>
                                                <i class='ti ti-ball-tennis me-1'></i>
                                                <small>" . $row['modalidadeMarcacao'] . "</small>
                                            </span>";
                    } else if ($row['modalidadeMarcacao'] == "Padel") {
                        $msg .= "<span class='badge rounded-pill text-bg-primary position-absolute top-0 end-0 mt-2 me-2'>
                                                <i class='ti ti-ball-tennis me-1'></i>
                                                <small>" . $row['modalidadeMarcacao'] . "</small>
                                            </span>";
                    } else if ($row['modalidadeMarcacao'] == "Futsal") {
                        $msg .= "<span class='badge rounded-pill text-bg-danger position-absolute top-0 end-0 mt-2 me-2'>
                                                <i class='ti ti-ball-football me-1'></i>
                                                <small>" . $row['modalidadeMarcacao'] . "</small>
                                            </span>";
                    } else if ($row['modalidadeMarcacao'] == "Basquetebol") {
                        $msg .= "<span class='badge rounded-pill text-bg-warning position-absolute top-0 end-0 mt-2 me-2'>
                                                <i class='ti ti-ball-basketball me-1'></i>
                                                <small>" . $row['modalidadeMarcacao'] . "</small>
                                            </span>";
                    }
                    $msg .= "<div class='row'>
                                    <div class='col-md-6'>
                                    <img src='" . $row['fotoCampoMarcacao'] . "' alt='Clube 1' class='img-fluid rounded border border-1 border-primary' style='height: 100px; width: 250px;'>
                                    </div>
                                    <div class='col-md-6'>
                                    <div class='text-center mt-sm-2'>
                                        <small class='fs-5'><i class='ti ti-calendar me-1'></i>" . $stringData . "</small><br>
                                        <small class='fs-5'><i class='ti ti-clock me-1'></i>" . $stringHora . "</small><br>
                                        <small class='fs-5'><i class='ti ti-map-pin me-1'></i>" . $row['nomeCampoMarcacao'] . "</small><br>
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
                                        <a href='./clube.php?id=" . $row['idClubeMarcacao'] . "'><span class='fs-4'>" . $row['nomeClubeMarcacao'] . "</span></a>
                                    </div>
                                    </div>
                                </div>
                                <div class='mt-2 mb-2'>
                                <span class='fs-3'>Participantes</span>
                            </div>
                            <div class='mt-1 d-flex overflow-y-auto' style='min-height: 70px'>
                                <div class='col-md-2 mb-2'>
                                    <a href='./perfil.php?id=" . $row['idAtletaHost'] . "'><img src='../../dist/" . $row['fotoAtletaHost'] . "' alt='Participant 2' class='rounded-circle border border-2 border-success' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='" . $row['nomeAtletaHost'] . " (Host)' style='cursor: pointer;'></a>
                                </div>";

                    $sql2 = "SELECT listagem_atletas_marcacao.id_marcacao AS idMarcacao, 
                    listagem_atletas_marcacao.id_atleta AS idAtleta, 
                    user.nome AS nomeAmigo,
                    user.foto AS fotoAmigo
                    FROM
                    listagem_atletas_marcacao
                    INNER JOIN
                    user ON listagem_atletas_marcacao.id_atleta = user.id
                    WHERE id_marcacao = " . $row['idMarcacao'] ."
                    AND listagem_atletas_marcacao.estado = 1";
                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            if ($row2['idAtleta'] != $row['idAtletaHost']) {
                                if($row2['idAtleta'] == $_SESSION['id']) {
                                    $msg .= "<div class='col-md-2 mb-2'>
                                        <a href='./perfil.php?id=" . $row2['idAtleta'] . "'><img src='../../dist/" . $row2['fotoAmigo'] . "' alt='" . $row2['nomeAmigo'] . " (Tu)' class='rounded-circle border border-2 border-primary' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='" . $row2['nomeAmigo'] . " (Tu)' style='cursor: pointer;'></a>
                                    </div>";
                                } else {
                                    $msg .= "<div class='col-md-2 mb-2'>
                                        <a href='./perfil.php?id=" . $row2['idAtleta'] . "'><img src='../../dist/" . $row2['fotoAmigo'] . "' alt='" . $row2['nomeAmigo'] . "' class='rounded-circle' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='" . $row2['nomeAmigo'] . "' style='cursor: pointer;'></a>
                                    </div>";
                                }
                            }
                        }
                    }

                    $sql3 = "SELECT
                    modalidade.n_participantes_max,
                    COUNT(listagem_atletas_marcacao.id_marcacao) AS num_atletas_inscritos
                  FROM
                    modalidade
                  INNER JOIN
                    campo_clube ON modalidade.id = campo_clube.id_modalidade
                  INNER JOIN
                    marcacao ON campo_clube.id_campo = marcacao.id_campo
                  LEFT JOIN
                    listagem_atletas_marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao
                  WHERE
                    marcacao.id = ".$row['idMarcacao']."
                  AND 
                    listagem_atletas_marcacao.estado = 1
                  GROUP BY
                    modalidade.n_participantes_max;";

                    $result3 = $conn->query($sql3);

                    if ($result3->num_rows > 0) {
                        while ($row3 = $result3->fetch_assoc()) {
                            for($i = 0; $i < ($row3['n_participantes_max'] - $row3['num_atletas_inscritos']); $i++) {
                                $msg .= "<div class='col-md-2 mb-2'>
                                            <div class='lugar-livre' data-toggle='tooltip' data-placement='top' title='Junta-te!'>
                                        
                                            </div>
                                        </div>";
                            }
                        }
                    }

                    $msg .= "</div>
                            <div class='row'>
                                <div class='col-md-12 mt-4'>
                                    <button type='button' class='btn btn-success w-100' onclick='getModalJuntarMarcacao(" . $row['idMarcacao'] . ")'>Juntar</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>";
                }
            }
        } else {
            $contagem = 0;
            $msg .= "<div class='text-center mt-3 mb-3'><span class='fs-6 fw-bold'>Sem resultados!</span><p>De momento não existem marcações abertas que se apliquem a este contexto. Verifica mais tarde!</p></div>";
        }

        $conn->close();
        $resp = json_encode(array("msg" => $msg, "localidadeUser" => $localidadeUserLogin, "contagem" => $contagem));
        return ($resp);
    }

    function getMarcacoesAbertasModalidades()
    {
        global $conn;
        $msg = "";
        $contagem = 0;

        $sql = "SELECT DISTINCT
                    marcacao.id AS idMarcacao,
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
                user AS user_atleta ON marcacao.id_atleta = user_atleta.id
                INNER JOIN 
                tipo_campo ON campo.tipo_campo = tipo_campo.id
                INNER JOIN
                concelho ON user_clube.localidade = concelho.id
                WHERE marcacao.tipo = 'aberta'
                AND listagem_atletas_marcacao.votacao = '2'
                AND marcacao.id NOT IN (
                        SELECT listagem_atletas_marcacao.id_marcacao 
                        FROM listagem_atletas_marcacao 
                        WHERE listagem_atletas_marcacao.id_atleta  = ".$_SESSION['id']." 
                    )
                AND marcacao.id_atleta != ".$_SESSION['id']."
                AND modalidade.id IN (SELECT modalidade.id
                                        FROM
                                        modalidade
                                        INNER JOIN
                                        atleta_modalidade ON modalidade.id = atleta_modalidade.id_modalidade
                                        INNER JOIN
                                        atleta
                                        ON
                                        atleta_modalidade.id_atleta = atleta.id_atleta
                                        WHERE atleta.id_atleta = ".$_SESSION['id'].") ORDER BY marcacao.data_inicio, marcacao.hora_inicio ASC;";


        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['idAtletaHost'] != $_SESSION['id']) {
                    $data = new DateTime($row['dataInicioMarcacao']);
                    $stringData = $data->format('d/m/Y');

                    $hora = new DateTime($row['horaInicioMarcacao']);
                    $stringHora = $hora->format('H:i');

                    $contagem++;
                    $msg .=  "<div class='item' id='marcacao" . $row['idMarcacao'] . "'>
                                <div class='mt-1'>
                                    <div class='card pt-5 pb-2 px-3 hover-img'>
                                    <span class='fs-4 text-dark position-absolute top-0 start-50 mt-2'>Nº: <span class='fw-bolder'>" . $row['idMarcacao'] . "</span></span>
                                    <span class='badge rounded-pill position-absolute top-0 start-0 mt-2 ms-2 text-dark' style='background-color: #f0f0f0'>
                                        <i class='ti ti-map-pin me-1'></i>
                                        " . $row['localidadeClubeMarcacao'] . "
                                    </span>";
                    if ($row['modalidadeMarcacao'] == "Ténis") {
                        $msg .= "<span class='badge rounded-pill text-bg-success position-absolute top-0 end-0 mt-2 me-2'>
                                                    <i class='ti ti-ball-tennis me-1'></i>
                                                    <small>" . $row['modalidadeMarcacao'] . "</small>
                                                </span>";
                    } else if ($row['modalidadeMarcacao'] == "Padel") {
                        $msg .= "<span class='badge rounded-pill text-bg-primary position-absolute top-0 end-0 mt-2 me-2'>
                                                    <i class='ti ti-ball-tennis me-1'></i>
                                                    <small>" . $row['modalidadeMarcacao'] . "</small>
                                                </span>";
                    } else if ($row['modalidadeMarcacao'] == "Futsal") {
                        $msg .= "<span class='badge rounded-pill text-bg-danger position-absolute top-0 end-0 mt-2 me-2'>
                                                    <i class='ti ti-ball-football me-1'></i>
                                                    <small>" . $row['modalidadeMarcacao'] . "</small>
                                                </span>";
                    } else if ($row['modalidadeMarcacao'] == "Basquetebol") {
                        $msg .= "<span class='badge rounded-pill text-bg-warning position-absolute top-0 end-0 mt-2 me-2'>
                                                    <i class='ti ti-ball-basketball me-1'></i>
                                                    <small>" . $row['modalidadeMarcacao'] . "</small>
                                                </span>";
                    }
                    $msg .= "<div class='row'>
                                        <div class='col-md-6'>
                                        <img src='" . $row['fotoCampoMarcacao'] . "' alt='Clube 1' class='img-fluid rounded border border-1 border-primary' style='height: 100px; width: 250px;'>
                                        </div>
                                        <div class='col-md-6'>
                                        <div class='text-center mt-sm-2'>
                                            <small class='fs-5'><i class='ti ti-calendar me-1'></i>" . $stringData . "</small><br>
                                            <small class='fs-5'><i class='ti ti-clock me-1'></i>" . $stringHora . "</small><br>
                                            <small class='fs-5'><i class='ti ti-map-pin me-1'></i>" . $row['nomeCampoMarcacao'] . "</small><br>
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
                                            <a href='./clube.php?id=" . $row['idClubeMarcacao'] . "'><span class='fs-4'>" . $row['nomeClubeMarcacao'] . "</span></a>
                                        </div>
                                        </div>
                                    </div>
                                    <div class='mt-2 mb-2'>
                                        <span class='fs-3'>Participantes</span>
                                    </div>
                                    <div class='mt-1 d-flex overflow-y-auto' style='min-height: 70px'>
                                        <div class='col-md-2 mb-2'>
                                            <a href='./perfil.php?id=" . $row['idAtletaHost'] . "'><img src='../../dist/" . $row['fotoAtletaHost'] . "' alt='" . $row['nomeAtletaHost'] . "' class='rounded-circle border border-2 border-success' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='" . $row['nomeAtletaHost'] . " (Host)' style='cursor: pointer;'></a>
                                        </div>";

                    $sql1 = "SELECT listagem_atletas_marcacao.id_marcacao AS idMarcacao, 
                            listagem_atletas_marcacao.id_atleta AS idAtleta, 
                            user.nome AS nomeAmigo,
                            user.foto AS fotoAmigo
                            FROM
                            listagem_atletas_marcacao
                            INNER JOIN
                            user ON listagem_atletas_marcacao.id_atleta = user.id
                            WHERE id_marcacao = " . $row['idMarcacao'] ."
                            AND listagem_atletas_marcacao.estado = 1";
                    $result1 = $conn->query($sql1);

                    if ($result1->num_rows > 0) {
                        while ($row1 = $result1->fetch_assoc()) {
                            if ($row1['idAtleta'] != $row['idAtletaHost']) {
                                if($row1['idAtleta'] == $_SESSION['id']) {
                                    $msg .= "<div class='col-md-2 mb-2'>
                                        <a href='./perfil.php?id=" . $row1['idAtleta'] . "'><img src='../../dist/" . $row1['fotoAmigo'] . "' alt='" . $row1['nomeAmigo'] . " (Tu)' class='rounded-circle border border-2 border-primary' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='" . $row1['nomeAmigo'] . " (Tu)' style='cursor: pointer;'></a>
                                    </div>";
                                } else {
                                    $msg .= "<div class='col-md-2 mb-2'>
                                    <a href='./perfil.php?id=" . $row1['idAtleta'] . "'><img src='../../dist/" . $row1['fotoAmigo'] . "' alt='" . $row1['nomeAmigo'] . "' class='rounded-circle' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='" . $row1['nomeAmigo'] . "' style='cursor: pointer;'></a>
                                    </div>";
                                }
                            }
                        }
                    }

                    $sql2 = "SELECT
                    modalidade.n_participantes_max,
                    COUNT(listagem_atletas_marcacao.id_marcacao) AS num_atletas_inscritos
                  FROM
                    modalidade
                  INNER JOIN
                    campo_clube ON modalidade.id = campo_clube.id_modalidade
                  INNER JOIN
                    marcacao ON campo_clube.id_campo = marcacao.id_campo
                  LEFT JOIN
                    listagem_atletas_marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao
                  WHERE
                    marcacao.id = ".$row['idMarcacao']."
                  AND 
                    listagem_atletas_marcacao.estado = 1
                  GROUP BY
                    modalidade.n_participantes_max;";

                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            for($i = 0; $i < ($row2['n_participantes_max'] - $row2['num_atletas_inscritos']); $i++) {
                                $msg .= "<div class='col-md-2 mb-2'>
                                            <div class='lugar-livre' data-toggle='tooltip' data-placement='top' title='Junta-te!' style='cursor: pointer;'>
                                        
                                            </div>
                                        </div>";
                            }
                        }
                    }

                    $msg .= "</div>
                                    <div class='row'>
                                        <div class='col-md-12 mt-4'>
                                            <button type='button' class='btn btn-success w-100' onclick='getModalJuntarMarcacao(" . $row['idMarcacao'] . ")'>Juntar</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>";
                }
            }
        } else {
            $contagem = 0;
            $msg .= "<div class='text-center mt-3 mb-3'><span class='fs-6 fw-bold'>Sem resultados!</span><p>De momento não existem marcações abertas que se apliquem a este contexto. Verifica mais tarde!</p></div>";
        }

        $conn->close();
        $resp = json_encode(array("msg" => $msg, "contagem" => $contagem));
        return ($resp);
    }



    function getModalJuntarMarcacao($idMarcacao) {
        $msg = "<button type='button' class='btn btn-primary text-white font-medium waves-effect text-start mb-3 mt-3'
                    data-bs-dismiss='modal' onclick='juntarMarcacao(".$idMarcacao.")'>
                    Sim
                </button>
                <button type='button' class='btn btn-light text-primary font-medium waves-effect text-start mb-3 mt-3'
                    data-bs-dismiss='modal'>
                    Não
                </button>";
        return ($msg);
    }

    function juntarMarcacao($idMarcacao) {
        global $conn;
        $msg = "";
        $flag = false;
        $icon = "";
        $title = "";

        $sql = "INSERT INTO listagem_atletas_marcacao VALUES (".$idMarcacao.", ".$_SESSION['id'].", 2, 1)";

        if($conn -> query($sql) === TRUE) {
            $flag = true;
            $title = "Successo";
            $msg = "Juntou-se a esta marcação!";
            $icon = "success";
        } else {
            $flag = false;
            $title = "Erro";
            $msg = "Não foi possível juntar-se a esta marcação!";
            $icon = "error";
        }
        $conn -> close();

        $resp = json_encode(array(
            "flag" => $flag,
            "title" => $title,
            "msg" => $msg,
            "icon" => $icon
        ));

        return ($resp);
    }
}
