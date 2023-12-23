<?php

session_start();

require_once 'connection.php';

class Grupo
{
    function getMarcacoesAbertasGrupos()
    {
        global $conn;
        $msg = "";
        $contagem = 0;

        $sql = "SELECT 
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
                    user_clube.nome AS nomeClubeMarcacao,
                    comunidade.id AS idComunidade,
                    comunidade.nome AS nomeComunidade,
                    comunidade.foto AS fotoComunidade
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
                        INNER JOIN comunidade_atletas ON  comunidade_atletas.id_atleta = user_atleta.id
                        INNER JOIN comunidade ON comunidade_atletas.id_comunidade = comunidade.id 
                    WHERE marcacao.tipo = 'aberta'
                    AND listagem_atletas_marcacao.votacao = '2'
                        AND listagem_atletas_marcacao.id_atleta != " . $_SESSION['id'] . "
                        AND marcacao.id_atleta != " . $_SESSION['id'] . "
                    AND marcacao.id NOT IN (
                            SELECT listagem_atletas_marcacao.id_marcacao 
                            FROM listagem_atletas_marcacao 
                            WHERE listagem_atletas_marcacao.id_atleta  = " . $_SESSION['id'] . "
                    )          
                    AND marcacao.id_atleta IN (
                            SELECT comunidade_atletas.id_atleta
                            FROM comunidade_atletas
                            INNER JOIN comunidade 
                                ON comunidade.id = comunidade_atletas.id_comunidade
                                WHERE comunidade.tipo_comunidade = 1 
                                AND comunidade_atletas.id_comunidade IN 
                                (SELECT comunidade_atletas.id_comunidade
                                FROM comunidade_atletas
                                WHERE comunidade_atletas.id_atleta = " . $_SESSION['id'] . ")
                        ) ";


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
                            WHERE id_marcacao = " . $row['idMarcacao'] . "
                            AND listagem_atletas_marcacao.estado = 1";
                    $result1 = $conn->query($sql1);

                    if ($result1->num_rows > 0) {
                        while ($row1 = $result1->fetch_assoc()) {
                            if ($row1['idAtleta'] != $row['idAtletaHost']) {
                                if ($row1['idAtleta'] == $_SESSION['id']) {
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
                    marcacao.id = " . $row['idMarcacao'] . "
                  AND 
                    listagem_atletas_marcacao.estado = 1
                  GROUP BY
                    modalidade.n_participantes_max;";

                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            for ($i = 0; $i < ($row2['n_participantes_max'] - $row2['num_atletas_inscritos']); $i++) {
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

    function getGruposUser()
    {
        global $conn;
        $msg = "";

        $sql = "SELECT 
                comunidade.id AS idComunidade,
                comunidade.nome AS nomeComunidade,
                comunidade.foto AS fotoComunidade,
                tipo_comunidade.descricao AS tipoComunidade,
                modalidade.descricao AS tipoModalidade
                FROM 
                comunidade
                INNER JOIN
                comunidade_atletas ON comunidade.id = comunidade_atletas.id_comunidade
                INNER JOIN
                modalidade ON comunidade.id_modalidade = modalidade.id
                INNER JOIN 
                tipo_comunidade ON comunidade.tipo_comunidade = tipo_comunidade.id
                WHERE comunidade_atletas.id_atleta = " . $_SESSION['id'] . "
                AND comunidade.tipo_comunidade = 1
                LIMIT 12";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<div class='col-md-2'>
                            <div class='card hover-img shadow'>
                            <div class='d-flex flex-column p-3 align-items-center mt-3'>
                                <a href='./grupo.php?id=" . $row['idComunidade'] . "'><img src='../../dist/" . $row['fotoComunidade'] . "' class='img-fluid' style='max-width: 100px;'></a>
                                <span class='fs-4'>" . $row['nomeComunidade'] . "</span>
                                <a href='./grupo.php?id=" . $row['idComunidade'] . "'>
                                    <button class='btn btn-primary btn-sm mt-3'>Ver</button>
                                </a>";
                if ($row['tipoModalidade'] == "Ténis") {
                    $msg .= "<span class='badge bg-success rounded-pill position-absolute top-0 end-0 mt-2 me-2'><i class='ti ti-ball-tennis me-1'></i>Ténis</span>";
                } else if ($row['tipoModalidade'] == "Futsal") {
                    $msg .= "<span class='badge bg-danger rounded-pill position-absolute top-0 end-0 mt-2 me-2'><i class='ti ti-ball-football me-1'></i>Futsal</span>";
                } else if ($row['tipoModalidade'] == "Basquetebol") {
                    $msg .= "<span class='badge bg-danger rounded-pill position-absolute top-0 end-0 mt-2 me-2'><i class='ti ti-ball-basketball me-1'></i>Basquetebol</span>";
                } else {
                    $msg .= "<span class='badge bg-primary rounded-pill position-absolute top-0 end-0 mt-2 me-2'><i class='ti ti-ball-tennis me-1'></i>Padel</span>";
                }


                $msg .= "</div>
                    </div>
                </div>";
            }
        } else {
            $msg .= "<div class='text-center mt-3 mb-3'><span class='fs-6 fw-bold'>Sem resultados!</span><p>De momento não estás associado a nenhum Grupo. Podes criar o teu próprio no botão no canto superior direito, ou juntares-te a Grupos existentes!</p></div>";
        }

        $conn->close();

        return ($msg);
    }

    function getAtletasGrupo($id, $offset, $porPagina)
    {
        global $conn;
        $msg = "";

        $offset = max(0, $offset); // Ter a certeza que o offset não é inferior a 0, se sim, mete a 0

        $sqlContagem = "SELECT COUNT(*) AS total FROM user
        INNER JOIN
        comunidade_atletas ON user.id = comunidade_atletas.id_atleta
        WHERE comunidade_atletas.id_comunidade = " . $id;

        $resultadoContagem = $conn->query($sqlContagem);
        $totalRows = $resultadoContagem->fetch_assoc();
        $itemsTotais = $totalRows['total'];

        $sql = "SELECT * 
        FROM
        user
        INNER JOIN
        comunidade_atletas ON user.id = comunidade_atletas.id_atleta
        WHERE comunidade_atletas.id_comunidade = " . $id. "
        LIMIT ".$offset.", ".$porPagina;

        $result = $conn->query($sql);

        $paginasTotais = ceil($itemsTotais / $porPagina);
        $paginaAtual = ceil(($offset + 1) / $porPagina);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<div class='col-md-2'>
                                <a href='./perfil.php?id=" . $row['id'] . "'><img src='../../dist/" . $row['foto'] . "' data-toggle='tooltip' data-bs-placement='top' title='" . $row['nome'] . "' class='img-fluid rounded-circle border border-1 border-primary' style='max-width: 50px;'></a>
                        </div>";
            }
        }

        $conn->close();
        $data = array('msg' => $msg, 'paginasTotais' => $paginasTotais, 'paginaAtual' => $paginaAtual, 'total' => $itemsTotais);
        return json_encode($data);
    }

    function getInfoGrupo($idGrupo) {
        global $conn;
        $msg = "";

        $sql = "SELECT comunidade.*, modalidade.descricao AS modalidadeGrupo FROM comunidade
        INNER JOIN 
        modalidade ON comunidade.id_modalidade = modalidade.id
        WHERE tipo_comunidade = 1
        AND comunidade.id = " . $idGrupo;

        $result = $conn -> query($sql);

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<div class='p-2 d-flex flex-column align-items-center'>";
                if($row['modalidadeGrupo'] == "Basquetebol") {
                    $msg .= "<span class='badge rounded-pill position-absolute ms-2 mt-2 top-0 start-0 text-bg-warning'>
                                <i class='ti ti-ball-basketball me-1'></i><small>" . $row['modalidadeGrupo'] . "</small>
                            </span>";
                } else if($row['modalidadeGrupo'] == "Futsal") {
                    $msg .= "<span class='badge rounded-pill position-absolute ms-2 mt-2 top-0 start-0 text-bg-danger mt-2'>
                                <i class='ti ti-ball-football me-1'></i><small>" . $row['modalidadeGrupo'] . "</small>
                            </span>";
                } else if($row['modalidadeGrupo'] == "Ténis") {
                    $msg .= "<span class='badge rounded-pill position-absolute ms-2 mt-2 top-0 start-0 text-bg-success mt-2'>
                                <i class='ti ti-ball-tennis me-1'></i><small>" . $row['modalidadeGrupo'] . "</small>
                            </span>";
                } else {
                    $msg .= "<span class='badge rounded-pill position-absolute ms-2 mt-2 top-0 start-0 text-bg-primary mt-2'>
                                <i class='ti ti-ball-tennis me-1'></i><small>" . $row['modalidadeGrupo'] . "</small>
                            </span>";
                }
                $maximoCaracteresDesc = 150; 
                $descricao = substr($row['descricao'], 0, $maximoCaracteresDesc);

                if (strlen($row['descricao']) > $maximoCaracteresDesc) {
                    $ultimoEspaco = strrpos(substr($descricao, 0, $maximoCaracteresDesc), ' ');
                    $descricao = substr($descricao, 0, $ultimoEspaco) . " (...)"; 
                }
                
                $msg .= "<img src='../../dist/" . $row['foto'] . "' class='mt-2 rounded-circle' width='130' height='130' alt='" . $row['nome'] . "' />
                        <h5 class='fw-semibold mb-1 pb-2 fs-7'>" . $row['nome'] . "</h5>
                        <span class='text-center'>" . $descricao . "</span>
                    </div>";
            }
        }

        $conn->close();
        return $msg;
    }
}
