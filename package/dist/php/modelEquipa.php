<?php

require_once 'connection.php';

class Equipa
{
    function getEquipasUser(){
        global $conn;
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
        AND comunidade.tipo_comunidade = 2
        LIMIT 12"; 
    }

}

?>