<?php
session_start();
require_once 'connection.php';

class Amigo
{
    function getAmigos($userId) {
        global $conn;
        $msg = "";
        $contagem = 0;

        $sql = "SELECT 
                    CASE
                        WHEN subquery.matched_column = amigo.id_atleta1 THEN amigo.id_atleta2
                        ELSE amigo.id_atleta1
                    END AS idPerfilCurrent,
                    CASE
                        WHEN subquery.matched_column = amigo.id_atleta1 THEN amigo.id_atleta1
                        ELSE amigo.id_atleta2
                    END AS idAmigo,
                    user.nome AS nomeAmigo,
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
                        CASE
                            WHEN id_atleta1 = ".$userId." THEN id_atleta2
                            WHEN id_atleta2 = ".$userId." THEN id_atleta1
                            ELSE NULL
                        END AS matched_column
                    FROM amigo
                    WHERE id_atleta1 = ".$userId." OR id_atleta2 = ".$userId."
                ) AS subquery ON subquery.id_atleta1 = amigo.id_atleta1 OR subquery.id_atleta2 = amigo.id_atleta2
                INNER JOIN atleta ON atleta.id_atleta = subquery.matched_column
                INNER JOIN user ON atleta.id_atleta = user.id
                GROUP BY idPerfilCurrent, idAmigo, nomeAmigo, fotoAmigo, localidadeAmigo, telemovelAmigo, emailAmigo, nifAmigo";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $contagem = $row['contagem'];
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
        }

        $conn->close();
        $resp = json_encode(array("msg" => $msg, "contagem" => $contagem));
        return ($resp);
    }

    function procurarAmigos($userId, $nomeAmigo) {
        global $conn;
        $msg = "";

        $sql = "SELECT 
                    CASE
                        WHEN subquery.matched_column = amigo.id_atleta1 THEN amigo.id_atleta2
                        ELSE amigo.id_atleta1
                    END AS idPerfilCurrent,
                    CASE
                        WHEN subquery.matched_column = amigo.id_atleta1 THEN amigo.id_atleta1
                        ELSE amigo.id_atleta2
                    END AS idAmigo,
                    user.nome AS nomeAmigo,
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
                        CASE
                            WHEN id_atleta1 = ".$userId." THEN id_atleta2
                            WHEN id_atleta2 = ".$userId." THEN id_atleta1
                            ELSE NULL
                        END AS matched_column
                    FROM amigo
                    WHERE id_atleta1 = ".$userId." OR id_atleta2 = ".$userId."
                ) AS subquery ON subquery.id_atleta1 = amigo.id_atleta1 OR subquery.id_atleta2 = amigo.id_atleta2
                INNER JOIN atleta ON atleta.id_atleta = subquery.matched_column
                INNER JOIN user ON atleta.id_atleta = user.id
                WHERE user.nome LIKE '%" . $nomeAmigo . "%'
                GROUP BY idPerfilCurrent, idAmigo, nomeAmigo, fotoAmigo, localidadeAmigo, telemovelAmigo, emailAmigo, nifAmigo";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
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
        }

        $conn->close();
        return ($msg);
    }
}