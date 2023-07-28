<?php

namespace Controller;

use Classes\Email;
use Model\ActiveRecord;
use Model\Usuario;
use MVC\Router;

class LoginController extends ActiveRecord{

    public static function create(Router $router){
        $usuario = new Usuario($_POST);
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if(empty($alertas)){
                //Verifica si existe algun usuario con ese correo
                $resultado = $usuario->existeUsuario();
                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else{
                    //Set usuario
                    $usuario->hashPassword();
                    $usuario->crearToken();
                    //Enviar email de confirmacion
                    $email = new Email($usuario->nombre, $usuario->correo,$usuario->token);
                    $email->enviarConfirmacion();

                    $resultado = $usuario->guardar();

                    if($resultado){
                        header('Location: /mensaje');
                    }
                }
                

            }
        }

        $router->render('paginas/auth/crear',[
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function confirmar(Router $router){
        $alertas = [];
        $usuario = new Usuario();

        //busca usuario con token
        $token = $_GET['token'];
        $usuario = $usuario->where('token', $token);

        //crea alerta
        if($usuario){
            $alertas['exito'][] = 'User Authenticated';
            $usuario->token = '';
            $usuario->confirmado = 1;
            $usuario->guardar();
        }else{
            $alertas['error'][] = 'Token invalid';
        }

        $router->render('paginas/auth/confirmacion',[
            'alertas' => $alertas
        ]);

    }

    public static function mensaje(Router $router){
     
        $router->render('paginas/auth/mensaje',[]);
    }

    public static function login(Router $router){
        $usuario = new Usuario();
        $alertas = [];

        if(isset($_GET['login'])){
            $alertas['advertencia'][] = 'You must login first';
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $alertas = [];
            $usuario->sincronizar($_POST);
            //checar si existe el usuario
            $resultado = $usuario->existeUsuario();    
            if($resultado->num_rows){
                $resultado = $usuario->where('correo',$usuario->correo);
                if($resultado->confirmado){
                    //checar el password
                    if(password_verify($usuario->password, $resultado->password)){
                        //iniciar sesion
                        session_start();
                        $_SESSION['id'] = $resultado->id;
                        $_SESSION['nombre'] = $resultado->nombre;
                        $_SESSION['email'] = $resultado->correo;
                        $_SESSION['login'] = true;
                        $_SESSION['favorite'] = $resultado->pokFav;

                        //redireccionar
                        header('Location: /myPokedex');
    
                    }else{
                        $alertas['error'][] = 'Password invalid';
                    }                
                }else{
                    $alertas['error'][] = 'User no confirmed';
                }
              
            }else{
                //crear alerta que no existe usuario
                $alertas['error'][] = 'No exist any account with that email';
            }
        }

        $router->render('paginas/auth/login',[
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function password(Router $router){
        $alertas = [];

        $router->render('paginas/auth/password',[
            'alertas' => $alertas
        ]);
    }

    public static  function logout(){
        $_SESSION = [];

        header('Location: /');
    }

    
}