<?php

function conectarDB() : mysqli {
    $db = new mysqli('localhost','root','root','pokeapi');
    $db->set_charset('utf8');

    if(!$db){
        echo "Error no se conecto a DB";
        exit;
    }

    return $db;
}