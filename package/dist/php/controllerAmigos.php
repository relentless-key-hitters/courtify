<?php

require_once 'modelAmigo.php';

$amigo = new Amigo();

if ($_POST['op'] == 1){
    $res = $amigo -> getAmigos($_POST['userId']);
    echo($res);
} else if ($_POST['op'] == 1) {
    $res = $amigo -> procurarAmigos($_POST['stringPesquisa']);
    echo($res);
}