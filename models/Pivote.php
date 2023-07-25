<?php

namespace Model;

class Pivote extends ActiveRecord{

    public static $tabla = 'pivote';
    public static $columnasDB = ['id','id_grupo','id_usuario'];

    public $id;
    public $id_grupo;
    public $id_usuario;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_grupo = $args['id_grupo'] ?? 0;
        $this->id_usuario = $args['id_usuario'] ?? 0;

    }

}