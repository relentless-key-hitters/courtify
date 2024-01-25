<?php
session_start();
require_once 'connection.php';

class Amigo
{
    /*Pedro*/
    function getAmigos($userId) {
        global $conn;
        $msg = "";
        $contagem = 0;

        $sql = "SELECT
                    user.nome AS nomeAmigo,
                    user.id AS idAmigo,
                    user.foto AS fotoAmigo,
                    user.localidade AS localidadeAmigo,
                    user.telemovel AS telemovelAmigo,
                    user.email AS emailAmigo,
                    user.nif AS nifAmigo,
                    COUNT(*) AS contagem
                FROM amigo
                INNER JOIN (
                    SELECT 
                        id_atleta1,
                        id_atleta2,
                        amigo.estado as estado,
                        CASE
                            WHEN id_atleta1 = ".$userId." THEN id_atleta2
                            WHEN id_atleta2 = ".$userId." THEN id_atleta1
                            ELSE NULL
                        END AS matched_column
                    FROM amigo
                    WHERE id_atleta1 = ".$userId." OR id_atleta2 = ".$userId."
                    AND amigo.estado = 1
                ) AS subquery ON subquery.id_atleta1 = amigo.id_atleta1 OR subquery.id_atleta2 = amigo.id_atleta2
                INNER JOIN atleta ON atleta.id_atleta = subquery.matched_column
                INNER JOIN user ON atleta.id_atleta = user.id
                WHERE subquery.estado = 1
                GROUP BY nomeAmigo, fotoAmigo, localidadeAmigo, telemovelAmigo, emailAmigo, nifAmigo";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $contagem++;
                $msg .= "<div class='col-sm-6 col-lg-4'>
                            <div class='card hover-img'>
                                <div class='card-body p-4 text-center border-bottom'>
                                    <a href='./perfil.php?id=".$row['idAmigo']."'>
                                        <img src='../../dist/".$row['fotoAmigo']."' alt='' class='rounded-circle mb-3'
                                            height='100' width='100' style='border: 2px solid transparent; border-radius: 50%; transition: border-color 0.3s;' onmouseover='this.style.borderColor=\"#044967\";' onmouseout='this.style.borderColor=\"transparent\";'>
                                    </a>
                        

                                    <a href='./perfil.php?id=".$row['idAmigo']."' style='text-decoration: none;'>
                                        <h6 class='fw-semibold mb-0' style='color: #000; transition: color 0.3s;' onmouseover='this.style.color=\"#044967\";' onmouseout='this.style.color=\"#000\";'>
                                            ".$row['nomeAmigo']."
                                        </h6>
                                    </a>
                                <span class='text-dark fs-2'>Futebol</span>
                            </div>";
                
                if($userId == $_SESSION['id']) {      
                    $msg .= "<ul class='px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0'>
                            <li class='position-relative'>
                            <a class='text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold'
                                href='javascript:void(0)'>
                                <i class='ti ti-plus'></i>
                            </a>
                            </li>
                            <li class='position-relative'>
                            <a class='text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold '
                                href='javascript:void(0)'>
                                <i class='ti ti-message'></i>
                            </a>
                            </li>
                            <li class='position-relative'>
                            <a class='text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold '
                                href='javascript:void(0)'>
                                <i class='ti ti-star'></i>
                            </a>
                            </li>
                            <li class='position-relative' onclick='getModalRemoverAmizade(".$row['idAmigo'].")'>
                            <a class='text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold '
                                href='javascript:void(0)'>
                                <i class='ti ti-square-x'></i>
                            </a>
                            </li>
                        </ul>
                        </div>
                    </div>";
                } else {
                    $msg .= "
                    </div>
                </div>";
                }     
            }
        } else {
            if($userId != $_SESSION['id']) {
                $msg .= "<div class='text-center mt-5'>
                            <h4>Sem resultados!</h4>
                            <p>Este Utilizador ainda não tem amigos.</p>
                        </div>";
            } else {
                $msg .= "<div class='text-center mt-5'>
                            <h3>Sem amigos!</h3>
                            <p>Conecta com outros utilizadores e eles aparecerão aqui.</p>
                        </div>";
            }
        }

        $conn->close();
        $resp = json_encode(array("msg" => $msg, "contagem" => $contagem));
        return ($resp);
    }
    /*Pedro*/
    function procurarAmigos($userId, $nomeAmigo) {
        global $conn;
        $msg = "";
        $contagem = 0;

        $sql = "SELECT
                    user.nome AS nomeAmigo,
                    user.id AS idAmigo,
                    user.foto AS fotoAmigo,
                    user.localidade AS localidadeAmigo,
                    user.telemovel AS telemovelAmigo,
                    user.email AS emailAmigo,
                    user.nif AS nifAmigo,
                    COUNT(*) AS contagem
                FROM amigo
                INNER JOIN (
                    SELECT 
                        id_atleta1,
                        id_atleta2,
                        amigo.estado as estado,
                        CASE
                            WHEN id_atleta1 = ".$userId." THEN id_atleta2
                            WHEN id_atleta2 = ".$userId." THEN id_atleta1
                            ELSE NULL
                        END AS matched_column
                    FROM amigo
                    WHERE id_atleta1 = ".$userId." OR id_atleta2 = ".$userId."
                    AND amigo.estado = 1
                ) AS subquery ON subquery.id_atleta1 = amigo.id_atleta1 OR subquery.id_atleta2 = amigo.id_atleta2
                INNER JOIN atleta ON atleta.id_atleta = subquery.matched_column
                INNER JOIN user ON atleta.id_atleta = user.id
                WHERE user.nome LIKE '%" . $nomeAmigo . "%'
                AND subquery.estado = 1
                GROUP BY nomeAmigo, fotoAmigo, localidadeAmigo, telemovelAmigo, emailAmigo, nifAmigo";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $contagem++;
                $msg .= "<div class='col-sm-6 col-lg-4'>
                            <div class='card hover-img'>
                                <div class='card-body p-4 text-center border-bottom'>
                                    <a href='./perfil.php?id=".$row['idAmigo']."'>
                                        <img src='../../dist/".$row['fotoAmigo']."' alt='' class='rounded-circle mb-3 object-fit-cover'
                                            height='100' width='100' style='border: 2px solid transparent; border-radius: 50%; transition: border-color 0.3s;' onmouseover='this.style.borderColor=\"#044967\";' onmouseout='this.style.borderColor=\"transparent\";'>
                                    </a>
                        

                                    <a href='./perfil.php?id=".$row['idAmigo']."' style='text-decoration: none;'>
                                        <h6 class='fw-semibold mb-0' style='color: #000; transition: color 0.3s;' onmouseover='this.style.color=\"#044967\";' onmouseout='this.style.color=\"#000\";'>
                                            ".$row['nomeAmigo']."
                                        </h6>
                                    </a>
                                <span class='text-dark fs-2'>Futebol</span>
                            </div>
                            <ul class='px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0'>
                                <li class='position-relative'>
                                <a class='text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold'
                                    href='javascript:void(0)'>
                                    <i class='ti ti-plus'></i>
                                </a>
                                </li>
                                <li class='position-relative'>
                                <a class='text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold '
                                    href='javascript:void(0)'>
                                    <i class='ti ti-message'></i>
                                </a>
                                </li>
                                <li class='position-relative'>
                                <a class='text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold '
                                    href='javascript:void(0)'>
                                    <i class='ti ti-star'></i>
                                </a>
                                </li>
                                <li class='position-relative'>
                                <a class='text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold '
                                    href='javascript:void(0)'>
                                    <i class='ti ti-square-x'></i>
                                </a>
                                </li>
                            </ul>
                            </div>
                        </div>";
            }
        } else {
            $contagem = 0;
            $msg .= "<div class='text-center mt-5'>
                        <h3>Sem resultados!</h3>
                        <p>Por favor verifique os termos da sua pesquisa e tente de novo.</p>
                        <button type='button' class='btn btn-primary btn-small' onclick='getAmigos()'>Redefinir</button>
                    </div>";
        }

        $conn->close();
        $resp = json_encode(array("msg" => $msg, "contagem" => $contagem));
        return ($resp);
    }
    /*Pedro*/
    function mostrarAmigosModalMarcacao($idCampo) {
        global $conn;
        $msg = "";
        $userId = $_SESSION['id'];

        $split = array();
        $split = explode(".", $idCampo, 2);
        $idCampoSplit = $split[0];

        $sql = "SELECT
                user.nome AS nomeAmigo,
                user.id AS idAmigo,
                user.foto AS fotoAmigo,
                user.localidade AS localidadeAmigo,
                user.telemovel AS telemovelAmigo,
                user.email AS emailAmigo,
                user.nif AS nifAmigo,
                COUNT(*) AS contagem
            FROM amigo
            INNER JOIN (
                SELECT 
                    id_atleta1,
                    id_atleta2,
                    amigo.estado as estado,
                    CASE
                        WHEN id_atleta1 = ".$userId." THEN id_atleta2
                        WHEN id_atleta2 = ".$userId." THEN id_atleta1
                        ELSE NULL
                    END AS matched_column
                FROM amigo
                WHERE id_atleta1 = ".$userId." OR id_atleta2 = ".$userId."
                AND amigo.estado = 1
            ) AS subquery ON subquery.id_atleta1 = amigo.id_atleta1 OR subquery.id_atleta2 = amigo.id_atleta2
            INNER JOIN atleta ON atleta.id_atleta = subquery.matched_column
            INNER JOIN user ON atleta.id_atleta = user.id
            INNER JOIN atleta_modalidade ON atleta.id_atleta = atleta_modalidade.id_atleta
            WHERE subquery.estado = 1
            AND atleta_modalidade.id_modalidade = (
                    SELECT campo_clube.id_modalidade 
                    FROM campo_clube INNER JOIN 
                    campo ON campo_clube.id_campo = campo.id
                    WHERE campo.id = ".$idCampoSplit."
                )
            GROUP BY nomeAmigo, fotoAmigo, localidadeAmigo, telemovelAmigo, emailAmigo, nifAmigo";

        $msg .= "<div class='row gap-4 d-flex justify-content-center align-items-center'>";

        $result = $conn -> query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<div class='col-2 me-3'>
                                <img id='".$row['idAmigo']."' src='../../dist/".$row['fotoAmigo']."' alt='".$row['nomeAmigo']."'
                                    class='rounded-circle object-fit-cover' width='60' height='60' onclick='adicionarAmigoMarcacao(this)' data-toggle='tooltip'
                                        data-placement='top' title='".$row['nomeAmigo']."' style='cursor: pointer'>
                        </div>";
            }
        } else {
            $msg .= "<div class='text-center mt-3'>
                        <h5>Sem resultados!</h5>
                        <span>Não tens Amigos ou os mesmos não praticam esta modalidade.</span><br>
                        <small class='text-muted mt-5'>No entanto, podes deixar a marcação aberta. Assim outros atletas podem juntar-se!</small>
                    </div>";
        }

        $msg .= "</div>";

        $conn->close();
        return ($msg);

    }
}