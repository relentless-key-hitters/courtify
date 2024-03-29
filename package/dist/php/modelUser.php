<?php
session_start();
require_once 'connection.php';

class User
{
    /*Mariana*/ 
    function getDistritos()
    {
        global $conn;
        $msg = "<option value = '-1' selected disabled >Distrito</option><option disabled>---------------</option>";
        $sql = "SELECT * FROM distrito";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $msg .= "<option value = '" . $row['id'] . "'>" . $row['descricao'] . "</option>";
            }
        }

        $conn->close();
        return ($msg);
    }
    /*Mariana*/ 
    function getConcelhos($distrito)
    {
        global $conn;
        $msg = "<option value = '-1' selected disabled>Escolha um concelho</option><option disabled>---------------</option>";
        $sql = "SELECT concelho.id , concelho.descricao FROM concelho INNER JOIN distrito_concelho ON concelho.id = distrito_concelho.id_concelho WHERE distrito_concelho.id_distrito = '" . $distrito . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $msg .= "<option value = '" . $row['id'] . "'>" . $row['descricao'] . "</option>";
            }
        }

        $conn->close();
        return ($msg);
    }
    /*Mariana*/ 
    function registarUser($nome, $tipo, $telemovel, $nif, $morada, $codP, $local, $email, $pass, $coords)
    {
        global $conn;
        $flag = true;

        $coordsDecode = json_decode($coords);

        $msg = "";
        $icon = "success";
        if ($local == 'null') {
            if($tipo == 2) {
                $sql = "INSERT INTO user(tipo_user, nome, telemovel, email, nif, morada, codigo_postal, lat, lon) VALUES ('" . $tipo . "', '" . $nome . "', '" . $telemovel . "', '" . $email . "', '" . $nif . "', '" . $morada . "', '" . $codP . "', " . $coordsDecode[0] . ", " . $coordsDecode[1] . ")";
            } else {
                $sql = "INSERT INTO user(tipo_user, nome, telemovel, email, nif, morada, codigo_postal) VALUES ('" . $tipo . "', '" . $nome . "', '" . $telemovel . "', '" . $email . "', '" . $nif . "', '" . $morada . "', '" . $codP . "')";
            }
            
        } else {
            if($tipo == 2) {
                $sql = "INSERT INTO user(tipo_user, nome, telemovel, email, nif, morada, codigo_postal, localidade, lat, lon) VALUES ('" . $tipo . "', '" . $nome . "', '" . $telemovel . "', '" . $email . "', '" . $nif . "', '" . $morada . "', '" . $codP . "', '" . $local . "', " . $coordsDecode[0] . ", " . $coordsDecode[1] . ")";
            } else {
                $sql = "INSERT INTO user(tipo_user, nome, telemovel, email, nif, morada, codigo_postal, localidade) VALUES ('" . $tipo . "', '" . $nome . "', '" . $telemovel . "', '" . $email . "', '" . $nif . "', '" . $morada . "', '" . $codP . "', '" . $local . "')";
            }
            
        }
        $sql2 = "SELECT user.id FROM user WHERE user.email = '" . $email . "'";
        $sql3 = "SELECT user.id FROM user WHERE user.nif = '" . $nif . "'";
        $result = $conn->query($sql2);
        $result2 = $conn->query($sql3);

        if ($result->num_rows > 0) {
            $msg = "Já existe uma conta com este email associado!";
            $icon = "error";
        } else if ($result2->num_rows > 0) {
            $msg = "Já existe uma conta com este nif associado!";
            $icon = "error";
        } else {
            if ($conn->query($sql) === TRUE) {
                $id = mysqli_insert_id($conn);
                $sql2 = "INSERT INTO login(id_user, password) VALUES ('" . $id . "', '" . $pass . "')";
                if($tipo == 1){
                    $sql3 = "INSERT INTO atleta (id_atleta) VALUES ('" . $id . "')";
                }else{
                    $sql3 = "INSERT INTO clube (id_clube) VALUES ('" . $id . "')";
                }
                if ($conn->query($sql2) === TRUE) {
                    $msg .= "Registado com sucesso!";
                } else {
                    $msg .= "Registado com sucesso mas sem credenciais de login!";
                }
                if ($conn->query($sql3) === TRUE) {
                } else {
                    $msg .= "ERRO!";
                }
            } else {
                $msg = "Error: " . $sql . "<br>" . $conn->error;
                $flag = false;
            }
        }

        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg,
            "icon" => $icon
        ));
        $conn->close();
        return ($resp);
    }
    /*Mariana*/ 
    function login($email, $pass)
    {

        global $conn;
        $sql = "SELECT user.id, user.tipo_user FROM user WHERE email = '" . $email . "'";
        $result = $conn->query($sql);
        $msg = "";
        $icon = "success";
        $flag = true;
        $title = "Sucesso";
        $flagFirstLogin = false;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sql2 = "SELECT login.id_user FROM login WHERE id_user = '" . $row['id'] . "' AND password = '" . md5($pass) . "'";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $msg = "Login efetuado com sucesso!";
                        $_SESSION['tipo'] = $row['tipo_user'];
                        $_SESSION['id'] = $row['id'];
                        $sql3 = "SELECT sem_login.id_atleta FROM sem_login WHERE id_atleta = '" . $row['id'] . "'";
                        $result3 = $conn->query($sql3);
                        if ($result3->num_rows > 0) {
                            $flagFirstLogin = true;
                        }
                    }
                } else {
                    $msg = "A palavra-passe e o email não coincidem!";
                    $icon = "error";
                    $title = "Erro";
                    $flag = false;
                }
            }
        } else {
            $msg = "Não há nenhuma conta registada com este email.";
            $icon = "error";
            $title = "Erro";
            $flag = false;
        }
        if ($flag) {
            $resp = json_encode(array(
                "flag" => $flag,
                "flagFirstLogin" => $flagFirstLogin,
                "msg" => $msg,
                "icon" => $icon,
                "title" => $title,
                "id" => $_SESSION['id'],
                "tipoUser" => $_SESSION['tipo']

            ));
        } else {
            $resp = json_encode(array(
                "flag" => $flag,
                "flagFirstLogin" => $flagFirstLogin,
                "msg" => $msg,
                "icon" => $icon,
                "title" => $title

            ));
        }
        $conn->close();

        return ($resp);
    }
     /*Mariana*/ 
    function getModalidades()
    {

        global $conn;
        $msg = "";
        $sql = "SELECT id, descricao FROM modalidade";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $msg .= "<div class='form-check form-check-inline'>
               <input class='form-check-input success' type='checkbox' id='modalidade" . $row['id'] . "' value='" . $row['id'] . "' onclick='getForm(" . $row['id'] . ")'>
               <label class='form-check-label' for='modalidade" . $row['id'] . "'>" . $row['descricao'] . "</label>
                </div>";
            }
        }

        $conn->close();
        return ($msg);
    }
    /*Mariana*/ 
    function getFutsalInfo()
    {

        global $conn;
        $msg = "<option selected disabled>Posição</option>";
        $sql = "SELECT * FROM posicao_futsal";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $msg .= "<option value='" . $row['id'] . "'>" . $row['descricao'] . "</option>";
            }
        }

        $conn->close();
        return ($msg);
    }
    /*Mariana*/ 
    function getNivelPadel()
    {
        global $conn;
        $msg = "<option selected disabled>Nível</option>";
        $sql = "SELECT * FROM nivel_padel";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $msg .= "<option value='" . $row['id'] . "'>" . $row['descricao'] . "</option>";
            }
        }

        $conn->close();
        return ($msg);
    }
    /*Mariana*/ 
    function uploads($img, $id)
    {

        $dir = "../images/utilizadores/" . $id . "/";
        $dir1 = "images/utilizadores/" . $id . "/";
        $flag = false;
        $targetBD = "";

        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, TRUE)) {
                die("Erro não é possivel criar o diretório");
            }
        }
        if (array_key_exists('fotoPerfil', $img)) {
            if (is_array($img)) {
                if (is_uploaded_file($img['fotoPerfil']['tmp_name'])) {
                    $fonte = $img['fotoPerfil']['tmp_name'];
                    $ficheiro = $img['fotoPerfil']['name'];
                    $end = explode(".", $ficheiro);
                    $extensao = end($end);
                    $newName = "user" . date("YmdHis") . "." . $extensao;
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
    /*Mariana*/ 
    function uploads2($img, $id)
    {

        $dir = "../images/utilizadores/" . $id . "/";
        $dir1 = "images/utilizadores/" . $id . "/";
        $flag = false;
        $targetBD = "";

        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, TRUE)) {
                die("Erro não é possivel criar o diretório");
            }
        }
        if (array_key_exists('fotoCapa', $img)) {
            if (is_array($img)) {
                if (is_uploaded_file($img['fotoCapa']['tmp_name'])) {
                    $fonte = $img['fotoCapa']['tmp_name'];
                    $ficheiro = $img['fotoCapa']['name'];
                    $end = explode(".", $ficheiro);
                    $extensao = end($end);
                    $newName = "user" . date("YmdHis") . "." . $extensao;
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
    /*Mariana*/ 
    function contRegisto($dn, $genero, $altura, $peso, $ms, $mi, $fotoPerfil, $bio, $modalidades, $posFutsal, $nivelPadel, $ladoPadel)
    {

        global $conn;
        $arrMod = json_decode($modalidades);
        $sql = "UPDATE atleta SET data_nasc = '" . $dn . "', altura = '" . $altura . "', peso = '" . $peso . "', ms = '" . $ms . "', mi = '" . $mi . "', genero = '" . $genero . "', bio = '" . $bio . "' WHERE id_atleta = '" . $_SESSION['id'] . "'";
        $msg = "";
        $flag = true;
        $respUpdate = $this->uploads($fotoPerfil, $_SESSION['id']);
        $respUpdate = json_decode($respUpdate, TRUE);
        $icon = "success";
        if ($conn->query($sql) === TRUE) {
            $sql2 = "";
            $sql3 = "";
            if ($respUpdate['flag']) {
                $sql4 = "UPDATE user SET foto = '" . $respUpdate['target'] . "' WHERE id = '" . $_SESSION['id'] . "'";
                if ($conn->query($sql4) === FALSE) {
                    $flag = false;
                    $icon = "error";
                    $msg = "Não foi possível guardar as alterações na foto de perfil.";
                }
            }
            for ($i = 0; $i < sizeof($arrMod); $i++) {
                $sql2 = "INSERT INTO atleta_modalidade (id_atleta, id_modalidade) VALUES ('" . $_SESSION['id'] . "', '" . $arrMod[$i] . "')";
                if ($conn->query($sql2) === FALSE) {
                    $flag = false;
                    $icon = "error";
                }
                if ($arrMod[$i] == '2') {
                    $sql3 = "INSERT INTO info_futsal (id_atleta, id_posicao, n_jogos, n_vitorias, n_golos, n_mvp) VALUES ('" . $_SESSION['id'] . "', '" . $posFutsal . "', '0', '0', '0', '0')";
                    if ($conn->query($sql3) === FALSE) {
                        $flag = false;
                        $icon = "error";
                    }
                } else if ($arrMod[$i] == '3') {
                    if ($nivelPadel == '3') {
                        $sql3 = "INSERT INTO info_padel (id_atleta, nivel, n_jogos, n_vitorias, n_pontos_set, n_set_ganhos, n_mvp) VALUES ('" . $_SESSION['id'] . "', '" . $nivelPadel . "', '0', '0' , '0' , '0' , '0')";
                    } else {
                        $sql3 = "INSERT INTO info_padel (id_atleta, id_lado, nivel, n_jogos, n_vitorias, n_pontos_set, n_set_ganhos, n_mvp) VALUES ('" . $_SESSION['id'] . "', '" . $ladoPadel . "', '" . $nivelPadel . "', '0', '0', '0', '0' , '0')";
                    }
                    if ($conn->query($sql3) === FALSE) {
                        $flag = false;
                        $icon = "error";
                    }
                } else if ($arrMod[$i] == '1') {
                    $sql3 = "INSERT INTO info_basquetebol (id_atleta, n_jogos, n_vitorias, n_mvp, n_pontos) VALUES ('" . $_SESSION['id'] . "', '0', '0', '0', '0')";
                    if ($conn->query($sql3) === FALSE) {
                        $flag = false;
                        $icon = "error";
                    }
                } else {
                    $sql3 = "INSERT INTO info_tenis (id_atleta, n_jogos, n_vitorias, n_pontos_set, n_set_ganhos, n_mvp) VALUES ('" . $_SESSION['id'] . "', '0', '0', '0', '0', '0')";
                    if ($conn->query($sql3) === FALSE) {
                        $flag = false;
                        $icon = "error";
                    }
                }
            }
            if ($flag === TRUE) {
                $msg = "Registado com Sucesso";
            }
        } else {
            $flag = false;
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            $icon = "error";
        }

        $resp = json_encode(array(
            "flag" => $flag,
            "mensagem" => $msg,
            "icon" => $icon,
            "idAtleta" => $_SESSION['id']
        ));
        $conn->close();
        return ($resp);
    }
    /*Mariana*/ 
    function getInfoPerfil($id)
    {
        global $conn;
        $fotoPerfil = "";
        $nome = "";
        $email = "";
        $localizacao = "";
        $bio = "";
        $mod = "";
        $fotoCapa = "";
        $altFotoCapaIcon = "";
        $sql4 = "";
        $botaoAmigo = "";
        $botaoMensagem = "";
        $modalidades = array();
        if ($id == $_SESSION['id']) {
            $altFotoCapaIcon .= "<i class='fas fa-pencil-alt text-white fs-6' data-toggle='tooltip' data-placement='top' title='Editar'
            data-bs-toggle='modal' data-bs-target='#vertical-center-modal'></i>";
        } else {
            $sql4 = "SELECT IF(amigo = " . $id . ", 1, 0) AS amigos, estado 
                        FROM (
                        SELECT amigo.id_atleta1 AS amigo, amigo.estado AS estado
                        FROM amigo 
                        WHERE (amigo.id_atleta1 = " . $_SESSION['id'] . "
                            OR amigo.id_atleta2 = " . $_SESSION['id'] . ")
                        AND  amigo.id_atleta1 = " . $id . "
                        UNION 
                        SELECT amigo.id_atleta2 AS amigo, amigo.estado AS estado
                        FROM amigo 
                        WHERE (amigo.id_atleta2 = " . $_SESSION['id'] . "
                            OR amigo.id_atleta1 = " . $_SESSION['id'] . ")
                        AND amigo.id_atleta2 = " . $id . ") AS temp
                        UNION 
                        SELECT 0 AS amigos, 0 AS estado
                        FROM (
                            SELECT id_atleta AS id
                            FROM atleta
                            WHERE id_atleta NOT IN (
                                SELECT amigo.id_atleta1 AS amigo
                                FROM amigo 
                                WHERE (amigo.id_atleta1 = " . $_SESSION['id'] . "
                                OR amigo.id_atleta2 = " . $_SESSION['id'] . ")
                                AND  amigo.id_atleta1 = " . $id . "
                                UNION 
                                SELECT amigo.id_atleta2 AS amigo
                                FROM amigo 
                                WHERE (amigo.id_atleta2 = " . $_SESSION['id'] . "
                                OR amigo.id_atleta1 = " . $_SESSION['id'] . ")
                                AND amigo.id_atleta2 = " . $id . ")) AS temp2
                        WHERE temp2.id != " . $_SESSION['id'] . "
                        AND temp2.id = " . $id;

            $result4 = $conn->query($sql4);
            if ($result4->num_rows > 0) {
                while ($row4 = $result4->fetch_assoc()) {
                    if ($row4['amigos'] == 1) {
                        if ($row4['estado'] == 1) {
                            $botaoMensagem .= "<button class='btn btn-outline-success'><i class='me-2 ti ti-message'></i>Mensagem</button>";
                            $botaoAmigo .= "<button class='btn btn-primary disabled'><i class='me-2 ti ti-check'></i>Amigo</button>";
                        } else {
                            $botaoAmigo .= "<button class='btn btn-primary disabled'><i class='me-2 ti ti-clock-pause'></i>Pendente</button>";
                        }
                    } else if ($row4['amigos'] == 0) {
                        $botaoAmigo .= "<button class='btn btn-primary' onclick='adicionarAmigo(" . $id . ")'><i class='me-2 ti ti-user-plus'></i>Adicionar</button>";
                    }
                }
            }
        }
        $sql = "SELECT user.foto as foto, user.email as email, user.nome as nome, atleta.bio as bio, atleta.fotoCapa as fotoCapa FROM user INNER JOIN atleta ON user.id = atleta.id_atleta WHERE user.id = " . $id;
        $sql2 = "SELECT concelho.descricao as concelho, distrito.descricao as distrito FROM user INNER JOIN concelho ON user.localidade = concelho.id INNER JOIN distrito_concelho ON concelho.id = distrito_concelho.id_concelho INNER JOIN distrito ON distrito_concelho.id_distrito = distrito.id WHERE user.id = " . $id;
        $sql3 = "SELECT atleta_modalidade.id_modalidade as id, modalidade.descricao as descricao FROM atleta_modalidade INNER JOIN modalidade ON atleta_modalidade.id_modalidade = modalidade.id WHERE atleta_modalidade.id_atleta = " . $id;
        $result = $conn->query($sql);
        $result2 = $conn->query($sql2);
        $result3 = $conn->query($sql3);
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $fotoPerfil = "../../dist/" . $row['foto'] . "";
                $nome = $row['nome'];
                $email = $row['email'];
                $bio = $row['bio'];
                if (is_null($row['fotoCapa'])) {
                    $fotoCapa = "../../dist/images/profile/backgroundBasic.png";
                } else {
                    $fotoCapa = "../../package/dist/" . $row['fotoCapa'];
                }
            }
        }
        if ($result2->num_rows > 0) {

            while ($row2 = $result2->fetch_assoc()) {
                $localizacao = $row2['concelho'] . ", " . $row2['distrito'];
            }
        }
        if ($result3->num_rows > 0) {

            while ($row3 = $result3->fetch_assoc()) {
                array_push($modalidades, $row3['descricao']);
                if ($row3['descricao'] == 'Basquetebol') {
                    $mod .= "<li>
                    <img src='../../dist/images/modalidades/basquetebol.png' alt='Badge 1' class='img-fluid mb-2 rounded'
                      data-toggle='tooltip' data-placement='top' title='" . $row3['descricao'] . "' style='max-width: 45px;'>
                    </li>";
                } else if ($row3['descricao'] == 'Futsal') {
                    $mod .= "<li>
                    <img src='../../dist/images/modalidades/futsal.png' alt='Badge 2' class='img-fluid mb-2 rounded'
                      data-toggle='tooltip' data-placement='top' title='" . $row3['descricao'] . "' style='max-width: 45px;'>
                    </li>";
                } else if ($row3['descricao'] == 'Padel') {
                    $mod .= "<li>
                    <img src='../../dist/images/modalidades/padel.png' alt='Badge 3' class='img-fluid mb-2 rounded'
                      data-toggle='tooltip' data-placement='top' title='" . $row3['descricao'] . "' style='max-width: 45px;'>
                    </li>";
                } else {
                    $mod .= "<li>
                    <img src='../../dist/images/modalidades/tenis.png' alt='Badge 4' class='img-fluid mb-2 rounded'
                      data-toggle='tooltip' data-placement='top' title='" . $row3['descricao'] . "' style='max-width: 45px;'>
                    </li>";
                }
            }
        }
        $valBadges = $this->getBadgesPerfil($modalidades, $id);
        $melhoresBadges = $this->getMelhoresBadges($id);
        $badgesRecentes = $this->getBadgesRecentes($id);
        $resp = json_encode(array(
            "fotoPerfil" => $fotoPerfil,
            "fotoCapa" => $fotoCapa,
            "nome" => $nome,
            "email" => $email,
            "localizacao" => $localizacao,
            "bio" => $bio,
            "mod" => $mod,
            "altFotoCapa" => $altFotoCapaIcon,
            "botaoAmigo" => $botaoAmigo,
            "botaoMensagem" => $botaoMensagem,
            "modalidades" => $modalidades,
            "valoresBadges" => $valBadges,
            "melhoresBadges" => $melhoresBadges,
            "badgesRecentes" => $badgesRecentes
        ));
        $conn->close();
        return ($resp);
    }
     /*Mariana*/ 
    function altFotoCapa($fotoCapa)
    {
        global $conn;
        $respUpdate = $this->uploads2($fotoCapa, $_SESSION['id']);
        $respUpdate = json_decode($respUpdate, TRUE);
        $msg = "";
        $elemento = "";
        $icon = "error";
        $flag = false;

        if ($respUpdate['flag']) {

            $larguraTarget = 1298;
            $alturaTarget = 504;


            $partesCaminho = pathinfo("../../dist/" . $respUpdate['target']);
            $novoNomeFicheiro = $partesCaminho['dirname'] . '/' . $partesCaminho['filename'] . '_resized.' . $partesCaminho['extension'];


            $this->resizeImagem("../../dist/" . $respUpdate['target'], $novoNomeFicheiro, $larguraTarget, $alturaTarget);

            $sql = "UPDATE atleta SET fotoCapa = '" . $novoNomeFicheiro . "' WHERE id_atleta = '" . $_SESSION['id'] . "'";
            $elemento = "'../../dist/" . $novoNomeFicheiro;

            if ($conn->query($sql) === TRUE) {
                $msg = "Alterada com sucesso!";
                $icon = "success";
                $flag = true;
            } else {
                $msg = "Não foi possível alterar a fotografia de capa!";
            }
        } else {
            $msg = "Não foi possível alterar a fotografia de capa!";
        }

        $resp = json_encode(array(
            "msg" => $msg,
            "elemento" => $elemento,
            "icon" => $icon,
            "flag" => $flag
        ));

        $conn->close();
        return ($resp);
    }
     /*Pedro*/ 
    function resizeImagem($ficheiroSource, $ficheiroTarget, $larguraTarget, $alturaTarget)
    {
        // Obter a extensão do ficheiro da imagem de origem
        $tipoImagem = pathinfo($ficheiroSource, PATHINFO_EXTENSION);

        // Criar recurso de imagem com base no tipo de ficheiro
        if ($tipoImagem == 'jpeg' || $tipoImagem == 'jpg') {
            $imagemSource = imagecreatefromjpeg($ficheiroSource);
        } elseif ($tipoImagem == 'png') {
            $imagemSource = imagecreatefrompng($ficheiroSource);
        } else {

            return false; // Devolver falso se o tipo de ficheiro não for suportado
        }
        // Obter as dimensões da imagem de origem
        list($sourceLagura, $sourceAltura) = getimagesize($ficheiroSource);

        // Calcular rácios de aspeto
        $sourceRacioAspeto = $sourceLagura / $sourceAltura;
        $targetRacioAspeto = $larguraTarget / $alturaTarget;

        // Calcular as dimensões do crop com base nos rácios de aspeto
        $cropLargura = $sourceLagura;
        $cropAltura = $sourceAltura;


        if ($sourceRacioAspeto > $targetRacioAspeto) {

            $cropLargura = $sourceAltura * $targetRacioAspeto;
        } else {

            $cropAltura = $sourceLagura / $targetRacioAspeto;
        }

        // Calcular as posições do crop
        $cropX = ($sourceLagura - $cropLargura) / 2;
        $cropY = ($sourceAltura - $cropAltura) / 2;

        // Criar um novo recurso de imagem true color
        $imagemResized = imagecreatetruecolor($larguraTarget, $alturaTarget);

        // Copiar e redimensionar parte de uma imagem com reamostragem
        imagecopyresampled($imagemResized, $imagemSource, 0, 0, $cropX, $cropY, $larguraTarget, $alturaTarget, $cropLargura, $cropAltura);

        // Guardar a imagem redimensionada com base no tipo de ficheiro
        if ($tipoImagem == 'jpeg' || $tipoImagem == 'jpg') {
            imagejpeg($imagemResized, $ficheiroTarget);
        } elseif ($tipoImagem == 'png') {
            imagepng($imagemResized, $ficheiroTarget);
        }

        // Libertar memória
        imagedestroy($imagemSource);
        imagedestroy($imagemResized);
    }
    /*Mariana*/ 
    function getEditInfo()
    {
        global $conn;
        $sql = "SELECT user.*, atleta.bio  FROM user INNER JOIN atleta on user.id = atleta.id_atleta WHERE user.id = '" . $_SESSION['id'] . "'";
        $result = $conn->query($sql);
        $nome = "";
        $nif = "";
        $cp = "";
        $email = "";
        $tel = "";
        $morada = "";
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $nome = $row['nome'];
                $nif = $row['nif'];
                $cp = $row['codigo_postal'];
                $email = $row['email'];
                $tel = $row['telemovel'];
                $morada = $row['morada'];
                $bio = $row['bio'];
            }
        }
        $resp = json_encode(array(
            "nome" => $nome,
            "nif" => $nif,
            "cp" => $cp,
            "email" => $email,
            "tel" => $tel,
            "morada" => $morada,
            "bio" => $bio
        ));
        $conn->close();
        return ($resp);
    }
    /*Mariana*/ 
    function guardaEditInfo($nome, $email, $nif, $cp, $tel, $morada, $local, $bio)
    {

        global $conn;
        $flag = true;
        $msg = "";
        $icon = "success";
        $sql = "";
        if ($local == 'null') {
            $sql = "UPDATE user SET nome = '" . $nome . "', email = '" . $email . "', nif = '" . $nif . "', morada = '" . $morada . "', telemovel = '" . $tel . "', codigo_postal = '" . $cp . "' WHERE id = '" . $_SESSION['id'] . "'";
        } else {
            $sql = "UPDATE user SET nome = '" . $nome . "', email = '" . $email . "', nif = '" . $nif . "', morada = '" . $morada . "', telemovel = '" . $tel . "', codigo_postal = '" . $cp . "', localidade = '" . $local . "' WHERE id = '" . $_SESSION['id'] . "'";
        }
        $sql2 = "UPDATE atleta SET bio = '" . $bio . "' WHERE id_atleta = '" . $_SESSION['id'] . "'";
        if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
            $msg = "Informação alterada com sucesso!";
        } else {
            $msg = "Não foi possível alterar a sua informação.";
            $flag = false;
            $icon = "error";
        }

        $resp = json_encode(array(
            "msg" => $msg,
            "icon" => $icon,
            "flag" => $flag,
            "id" => $_SESSION['id']
        ));

        $conn->close();
        return ($resp);
    }
    /*Mariana*/ 
    function getNotificacoes()
    {
        global $conn;
        $sql = " SELECT listagem_atletas_marcacao.id_marcacao as idMarcacao FROM listagem_atletas_marcacao INNER JOIN marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao INNER JOIN campo_clube ON marcacao.id_campo = campo_clube.id_campo INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id WHERE listagem_atletas_marcacao.id_atleta = '" . $_SESSION['id'] . "' AND listagem_atletas_marcacao.votacao = 0";
        $result = $conn->query($sql);
        $msg = "";
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $msg .= "<a class='py-6 px-7 d-flex align-items-center dropdown-item' style='cursor: pointer;' onclick = 'getModalVot(" . $row['idMarcacao'] . ")'>
                <span class='me-3'>
                  <img src='../../dist/images/rating/vote.jpg' alt='user' class='rounded-circle object-fit-cover'
                    width='48' height='48' />
                </span>
                <div class='w-75 d-inline-block v-middle'>
                  <h6 class='mb-1 fw-semibold'>Votação Jogo</h6>
                  <span class='d-block'>Tem uma votação pendente.</span>
                </div>
              </a>";
            }
        }
        $conn->close();
        return ($msg);
    }
    /*Mariana*/ 
    function getModalVot($id)
    {


        global $conn;
        $sql = "SELECT marcacao.data_inicio AS dataMarc, 
        marcacao.hora_inicio AS horaMarc, 
        modalidade.descricao AS modalidade, 
        user.nome AS nomeClube, 
        user.foto as fotoClube 
        FROM listagem_atletas_marcacao 
        INNER JOIN marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao 
        INNER JOIN campo_clube ON marcacao.id_campo = campo_clube.id_campo 
        INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id 
        INNER JOIN clube ON campo_clube.id_clube = clube.id_clube 
        INNER JOIN user ON clube.id_clube = user.id 
        WHERE listagem_atletas_marcacao.id_marcacao = '" . $id . "'
        LIMIT 1";
        $result = $conn->query($sql);
        $msg = "";
        $modalidade = "";


        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $mvp = "";
                $corpo = "";
                $mod = "";
                $modalidade = $row['modalidade'];

                $sql1 = "SELECT * 
                FROM 
                user
                INNER JOIN 
                listagem_atletas_marcacao ON user.id = listagem_atletas_marcacao.id_atleta
                WHERE listagem_atletas_marcacao.id_atleta != " . $_SESSION['id'] . "
                AND listagem_atletas_marcacao.id_marcacao = " . $id . "
                ";
                $result1 = $conn->query($sql1);
                $mvp .= "<div class='row gap-4 d-flex justify-content-center align-items-center'>";
                if ($result1->num_rows > 0) {
                    while ($row1 = $result1->fetch_assoc()) {
                        $mvp .= "<div class='col-2 me-4'>
                                        <img id='" . $row1['id'] . "' src='../../dist/" . $row1['foto'] . "' alt='" . $row1['nome'] . "'
                                            class='rounded-circle object-fit-cover' width='80' height='80' onclick='toggleImageSelection(this)' data-toggle='tooltip'
                                                data-placement='top' title='" . $row1['nome'] . "'>
                                </div>";
                    }
                }

                $mvp .= "</div>";


                if ($row['modalidade'] == "Basquetebol") {
                    $mod .= "<span class='badge rounded-pill text-bg-warning mt-2 fs-5'><i
                    class='ti ti-ball-basketball me-1'></i><small>Basquetebol</small></span>";
                    $corpo .= "<h5 class='mt-4 text-center fw-semibold border-top border-2 border-light pt-3 fs-9'>Resultado</h5>
                    <div class='d-flex justify-content-between align-items-center' style='margin: 50px;'>
                      <div class='d-flex flex-column input-group-lg text-center'>
                          <h6 class='fs-5'>A tua equipa</h6>
                          <input type='number' class='form-control rounded' id='resultadoEquipa'></input>
                      </div>
                      <div class='d-flex flex-column input-group-lg text-center'>
                          <h6 class='fs-5'>A equipa adversária</h6>
                          <input type='number' class='form-control rounded' id='resultadoAdvers'></input>
                      </div>
                  </div>        
                    <h5 class='mt-4 text-center pb-3 fs-11'>MVP</h5>
                    <div class='d-flex justify-content-center align-items-center text-center'>
                      <div class='row'>
                   " . $mvp . "</div>
                    </div>
                  </div>
                  <h5 class='mt-4 text-center fw-semibold border-top border-2 border-light pt-3 fs-9'>Nº de Pontos</h5>
                    <div class='d-flex justify-content-center align-items-center' style='margin: 50px;'>
                      <div class='d-flex flex-column input-group-lg text-center'>
                          <h6 class='fs-5'>Pontos que marcaste durante o jogo</h6>
                          <input type='number' class='form-control rounded'  id='numPontos'></input>
                      </div>
                  </div>";
                } else if ($row['modalidade'] == "Futsal") {
                    $mod = "<span class='badge rounded-pill text-bg-danger mt-2 fs-5'><i
                    class='ti ti-ball-football me-1'></i><small>Futsal</small></span>";
                    $corpo .= "<h5 class='mt-4 text-center fw-semibold border-top border-2 border-light pt-3 fs-9'>Resultado</h5>
                    <div class='d-flex justify-content-between align-items-center' style='margin: 50px;'>
                      <div class='d-flex flex-column input-group-lg text-center'>
                          <h6 class='fs-5'>A tua equipa</h6>
                          <input type='number' class='form-control rounded' id='resultadoEquipa'></input>
                      </div>
                      <div class='d-flex flex-column input-group-lg text-center'>
                          <h6 class='fs-5'>A equipa adversária</h6>
                          <input type='number' class='form-control rounded' id='resultadoAdvers'></input>
                      </div>
                  </div>        
                    <h5 class='mt-4 text-center pb-3 fs-11'>MVP</h5>
                    <div class='d-flex justify-content-center align-items-center text-center'>
                      <div class='row'>
                   " . $mvp . "</div>
                    </div>
                  </div>
                  <h5 class='mt-4 text-center fw-semibold border-top border-2 border-light pt-3 fs-9'>Nº de Golos</h5>
                    <div class='d-flex justify-content-center align-items-center' style='margin: 50px;'>
                      <div class='d-flex flex-column input-group-lg text-center'>
                          <h6 class='fs-5'>Golos que marcaste durante o jogo</h6>
                          <input type='number' class='form-control rounded' id='numPontos'></input>
                      </div>
                  </div>";
                } else if ($row['modalidade'] == "Padel") {
                    $mod = "<span class='badge rounded-pill text-bg-primary mt-2 fs-5'><i
                    class='ti ti-ball-tennis me-1'></i><small>Padel</small></span>";
                    $corpo .= "<h5 class='mt-4 text-center fw-semibold border-top border-2 border-light pt-3 fs-9'>Resultado</h5>
                    <div class='d-flex align-items-center' style='margin: 50px;'>
                    <div class='col-5'>
                        <h6 class='fs-5 ms-5'>Quantos sets jogaram?</h6>
                    </div>
                    <div class='col-7'>      
                      <select class='form-select w-75' onchange= 'getSets(this.value)'>
                        <option value = '-1'>Seleciona uma opção</option>
                        <option value = '1'>1</option>
                        <option value = '2'>2</option>
                        <option value = '3'>3</option>
                        <option value = '4'>4</option>
                        <option value = '5'>5</option>
                      </select>
                    </div>
                    </div>                     
                    <div id = 'campoResultadoSets'>
                    </div>         
                    <h5 class='mt-4 text-center pb-3 fs-11'>MVP</h5>
                    <div class='d-flex justify-content-center align-items-center text-center'>
                      <div class='row'>
                   " . $mvp . "</div>
                    </div>
                  </div>";
                } else {
                    $mod = "<span class='badge rounded-pill text-bg-success mt-2 fs-5'><i
                    class='ti ti-ball-tennis me-1'></i><small>Ténis</small></span>";
                    $corpo .= "<h5 class='mt-4 text-center fw-semibold border-top border-2 border-light pt-3 fs-9'>Resultado</h5>
                    <div class='d-flex align-items-center' style='margin: 50px;'>
                    <div class='col-5'>
                        <h6 class='fs-5 ms-5'>Quantos sets jogaram?</h6>
                    </div>
                    <div class='col-7'>      
                      <select class='form-select w-75' onchange= 'getSets(this.value)'>
                        <option value = '-1'>Seleciona uma opção</option>
                        <option value = '1'>1</option>
                        <option value = '2'>2</option>
                        <option value = '3'>3</option>
                        <option value = '4'>4</option>
                        <option value = '5'>5</option>
                      </select>
                    </div>
                    </div>                     
                    <div id = 'campoResultadoSets'>
                    </div>         
                    <h5 class='mt-4 text-center pb-3 fs-11'>MVP</h5>
                    <div class='d-flex justify-content-center align-items-center text-center'>
                      <div class='row'>
                   " . $mvp . "</div>
                    </div>
                  </div>";
                }

                $data = new DateTime($row['dataMarc']);
                $stringData = $data->format('d/m/Y');

                $hora = new DateTime($row['horaMarc']);
                $stringHora = $hora->format('H:i');

                $msg .= "
                <div class='d-flex justify-content-center pb-5'>
                <h4 class='fw-semibold fs-9'>Votação</h4>
              </div>
              <div class='container-fluid'>
                <div class='row'>
                  <div class='col-md-6 text-center'>
                    <img src='" . $row['fotoClube'] . "' alt='Clube 1' class='img-fluid rounded border border-1 border-primary'
                      style='max-width: 300px;'>
                  </div>
                  <div class='col-md-6' style='align-items: start;'>
                    <div class='mb-3'>
                      <small class='fs-5'><i class='ti ti-calendar me-1'></i>" . $stringData . "</small><br>
                      <small class='fs-5'><i class='ti ti-clock me-1'></i>" . $stringHora . "</small><br>
                      <small class='fs-5'><i class='ti ti-map-pin me-1'></i>" . $row['nomeClube'] . "</small><br>
                      " . $mod . "
                    </div>
                  </div>
                </div>
              </div>" . $corpo;
            }
        }
        $resp = json_encode(array(
            "msg" => $msg,
            "modalidade" => $modalidade
        ));

        $conn->close();
        return ($resp);
    }
    /*Pedro*/ 
    function getMarcacoesNaoConcluidas()
    {

        global $conn;
        $contador = 0;
        $msg = "";
        $arrayHorasMarcacoesCalendario = array();

        $sql = "SELECT
                'Marcação' AS tipo,
                marcacao.id as idMarcacao,
                marcacao.id_atleta as idAtletaHost,
                marcacao.data_inicio AS dataMarc, 
                marcacao.hora_inicio AS horaMarcInicio,
                marcacao.hora_fim AS horaMarcFim,  
                modalidade.descricao AS modalidade, 
                user.id AS idClube,
                user.nome AS nomeClube, 
                user.foto as fotoClube, 
                user.nome AS nomeClube, 
                campo.foto AS fotoCampo,
                campo.nome AS nomeCampo,
                listagem_atletas_marcacao.votacao as estadoVotacao 
                FROM listagem_atletas_marcacao 
                INNER JOIN marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao 
                INNER JOIN campo_clube ON marcacao.id_campo = campo_clube.id_campo 
                INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id 
                INNER JOIN clube ON campo_clube.id_clube = clube.id_clube 
                INNER JOIN user ON clube.id_clube = user.id
                INNER JOIN campo ON campo_clube.id_campo = campo.id
                WHERE listagem_atletas_marcacao.id_atleta = " . $_SESSION['id'] . "
                AND listagem_atletas_marcacao.votacao = 2 
                AND listagem_atletas_marcacao.estado = 1
                AND marcacao.data_inicio >= CURRENT_DATE()
                
            
            UNION
            
            SELECT
                'Torneio' AS tipo,
                torneio.id AS idMarcacao,
                torneio.id_clube AS idAtletaHost,
                torneio.`data` AS dataMarc,
                torneio.hora AS horaMarcInicio,
                0 AS horMarcFim,
                modalidade.descricao AS modalidade,
                user.id AS idClube,
                user.nome AS nomeClube,
                user.foto AS fotoClube,
                user.nome AS nomeClube,
                torneio.foto AS fotoCampo,
                torneio.descricao AS nomeCampo,
                NULL AS estadoVotacao
                FROM
                torneio
                INNER JOIN modalidade ON torneio.modalidade = modalidade.id
                INNER JOIN user ON torneio.id_clube = user.id
                INNER JOIN torneio_atleta ON torneio.id = torneio_atleta.id_torneio
                WHERE torneio_atleta.id_atleta = " . $_SESSION['id'] . "
                AND torneio.estado = 'nc'
                ORDER BY dataMarc ASC, horaMarcInicio ASC
            LIMIT 2 ";

        $result = $conn->query($sql);
        $horaA = "";
        $msgA = "";
        $diaA = "";

        if ($result->num_rows > 0) {
            $flag = false;
            while ($row = $result->fetch_assoc()) {
                if ($contador < 2) {
                    if ($contador == 0) {

                        $data = new DateTime($row['dataMarc']);
                        $stringData = $data->format('d/m/Y');

                        $hora = new DateTime($row['horaMarcInicio']);
                        $stringHora = $hora->format('H:i');

                        $msgA = "<div class='col-lg-12'>
                        <div class='card card-hover align-items-center shadow' style='margin: 20px 40px;'>
                            <img src='" . $row['fotoCampo'] . "' class='card-img-top object-fit-cover' style='max-height: 300px' alt='" . $row['nomeCampo'] . "'>
                            <div class='p-3'>
                                <span class='fs-4 text-dark mt-2'>Nº: <span class='fw-bolder'>" . $row['idMarcacao'] . "</span></span>
                                <h5 class='m-0 p-0 card-title fs-7'><i class='ti ti-map-pin me-1'></i>" . $row['nomeCampo'] . "</h5>
                                <div class='d-flex justify-content-around'>
                                    <p class='m-0 p-0 card-text fs-6'><i class='ti ti-calendar me-1'></i>" . $stringData . "</p>
                                    <p class='m-0 p-0 card-text fs-6'>&nbsp;&nbsp;&nbsp;</p> 
                                    <p class='m-0 p-0 card-text fs-6'><i class='ti ti-clock me-1'></i>" . $stringHora . "</p>
                                </div>
                                <a href='./clube.php?id=" . $row['idClube'] . "'>
                                        <p class='card-text fs-4'><i class='ti ti-building me-1 fs-5 mt-1'></i>" . $row['nomeClube'] . "</p>
                                </a>";


                        if ($row['tipo'] == "Marcação") {

                            $msgA .= "<div class='mt-1 mb-1'>
                                        <span class='fs-3'>Participantes</span>
                                    </div>                                    
                                    <div class='mt-1 d-flex overflow-y-auto gap-2' style='min-height: 70px'>";

                            $sql2 = "SELECT listagem_atletas_marcacao.id_marcacao AS idMarcacao, 
                            listagem_atletas_marcacao.id_atleta AS idAtleta, 
                            user.nome AS nomeAmigo,
                            user.foto AS fotoAmigo
                            FROM
                            listagem_atletas_marcacao
                            INNER JOIN
                            user ON listagem_atletas_marcacao.id_atleta = user.id
                            WHERE id_marcacao = " . $row['idMarcacao'] . "
                            AND listagem_atletas_marcacao.estado = 1";

                            $result2 = $conn->query($sql2);

                            if ($result2->num_rows > 0) {
                                while ($row2 = $result2->fetch_assoc()) {
                                    if ($row2['idAtleta'] == $_SESSION['id']) {
                                        $msgA .= "<div class='col-md-2 mb-2'>
                                                <a href='./perfil.php?id=" . $row2['idAtleta'] . "'><img src='../../dist/" . $row2['fotoAmigo'] . "' alt='" . $row2['nomeAmigo'] . " (Tu)' class='rounded-circle border border-2 border-primary' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='" . $row2['nomeAmigo'] . " (Tu)' style='cursor: pointer;'></a>
                                            </div>";
                                    } else {
                                        $msgA .= "<div class='col-md-2 mb-2'>
                                                <a href='./perfil.php?id=" . $row2['idAtleta'] . "'><img src='../../dist/" . $row2['fotoAmigo'] . "' alt='" . $row2['nomeAmigo'] . "' class='rounded-circle' style='height: 40px; width: 40px;' data-toggle='tooltip' data-placement='top' title='" . $row2['nomeAmigo'] . "' style='cursor: pointer;'></a>
                                            </div>";
                                    }
                                }
                            }

                            $msgA .= "</div>
                                        <button type='button' class='btn mb-2' style = 'background-color: #b80000; color: white;'
                                        onmouseover=\"this.style.backgroundColor = '#cf0202';\" onmouseout=\"this.style.backgroundColor = '#b80000';\" onclick='cancelarMarcacao(" . $row['idMarcacao'] . ")'><i class= 'ti ti-x me-1'></i>Cancelar</button>
                                        </div>
                                    </div>
                                </div>";
                        } else {
                            $msgA .= "</div>
                                        <button type='button' class='btn mb-2' style = 'background-color: #b80000; color: white;'
                                        onmouseover=\"this.style.backgroundColor = '#cf0202';\" onmouseout=\"this.style.backgroundColor = '#b80000';\" onclick='cancelarMarcacaoTorneio(" . $row['idMarcacao'] . ")'><i class= 'ti ti-x me-1'></i>Cancelar</button>
                                        </div>
                                    </div>
                                </div>";
                        }

                        $horaA = $row['horaMarcInicio'];
                        $diaA = $row['dataMarc'];
                    } else {
                        $flag = true;
                        if (($horaA < $row['horaMarcInicio'] && $diaA == $row['dataMarc']) ||  $diaA != $row['dataMarc']) {

                            $data = new DateTime($row['dataMarc']);
                            $stringData = $data->format('d/m/Y');

                            $hora = new DateTime($row['horaMarcInicio']);
                            $stringHora = $hora->format('H:i');

                            $msg .= $msgA;
                            $msg .= "<div class='col-lg-12'>
                            <div class='card card-hover align-items-center shadow' style='margin: 20px 40px;'>
                                <img src='" . $row['fotoCampo'] . "' class='card-img-top object-fit-cover' style='max-height: 300px' alt='" . $row['nomeCampo'] . "'>
                                <div class='p-3'>
                                    <span class='fs-4 text-dark mt-2'>Nº: <span class='fw-bolder'>" . $row['idMarcacao'] . "</span></span>
                                    <h5 class='m-0 p-0 card-title fs-7'><i class='ti ti-map-pin me-1'></i>" . $row['nomeCampo'] . "</h5>
                                    <div class='d-flex justify-content-around'>
                                        <p class='m-0 p-0 card-text fs-6'><i class='ti ti-calendar me-1'></i>" . $stringData . "</p>
                                        <p class='m-0 p-0 card-text fs-6'>&nbsp;&nbsp;&nbsp;</p> 
                                        <p class='m-0 p-0 card-text fs-6'><i class='ti ti-clock me-1'></i>" . $stringHora . "</p>
                                    </div>
                                    <a href='./clube.php?id=" . $row['idClube'] . "'>
                                            <p class='card-text fs-4'><i class='ti ti-building me-1 fs-5 mt-1'></i>" . $row['nomeClube'] . "</p>
                                    </a>";


                            if ($row['tipo'] == "Marcação") {

                                $msg .= "<div class='mt-1 mb-1'>
                                        <span class='fs-3'>Participantes</span>
                                    </div>                                    
                                    <div class='mt-1 d-flex overflow-y-auto gap-2' style='min-height: 70px'>";

                                $sql2 = "SELECT listagem_atletas_marcacao.id_marcacao AS idMarcacao, 
                                listagem_atletas_marcacao.id_atleta AS idAtleta, 
                                user.nome AS nomeAmigo,
                                user.foto AS fotoAmigo
                                FROM
                                listagem_atletas_marcacao
                                INNER JOIN
                                user ON listagem_atletas_marcacao.id_atleta = user.id
                                WHERE id_marcacao = " . $row['idMarcacao'] . "
                                AND listagem_atletas_marcacao.estado = 1";

                                $result2 = $conn->query($sql2);

                                if ($result2->num_rows > 0) {
                                    while ($row2 = $result2->fetch_assoc()) {
                                        if ($row2['idAtleta'] == $_SESSION['id']) {
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
                                $msgA .= "</div>
                                            <button type='button' class='btn mb-2' style = 'background-color: #b80000; color: white;'
                                            onmouseover=\"this.style.backgroundColor = '#cf0202';\" onmouseout=\"this.style.backgroundColor = '#b80000';\" onclick='cancelarMarcacao(" . $row['idMarcacao'] . ")'><i class= 'ti ti-x me-1'></i>Cancelar</button>
                                            </div>
                                        </div>
                                    </div>";
                            } else {
                                $msgA .= "</div>
                                            <button type='button' class='btn mb-2' style = 'background-color: #b80000; color: white;'
                                            onmouseover=\"this.style.backgroundColor = '#cf0202';\" onmouseout=\"this.style.backgroundColor = '#b80000';\" onclick='cancelarMarcacaoTorneio(" . $row['idMarcacao'] . ")'><i class= 'ti ti-x me-1'></i>Cancelar</button>
                                            </div>
                                        </div>
                                    </div>";
                            }


                            $msg .= "</div>
                            <button type='button' class='btn mb-2' style = 'background-color: #b80000; color: white;'
                            onmouseover=\"this.style.backgroundColor = '#cf0202';\" onmouseout=\"this.style.backgroundColor = '#b80000';\" onclick='cancelarMarcacao(" . $row['idMarcacao'] . ")'><i class= 'ti ti-x me-1'></i>Cancelar</button>
                                </div>
                            </div>
                        </div>";
                        } else {

                            $data = new DateTime($row['dataMarc']);
                            $stringData = $data->format('d/m/Y');

                            $hora = new DateTime($row['horaMarcInicio']);
                            $stringHora = $hora->format('H:i');

                            $msg .= "<div class='col-lg-12'>
                            <div class='card card-hover align-items-center shadow' style='margin: 20px 40px;'>
                                <img src='" . $row['fotoCampo'] . "' class='card-img-top object-fit-cover' style='max-height: 300px' alt='" . $row['nomeCampo'] . "'>
                                <div class='p-3'>
                                    <span class='fs-4 text-dark mt-1'>Nº: <span class='fw-bolder'>" . $row['idMarcacao'] . "</span></span>
                                    <h5 class='m-0 p-0 card-title fs-7'><i class='ti ti-map-pin me-1'></i>" . $row['nomeCampo'] . "</h5>
                                    <div class='d-flex justify-content-around'>
                                        <p class='m-0 p-0 card-text fs-6'><i class='ti ti-calendar me-1'></i>" . $stringData . "</p>
                                        <p class='m-0 p-0 card-text fs-6'>&nbsp;&nbsp;&nbsp;</p> 
                                        <p class='m-0 p-0 card-text fs-6'><i class='ti ti-clock me-1'></i>" . $stringHora . "</p>
                                    </div>
                                    <a href='./clube.php?id=" . $row['idClube'] . "'>
                                            <p class='card-text fs-4'><i class='ti ti-building me-1 fs-5 mt-1'></i>" . $row['nomeClube'] . "</p>
                                    </a>";


                            if ($row['tipo'] == "Marcação") {

                                $msg .= "<div class='mt-1 mb-1'>
                                                <span class='fs-3'>Participantes</span>
                                            </div>                                    
                                            <div class='mt-1 d-flex overflow-y-auto gap-2' style='min-height: 70px'>";

                                $sql2 = "SELECT listagem_atletas_marcacao.id_marcacao AS idMarcacao, 
                                        listagem_atletas_marcacao.id_atleta AS idAtleta, 
                                        user.nome AS nomeAmigo,
                                        user.foto AS fotoAmigo
                                        FROM
                                        listagem_atletas_marcacao
                                        INNER JOIN
                                        user ON listagem_atletas_marcacao.id_atleta = user.id
                                        WHERE id_marcacao = " . $row['idMarcacao'] . "
                                        AND listagem_atletas_marcacao.estado = 1";

                                $result2 = $conn->query($sql2);

                                if ($result2->num_rows > 0) {
                                    while ($row2 = $result2->fetch_assoc()) {
                                        if ($row2['idAtleta'] == $_SESSION['id']) {
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
                                $msgA .= "</div>
                                                    <button type='button' class='btn mb-2' style = 'background-color: #b80000; color: white;'
                                                    onmouseover=\"this.style.backgroundColor = '#cf0202';\" onmouseout=\"this.style.backgroundColor = '#b80000';\" onclick='cancelarMarcacao(" . $row['idMarcacao'] . ")'><i class= 'ti ti-x me-1'></i>Cancelar</button>
                                                    </div>
                                                </div>
                                            </div>";
                            } else {
                                $msgA .= "</div>
                                                    <button type='button' class='btn mb-2' style = 'background-color: #b80000; color: white;'
                                                    onmouseover=\"this.style.backgroundColor = '#cf0202';\" onmouseout=\"this.style.backgroundColor = '#b80000';\" onclick='cancelarMarcacaoTorneio(" . $row['idMarcacao'] . ")'><i class= 'ti ti-x me-1'></i>Cancelar</button>
                                                    </div>
                                                </div>
                                            </div>";
                            }


                            $msg .= "</div>
                                    <button type='button' class='btn mb-2' style = 'background-color: #b80000; color: white;'
                                    onmouseover=\"this.style.backgroundColor = '#cf0202';\" onmouseout=\"this.style.backgroundColor = '#b80000';\" onclick='cancelarMarcacao(" . $row['idMarcacao'] . ")'><i class= 'ti ti-x me-1'></i>Cancelar</button>
                                        </div>
                                    </div>
                                </div>";
                            $msg .= $msgA;
                        }
                    }
                    $contador++;
                }
                array_push($arrayHorasMarcacoesCalendario, array($row['horaMarcInicio'], $row['horaMarcFim'], $row['dataMarc'], $row['nomeClube']));
            }
            if (!$flag) {
                $msg .= $msgA;;
            }
        } else {
            $msg .= "<div class='col-lg-12'>
                            <h4 class='mt-5'>Sem jogos próximos!</h4>
                            <p class='p-3'>Quando procederes á marcação de jogos em campos, os mesmo irão aparecer aqui. De momento, não existe nenhuma marcação registada no teu nome ou em que sejas participante.</p>
                        </div>";
        }
        $resp = json_encode(array(
            "msg" => $msg,
            "arrayCalendario" => $arrayHorasMarcacoesCalendario
        ));

        $conn->close();
        return ($resp);
    }
    /*Mariana*/ 
    function  votacaoBasqFuts($id, $modalidade, $resEquipa, $resAdver, $numPontos, $idMvp)
    {
        global $conn;
        $sql = "";
        $sql2 = "";
        $msg = "";
        $nPontos = 0;
        $nVitorias = 0;
        $percVitorias = 0;
        $nomeTabela = "";
        $sql5 = "";
        if ($modalidade == "Basquetebol") {
            $sql .= "SELECT * FROM info_basquetebol WHERE id_atleta = " . $_SESSION['id'];
            $sql5 .= "UPDATE info_basquetebol SET n_mvp = n_mvp + 1 WHERE id_atleta = " . $idMvp;
        } else {
            $sql .= "SELECT * FROM info_futsal WHERE id_atleta = " . $_SESSION['id'];
            $sql5 .= "UPDATE info_futsal SET n_mvp = n_mvp + 1 WHERE id_atleta = " . $idMvp;
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['n_jogos'] >= 30) {
                    /*Cálculo de ranking é atualizado cada vez que as estatisticas do utilizador são alteradas. O valor base de nº de jogos é 30.*/
                    $ranking = ($row['n_vitorias'] / $row['n_jogos']) * 0.45 +
                        ($row['n_mvp'] / $row['n_jogos']) * 0.25;
                } else {
                    $ranking = 0;
                }
                if ($resEquipa > $resAdver) {
                    if ($modalidade == "Basquetebol") {
                        $sql2 .= "UPDATE info_basquetebol SET n_jogos = " . $row['n_jogos'] . " + 1 , n_vitorias = " . $row['n_vitorias'] . " + 1, n_pontos = " . $row['n_pontos'] . " + " . $numPontos . ", ranking = " . $ranking . " WHERE id_atleta = " . $_SESSION['id'];
                        $nomeTabela .= "info_basquetebol";
                    } else {
                        $sql2 .= "UPDATE info_futsal SET n_jogos = " . $row['n_jogos'] . " + 1 , n_vitorias = " . $row['n_vitorias'] . " + 1, n_golos = " . $row['n_golos'] . " + " . $numPontos . ", ranking = " . $ranking . " WHERE id_atleta = " . $_SESSION['id'];
                        $nomeTabela .= "info_futsal";
                    }
                    $columnNamePontos = ($modalidade == "Basquetebol") ? 'n_pontos' : 'n_golos';
                    $nPontos +=  $row[$columnNamePontos] + $numPontos;
                    $nVitorias += $row['n_vitorias'] + 1;
                    if ($row['n_jogos'] != 0) {
                        $percVitorias += ($nVitorias / $row['n_jogos'] + 1) * 100;
                    } else {
                        $percVitorias = 0;
                    }
                } else {
                    if ($modalidade == "Basquetebol") {
                        $sql2 .= "UPDATE info_basquetebol SET n_jogos = " . $row['n_jogos'] . " + 1 , n_pontos = " . $row['n_pontos'] . " + " . $numPontos . ", ranking = " . $ranking . " WHERE id_atleta = " . $_SESSION['id'];
                        $nomeTabela .= "info_basquetebol";
                    } else {
                        $sql2 .= "UPDATE info_futsal SET n_jogos = " . $row['n_jogos'] . " + 1, n_golos = " . $row['n_golos'] . " + " . $numPontos . ", ranking = " . $ranking . " WHERE id_atleta = " . $_SESSION['id'];
                        $nomeTabela .= "info_futsal";
                    }
                    $columnNamePontos = ($modalidade == "Basquetebol") ? 'n_pontos' : 'n_golos';
                    $nPontos +=  $row[$columnNamePontos] + $numPontos;
                    $nVitorias += $row['n_vitorias'];
                    if ($row['n_jogos'] != 0) {
                        $percVitorias += ($nVitorias / $row['n_jogos'] + 1) * 100;
                    } else {
                        $percVitorias = 0;
                    }
                }
            }
        }
        /*A coluna votação tem 3 valores possíveis: 0: jogo terminado mas não votado, 1: jogo terminado e votado, 2: jogo ainda não aconteceu. Após a votação, o valor é atualizado para 1 */
        $sql3 = "UPDATE listagem_atletas_marcacao SET votacao = 1 WHERE id_marcacao = " . $id . " AND id_atleta = " . $_SESSION['id'];
        if ($conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE) {
            $msg .= "Votação feita com sucesso!";
        } else {
            $flag = false;
            $msg = "Error: " . $sql2 . "<br>" . $conn->error;
            $icon = "error";
        }


        if ($conn->query($sql5) === TRUE) {
            $flag = true;
        } else {
            $flag = false;
            $msg .= "Nao foi possível adicionar o mvp";
        }
        /*A coluna votação tem 3 valores possíveis: 0: jogo terminado mas não votado, 1: jogo terminado e votado, 2: jogo ainda não aconteceu. Após a votação, o valor é atualizado para 1 */
        $resultadoBadges1 = $this->getBadgesPontos($modalidade,  $nPontos);
        $resultadoBadges2 = $this->getBadgesVitorias($modalidade, $nVitorias);
        $resultadoBadges3 = $this->getBadgesPercVitorias($modalidade, $percVitorias, $nomeTabela);
        $conn->close();
        $resp = json_encode(array(
            "msg" => $msg,
            "respBadgesPontos" =>  $resultadoBadges1,
            "respBadgesVitorias" =>  $resultadoBadges2,
            "respBadgesPercVitorias" =>  $resultadoBadges3
        ));
        return ($resp);
    }
    /*Mariana*/ 
    function votacaoPadelTenis($id, $modalidade, $resultados, $idMvp)
    {
        global $conn;
        $sql = "";
        $sql2 = "";
        $msg = "";
        $arrRes = json_decode($resultados);
        $nVit = 0;
        $nDerr = 0;
        $nSets = sizeof($arrRes);
        $nPontosSet = 0;
        $nPontos = 0;
        $nVitorias = 0;
        $percVitorias = 0;
        $nomeTabela = "";
        $sql5 = "";
        for ($i = 0; $i < sizeof($arrRes); $i++) {
            /*Comparação dos resultados da equipa do utilizador que fez a votação e a equipa contrária. Caso seja uma vitória, é adicionada ao número de vitórias e, em ambas as possibilidades, o número de pontos por set entram para as suas estatísticas pessoais. */
            if ($arrRes[$i][0] > $arrRes[$i][1]) {
                $nVit++;
                $nPontosSet = $nPontosSet + $arrRes[$i][0];
            } else {
                $nDerr++;
                $nPontosSet = $nPontosSet + $arrRes[$i][0];
            }
        }
        if ($modalidade == "Padel") {
            $sql .= "SELECT * FROM info_padel WHERE id_atleta = " . $_SESSION['id'];
            $sql5 .= "UPDATE info_padel SET n_mvp = n_mvp + 1 WHERE id_atleta = " . $idMvp;
        } else {
            $sql .= "SELECT * FROM info_tenis WHERE id_atleta = " . $_SESSION['id'];
            $sql5 .= "UPDATE info_tenis SET n_mvp = n_mvp + 1 WHERE id_atleta = " . $idMvp;
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['n_jogos'] >= 30) {
                     /*Cálculo de ranking é atualizado cada vez que as estatisticas do utilizador são alteradas. O valor base de nº de jogos é 30.*/
                    $ranking = ($row['n_vitorias']/$row['n_jogos'])*0.45 + ($row['n_mvp']/$row['n_jogos'])*0.25 + ($row['n_set_ganhos']/$row['n_sets'])*0.3;
                }else{
                    $ranking = 0;
                }
                if ($nVit >  $nDerr) {
                    if ($modalidade == "Padel") {
                        $sql2 .= "UPDATE info_padel SET n_jogos = " . $row['n_jogos'] . " + 1 , n_vitorias = " . $row['n_vitorias'] . " + 1, n_pontos_set = " . $row['n_pontos_set'] . " + " . $nPontosSet . ", n_set_ganhos = " . $row['n_set_ganhos'] . " + " . $nVit . ", n_sets =" . $row['n_sets'] . " + " . $nSets . ", ranking = " . $ranking . "  WHERE id_atleta = " . $_SESSION['id'];
                        $nomeTabela .= "info_padel";
                    } else {
                        $sql2 .= "UPDATE info_tenis SET n_jogos = " . $row['n_jogos'] . " + 1 , n_vitorias = " . $row['n_vitorias'] . " + 1, n_pontos_set = " . $row['n_pontos_set'] . " + " . $nPontosSet . ", n_set_ganhos = " . $row['n_set_ganhos'] . " + " . $nVit . " , n_sets =" . $row['n_sets'] . " + " . $nSets . ", ranking = " . $ranking . "  WHERE id_atleta = " . $_SESSION['id'];
                        $nomeTabela .= "info_tenis";
                    } 
                    /*O numero de pontos, numero de vitorias e percentagem de vitórias são guardados em variáveis para posteriormente as funções de atribuição de badges serem executadas com os novos valores. */
                    $nPontos = $row['n_pontos_set'] + $nPontosSet;
                    $nVitorias += $row['n_vitorias'] + 1;
                    if( $row['n_jogos'] > 0){
                        $percVitorias +=  ($nVitorias / $row['n_jogos'] + 1) * 100;
                    }
                } else {
                    if ($modalidade == "Padel") {
                        $sql2 .= "UPDATE info_padel SET n_jogos = " . $row['n_jogos'] . " + 1 , n_pontos_set = " . $row['n_pontos_set'] . " + " . $nPontosSet . ", n_set_ganhos = " . $row['n_set_ganhos'] . " + " . $nVit . ", n_sets =" . $row['n_sets'] . " + " . $nSets . ", ranking = " . $ranking . "  WHERE id_atleta = " . $_SESSION['id'];
                        $nomeTabela .= "info_padel";
                    } else {
                        $sql2 .= "UPDATE info_tenis SET n_jogos = " . $row['n_jogos'] . " + 1 , n_pontos_set = " . $row['n_pontos_set'] . " + " . $nPontosSet . ", n_set_ganhos = " . $row['n_set_ganhos'] . " + " . $nVit . ", n_sets =" . $row['n_sets'] . " + " . $nSets . ", ranking = " . $ranking . "  WHERE id_atleta = " . $_SESSION['id'];
                        $nomeTabela .= "info_tenis";
                    }
                    $nPontos = $row['n_pontos_set'] + $nPontosSet;
                    $nVitorias += $row['n_vitorias'];
                    if( $row['n_jogos'] > 0){
                        $percVitorias +=  ($nVitorias / $row['n_jogos'] + 1) * 100;
                    }
                }
            }
        }
        /*A coluna votação tem 3 valores possíveis: 0: jogo terminado mas não votado, 1: jogo terminado e votado, 2: jogo ainda não aconteceu. Após a votação, o valor é atualizado para 1 */
        $sql3 = "UPDATE listagem_atletas_marcacao SET votacao = 1 WHERE id_marcacao = " . $id . " AND id_atleta = " . $_SESSION['id'];
        if ($conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE) {
            $msg .= "Votação feita com sucesso!";
        } else {
            $flag = false;
            $msg = "Error: " . $sql2 . "<br>" . $conn->error;
            $msg = "Error: " . $sql3 . "<br>" . $conn->error;
            $icon = "error";
        }

        if ($conn->query($sql5) === TRUE) {
            $flag = true;
        } else {
            $flag = false;
            $msg .= "Nao foi possível adicionar o mvp";
        }
        /*Cálculo de atribuição de badges para novas estatísticas para enviar para js e gerar um toast com a notificação de conquista de um novo badge. São chamadas 3 funções, que se dividem em categorias diferentes de badges.*/
        $resultadoBadges1 = $this->getBadgesPontos($modalidade,  $nPontos);
        $resultadoBadges2 = $this->getBadgesVitorias($modalidade, $nVitorias);
        $resultadoBadges3 = $this->getBadgesPercVitorias($modalidade, $percVitorias, $nomeTabela);
        $conn->close();
        $resp = json_encode(array(
            "msg" => $msg,
            "respBadges" =>  $resultadoBadges1,
            "respBadgesVitorias" =>  $resultadoBadges2,
            "respBadgesPercVitorias" =>  $resultadoBadges3
        ));
        return ($resp);
    }
     /*Pedro*/ 
    function getPerfilNavbar()
    {
        global $conn;
        $fotoPerfil = "";
        $email = "";
        $nome = "";

        $sql = "SELECT user.foto as foto, user.email as email, user.nome as nome FROM user INNER JOIN atleta ON user.id = atleta.id_atleta WHERE user.id = " . $_SESSION['id'];

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $fotoPerfil = "../../dist/" . $row['foto'] . "";
                $email = $row['email'];
                $nome = $row['nome'];
            }
        }

        $conn->close();
        $resp = json_encode(array("fotoPerfil" => $fotoPerfil, "nome" => $nome, "email" => $email, "id" => $_SESSION['id']));
        return ($resp);
    }
    /*Mariana*/ 
    function getEstatisticas($id)
    {
        /*função geral para construção de arrays de estatísticas de cada modalidade para mostrar do perfil de user.*/
        global $conn;
        $sql = "SELECT modalidade.descricao as modalidade FROM modalidade INNER JOIN atleta_modalidade ON modalidade.id = atleta_modalidade.id_modalidade WHERE atleta_modalidade.id_atleta = '" . $id . "'";
        $result = $conn->query($sql);
        $arrEst = array();
        /*Pelo facto das estatisticas de modalidades serem divididas em tabelas distintas, a associação do user às suas modalidades é necessária previamente. .*/
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['modalidade'] == 'Basquetebol') {
                    $resp = $this->getEstatisticasBasquetebol($id);
                    array_push($arrEst, $resp);
                } else if ($row['modalidade'] == 'Futsal') {
                    $resp = $this->getEstatisticasFutsal($id);
                    array_push($arrEst, $resp);
                } else if ($row['modalidade'] == 'Padel') {
                    $resp = $this->getEstatisticasPadel($id);
                    array_push($arrEst, $resp);
                } else {
                    $resp = $this->getEstatisticasTenis($id);
                    array_push($arrEst, $resp);
                }
            }
        }
        $resp = json_encode($arrEst);
        $conn->close();
        return ($resp);
    }
    /*Mariana*/ 
    function getEstatisticasPadel($id)
    {
        global $conn;
        $sql = "SELECT info_padel.*, temp2.ranking AS posicao 
        FROM info_padel,
        (
        SELECT temp.posicao AS ranking
            FROM (
            SELECT ROW_NUMBER() OVER (ORDER BY ranking DESC) AS posicao, ranking, id_atleta
            FROM info_padel
            ORDER BY ranking DESC
            )AS temp
            WHERE temp.id_atleta = " . $id . "
        )AS temp2
        WHERE id_atleta = " . $id;
        $result = $conn->query($sql);
        $percVitorias1 = 0;
        $percVitorias = "";
        $nJogos = 0;
        $nPontos = 0;
        $nSetsGanhos = 0;
        $nMvp = 0;
        $percSetsGanhos = 0;
        $mediaPontosSet = 0;
        $ranking = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['n_jogos'] != 0) {
                    $percVitorias1 = round(($row['n_vitorias'] / $row['n_jogos']) * 100, 1, PHP_ROUND_HALF_DOWN);
                    $percVitorias = $percVitorias1 . "%";
                } else {
                    $percVitorias .= "0 %";
                }
                if ($row['n_sets'] != 0) {
                    $percSetsGanhos = round(($row['n_set_ganhos'] / $row['n_sets']) * 100, 1, PHP_ROUND_HALF_DOWN);
                    $mediaPontosSet = round(($row['n_pontos_set'] / $row['n_sets']), 1, PHP_ROUND_HALF_DOWN);
                }
                $nJogos = $row['n_jogos'];
                $nPontos = $row['n_pontos_set'];
                $nSetsGanhos = $row['n_set_ganhos'];
                $nMvp = $row['n_mvp'];
                $ranking = $row['posicao'];
            }
        }
        $resp = array("modalidade" => "Padel", "percVitorias" => $percVitorias, "nJogos" => $nJogos, "nPontos" => $nPontos, "nSetsGanhos" => $nSetsGanhos, "nMvp" => $nMvp, "percSets" => $percSetsGanhos, "mediaPontosSet" => $mediaPontosSet, "ranking" => $ranking);
        return ($resp);
    }
    /*Mariana*/ 
    function getEstatisticasTenis($id)
    {
        global $conn;
        $sql = "SELECT info_tenis.*, temp2.ranking AS posicao 
        FROM info_tenis,
        (
        SELECT temp.posicao AS ranking
            FROM (
            SELECT ROW_NUMBER() OVER (ORDER BY ranking DESC) AS posicao, ranking, id_atleta
            FROM info_tenis
            ORDER BY ranking DESC
            )AS temp
            WHERE temp.id_atleta = " . $id . "
        )AS temp2
        WHERE id_atleta = " . $id;
        $result = $conn->query($sql);
        $percVitorias1 = 0;
        $percVitorias = "";
        $nJogos = 0;
        $nPontos = 0;
        $nSetsGanhos = 0;
        $nMvp = 0;
        $percSetsGanhos = 0;
        $mediaPontosSet = 0;
        $ranking = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['n_jogos'] != 0) {
                    $percVitorias1 = round(($row['n_vitorias'] / $row['n_jogos']) * 100, 1, PHP_ROUND_HALF_DOWN);
                    $percVitorias = $percVitorias1 . "%";
                } else {
                    $percVitorias .= "0 %";
                }
                if ($row['n_sets'] != 0) {
                    $percSetsGanhos = round(($row['n_set_ganhos'] / $row['n_sets']) * 100, 1, PHP_ROUND_HALF_DOWN);
                    $mediaPontosSet = round(($row['n_pontos_set'] / $row['n_sets']), 1, PHP_ROUND_HALF_DOWN);
                }
                $nJogos = $row['n_jogos'];
                $nPontos = $row['n_pontos_set'];
                $nSetsGanhos = $row['n_set_ganhos'];
                $nMvp = $row['n_mvp'];
                $ranking = $row['posicao'];
            }
        }
        $resp = array("modalidade" => "Ténis", "percVitorias" => $percVitorias, "nJogos" => $nJogos, "nPontos" => $nPontos, "nSetsGanhos" => $nSetsGanhos, "nMvp" => $nMvp, "percSets" => $percSetsGanhos, "mediaPontosSet" => $mediaPontosSet, "ranking" => $ranking);
        return ($resp);
    }
    /*Mariana*/ 
    function getEstatisticasBasquetebol($id)
    {
        global $conn;
        $sql = "SELECT info_basquetebol.*, temp2.ranking AS posicao 
        FROM info_basquetebol,
        (
        SELECT temp.posicao AS ranking
            FROM (
            SELECT ROW_NUMBER() OVER (ORDER BY ranking DESC) AS posicao, ranking, id_atleta
            FROM info_basquetebol
            ORDER BY ranking DESC
            )AS temp
            WHERE temp.id_atleta = " . $id . "
        )AS temp2
        WHERE id_atleta = " . $id;
        $result = $conn->query($sql);
        $percVitorias1 = 0;
        $percVitorias = "";
        $nJogos = 0;
        $nPontos = 0;
        $nMvp = 0;
        $ranking = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['n_jogos'] != 0) {
                    $percVitorias1 = round(($row['n_vitorias'] / $row['n_jogos']) * 100, 1, PHP_ROUND_HALF_DOWN);
                }
                $percVitorias = $percVitorias1 . "%";
                $nJogos = $row['n_jogos'];
                $nPontos = $row['n_pontos'];
                $nMvp = $row['n_mvp'];
                $ranking = $row['posicao'];
            }
        }
        $resp = array("modalidade" => "Basquetebol", "percVitorias" => $percVitorias, "nJogos" => $nJogos, "nPontos" => $nPontos, "nMvp" => $nMvp, "ranking" => $ranking);
        return ($resp);
    }
    /*Mariana*/ 
    function getEstatisticasFutsal($id)
    {
        global $conn;
        $sql = "SELECT info_futsal.*, temp2.ranking AS posicao 
        FROM info_futsal,
        (
        SELECT temp.posicao AS ranking
            FROM (
            SELECT ROW_NUMBER() OVER (ORDER BY ranking DESC) AS posicao, ranking, id_atleta
            FROM info_futsal
            ORDER BY ranking DESC
            )AS temp
            WHERE temp.id_atleta = " . $id . "
        )AS temp2
        WHERE id_atleta = " . $id;
        $result = $conn->query($sql);
        $percVitorias1 = 0;
        $percVitorias = "";
        $nJogos = 0;
        $nGolos = 0;
        $nMvp = 0;
        $ranking = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['n_jogos'] != 0) {
                    $percVitorias1 = round(($row['n_vitorias'] / $row['n_jogos']) * 100, 1, PHP_ROUND_HALF_DOWN);
                }
                $percVitorias = $percVitorias1 . "%";
                $nJogos = $row['n_jogos'];
                $nGolos = $row['n_golos'];
                $nMvp = $row['n_mvp'];
                $ranking = $row['posicao'];
            }
        }
        $resp = array("modalidade" => "Futsal", "percVitorias" => $percVitorias, "nJogos" => $nJogos, "nGolos" => $nGolos, "nMvp" => $nMvp, "ranking" => $ranking);
        return ($resp);
    }
    /*Mariana*/ 
    function getNotificacaoConviteMarcacao()
    {

        global $conn;
        $sql = " SELECT listagem_atletas_marcacao.id_marcacao as idMarcacao 
                FROM listagem_atletas_marcacao 
                INNER JOIN marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao 
                INNER JOIN campo_clube ON marcacao.id_campo = campo_clube.id_campo 
                INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id 
                WHERE listagem_atletas_marcacao.id_atleta = '" . $_SESSION['id'] . "' 
                AND marcacao.id_atleta != '" . $_SESSION['id'] . "'  
                AND listagem_atletas_marcacao.estado = 0";
        $result = $conn->query($sql);
        $msg = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<a class='py-6 px-7 d-flex align-items-center dropdown-item' style='cursor: pointer;' onclick = 'getModalConviteMarcacao(" . $row['idMarcacao'] . ")'>
                <span class='me-3'>
                <img src='../../dist/images/rating/invite.png' alt='user' class='rounded-circle object-fit-cover'
                    width='48' height='48' />
                </span>
                <div class='w-75 d-inline-block v-middle'>
                    <h6 class='mb-1 fw-semibold'>Convite Partida</h6>
                    <span class='d-block'>Foi convidado para uma partida.</span>
                </div>
            </a>";
            }
        }
        $conn->close();
        return ($msg);
    }
    /*Mariana*/ 
    function getModalConviteMarcacao($id)
    {

        global $conn;
        $sql = "SELECT marcacao.data_inicio AS dataMarc, 
                marcacao.hora_inicio AS horaMarc,
                marcacao.id_atleta AS idAtletaHost,
                user_atleta.nome AS nomeAtletaHost,
                user_atleta.foto AS fotoAtletaHost, 
                modalidade.descricao AS modalidade,
                campo.nome AS nomeCampoMarcacao,
                campo.foto AS fotoCampoMarcacao,
                campo.morada AS moradaCampoMarcacao,
                user_clube.id AS idClube,  
                user_clube.nome AS nomeClube, 
                user_clube.foto as fotoClube
                FROM 
                listagem_atletas_marcacao 
                INNER JOIN marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao 
                INNER JOIN campo_clube ON marcacao.id_campo = campo_clube.id_campo
                INNER JOIN campo ON campo_clube.id_campo = campo.id 
                INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id 
                INNER JOIN clube ON campo_clube.id_clube = clube.id_clube 
                INNER JOIN atleta ON marcacao.id_atleta = atleta.id_atleta
                INNER JOIN user AS user_clube ON clube.id_clube = user_clube.id
                INNER JOIN user AS user_atleta ON atleta.id_atleta = user_atleta.id
                WHERE listagem_atletas_marcacao.id_marcacao = " . $id . "
                AND listagem_atletas_marcacao.id_atleta = " . $_SESSION['id'];

        $result = $conn->query($sql);
        $msg = "";
        $mod = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['modalidade'] == "Basquetebol") {
                    $mod .= "<span class='badge rounded-pill text-bg-warning mt-2 fs-5'><i
                    class='ti ti-ball-basketball me-1'></i><small>Basquetebol</small></span>";
                } else if ($row['modalidade'] == "Futsal") {
                    $mod = "<span class='badge rounded-pill text-bg-danger mt-2 fs-5'><i
                    class='ti ti-ball-football me-1'></i><small>Futsal</small></span>";
                } else if ($row['modalidade'] == "Padel") {
                    $mod = "<span class='badge rounded-pill text-bg-primary mt-2 fs-5'><i
                    class='ti ti-ball-tennis me-1'></i><small>Padel</small></span>";
                } else {
                    $mod = "<span class='badge rounded-pill text-bg-success mt-2 fs-5'><i
                    class='ti ti-ball-tennis me-1'></i><small>Ténis</small></span>";
                }

                $data = new DateTime($row['dataMarc']);
                $stringData = $data->format('d/m/Y');

                $hora = new DateTime($row['horaMarc']);
                $stringHora = $hora->format('H:i');

                $msg .= "
                <div class='d-flex justify-content-center pb-5'>
                <h4 class='fw-semibold fs-9'>Convite Marcação</h4>
              </div>
              <div class='container-fluid'>
                <div class='row'>
                  <div class='col-md-6 text-center'>
                    <img src='" . $row['fotoCampoMarcacao'] . "' alt='Clube 1' class='img-fluid rounded border border-1 border-primary'>
                  </div>
                  <div class='col-md-6 d-flex justify-content-end align-items-center'>
                    <div class='mb-3'>
                      <small class='fs-6'><i class='ti ti-calendar me-1'></i>" . $stringData . "</small><br>
                      <small class='fs-6'><i class='ti ti-clock me-1'></i>" . $stringHora . "</small><br>
                      <small class='fs-6'><i class='ti ti-map-pin me-1'></i>" . $row['nomeCampoMarcacao'] . "</small><br>
                      <a href='./clube.php?id=" . $row['idClube'] . "'><small class='fs-6'><i class='ti ti-building me-1'></i>" . $row['nomeClube'] . "</small><br></a>
                      " . $mod . "
                            <div class='d-flex justify-content-start'>
                                <small class='fs-6 mb-3 mt-3 me-3'>Host:</small>
                                <a href='./perfil.php?id=" . $row['idAtletaHost'] . "'><img id='" . $row['idAtletaHost'] . "' src='../../dist/" . $row['fotoAtletaHost'] . "' alt='" . $row['nomeAtletaHost'] . "'
                                    class='rounded-circle object-fit-cover mt-2' width='40' height='40' onclick='' data-toggle='tooltip'
                                        data-placement='top' title='" . $row['nomeAtletaHost'] . "' style='border: 2px solid transparent; border-radius: 50%; transition: border-color 0.3s;' onmouseover='this.style.borderColor=\"#044967\";' onmouseout='this.style.borderColor=\"transparent\";'></a>
                            </div>            
                    </div>
                  </div>
                </div>
              </div>";
            }
        }
        $resp = json_encode(array(
            "msg" => $msg
        ));

        $conn->close();
        return ($resp);
    }
    /*Pedro*/ 
    function aceitarConvite($idMarcacao)
    {

        global $conn;
        $msg = "";
        $icon = "";
        $flag = false;
        $titulo = "";

        $sql = "UPDATE listagem_atletas_marcacao
                SET estado = 1
                WHERE listagem_atletas_marcacao.id_marcacao = " . $idMarcacao . "
                AND listagem_atletas_marcacao.id_atleta = " . $_SESSION['id'];

        if ($conn->query($sql) === TRUE) {
            $titulo = "Sucesso";
            $msg = "Convite aceite com sucesso.";
            $icon = "success";
            $flag = true;
        } else {
            $titulo = "Erro";
            $msg = "Não foi possível aceitar o convite.";
            $icon = "success";
            $flag = true;
        }

        $resp = json_encode(array(
            "titulo" => $titulo,
            "msg" => $msg,
            "icon" => $icon,
            "flag" => $flag
        ));
        $conn->close();
        return ($resp);
    }
    /*Pedro*/ 
    function rejeitarConvite($idMarcacao)
    {
        global $conn;
        $msg = "";
        $icon = "";
        $flag = false;
        $titulo = "";

        $sql = "DELETE FROM listagem_atletas_marcacao
                WHERE listagem_atletas_marcacao.id_marcacao = " . $idMarcacao . "
                AND listagem_atletas_marcacao.id_atleta = " . $_SESSION['id'];

        if ($conn->query($sql) === TRUE) {
            $titulo = "Sucesso";
            $msg = "Convite rejeitado com sucesso.";
            $icon = "success";
            $flag = true;
        } else {
            $titulo = "Erro";
            $msg = "Não foi possível rejeitar o convite.";
            $icon = "success";
            $flag = true;
        }

        $resp = json_encode(array(
            "titulo" => $titulo,
            "msg" => $msg,
            "icon" => $icon,
            "flag" => $flag
        ));
        $conn->close();
        return ($resp);
    }
    /*Pedro*/ 
    function adicionarAmigo($idAmigo)
    {
        global $conn;
        $msg = "";
        $icon = "";
        $flag = false;
        $titulo = "";

        $sql = "INSERT INTO amigo(id_atleta1, id_atleta2) VALUES (" . $_SESSION['id'] . ", " . $idAmigo . ")";

        if ($conn->query($sql) === TRUE) {
            $titulo = "Sucesso";
            $msg = "Pedido de Amizade efetuado com sucesso!";
            $icon = "success";
            $flag = true;
        } else {
            $titulo = "Erro";
            $msg = "Não foi possível pedir amizade a este Utilizador!";
            $icon = "error";
            $flag = false;
        }

        $resp = json_encode(array(
            "titulo" => $titulo,
            "msg" => $msg,
            "icon" => $icon,
            "flag" => $flag
        ));
        $conn->close();
        return ($resp);
    }
     /*Pedro*/ 
    function notificacaoPedidoAmizade()
    {
        global $conn;
        $msg = "";

        $sql = "SELECT user.nome, user.id, user.foto
                FROM user 
                WHERE user.id IN (
                SELECT amigo
                FROM (
                SELECT amigo.id_atleta1 AS amigo, amigo.estado AS estado
                FROM amigo 
                WHERE amigo.id_atleta2 = " . $_SESSION['id'] . "
                AND  amigo.estado = 0
                )as temp)";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<a class='py-6 px-7 d-flex align-items-center dropdown-item' style='cursor: pointer;'>
                            <span class='me-3'>
                                <img src='../../dist/" . $row['foto'] . "' alt='" . $row['nome'] . "' class='rounded-circle object-fit-cover'
                                    width='48' height='48' />
                            </span>
                            <div class='w-75 d-inline-block v-middle'>
                                <h6 class='mb-1 fw-semibold'>Pedido de Amizade</h6>
                                <span class='d-block'>" . $row['nome'] . " pretende adicioná-lo.</span>
                                <div class='d-flex justify-content-around align-items-center mt-1'>
                                    <button class='btn btn-success' 
                                        style='--bs-btn-padding-y: .15rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;' onclick='aceitarPedido(" . $row['id'] . ")'>
                                        <i class='ti ti-check me-1'></i>
                                        <span class='me-1'>Aceitar</span>
                                    </button>
                                    <button class='btn' style='--bs-btn-padding-y: .15rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem; background-color: #b80000; color: white;'
                                        onmouseover=\"this.style.backgroundColor = '#cf0202';\" onmouseout=\"this.style.backgroundColor = '#b80000';\" onclick='rejeitarPedido(" . $row['id'] . ")'>
                                        <i class='ti ti-x me-1'></i>
                                        <span class='me-1'>Rejeitar</span>
                                    </button>
                                </div>
                            </div>
                        </a>";
            }
        }
        $conn->close();
        return ($msg);
    }
     /*Pedro*/ 
    function aceitarPedido($id)
    {

        global $conn;
        $msg = "";
        $icon = "";
        $flag = false;
        $titulo = "";

        $sql = "UPDATE amigo SET estado = 1 WHERE id_atleta1 = " . $id . " AND id_atleta2 = " . $_SESSION['id'];

        if ($conn->query($sql) === TRUE) {
            $titulo = "Sucesso";
            $msg = "Pedido aceite com sucesso";
            $icon = "success";
            $flag = true;
        } else {
            $titulo = "Erro";
            $msg = "Não foi possível aceitar o pedido.";
            $icon = "success";
            $flag = true;
        }

        $resp = json_encode(array(
            "titulo" => $titulo,
            "msg" => $msg,
            "icon" => $icon,
            "flag" => $flag
        ));
        $conn->close();
        return ($resp);
    }
    /*Pedro*/ 
    function rejeitarPedido($id)
    {

        global $conn;
        $msg = "";
        $icon = "";
        $flag = false;
        $titulo = "";

        $sql = "DELETE FROM amigo WHERE id_atleta1 = " . $id . " AND id_atleta2 = " . $_SESSION['id'];

        if ($conn->query($sql) === TRUE) {
            $titulo = "Sucesso";
            $msg = "Pedido rejeitado com sucesso";
            $icon = "success";
            $flag = true;
        } else {
            $titulo = "Erro";
            $msg = "Não foi possível rejeitar o pedido.";
            $icon = "success";
            $flag = true;
        }

        $resp = json_encode(array(
            "titulo" => $titulo,
            "msg" => $msg,
            "icon" => $icon,
            "flag" => $flag
        ));
        $conn->close();
        return ($resp);
    }
    /*Pedro*/ 
    function getJogosRecentes($idUser, $offset, $porPagina)
    {
        global $conn;
        $msg = "";

        $offset = max(0, $offset); // Ter a certeza que o offset não é inferior a 0, se sim, mete a 0

        $sqlContagem = "SELECT COUNT(*) AS total FROM listagem_atletas_marcacao
                INNER JOIN marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao 
                INNER JOIN campo_clube ON marcacao.id_campo = campo_clube.id_campo
                INNER JOIN campo ON campo_clube.id_campo = campo.id 
                INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id
                INNER JOIN clube ON campo_clube.id_clube = clube.id_clube  
                INNER JOIN user ON clube.id_clube = user.id  
                WHERE listagem_atletas_marcacao.id_atleta = " . $idUser . " 
                AND listagem_atletas_marcacao.votacao = 1";

        $resultadoContagem = $conn->query($sqlContagem);
        $totalRows = $resultadoContagem->fetch_assoc();
        $itemsTotais = $totalRows['total'];

        $sql = "SELECT 
                listagem_atletas_marcacao.id_marcacao as idMarcacao,
                marcacao.id_atleta AS idAtletaHostMarcacao,
                marcacao.data_inicio AS dataInicioMarcacao,
                marcacao.hora_inicio AS horaInicioMarcacao,
                marcacao.tipo AS tipoMarcacao,
                marcacao.id_campo AS idCampoMarcacao,
                campo.foto as fotoCampoMarcacao,
                campo.nome AS nomeCampoMarcacao,
                user.nome AS nomeClube,
                clube.id_clube AS idClube,
                modalidade.descricao AS modalidadeMarcacao
                FROM listagem_atletas_marcacao 
                INNER JOIN marcacao ON marcacao.id = listagem_atletas_marcacao.id_marcacao 
                INNER JOIN campo_clube ON marcacao.id_campo = campo_clube.id_campo
                INNER JOIN campo ON campo_clube.id_campo = campo.id 
                INNER JOIN modalidade ON campo_clube.id_modalidade = modalidade.id
                INNER JOIN clube ON campo_clube.id_clube = clube.id_clube  
                INNER JOIN user ON clube.id_clube = user.id  
                WHERE listagem_atletas_marcacao.id_atleta = " . $idUser . " 
                AND listagem_atletas_marcacao.votacao = 1
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

                $msg .= "<div class='card shadow border hover-img'>
                            <div class='p-3'>
                                <div class='row mt-2'>
                                    <div class='col-6 col-md-6 mt-2'>
                                        <span class='fs-4 text-dark'>Nº: <span class='fw-bolder'>" . $row['idMarcacao'] . "</span></span>
                                    </div>
                                    <div class='col-6 col-md-6 d-flex justify-content-end mt-2'>
                                        <button type='button' class='btn btn-success disabled btn-sm'><i class='ti ti-check me-1'></i>Concluída</button>
                                    </div>
                                    <div class='col-6 col-md-3 col-sm-6 mt-3 d-flex justify-content-between'>";
                if ($row['modalidadeMarcacao'] == "Basquetebol") {
                    $msg .= "<span class='badge rounded-pill position-absolute ms-2 mt-2 top-0 start-0 text-bg-warning'>
                                                    <i class='ti ti-ball-basketball me-1'></i><small>" . $row['modalidadeMarcacao'] . "</small>
                                                </span>";
                } else if ($row['modalidadeMarcacao'] == "Futsal") {
                    $msg .= "<span class='badge rounded-pill position-absolute ms-2 mt-2 top-0 start-0 text-bg-danger mt-2'>
                                                    <i class='ti ti-ball-football me-1'></i><small>" . $row['modalidadeMarcacao'] . "</small>
                                                </span>";
                } else if ($row['modalidadeMarcacao'] == "Ténis") {
                    $msg .= "<span class='badge rounded-pill position-absolute ms-2 mt-2 top-0 start-0 text-bg-success mt-2'>
                                                    <i class='ti ti-ball-tennis me-1'></i><small>" . $row['modalidadeMarcacao'] . "</small>
                                                </span>";
                } else {
                    $msg .= "<span class='badge rounded-pill position-absolute ms-2 mt-2 top-0 start-0 text-bg-primary mt-2'>
                                                    <i class='ti ti-ball-tennis me-1'></i><small>" . $row['modalidadeMarcacao'] . "</small>
                                                </span>";
                }
                $msg .= "<img src='" . $row['fotoCampoMarcacao'] . "' alt='" . $row['nomeCampoMarcacao'] . "'
                                                 class=' img-fluid object-fit-fill rounded-2 border border-1 border-primary' style='height: 100px; width: 150px;'>";
                $msg .= "</div>
                                    <div class='col-6 col-md-3 col-sm-6 mt-3'>
                                    <a href='./clube.php?id=" . $row['idClube'] . "'><small class='fs-4'><i class='ti ti-building me-1'></i>" . $row['nomeClube'] . "</small><br></a>
                                    <small><i class='ti ti-calendar me-1'></i>" . $stringData . "</small><br>
                                    <small><i class='ti ti-clock me-1'></i>" . $stringHora . "</small><br>
                                    <small><i class='ti ti-map-pin me-1'></i>" . $row['nomeCampoMarcacao'] . "</small><br>";
                $msg .= "</div>
                                    <div class='col-12 col-md-6 col-sm-6'>
                                        <div class='row'>
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
            if ($idUser != $_SESSION['id']) {
                $msg .= "<div class='text-center mt-5'>
                            <h4>Sem resultados!</h4>
                            <p>Não há jogos recentes de momento para este Utilizador.</p>
                        </div>";
            } else {
                $msg .= "<div class='text-center mt-5'>
                            <h4>Sem resultados!</h4>
                            <p>Faz ou junta-te a marcações, dá a tua votação, e irás ter conteúdo aqui!</p>
                        </div>";
            }
        }

        $conn->close();

        $data = array('msg' => $msg, 'paginasTotais' => $paginasTotais, 'paginaAtual' => $paginaAtual);
        return json_encode($data);
    } 
    /*Pedro*/ 
    function getModalRemoverAmizade($id)
    {
        $msg = "<button type='button' class='btn btn-primary text-white font-medium waves-effect text-start mb-3 mt-3'
                    data-bs-dismiss='modal' onclick='removerAmizade(" . $id . ")'>
                    Sim
                </button>
                <button type='button' class='btn btn-light text-primary font-medium waves-effect text-start mb-3 mt-3'
                    data-bs-dismiss='modal'>
                    Não
                </button>";
        return ($msg);
    }
     /*Pedro*/ 
    function removerAmizade($idAmigo)
    {
        global $conn;
        $msg = "";
        $icon = "";
        $flag = false;
        $titulo = "";

        $sql = "DELETE FROM amigo 
        WHERE (id_atleta1 = " . $idAmigo . " AND id_atleta2 = " . $_SESSION['id'] . ") 
        OR (id_atleta1 = " . $_SESSION['id'] . " AND id_atleta2 = " . $idAmigo . ")";

        if ($conn->query($sql) === TRUE) {
            $titulo = "Sucesso";
            $msg = "Já não és amigo deste utilizador!";
            $icon = "success";
            $flag = true;
        } else {
            $titulo = "Erro";
            $msg = "Não foi possível remover esta amizade.";
            $icon = "error";
            $flag = true;
        }

        $resp = json_encode(array(
            "titulo" => $titulo,
            "msg" => $msg,
            "icon" => $icon,
            "flag" => $flag
        ));
        $conn->close();
        return ($resp);
    }
    /*Mariana*/ 
    function getBadgesPontos($modalidade, $pontos)
    {
        global $conn;
        $sql = "";
        $arrayRes = array();
        $sql .= " SELECT descricao, id, foto
        FROM badge 
        WHERE badge.id NOT IN (
            SELECT atleta_badges.id_badge
            FROM atleta_badges INNER JOIN 
            badge ON atleta_badges.id_badge = badge.id 
            WHERE atleta_badges.id_atleta = " . $_SESSION['id'] . " 
        ) AND badge.id_modalidade = (
            SELECT id
            FROM modalidade 
            WHERE descricao LIKE '" . $modalidade . "'
        ) AND valorPatamar <= " . $pontos . " AND categoria LIKE 'Pontos'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($arrayRes, array($row['descricao'], $row['id'], $row['foto']));
                $sql2 = "INSERT INTO atleta_badges VALUES (" . $row['id'] . ", " . $_SESSION['id'] . ", '" . date("Y/m/d") . "')";
                $result2 = $conn->query($sql2);
            }
        }
        return ($arrayRes);
    }
    /*Mariana*/ 
    function getBadgesVitorias($modalidade, $vitorias)
    {
        global $conn;
        $sql = "";
        $arrayRes = array();
        $sql .= " SELECT descricao, id, foto
        FROM badge 
        WHERE badge.id NOT IN (
            SELECT atleta_badges.id_badge
            FROM atleta_badges INNER JOIN 
            badge ON atleta_badges.id_badge = badge.id 
            WHERE atleta_badges.id_atleta = " . $_SESSION['id'] . " 
        ) AND badge.id_modalidade = (
            SELECT id
            FROM modalidade 
            WHERE descricao LIKE '" . $modalidade . "'
        ) AND valorPatamar <= " . $vitorias . " AND categoria LIKE 'Vitórias'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($arrayRes, array($row['descricao'], $row['id'], $row['foto']));
                $sql2 = "INSERT INTO atleta_badges VALUES (" . $row['id'] . ", " . $_SESSION['id'] . ", '" . date("Y/m/d") . "')";
                $result2 = $conn->query($sql2);
            }
        }
        return ($arrayRes);
    }
    /*Mariana*/ 
    function getBadgesPercVitorias($modalidade, $percVitorias, $nomeTabela)
    {
        global $conn;
        $sql = "";
        $arrayRes = array();
        $sql .= " SELECT descricao, id, foto
        FROM badge, " . $nomeTabela . "
        WHERE badge.id NOT IN (
            SELECT atleta_badges.id_badge
            FROM atleta_badges INNER JOIN 
            badge ON atleta_badges.id_badge = badge.id 
            WHERE atleta_badges.id_atleta = " . $_SESSION['id'] . "
        ) AND badge.id_modalidade = (
            SELECT id
            FROM modalidade 
            WHERE descricao LIKE '" . $modalidade . "'
        ) AND valorPatamar <= " . $percVitorias . "
		  AND categoria LIKE 'Percentagem Vitórias'
		  AND " . $nomeTabela . ".id_atleta = " . $_SESSION['id'] . " 
		  AND " . $nomeTabela . ".n_jogos >= 30";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($arrayRes, array($row['descricao'], $row['id'], $row['foto']));
                $sql2 = "INSERT INTO atleta_badges VALUES (" . $row['id'] . ", " . $_SESSION['id'] . ", '" . date("Y/m/d") . "')";
                $result2 = $conn->query($sql2);
            }
        }
        return ($arrayRes);
    }
    /*Mariana*/ 
    function getBadgesPerfil($modalidades, $id)
    {
        global $conn;
        $valBadges =  array();
        for ($i = 0; $i < count($modalidades); $i++) {
            $sql = "";
            if ($modalidades[$i] == "Basquetebol") {
                $sql .= "SELECT n_jogos, n_vitorias, n_pontos as n_pontos FROM info_basquetebol WHERE id_atleta = " . $id;
            } else if ($modalidades[$i] == "Futsal") {
                $sql .= "SELECT n_jogos, n_vitorias, n_golos as n_pontos FROM info_futsal WHERE id_atleta = " . $id;
            } else if ($modalidades[$i] == "Padel") {
                $sql .= "SELECT n_jogos, n_vitorias, n_pontos_set as n_pontos FROM info_padel WHERE id_atleta = " . $id;
            } else {
                $sql .= "SELECT n_jogos, n_vitorias, n_pontos_set as n_pontos FROM info_tenis WHERE id_atleta = " . $id;
            }
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['n_jogos'] == 0) {
                        $pVit = 0;
                    } else {
                        $pVit = round(($row['n_vitorias'] / $row['n_jogos']) * 100, 0, PHP_ROUND_HALF_DOWN);
                    }
                    array_push($valBadges, array($modalidades[$i], $pVit, $row['n_vitorias'], $row['n_pontos']));
                }
            }
        }
        return ($valBadges);
    }
    /*Mariana*/ 
    function getMelhoresBadges($id)
    {
        global $conn;
        $melhoresBadges = array();
        $sql = "SELECT *
        FROM badge 
        WHERE id IN (
        SELECT id_badge
        FROM atleta_badges
        WHERE id_atleta = " . $id . "
        )
        ORDER BY valorPatamar DESC
        LIMIT 4";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($melhoresBadges, array($row['descricao'], $row['foto']));
            }
        } else {
        }

        return ($melhoresBadges);
    }
    /*Mariana*/ 
    function getBadgesRecentes($id)
    {
        global $conn;
        $badgesRecentes = array();
        $sql = "SELECT DISTINCT badge.*, atleta_badges.dataAq
        FROM badge INNER JOIN
        atleta_badges ON badge.id = atleta_badges.id_badge
        WHERE 
        atleta_badges.id_atleta = ".$id."
        ORDER BY atleta_badges.dataAq ASC
        LIMIT 6";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($badgesRecentes, array($row['descricao'], $row['foto'], $row['dataAq']));
            }
        }

        return ($badgesRecentes);
    }
    /*Pedro*/ 
    function getComunidades($idUser)
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
                WHERE comunidade_atletas.id_atleta = " . $idUser . "
                AND comunidade_atletas.estado = 1
                LIMIT 2";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<div class='col-lg-12 col-md-6 col-sm-6'>
                            <div class='shadow rounded d-flex align-items-center mt-3 position-relative'>";
                            if ($row['tipoComunidade'] == "Grupo") {
                        $msg .= "<a href='./grupo.php?id=" . $row['idComunidade'] . "'>";
                            } else {
                        $msg .= "<a href='./equipa.php?id=" . $row['idComunidade'] . "'>";
                            }
                        $msg .= "<img src='../../dist/" . $row['fotoComunidade'] . "' alt='" . $row['nomeComunidade'] . "' class='img-fluid rounded-2 mt-3' width='100' height='100'>
                                </a>
                                <div class='ms-3 mt-3'>
                                    <p><span class='fw-bolder fs-5'>" . $row['nomeComunidade'] . "</span></p>";

                if ($row['tipoModalidade'] == "Ténis") {
                    $msg .= "<span class='badge bg-success rounded-pill position-absolute top-0 end-0 mt-2 me-2'><i class='ti ti-ball-tennis me-1'></i>Ténis</span>";
                } else if ($row['tipoModalidade'] == "Futsal") {
                    $msg .= "<span class='badge bg-danger rounded-pill position-absolute top-0 end-0 mt-2 me-2'><i class='ti ti-ball-football me-1'></i>Futsal</span>";
                } else if ($row['tipoModalidade'] == "Basquetebol") {
                    $msg .= "<span class='badge bg-warning rounded-pill position-absolute top-0 end-0 mt-2 me-2'><i class='ti ti-ball-basketball me-1'></i>Basquetebol</span>";
                } else {
                    $msg .= "<span class='badge bg-primary rounded-pill position-absolute top-0 end-0 mt-2 me-2'><i class='ti ti-ball-tennis me-1'></i>Padel</span>";
                }

                $msg .= "<span>";
                if ($row['tipoComunidade'] == "Grupo") {
                    $msg .= "<span class='fw-bolder'>Tipo:&nbsp</span><i class='ti ti-users me-1'></i>" . $row['tipoComunidade'] . "</span>";
                } else {
                    $msg .= "<span class='fw-bolder'>Tipo:&nbsp</span><i class='ti ti-trophy me-1'></i>" . $row['tipoComunidade'] . "</span>";
                }
                $msg .= "</div>
                            </div>
                        </div>";
            }
        } else {
            if ($idUser != $_SESSION['id']) {
                $msg .= "<div class='text-center mt-5'>
                            <h4>Sem resultados!</h4>
                            <p>Não existem comunidades associadas a este Utilizador.</p>
                        </div>";
            } else {
                $msg .= "<div class='text-center mt-5'>
                            <h4>Sem resultados!</h4>
                            <p>Cria ou junta-te a Comunidades, e elas aparecerão aqui!</p>
                        </div>";
            }
        }

        $conn->close();
        return ($msg);
    }
    /*Pedro*/ 
    function getAtletasPesquisaNavbar()
    {
        global $conn;
        $msg = "";

        $sql = "SELECT DISTINCT user.id,
                        user.nome,
                        0 as tipo_comunidade,
                        user.foto,
                        'N/A' AS descricao,
                        0 as nomeUser,
                        user.tipo_user,
                        concelho.descricao AS concelho, 
                IF(amigo_status.are_friends = 1, 1, 0) AS are_friends
                FROM user
                LEFT JOIN (
                SELECT id_atleta1 AS friend_id, 1 AS are_friends
                FROM amigo
                WHERE id_atleta2 = " . $_SESSION['id'] . " AND estado = 1
                UNION
                SELECT id_atleta2 AS friend_id, 1 AS are_friends
                FROM amigo
                WHERE id_atleta1 = " . $_SESSION['id'] . " AND estado = 1
                ) AS amigo_status ON user.id = amigo_status.friend_id
                INNER JOIN concelho ON user.localidade = concelho.id               
                WHERE user.id != " . $_SESSION['id'] . "


                UNION


                SELECT comunidade.id,
                comunidade.nome,
                comunidade.tipo_comunidade,
                comunidade.foto,
                modalidade.descricao,
                user.nome as nomeUser,
                0 AS tipo_user, 
                NULL AS descricao,
                NULL AS are_friends  
                FROM comunidade
                INNER JOIN
                modalidade ON comunidade.id_modalidade = modalidade.id
                INNER JOIN user ON comunidade.id_atletaHost = user.id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                if ($row['tipo_user'] == 1) {
                    $textoBotaoAmigo = ($row['are_friends'] == 1) ? "Amigo" : "Adicionar";
                    $classBotaoAmigo = ($row['are_friends'] == 1) ? "btn-primary" : "btn-primary";
                    $botaoAmigoDisabled = ($row['are_friends'] == 1) ? "disabled" : "";

                    $msg .= "<li class='p-1 mb-1 bg-hover-light-black'>
                        <div class='d-flex justify-content-between align-items-center'>
                            <div class='d-flex align-items-center gap-3'>
                                <i class='ti ti-user fs-6' data-toggle='tooltip' data-bs-placement='top' title='Atleta'></i>
                                <a href='./perfil.php?id=" . $row['id'] . "'><img src='../../dist/" . $row['foto'] . "' class='rounded-circle border border-1 border-primary' width='40' height='40'></a>
                                <a href='./perfil.php?id=" . $row['id'] . "'><span class='fs-4 text-black fw-normal d-block'>" . $row['nome'] . "</span></a>
                                <span class='d-none d-md-block'><i class='ti ti-map-pin me-1'></i>" . $row['concelho'] . "</span>
                            </div>
                            <div class='d-flex align-items-center'>
                                <button class='btn $classBotaoAmigo btn-sm' $botaoAmigoDisabled onclick='adicionarAmigo(" . $row['id'] . ")'>$textoBotaoAmigo</button>
                            </div>
                        </div>   
                    </li>";
                } else if ($row['tipo_user'] == 2) {
                    $msg .= "<li class='p-1 mb-1 bg-hover-light-black'>
                        <div class='d-flex justify-content-between align-items-center'>
                            <div class='d-flex align-items-center gap-3'>
                                <i class='ti ti-building fs-5' data-toggle='tooltip' data-bs-placement='top' title='Clube'></i>
                                <a href='./clube.php?id=" . $row['id'] . "'><img src='" . $row['foto'] . "' class='rounded-circle border border-1 border-primary' width='40' height='40'></a>
                                <a href='./clube.php?id=" . $row['id'] . "'><span class='fs-4 text-black fw-normal d-block'>" . $row['nome'] . "</span></a>
                                <span class='d-none d-md-block'><i class='ti ti-map-pin me-1'></i>" . $row['concelho'] . "</span>
                            </div>
                            <div class='d-flex align-items-center'>
                                <a href='./clube.php?id=" . $row['id'] . "'><button class='btn btn-success btn-sm'>Marcar</button></a>
                            </div>
                        </div>   
                    </li>";
                } else {
                    $msg .= "<li class='p-1 mb-1 bg-hover-light-black'>
                        <div class='d-flex justify-content-between align-items-center'>
                            <div class='d-flex align-items-center gap-3'>";
                            if($row['tipo_comunidade'] == 1) {
                                $msg .= "<i class='ti ti-users fs-5' data-toggle='tooltip' data-bs-placement='top' title='Grupo'></i>
                                         <a href='./grupo.php?id=" . $row['id'] . "'><img src='../../dist/" . $row['foto'] . "' class='rounded-circle border border-1 border-primary' width='40' height='40'></a>
                                         <a href='./grupo.php?id=" . $row['id'] . "'><span class='fs-4 text-black fw-normal d-block'>" . $row['nome'] . "</span></a>";
                            } else {
                                $msg .= "<i class='ti ti-shirt-sport fs-5' data-toggle='tooltip' data-bs-placement='top' title='Equipa'></i>
                                         <a href='./equipa.php?id=" . $row['id'] . "'><img src='../../dist/" . $row['foto'] . "' class='rounded-circle border border-1 border-primary' width='40' height='40'></a>
                                         <a href='./equipa.php?id=" . $row['id'] . "'><span class='fs-4 text-black fw-normal d-block'>" . $row['nome'] . "</span></a>";
                            }
                    if ($row['descricao'] == "Basquetebol") {
                        $msg .= "<span class='badge rounded-pill text-bg-warning'><i
                                    class='ti ti-ball-basketball me-1'></i><small>Basquetebol</small></span>";
                    } else if ($row['descricao'] == "Futsal") {
                        $msg .= "<span class='badge rounded-pill text-bg-danger'><i
                                    class='ti ti-ball-football me-1'></i><small>Futsal</small></span>";
                    } else if ($row['descricao'] == "Padel") {
                        $msg .= "<span class='badge rounded-pill text-bg-primary'><i
                                    class='ti ti-ball-tennis me-1'></i><small>Padel</small></span>";
                    } else {
                        $msg .= "<span class='badge rounded-pill text-bg-success'><i
                                    class='ti ti-ball-tennis me-1'></i><small>Ténis</small></span>";
                    }

                    if($row['tipo_comunidade'] == 2) {
                       $msg .= "<span class='d-none d-md-block'><i class='ti ti-building me-1'></i>" . $row['nomeUser'] . "</span>";
                    }

                    $msg .= "</div>
                            <div class='d-flex align-items-center'>
                                <a href='./grupo.php?id=" . $row['id'] . "'><button class='btn btn-success btn-sm'>Ver</button></a>
                            </div>
                        </div>   
                    </li>";
                }
            }
        }

        $conn->close();
        return ($msg);
    }
    /*Mariana*/ 
    function getGraficos($id, $mod)
    {
        global $conn;
        $msg = "";
        $vals = array();
        $modalid = json_decode($mod);
        for ($i = 0; $i < count($modalid); $i++) {
            if ($modalid[$i] == "Basquetebol") {
                $res = $this->getGraficosBasquetebol($id);
                array_push($vals, $res);
            } else if ($modalid[$i] == "Futsal") {
                $res = $this->getGraficosFutsal($id);
                array_push($vals, $res);
            } else if ($modalid[$i] == "Padel") {
                $res = $this->getGraficosPadel($id);
                array_push($vals, $res);
            } else {
                $res = $this->getGraficosTenis($id);
                array_push($vals, $res);
            }
        }

        $resp = json_encode($vals);
        $conn->close();
        return ($resp);
    }
    /*Mariana*/ 
    function getGraficosPadel($id)
    {
        global $conn;
        $sql = "SELECT * FROM info_padel WHERE id_atleta =" . $id;
        $result = $conn->query($sql);
        $sql2 = "SELECT * FROM estatisticas_padel";
        $result2 = $conn->query($sql2);
        $vals = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $percVit = 0;
                $percSetGanhos = 0;
                $percMVP = 0;
                if($row['n_jogos'] > 0){
                    $percVit = $row['n_vitorias'] / $row['n_jogos'];
                    $percMVP = $row['n_mvp'] / $row['n_jogos'];
                }
                if($row['n_sets'] > 0){
                    $percSetGanhos =  $row['n_set_ganhos'] / $row['n_sets'];
                }
               
                array_push($vals, array("Padel", round($percVit * 100, 1), round($percSetGanhos * 100, 1), round($percMVP * 100), 1));
            }
        }
        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                array_push($vals, array("Padel", round($row2['percVitorias'] * 100, 1), round($row2['percSetsGanhos'] * 100, 1), round($row2['percMvp'] * 100, 1)));
            }
        }

        $sql3 = "SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 0 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_padel
            WHERE (n_vitorias/n_jogos) < 0.2
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_padel
            WHERE (n_mvp/n_jogos) < 0.2
        )AS temp3
            UNION 
         SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 1 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_padel
            WHERE (n_vitorias/n_jogos) < 0.4 AND (n_vitorias/n_jogos) >= 0.2
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_padel
            WHERE (n_mvp/n_jogos) < 0.4 AND (n_mvp/n_jogos) >= 0.2
        )AS temp3
            UNION 
         SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 2 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_padel
            WHERE (n_vitorias/n_jogos) < 0.6 AND (n_vitorias/n_jogos) >= 0.4
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_padel
            WHERE (n_mvp/n_jogos) < 0.6 AND (n_mvp/n_jogos) >= 0.4
        )AS temp3
               UNION 
         SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 3 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_padel
            WHERE (n_vitorias/n_jogos) < 0.8 AND (n_vitorias/n_jogos) >= 0.6
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_padel
            WHERE (n_mvp/n_jogos) < 0.8 AND (n_mvp/n_jogos) >= 0.6
        )AS temp3
            UNION 
            SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 4 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_padel
            WHERE (n_vitorias/n_jogos) >= 0.8
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_padel
            WHERE (n_mvp/n_jogos) >= 0.8
        )AS temp3";
        $arrGraf1 = array();
        $arrGraf2 = array();
        $result3 = $conn->query($sql3);
        if ($result3->num_rows > 0) {
            while ($row3 = $result3->fetch_assoc()) {
                array_push($arrGraf1, $row3['percVit']);
                array_push($arrGraf2, $row3['percMvp']);
            }
        }
        array_push($vals,  $arrGraf1);
        array_push($vals,  $arrGraf2);
        return ($vals);
    }
    /*Mariana*/ 
    function getGraficosTenis($id)
    {
        global $conn;
        $sql3 = "SELECT * FROM info_tenis WHERE id_atleta =" . $id;
        $result3 = $conn->query($sql3);
        $sql4 = "SELECT * FROM estatisticas_tenis";
        $result4 = $conn->query($sql4);
        $vals = array();
        if ($result3->num_rows > 0) {
            while ($row3 = $result3->fetch_assoc()) {
                $percVit = 0;
                $percSetGanhos = 0;
                $percMVP = 0;
                if($row3['n_jogos'] > 0){
                    $percVit = $row3['n_vitorias'] / $row3['n_jogos'];
                    $percMVP = $row3['n_mvp'] / $row3['n_jogos'];
                }
                if($row3['n_sets'] > 0){
                    $percSetGanhos =  $row3['n_set_ganhos'] / $row3['n_sets'];
                }
                array_push($vals, array("Ténis", round($percVit * 100, 1), round($percSetGanhos * 100, 1), round($percMVP * 100, 1)));
            }
        }
        if ($result4->num_rows > 0) {
            while ($row4 = $result4->fetch_assoc()) {
                array_push($vals, array("Ténis", round($row4['percVitorias'] * 100, 1), round($row4['percSetsGanhos'] * 100, 1), round($row4['percMvp'] * 100, 1)));
            }
        }
        $sql5 = "SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 0 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_tenis
            WHERE (n_vitorias/n_jogos) < 0.2
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_tenis
            WHERE (n_mvp/n_jogos) < 0.2
        )AS temp3
            UNION 
         SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 1 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_tenis
            WHERE (n_vitorias/n_jogos) < 0.4 AND (n_vitorias/n_jogos) >= 0.2
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_tenis
            WHERE (n_mvp/n_jogos) < 0.4 AND (n_mvp/n_jogos) >= 0.2
        )AS temp3
            UNION 
         SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 2 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_tenis
            WHERE (n_vitorias/n_jogos) < 0.6 AND (n_vitorias/n_jogos) >= 0.4
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_tenis
            WHERE (n_mvp/n_jogos) < 0.6 AND (n_mvp/n_jogos) >= 0.4
        )AS temp3
               UNION 
         SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 3 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_tenis
            WHERE (n_vitorias/n_jogos) < 0.8 AND (n_vitorias/n_jogos) >= 0.6
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_tenis
            WHERE (n_mvp/n_jogos) < 0.8 AND (n_mvp/n_jogos) >= 0.6
        )AS temp3
            UNION 
            SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 4 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_tenis
            WHERE (n_vitorias/n_jogos) >= 0.8
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_tenis
            WHERE (n_mvp/n_jogos) >= 0.8
        )AS temp3";

        $arrGraf1 = array();
        $arrGraf2 = array();
        $result5 = $conn->query($sql5);
        if ($result5->num_rows > 0) {
            while ($row5 = $result5->fetch_assoc()) {
                array_push($arrGraf1, $row5['percVit']);
                array_push($arrGraf2, $row5['percMvp']);
            }
        }
        array_push($vals,  $arrGraf1);
        array_push($vals,  $arrGraf2);
        return ($vals);
    }
    /*Mariana*/ 
    function getGraficosBasquetebol($id)
    {
        global $conn;
        $vals = array();
        $sql5 = "SELECT * FROM info_basquetebol WHERE id_atleta =" . $id;
        $result5 = $conn->query($sql5);
        $sql6 = "SELECT * FROM estatisticas_basquetebol";
        $result6 = $conn->query($sql6);
        if ($result5->num_rows > 0) {
            while ($row5 = $result5->fetch_assoc()) {
                $percVit = 0;
                $percMVP = 0;
                if($row5['n_jogos'] > 0){
                    $percVit = $row5['n_vitorias'] / $row5['n_jogos'];
                    $percMVP = $row5['n_mvp'] / $row5['n_jogos'];
                }
                array_push($vals, array("Basquetebol", round($percVit * 100, 1), round($percMVP * 100, 1)));
            }
        }
        if ($result6->num_rows > 0) {
            while ($row6 = $result6->fetch_assoc()) {
                array_push($vals, array("Basquetebol", round($row6['percVitorias'] * 100, 1), round($row6['percMvp'] * 100, 1)));
            }
        }
        $sql7 = "SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 0 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_basquetebol
            WHERE (n_vitorias/n_jogos) < 0.2
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_basquetebol
            WHERE (n_mvp/n_jogos) < 0.2
        )AS temp3
            UNION 
         SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 1 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_basquetebol
            WHERE (n_vitorias/n_jogos) < 0.4 AND (n_vitorias/n_jogos) >= 0.2
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_basquetebol
            WHERE (n_mvp/n_jogos) < 0.4 AND (n_mvp/n_jogos) >= 0.2
        )AS temp3
            UNION 
         SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 2 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_basquetebol
            WHERE (n_vitorias/n_jogos) < 0.6 AND (n_vitorias/n_jogos) >= 0.4
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_basquetebol
            WHERE (n_mvp/n_jogos) < 0.6 AND (n_mvp/n_jogos) >= 0.4
        )AS temp3
               UNION 
         SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 3 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_basquetebol
            WHERE (n_vitorias/n_jogos) < 0.8 AND (n_vitorias/n_jogos) >= 0.6
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_basquetebol
            WHERE (n_mvp/n_jogos) < 0.8 AND (n_mvp/n_jogos) >= 0.6
        )AS temp3
            UNION 
            SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 4 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_basquetebol
            WHERE (n_vitorias/n_jogos) >= 0.8
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_basquetebol
            WHERE (n_mvp/n_jogos) >= 0.8
        )AS temp3";

        $arrGraf1 = array();
        $arrGraf2 = array();
        $result7 = $conn->query($sql7);
        if ($result7->num_rows > 0) {
            while ($row7 = $result7->fetch_assoc()) {
                array_push($arrGraf1, $row7['percVit']);
                array_push($arrGraf2, $row7['percMvp']);
            }
        }
        array_push($vals,  $arrGraf1);
        array_push($vals,  $arrGraf2);
        return ($vals);
    }
    /*Mariana*/ 
    function getGraficosFutsal($id)
    {
        global $conn;
        $vals = array();
        $sql5 = "SELECT * FROM info_futsal WHERE id_atleta =" . $id;
        $result5 = $conn->query($sql5);
        $sql6 = "SELECT * FROM estatisticas_futsal";
        $result6 = $conn->query($sql6);
        if ($result5->num_rows > 0) {
            while ($row5 = $result5->fetch_assoc()) {
                $percVit = 0;
                $percMVP = 0;
                if($row5['n_jogos'] > 0){
                    $percVit = $row5['n_vitorias'] / $row5['n_jogos'];
                    $percMVP = $row5['n_mvp'] / $row5['n_jogos'];
                }
                array_push($vals, array("Futsal", round($percVit * 100, 1), round($percMVP * 100, 1)));
            }
        }
        if ($result6->num_rows > 0) {
            while ($row6 = $result6->fetch_assoc()) {
                array_push($vals, array("Futsal", round($row6['percVitorias'] * 100, 1), round($row6['percMvp'] * 100, 1)));
            }
        }
        $sql7 = "SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 0 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_futsal
            WHERE (n_vitorias/n_jogos) < 0.2
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_futsal
            WHERE (n_mvp/n_jogos) < 0.2
        )AS temp3
            UNION 
         SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 1 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_futsal
            WHERE (n_vitorias/n_jogos) < 0.4 AND (n_vitorias/n_jogos) >= 0.2
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_futsal
            WHERE (n_mvp/n_jogos) < 0.4 AND (n_mvp/n_jogos) >= 0.2
        )AS temp3
            UNION 
         SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 2 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_futsal
            WHERE (n_vitorias/n_jogos) < 0.6 AND (n_vitorias/n_jogos) >= 0.4
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_futsal
            WHERE (n_mvp/n_jogos) < 0.6 AND (n_mvp/n_jogos) >= 0.4
        )AS temp3
               UNION 
         SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 3 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_futsal
            WHERE (n_vitorias/n_jogos) < 0.8 AND (n_vitorias/n_jogos) >= 0.6
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_futsal
            WHERE (n_mvp/n_jogos) < 0.8 AND (n_mvp/n_jogos) >= 0.6
        )AS temp3
            UNION 
            SELECT temp.posicao AS percVit, temp3.posicao2 AS percMvp, 4 AS res
        FROM (
            SELECT COUNT(*) AS posicao
            FROM info_futsal
            WHERE (n_vitorias/n_jogos) >= 0.8
        )AS temp, 
        (SELECT COUNT(*) AS posicao2
            FROM info_futsal
            WHERE (n_mvp/n_jogos) >= 0.8
        )AS temp3";

        $arrGraf1 = array();
        $arrGraf2 = array();
        $result7 = $conn->query($sql7);
        if ($result7->num_rows > 0) {
            while ($row7 = $result7->fetch_assoc()) {
                array_push($arrGraf1, $row7['percVit']);
                array_push($arrGraf2, $row7['percMvp']);
            }
        }
        array_push($vals,  $arrGraf1);
        array_push($vals,  $arrGraf2);
        return ($vals);
    }
    /*Mariana*/  
    function cancelarMarcacao($idMarcacao)
    {
        global $conn;
        $sql2 = "SELECT id_atleta FROM marcacao WHERE id = " . $idMarcacao;
        $sql = "";
        $sql3 = "";
        $flag = false;
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
                if ($row['id_atleta'] == $_SESSION['id']) {
                    $flag = true;
                    $sql = "DELETE FROM listagem_atletas_marcacao WHERE id_marcacao = " . $idMarcacao;
                    $sql3 = "DELETE FROM marcacao WHERE id = " . $idMarcacao;
                } else {
                    $sql = "DELETE FROM listagem_atletas_marcacao WHERE id_atleta = " . $_SESSION['id'] . " AND id_marcacao = " . $idMarcacao;
                }
            }
        }

        $msg = "";
        $icon = "success";
        if ($conn->query($sql) === TRUE) {
            if ($flag === true) {
                if ($conn->query($sql3) === TRUE) {
                    $msg .= "Marcação cancelada com sucesso!";
                } else {
                    $msg .= "Não foi possível cancelar a marcação!";
                    $icon = "error";
                }
            } else {
                $msg .= "Marcação cancelada com sucesso!";
            }
        } else {
            $msg .= "Não foi possível cancelar a marcação!";
            $icon = "error";
        }

        $resp = json_encode(array(
            "msg" => $msg,
            "icon" => $icon
        ));

        $conn->close();
        return ($resp);
    }
    /*Mariana*/ 
    function cancelarMarcacaoTorneio($idTorneio)
    {
        global $conn;
        $sql = "DELETE FROM torneio_atleta WHERE id_atleta = " . $_SESSION['id'] . " AND id_torneio = " . $idTorneio;
        
        $msg = "";
        $icon = "";

        if ($conn->query($sql) === TRUE) {
            $msg .= "Cancelou a sua participação neste torneio!";
            $icon = "success";
        } else {
            $msg .= "Não foi possível cancelar o torneio!";
            $icon = "error";
        }

        $resp = json_encode(array(
            "msg" => $msg,
            "icon" => $icon
        ));

        $conn->close();
        return ($resp);
    }
    /*Pedro*/ 
    function getNotificacaoJuntarGrupo()
    {
        global $conn;
        $msg = "";

        $sql = "SELECT 
                user.nome, 
                user.id, 
                user.foto, 
                comunidade.id as idComunidade,
                comunidade.nome as nomeComunidade,
                comunidade.foto as fotoComunidade
                FROM user
                INNER JOIN comunidade_atletas ON user.id = comunidade_atletas.id_atleta
                INNER JOIN comunidade ON comunidade_atletas.id_comunidade = comunidade.id
                WHERE user.id IN (
                SELECT comunidade_atletas.id_atleta
                FROM comunidade_atletas
                WHERE comunidade_atletas.estado = 0
                AND comunidade_atletas.id_atleta != " . $_SESSION['id'] . "
                )
                AND comunidade.id_atletaHost = " . $_SESSION['id'];


        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<a class='py-6 px-7 d-flex align-items-center dropdown-item' style='cursor: pointer;'>
                            <span class='me-2'>
                                <img src='../../dist/" . $row['fotoComunidade'] . "' alt='" . $row['nomeComunidade'] . "' class='rounded-circle object-fit-cover'
                                    width='48' height='48' />
                            </span>
                            <div class='w-75 d-inline-block v-middle'>
                                <h6 class='mb-1 fw-semibold'>Pedido de Grupo</h6>
                                <span class='d-block'>" . $row['nome'] . " pretende juntar-se<br> ao grupo " . $row['nomeComunidade'] . ".</span>
                                <div class='d-flex justify-content-around align-items-center mt-1'>
                                    <button class='btn btn-success' 
                                        style='--bs-btn-padding-y: .15rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;' onclick='aceitarPedidoGrupo(" . $row['id'] . ")'>
                                        <i class='ti ti-check me-1'></i>
                                        <span class='me-1'>Aceitar</span>
                                    </button>
                                    <button class='btn' style='--bs-btn-padding-y: .15rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem; background-color: #b80000; color: white;'
                                        onmouseover=\"this.style.backgroundColor = '#cf0202';\" onmouseout=\"this.style.backgroundColor = '#b80000';\" onclick='rejeitarPedidoGrupo(" . $row['id'] . ")'>
                                        <i class='ti ti-x me-1'></i>
                                        <span class='me-1'>Rejeitar</span>
                                    </button>
                                </div>
                            </div>
                        </a>";
            }
        }
        $conn->close();
        return ($msg);
    }
    /*Pedro*/ 
    function aceitarPedidoGrupo($id)
    {

        global $conn;
        $msg = "";
        $icon = "";
        $flag = false;
        $titulo = "";

        $sql = "UPDATE comunidade_atletas SET estado = 1 WHERE id_atleta = " . $id;

        if ($conn->query($sql) === TRUE) {
            $titulo = "Sucesso";
            $msg = "Pedido aceite com sucesso";
            $icon = "success";
            $flag = true;
        } else {
            $titulo = "Erro";
            $msg = "Não foi possível aceitar o pedido.";
            $icon = "success";
            $flag = true;
        }

        $resp = json_encode(array(
            "titulo" => $titulo,
            "msg" => $msg,
            "icon" => $icon,
            "flag" => $flag
        ));
        $conn->close();
        return ($resp);
    }
    /*Pedro*/ 
    function rejeitarPedidoGrupo($id)
    {

        global $conn;
        $msg = "";
        $icon = "";
        $flag = false;
        $titulo = "";

        $sql = "DELETE FROM comunidade_atletas WHERE id_atleta = " . $id;

        if ($conn->query($sql) === TRUE) {
            $titulo = "Sucesso";
            $msg = "Pedido rejeitado com sucesso";
            $icon = "success";
            $flag = true;
        } else {
            $titulo = "Erro";
            $msg = "Não foi possível rejeitar o pedido.";
            $icon = "success";
            $flag = true;
        }

        $resp = json_encode(array(
            "titulo" => $titulo,
            "msg" => $msg,
            "icon" => $icon,
            "flag" => $flag
        ));
        $conn->close();
        return ($resp);
    }
    /*Pedro*/ 
    function guardaEditFotoPerfil($fotoPerfil)
    {
        global $conn;
        $respUpdate = $this->uploads($fotoPerfil, $_SESSION['id']);
        $respUpdate = json_decode($respUpdate, TRUE);
        $sql = "UPDATE user SET foto = '" . $respUpdate['target'] . "' WHERE id = " . $_SESSION['id'];
        $msg = "";
        $icon = "success";
        if ($conn->query($sql) === TRUE) {
            $msg = "Foto de perfil alterada com sucesso!";
        } else {
            $msg = "Não foi possível alterar a sua foto de perfil";
            $icon = "error";
        }
        $conn->close();
        return json_encode(array("msg" => $msg, "icon" => $icon));
    }
}
