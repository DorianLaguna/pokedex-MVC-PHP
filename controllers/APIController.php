<?php

namespace Controller;

use Model\Grupo;
use Model\Pivote;

class APIController{

    public static function grupos(){
        
        $idUsuario = $_GET['idUsuario'];
        
        //obtiene el numero del id de grupos que tiene el usuario
        $numeroGrupo = new Pivote();
        $respuestas = $numeroGrupo->whereAll('id_usuario', $idUsuario);
        
        //obtiene los grupos completos
        $grupoCompleto = [];
        $respuestaGrupo = new Grupo();
        foreach ($respuestas as $respuesta) {
            $grupoCompleto[] = $respuestaGrupo->where('id',$respuesta->id_grupo);
        }
        
        echo json_encode($grupoCompleto);
    }

    public static function sesion(){
        isSession();

        echo json_encode($_SESSION);

    }




}