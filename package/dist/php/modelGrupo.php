<?php

session_start();

require_once 'connection.php';

class Grupo
{

    function uploads($img, $id)
    {

        $dir = "../images/grupos/" . $id . "/";
        $dir1 = "images/grupos/" . $id . "/";
        $flag = false;
        $targetBD = "";

        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, TRUE)) {
                die("Erro não é possivel criar o diretório");
            }
        }
        if (array_key_exists('imagemGrupo', $img)) {
            if (is_array($img)) {
                if (is_uploaded_file($img['imagemGrupo']['tmp_name'])) {
                    $fonte = $img['imagemGrupo']['tmp_name'];
                    $ficheiro = $img['imagemGrupo']['name'];
                    $end = explode(".", $ficheiro);
                    $extensao = end($end);
                    $newName = "grupo" . date("YmdHis") . "." . $extensao;
                    $target = $dir . $newName;
                    $targetBD = $dir1 . $newName;
                    $flag = move_uploaded_file($fonte, $target);
                }
            }
        }
        return (json_encode(array(
            "flag" => $flag,
            "target" => $targetBD
        )));
    }

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
                                WHERE comunidade_atletas.estado = 1
                                AND comunidade_atletas.id_atleta = " . $_SESSION['id'] . ")
                        ) GROUP BY marcacao.id";


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

        $sql = "SELECT DISTINCT
                comunidade.id AS idComunidade,
                comunidade.nome AS nomeComunidade,
                comunidade.foto AS fotoComunidade,
                comunidade.id_atletaHost as idAtletaHost,
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
                AND comunidade_atletas.estado = 1
                AND comunidade.tipo_comunidade = 1
                LIMIT 12";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<div class='col-md-2'>
                            <div class='card hover-img shadow'>
                            <div class='d-flex flex-column p-3 align-items-center mt-3'>
                                <a href='./grupo.php?id=" . $row['idComunidade'] . "'><img src='../../dist/" . $row['fotoComunidade'] . "' class='img-fluid' style='max-width: 100px;'></a>
                                <span class='fs-4'>" . $row['nomeComunidade'] . "</span>";
                if ($row['idAtletaHost'] == $_SESSION['id']) {
                    $msg .= "<span class='fw-bolder'><i class='ti ti-award text-success me-1'></i>Host</span>";
                }
                $msg .= "<a href='./grupo.php?id=" . $row['idComunidade'] . "'>
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

    function getInfoGrupo($idGrupo)
    {
        global $conn;
        $msg = "";

        $sql = "SELECT comunidade.*, modalidade.descricao AS modalidadeGrupo FROM comunidade
        INNER JOIN 
        modalidade ON comunidade.id_modalidade = modalidade.id
        WHERE tipo_comunidade = 1
        AND comunidade.id = " . $idGrupo;

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<div class='p-2 d-flex flex-column align-items-center'>";
                if ($row['modalidadeGrupo'] == "Basquetebol") {
                    $msg .= "<span class='badge rounded-pill position-absolute ms-2 mt-2 top-0 start-0 text-bg-warning'>
                                <i class='ti ti-ball-basketball me-1'></i><small>" . $row['modalidadeGrupo'] . "</small>
                            </span>";
                } else if ($row['modalidadeGrupo'] == "Futsal") {
                    $msg .= "<span class='badge rounded-pill position-absolute ms-2 mt-2 top-0 start-0 text-bg-danger mt-2'>
                                <i class='ti ti-ball-football me-1'></i><small>" . $row['modalidadeGrupo'] . "</small>
                            </span>";
                } else if ($row['modalidadeGrupo'] == "Ténis") {
                    $msg .= "<span class='badge rounded-pill position-absolute ms-2 mt-2 top-0 start-0 text-bg-success mt-2'>
                                <i class='ti ti-ball-tennis me-1'></i><small>" . $row['modalidadeGrupo'] . "</small>
                            </span>";
                } else {
                    $msg .= "<span class='badge rounded-pill position-absolute ms-2 mt-2 top-0 start-0 text-bg-primary mt-2'>
                                <i class='ti ti-ball-tennis me-1'></i><small>" . $row['modalidadeGrupo'] . "</small>
                            </span>";
                }
                $maximoCaracteresDesc = 205;
                $descricao = substr($row['descricao'], 0, $maximoCaracteresDesc);

                if (strlen($row['descricao']) > $maximoCaracteresDesc) {
                    $ultimoEspaco = strrpos(substr($descricao, 0, $maximoCaracteresDesc), ' ');
                    $descricao = substr($descricao, 0, $ultimoEspaco) . " (...)";
                }

                $msg .= "<img src='../../dist/" . $row['foto'] . "' class='mt-3 rounded-circle' width='130' height='130' alt='" . $row['nome'] . "' />";
                if ($row['id_atletaHost'] == $_SESSION['id']) {
                    $msg .= "<span class='fw-bolder mb-2'><i class='ti ti-award text-success me-1'></i>Host</span>";
                }
                $msg .= "<h5 class='fw-semibold mb-1 pb-2 fs-7'>" . $row['nome'] . "</h5>";
                if($row['estado'] == 'aberto'){
                    $msg .= "<span class='badge badge-primary rounded-pill bg-light text-dark'><i class='ti ti-brand-open-source me-1 '></i>".ucfirst(strtolower($row['estado']))."</span><br>
                        <div class='px-2 text-center'>
                            <span class=''>" . $descricao . "</span>
                        </div>
                    </div>";
                } else {
                    $msg .= "<span class='badge badge-primary rounded-pill bg-light text-dark'><i class='ti ti-lock me-1 '></i>".ucfirst(strtolower($row['estado']))."</span><br>
                        <div class='px-2 text-center'>
                            <span class=''>" . $descricao . "</span>
                        </div>
                    </div>";
                }
            }
        }

        $conn->close();
        return $msg;
    }

    function getMarcacoesConcluidasGrupo($id, $offset, $porPagina)
    {
        global $conn;
        $msg = "";

        $offset = max(0, $offset); // Ter a certeza que o offset não é inferior a 0, se sim, mete a 0


        $sqlContagem = "SELECT COUNT(*) AS total FROM listagem_atletas_marcacao 
        INNER JOIN marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao 
        INNER JOIN campo_clube ON marcacao.id_campo = campo_clube.id_campo 
        INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id 
        INNER JOIN clube ON campo_clube.id_clube = clube.id_clube 
        INNER JOIN user ON clube.id_clube = user.id
        INNER JOIN campo ON campo_clube.id_campo = campo.id
        INNER JOIN comunidade_atletas ON listagem_atletas_marcacao.id_atleta = comunidade_atletas.id_atleta
        INNER JOIN comunidade ON comunidade_atletas.id_comunidade = comunidade.id
        WHERE listagem_atletas_marcacao.votacao = 1 
            AND listagem_atletas_marcacao.estado = 1
            AND comunidade.id = " . $id . "
            AND comunidade.id_modalidade = modalidade.id
        ";

        $resultadoContagem = $conn->query($sqlContagem);
        $totalRows = $resultadoContagem->fetch_assoc();
        $itemsTotais = $totalRows['total'];


        $sql = "SELECT DISTINCT
                    marcacao.id as idMarcacao,
                    marcacao.id_atleta as idAtletaHost,
                    marcacao.data_inicio AS dataInicioMarcacao, 
                    marcacao.hora_inicio AS horaInicioMarcacao,
                    marcacao.hora_fim AS horaMarcFim,
                    modalidade.id AS idModalidadeCampo,  
                    modalidade.descricao AS modalidadeMarcacao, 
                    user.id AS idClube,
                    user.nome AS nomeClube, 
                    user.foto as fotoClube, 
                    user.nome AS nomeClube, 
                    campo.foto AS fotoCampoMarcacao,
                    campo.nome AS nomeCampoMarcacao,
                    comunidade.id_modalidade AS idModalidadeGrupo
                FROM listagem_atletas_marcacao 
                INNER JOIN marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao 
                INNER JOIN campo_clube ON marcacao.id_campo = campo_clube.id_campo 
                INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id 
                INNER JOIN clube ON campo_clube.id_clube = clube.id_clube 
                INNER JOIN user ON clube.id_clube = user.id
                INNER JOIN campo ON campo_clube.id_campo = campo.id
                INNER JOIN comunidade_atletas ON listagem_atletas_marcacao.id_atleta = comunidade_atletas.id_atleta
                INNER JOIN comunidade ON comunidade_atletas.id_comunidade = comunidade.id
                WHERE listagem_atletas_marcacao.votacao = 1 
                    AND listagem_atletas_marcacao.estado = 1
                    AND comunidade.id = " . $id . "
                    AND comunidade.id_modalidade = modalidade.id
                ORDER BY marcacao.data_inicio DESC
                LIMIT " . $offset . ", " . $porPagina;

        $result = $conn->query($sql);

        $paginasTotais = ceil($itemsTotais / $porPagina);
        $paginaAtual = ceil(($offset + 1) / $porPagina);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $data = new DateTime($row['dataInicioMarcacao']);
                $stringData = $data->format('d/m/Y');

                $hora = new DateTime($row['horaInicioMarcacao']);
                $stringHora = $hora->format('H:i');

                $msg .= "<div class='card shadow border hover-img3'>
                            <div class='p-3'>
                                <div class='row'>
                                    <div class='col-6 col-md-6'>
                                        <span class='fs-4 text-dark'>Nº: <span class='fw-bolder'>" . $row['idMarcacao'] . "</span></span>
                                    </div>
                                    <div class='col-6 col-md-6 d-flex justify-content-end'>
                                        <button type='button' class='btn btn-success disabled btn-sm'><i class='ti ti-check me-1'></i>Concluída</button>
                                    </div>
                                    <div class='col-6 col-sm-6 col-md-6 col-lg-3 mt-3'>
                                        <img src='" . $row['fotoCampoMarcacao'] . "' alt='" . $row['nomeCampoMarcacao'] . "'
                                                 class=' img-fluid object-fit-fill rounded-2 border border-1 border-primary' style='max-width: 80%'>
                                    </div>
                                    <div class='col-6 col-sm-6 col-md-6 col-lg-3 mt-3'>
                                        <div class='row d-flex flex-column gap-1'>
                                            <a href='./clube.php?id=" . $row['idClube'] . "'><span class='fs-3'><i class='ti ti-building me-1'></i>" . $row['nomeClube'] . "</span></a>
                                            <span class='fs-3'><i class='ti ti-calendar me-1'></i>" . $stringData . "</span>
                                            <span class='fs-3'><i class='ti ti-clock me-1'></i>" . $stringHora . "</span>
                                            <span class='fs-3'><i class='ti ti-map-pin me-1'></i>" . $row['nomeCampoMarcacao'] . "</span>
                                        </div>
                                    </div>
                                    <div class='col-12 col-md-6 col-sm-6 mt-3'>
                                        <div class='row gap-1 overflow-y-auto' style='min-height: 70px'>
                                            <small class='fs-3'>Participantes</small><br>";



                $sql1 = "SELECT
                            CASE
                                WHEN listagem_atletas_marcacao.id_atleta = marcacao.id_atleta THEN TRUE
                                ELSE FALSE
                            END AS isHost,
                            listagem_atletas_marcacao.id_atleta AS idAtleta,
                            user.foto AS fotoAtleta,
                            user.nome AS nomeAtleta
                        FROM
                            listagem_atletas_marcacao
                        INNER JOIN
                            marcacao ON listagem_atletas_marcacao.id_marcacao = marcacao.id
                        INNER JOIN
                            user AS user ON listagem_atletas_marcacao.id_atleta = user.id      
                        WHERE
                            listagem_atletas_marcacao.id_marcacao = " . $row['idMarcacao'] . "
                            AND listagem_atletas_marcacao.estado = 1
                            AND listagem_atletas_marcacao.votacao = 1
                        LIMIT 6";

                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) {
                    while ($row1 = $result1->fetch_assoc()) {
                        if ($row1['isHost'] == 1) {
                            $msg .= "<div class='col-2'>
                                        <div class='d-flex align-items-center mt-2'>
                                            <a href='./perfil.php?id=" . $row1['idAtleta'] . "'><img alt='" . $row1['nomeAtleta'] . " (Host)' src='../../dist/" . $row1['fotoAtleta'] . "' data-toggle='tooltip' data-placement='top' title='" . $row1['nomeAtleta'] . " (Host)' class='object-fit-cover rounded-circle border border-2 border-success' width='40' height='40'></a>
                                        </div>
                                    </div>";
                        } else if ($row1['idAtleta'] == $_SESSION['id']) {
                            $msg .= "<div class='col-2'>
                                        <div class='d-flex align-items-center mt-2'>
                                            <a href='./perfil.php?id=" . $row1['idAtleta'] . "'><img alt='" . $row1['nomeAtleta'] . " (Host)' src='../../dist/" . $row1['fotoAtleta'] . "' data-toggle='tooltip' data-placement='top' title='" . $row1['nomeAtleta'] . " (Tu)' class='object-fit-cover rounded-circle border border-2 border-primary' width='40' height='40'></a>
                                        </div>
                                    </div>";
                        } else {
                            $msg .= "<div class='col-2'>
                                        <div class='d-flex align-items-center mt-2'>
                                            <a href='./perfil.php?id=" . $row1['idAtleta'] . "'><img alt='Participant 1' src='../../dist/" . $row1['fotoAtleta'] . "' data-toggle='tooltip' data-placement='top' title='" . $row1['nomeAtleta'] . "' class='rounded-circle object-fit-cover' width='40' height='40'></a>
                                        </div>
                                    </div>";
                        }
                    }


                    $msg .= "</div>";
                    $msg .= "</div></div></div></div>";
                }
            }
        } else {
            $msg .= "<div class='text-center mt-5'>
                            <h4>Sem resultados!</h4>
                            <p>Sem marcações concluídas de Atletas deste Grupo.</p>
                        </div>";
        }

        $conn->close();
        $data = array('msg' => $msg, 'paginasTotais' => $paginasTotais, 'paginaAtual' => $paginaAtual, 'total' => $itemsTotais);
        return json_encode($data);
    }

    function getBotoesMenus($id)
    {
        global $conn;

        $idAtletaHost = 0;
        $userIsHost = false;
        $userIsMember = false;
        $userIsPending = false;

        $sql = "SELECT id_atletaHost FROM comunidade WHERE comunidade.id = " . $id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $idAtletaHost = $row['id_atletaHost'];
        }

        if ($_SESSION['id'] == $idAtletaHost) {
            $userIsHost = true;
        }

        $sql1 = "SELECT id_atleta, estado FROM comunidade_atletas WHERE id_comunidade = " . $id;
        $resultSql1 = $conn->query($sql1);

        if ($resultSql1->num_rows > 0) {
            while ($rowSql1 = $resultSql1->fetch_assoc()) {
                if ($_SESSION['id'] == $rowSql1['id_atleta'] && $rowSql1['estado'] == 1) {
                    $userIsMember = true;
                    break;
                } else if($_SESSION['id'] == $rowSql1['id_atleta'] && $rowSql1['estado'] == 0) {
                    $userIsPending = true;
                }
            }
        }

        $conn->close();

        return json_encode(array('userIsHost' => $userIsHost, 'userIsMember' => $userIsMember, 'userIsPending' => $userIsPending));
    }

    function sairGrupo($id)
    {
        global $conn;
        $msg = "";

        $sql = "DELETE FROM comunidade_atletas WHERE id_atleta = " . $_SESSION['id'] . " AND id_comunidade = " . $id;

        if ($conn->query($sql) === TRUE) {
            $msg .= "Saíste deste grupo com sucesso!";
        }

        $conn->close();

        return $msg;
    }

    function juntarGrupo($id)
    {
        global $conn;
        $msg = "";
        $flag = false;

        $sql2 = "SELECT comunidade.estado FROM comunidade WHERE comunidade.id = ".$id;

        $sql = "";
        $result = $conn -> query($sql2);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if($row['estado'] == "aberto"){

                    $sql = "INSERT INTO comunidade_atletas (id_atleta, id_comunidade, estado) VALUES (" . $_SESSION['id'] . ", " . $id . ", 1)";
                    $flag = true;

                } else {
                    $sql = "INSERT INTO comunidade_atletas (id_atleta, id_comunidade, estado) VALUES (" . $_SESSION['id'] . ", " . $id . ", 0)";

                }
            }
        }

        if($conn -> query($sql) === TRUE) {
            if($flag) {
                $msg .= "Entraste neste grupo com sucesso!";
            } else {
                $msg .= "O teu pedido para te juntares foi enviado com sucesso!";
            }
        } else {
            $msg .= "Não foi possível juntar ou fazer pedido a este grupo.";
        }
        $conn->close();

        return $msg;
    }

    function getInfoEditGrupo($id)
    {
        global $conn;
        $msg = "";
        $foto = "";

        $sql = "SELECT 
                comunidade.id AS idComunidade,
                comunidade.foto AS fotoComunidade,
                tipo_comunidade.descricao AS tipoComunidade,
                comunidade.nome AS nomeComunidade,
                comunidade.descricao AS descricaoComunidade,
                modalidade.descricao AS modalidadeComunidade,
                user.nome AS nomeAtletaHost
                FROM
                comunidade
                INNER JOIN
                modalidade ON comunidade.id_modalidade = modalidade.id
                INNER JOIN
                user ON comunidade.id_atletaHost = user.id
                INNER JOIN 
                tipo_comunidade ON comunidade.tipo_comunidade = tipo_comunidade.id 
                WHERE comunidade.tipo_comunidade = 1
                AND comunidade.id = " . $id;

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $foto .= $row['fotoComunidade'];
                $msg .= "<form class='row g-3'>
                            <div class='col-md-12'>
                                <div class='d-flex flex-column gap-3 align-items-center'>
                                    <img src='../../dist/" . $row['fotoComunidade'] . "' class='img-fluid img-thumbnail' width='200' alt='' id='imgGrupo'>
                                    <div class='col-md-6 text-center'>
                                        <input type='file' class='form-control' id='imgGrupoEdit' accept='image/png, image/gif, image/jpeg' onchange='previewImagem()'>
                                        <small class='mb-0'>Permitido JPG ou PNG. Tamanho máximo de 10MB.</small>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-7'>
                                <label for='nomeGrupoEdit' class='form-label'>Nome</label>
                                <input type='text' class='form-control' id='nomeGrupoEdit' value='" . $row['nomeComunidade'] . "'>
                            </div>
                            <div class='col-md-5'>
                                <label for='modalidadeGrupoEdit' class='form-label'>Modalidade</label>
                                <svg xmlns='http://www.w3.org/2000/svg' class='ms-1 icon icon-tabler icon-tabler-info-circle' data-toggle='tooltip' data-bs-placement='top' width='20' height='20' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round' aria-label='Informação' data-bs-original-title='A escolha da Modalidade na criação do Grupo é permanente e portanto não pode ser alterada.'>
                                    <path stroke='none' d='M0 0h24v24H0z' fill='none'></path>
                                    <path d='M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0'></path>
                                    <path d='M12 9h.01'></path>
                                    <path d='M11 12h1v4h1'></path>
                                </svg>
                                <input type='text' disabled class='form-control' id='modalidadeGrupoEdit' value='" . $row['modalidadeComunidade'] . "'>
                            </div>
                            <div class='col-12'>
                                <label for='inputAddress' class='form-label'>Descrição</label>
                                <textarea name='' class='form-control' cols='30' rows='8' id='descricaoGrupoEdit' maxlength='500'>" . $row['descricaoComunidade'] . "</textarea>
                            </div>
                        </form>";
            }
        }

        $conn->close();

        $resp = json_encode(array("msg" => $msg, "img" => $foto));

        return $resp;
    }

    function guardaEditGrupo($id, $nome, $descricao, $imagem)
    {
        global $conn;
        $icon = "success";
        $msg = "Alterado com sucesso!";


        $sql = "UPDATE comunidade SET nome = '" . $nome . "', descricao = '" . $descricao . "' WHERE id = " . $id;

        $upload = $this->uploads($imagem, $id);
        $upload = json_decode($upload, TRUE);

        if ($conn->query($sql) === TRUE) {
            if ($upload['flag']) {
                $sql1 = "UPDATE comunidade SET foto = '" . $upload['target'] . "' WHERE id = '" .  $id . "'";
                if ($conn->query($sql1) === FALSE) {
                    $icon = "error";
                    $msg = "Não foi possível guardar as alterações na foto de perfil.";
                }
            }
        } else {
            $icon = "error";
            $msg = "Não foi possível guardar as alterações.";
        }

        $conn->close();

        return json_encode(array(
            "icon" => $icon,
            "msg" => $msg
        ));
    }

    function apagarGrupo($id)
    {
        global $conn;
        $title = "";
        $icon = "";
        $msg = "";

        $sql = "DELETE FROM comunidade WHERE id = " . $id;
        $sql1 = "DELETE FROM comunidade_atletas WHERE id_comunidade = " . $id;
        $sql2 = "DELETE FROM comunidade_badges WHERE id_comunidade = " . $id;

        if ($conn->query($sql2) === TRUE && $conn->query($sql1) === TRUE && $conn->query($sql) === TRUE) {
            $msg = "Apagado com sucesso!";
            $title = "Sucesso";
            $icon = "success";
        } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            $title = "Erro";
            $icon = "error";
        }

        $conn->close();

        $resp = json_encode(array(
            "title" => $title,
            "icon" => $icon,
            "msg" => $msg
        ));

        return $resp;
    }

    function getMembrosGrupo($id)
    {
        global $conn;
        $msg = "";

        $sql = "SELECT 
                user.id,
                user.foto,
                user.nome,
                concelho.descricao as concelho 
                FROM
                user
                INNER JOIN
                comunidade_atletas ON user.id = comunidade_atletas.id_atleta
                INNER JOIN
                concelho ON user.localidade = concelho.id
                INNER JOIN
                comunidade ON comunidade_atletas.id_comunidade = comunidade.id
                WHERE
                comunidade_atletas.id_comunidade = " . $id . "
                AND comunidade_atletas.estado = 1
                ORDER BY
                comunidade.id_atletaHost = user.id DESC, nome ASC";


        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['id'] == $_SESSION['id']) {
                    $msg .= "<li class='p-1 mb-1 bg-hover-light-black'>
                                <div class='d-flex justify-content-between align-items-center'>
                                    <div class='d-flex align-items-center gap-3'>
                                        <i class='ti ti-user text-success fs-6' data-toggle='tooltip' data-bs-placement='top' title='Host'></i>
                                        <a href='./perfil.php?id=" . $row['id'] . "'><img src='../../dist/" . $row['foto'] . "' class='rounded-circle border border-2 border-success' width='40' height='40'></a>
                                        <a href='./perfil.php?id=" . $row['id'] . "'><span class='fs-4 text-black fw-normal d-block'>" . $row['nome'] . "</span></a>
                                        <span class='fw-bolder '><i class='ti ti-award text-success me-1'></i>Host</span>
                                    </div>
                                </div>   
                            </li>";
                } else {
                    $msg .= "<li class='p-1 mb-1 bg-hover-light-black'>
                                <div class='d-flex justify-content-between align-items-center'>
                                    <div class='d-flex align-items-center gap-3'>
                                        <i class='ti ti-user fs-6' data-toggle='tooltip' data-bs-placement='top' title='Membro'></i>
                                        <a href='./perfil.php?id=" . $row['id'] . "'><img src='../../dist/" . $row['foto'] . "' class='rounded-circle border border-1 border-primary' width='40' height='40'></a>
                                        <a href='./perfil.php?id=" . $row['id'] . "'><span class='fs-4 text-black fw-normal d-block'>" . $row['nome'] . "</span></a>
                                        <span class=''><i class='ti ti-map-pin me-1'></i>" . $row['concelho'] . "</span>
                                    </div>
                                    <div class='d-flex align-items-center gap-2'>
                                        <a href='./perfil.php?id=" . $row['id'] . "'><button class='btn btn-sm btn-success' data-toggle='tooltip' data-bs-placement='top' title='Ver Perfil'><i class='ti ti-plus'></i></button></a>
                                        <button class='btn btn-sm text-white' data-toggle='tooltip' data-bs-placement='top' title='Remover' style='background-color: #b80000;' onmouseover=\"this.style.backgroundColor = '#cf0202';\" onmouseout=\"this.style.backgroundColor = '#b80000';\" onclick='removerMembroGrupo(" . $row['id'] . ")'><i class='ti ti-trash'></i></button>
                                    </div>
                                </div>   
                            </li>";
                }
            }
        } else {
            $msg .= "<li class='p-1 mb-1 bg-hover-light-black'>
                        <div class='d-flex justify-content-between align-items-center'>
                            <div class='d-flex align-items-center gap-3'>
                                <i class='ti ti-user fs-6' data-toggle='tooltip' data-bs-placement='top' title='Atleta'></i>
                                <span class='fs-4 text-black fw-normal d-block'>Sem atletas</span>
                            </div>
                            <div class='d-flex align-items-center'>
                                <button class='btn btn-sm' onclick=''></button>
                            </div>
                        </div>   
                    </li>";
        }

        $conn->close();

        return $msg;
    }

    function removerMembroGrupo($idUser, $idGrupo)
    {
        global $conn;
        $title = "";
        $icon = "";
        $msg = "";

        $sql = "DELETE FROM comunidade_atletas WHERE id_atleta = " . $idUser . " AND id_comunidade = " . $idGrupo;

        if ($conn->query($sql) === TRUE) {
            $title = "Sucesso";
            $icon = "success";
            $msg .= "Removeste este membro do Grupo com sucesso!";
        } else {
            $title = "Erro";
            $icon = "error";
            $msg .= "Não foi possível eliminar este membro. Por favor tenta de novo mais tarde!";
        }

        $conn->close();

        return json_encode(array(
            "title" => $title,
            "icon" => $icon,
            "msg" => $msg
        ));
    }

    function registaGrupo($nome, $descricao, $modalidade, $imagem, $estado)
    {
        global $conn;
        $icon = "success";
        $msg = "Grupo criado com sucesso!";
        $title = "Sucesso";


        $sql = "INSERT INTO comunidade (tipo_comunidade, nome, descricao, id_modalidade, id_atletaHost, estado) VALUES (1, '" . $nome . "', '" . $descricao . "', '" . $modalidade . "', '" . $_SESSION['id'] . "', '".$estado."')";

        if ($conn->query($sql) === TRUE) {

            $lastId = mysqli_insert_id($conn);

            $sql2 = "INSERT INTO comunidade_atletas (id_comunidade, id_atleta, estado) VALUES (" . $lastId . ", " . $_SESSION['id'] . ", 1)";

            if ($conn->query($sql2) === TRUE) {

                $upload = $this->uploads($imagem, $lastId);
                $upload = json_decode($upload, TRUE);

                if ($upload['flag']) {
                    $sql1 = "UPDATE comunidade SET foto = '" . $upload['target'] . "' WHERE id = '" .  $lastId . "'";
                    if ($conn->query($sql1) === FALSE) {
                        $icon = "error";
                        $msg = "Não foi possível dar upload a esta foto. Tenta novamente mais tarde.";
                        $title = "Erro";
                    }
                }
            } else {
                $icon = "error";
                $msg = "Não foi possível inserir-te no grupo que acabaste de criar. Tenta novamente mais tarde.";
                $title = "Erro";
            }
        } else {
            $icon = "error";
            $msg = "Não foi possível criar este Grupo. Tenta novamente mais tarde.";
            $title = "Erro";
        }

        $conn->close();

        return json_encode(array(
            "icon" => $icon,
            "msg" => $msg,
            "title" => $title,
            "id" => $lastId
        ));
    }


    function getEstatisticasGrupo($idGrupo){
        global $conn;
        $sql = "SELECT modalidade.descricao 
        FROM modalidade 
        WHERE modalidade.id = (
            SELECT id_modalidade
            FROM comunidade 
            WHERE id = ".$idGrupo.")";
        $result = $conn -> query($sql);
        $res = "";
        if($result -> num_rows>0){
            while($row = $result -> fetch_assoc()){
                if($row['descricao'] == "Basquetebol"){
                    $res = $this -> getEstatisticasGrupoBasqFutsal($idGrupo, "info_basquetebol");
                }else if ($row['descricao'] == "Futsal"){
                    $res = $this -> getEstatisticasGrupoBasqFutsal($idGrupo, "info_futsal");
                }else if($row['descricao'] == "Padel"){
                    $res = $this -> getEstatisticasGrupoPadelTenis($idGrupo, "info_padel");
                }else{
                    $res = $this -> getEstatisticasGrupoPadelTenis($idGrupo, "info_tenis");
                }
            }
        }  
        $conn->close();
        return json_encode($res); 
    }

    function getEstatisticasGrupoPadelTenis($idGrupo, $nome){
        global $conn;
        $percVit = 0;
        $percSetsGanhos = 0;
        $percMvp = 0;
        $sql = "SELECT *
        FROM ".$nome."
        WHERE id_atleta IN (
            SELECT id_atleta
            FROM comunidade_atletas
            WHERE id_comunidade = '".$idGrupo."'
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


    function getEstatisticasGrupoBasqFutsal($idGrupo, $nome){
        global $conn;
        $percVit = 0;
        $percMvp = 0;
        $sql = "SELECT *
        FROM ".$nome."
        WHERE id_atleta IN (
            SELECT id_atleta
            FROM comunidade_atletas
            WHERE id_comunidade = '".$idGrupo."'
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
