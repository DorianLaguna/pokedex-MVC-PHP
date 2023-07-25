<?php


namespace Controller;

use LDAP\Result;
use Model\Grupo;
use Model\Pivote;
use Model\Usuario;
use MVC\Router;

class PaginasController{
    public static function index (Router $router){
        isSession();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            estaAutenticado();
            //agrega pokemon al favorito o a un NUEVO grupo
            $alertas = PaginasController::add();
        }

        $router->render('paginas/index', [
            'alertas' => $alertas
        ]);
    }

    public static function list(Router $router){
        isSession();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            estaAutenticado();
            
            //agrega pokemon al favorito o a un NUEVO grupo
            $alertas = PaginasController::add();
        }

        $router->render('paginas/lista', [
            'alertas' => $alertas
        ]);
    }

    public static function buscaPokemon(Router $router){
        isSession();
        $alertas = [];

        //obtener nombre para mostrar la vista con ese pokemon
        $nombre = $_GET['pokemon-name'] ?? '';
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            estaAutenticado();
           //agrega pokemon al favorito o a un nuevo grupo
            $alertas = PaginasController::add();           
        }

        $router->render('paginas/pokemon',[
            'name' => $nombre,
            'alertas' => $alertas
        ]);
    }

    public static function myPokedex(Router $router){
        isSession();
        estaAutenticado();
        $favorito = $_SESSION['favorite'];
        $alertas = [];

        $pivote = new Pivote();
        $idUsuario = $_SESSION['id'];
        //conseguir el numero de grupos
        $args = $pivote->whereAll('id_usuario', $idUsuario);
        $grupos = count($args);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            if($_POST['tipo'] === 'delete'){
                //valores key para borrar
                $equipo = $_POST['equipo'];
                $idGrupo = $args[$equipo-1]->id_grupo;
                $pokemon = $_POST['pokemon'];
                // debugear($args);
    
                //conseguimos la columna a borrar del grupo
                $grupo = new Grupo();
                $resultado = $grupo->where('id',$idGrupo);
                $array = (array) $resultado;
                $array = array_slice($array, 1);
                $indice = array_search($pokemon, $array);
                if(!$indice) return;
                $array[$indice] = '0';
    
                //elimina los que no son id de pokemones y verifica si son todos 0
                $array = array_slice($array, 1);
                $array = array_values($array);
                $array = array_map('intval',$array);
                $suma = array_sum($array);
    
                if($suma === 0){
                    //elimina el grupo entero
                    $respuesta = $resultado->eliminar();
                    if($respuesta){
                        header('Location: /myPokedex');
                    }
    
                }else{
                    //actualiza el grupo
                    $resultado->$indice = '0';
                    $resultado->guardar();
                }
            }
            if($_POST['tipo'] === 'edit'){
                $grupo = new Grupo();
                $grupo->id = $_POST['id'];
                $grupo->nombre = $_POST['team-name'];
                
                if(strlen($_POST['team-name']) === 0){
                    $alertas['error'][] = 'Name requerid';
                }elseif(strlen($_POST['team-name']) < 10){
                    $grupo->actualizaNombre();
                }else{
                    $alertas['error'][] = 'Name must be shorter';
                }
            }

        }

        $router->render('paginas/myPokedex',[
            'grupos' => $grupos,
            'favorito' => $favorito,
            'alertas' => $alertas
        ]);
    }

    public static function add(){
        $idUsuario = $_SESSION['id'];
        if($_POST['boton'] === 'favorite'){
            //setear el usuario y guardar el nuevo pokemon
            $usuario = new Usuario();
            $usuario->id = $idUsuario;
            $usuario->pokFav = $_POST['id'] ?? '';
            $_SESSION['favorite'] = $_POST['id'];
            $alertas = $usuario->setPokemonFav();
        }
        if($_POST['boton'] === 'new'){

            //crea el nuevo grupo y guardamos
            $grupo = new Grupo();
            $grupo->pok_1 = $_POST['id'];
            $resultado = $grupo->guardar();
            
            //seteamos el array para el pivote
            $args['id_grupo'] = $resultado['id'];
            $args['id_usuario'] = $idUsuario;

            //crear el nuevo pivote
            $pivote = new Pivote($args);
            $resultado = $pivote->guardar();
            header('Location: /myPokedex');

        }
        if($_POST['boton'] === 'add'){
            
            $grupo = new Grupo();
            $respuesta = $grupo->where('id', $_POST['grupo']);
            $array = (array) $respuesta;
            $indice = array_search('0', $array);
            if(!$indice){
                $alertas['error'][] = 'Team is full';
            }else{
                $respuesta->$indice = $_POST['id'];
                $respuesta->guardar();
                if($respuesta){
                    $alertas['exito'][] = 'Succesful';
                }
            }



        }
        return $alertas;
    }
}