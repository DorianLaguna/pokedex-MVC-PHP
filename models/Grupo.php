<?php

namespace Model;

class Grupo  extends ActiveRecord{
    
    public static $tabla = 'grupo';
    public static $columnasDB = ['id','nombre','pok_1','pok_2','pok_3','pok_4','pok_5','pok_6'];
    
    public $id;
    public $nombre;
    public $pok_1;
    public $pok_2;
    public $pok_3;
    public $pok_4;
    public $pok_5;
    public $pok_6;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? 'Group';
        $this->pok_1 = $args['pok_1'] ?? 0;
        $this->pok_2 = $args['pok_2'] ?? 0;
        $this->pok_3 = $args['pok_3'] ?? 0;
        $this->pok_4 = $args['pok_4'] ?? 0;
        $this->pok_5 = $args['pok_5'] ?? 0;
        $this->pok_6 = $args['pok_6'] ?? 0;
    }

    public function actualizaNombre(){
            $query = 'UPDATE ' . self::$tabla . ' SET nombre = "' . $this->nombre . '" WHERE id="' . $this->id . '"';
            $respuesta = self::$db->query($query);
    }
    
}