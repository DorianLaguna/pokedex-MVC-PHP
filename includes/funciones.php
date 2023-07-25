<?php


define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL','funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . "/imagenes/");
function incluirTemplate(string $nombre, bool $inicio = false){
    
    include TEMPLATES_URL . "/$nombre.php";
}

function estaAutenticado() : void{
    isSession();
    if(!$_SESSION['login']){
        header('Location: /login?login=1');
        exit;
    }
}

function debugear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function s($html) : string{
    $s= htmlspecialchars($html);
    return $s;
}

function mostrarNotificacion($codigo){
    $mensaje = '';

    switch($codigo){
        case 1:
            $mensaje = 'Creado correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}
function validarORedireccionar(string $url){
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    IF(!$id){
        header("Location: /$url");
    }
    return $id;
}

function isSession() : void{
    if(!isset($_SESSION)) {
        session_start();
    }
}