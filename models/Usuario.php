<?php

namespace Model;

class Usuario extends ActiveRecord{
    public static $tabla = 'usuarios';
    public static $columnasDB = ['id', 'nombre', 'correo','password','confirmado','token', 'pokFav'];

    public $id = null;
    public $nombre = '';
    public $correo = '';
    public $password = '';
    public $confirmado = 0;
    public $token = '';
    public $pokFav = 0;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
    }

    public function validarNuevaCuenta(){
        if($this->nombre === ''){
            self::setAlerta('error', 'Name is required');
            self::$alertas['error'][] = 'Name is required';
        }
        if($this->correo === ''){
            self::setAlerta('error', 'Email is required');
        }
        if($this->password === ''){
            self::setAlerta('error', 'Password is required');
        }
        if(strlen($this->password) < 6 ){
            self::setAlerta('error', 'Password is very short');
        };
        
        return self::$alertas;

    }

    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE correo= '" . $this->correo . "' LIMIT 1";

        $resultado = self::$db->query($query);
        if($resultado->num_rows){
            self::$alertas['error'][] = 'User exist';
        }
        return $resultado;
    }
    
    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }


    public function crearToken(){
        //generar Token
        $this->token = uniqid();
    }

    public function checarVerificado(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE correo= '" . $this->correo . "' LIMIT 1";

        $resultado = self::$db->query($query);
        $resultado;
    }

    public function setPokemonFav(){
        $query =  "UPDATE " . self::$tabla . " SET pokFav = '" . $this->pokFav . "' WHERE id='" . $this->id . "'";
        $resultado = self::$db->query($query);
        
        if($resultado){
            Usuario::setAlerta('exito','New favorite Pokemon');
        }else{
            Usuario::setAlerta('error','There was an error');
        }
        return self::$alertas;
    }
    
}