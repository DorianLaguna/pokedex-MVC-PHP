<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controller\APIController;
use Controller\LoginController;
use Controller\PaginasController;


$router = new Router;


$router->get('/', [PaginasController::class, 'index']);
$router->post('/', [PaginasController::class, 'index']);

$router->get('/pokemon', [PaginasController::class, 'buscaPokemon']);
$router->post('/pokemon', [PaginasController::class, 'buscaPokemon']);

$router->get('/myPokedex', [PaginasController::class, 'myPokedex']);
$router->post('/myPokedex', [PaginasController::class, 'myPokedex']);

$router->get('/list', [PaginasController::class, 'list']);
$router->post('/list', [PaginasController::class, 'list']);

$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);

$router->get('/logout', [LoginController::class, 'logout']);

$router->get('/create', [LoginController::class, 'create']);
$router->post('/create', [LoginController::class, 'create']);

$router->get('/password', [LoginController::class, 'password']);
$router->post('/password', [LoginController::class, 'password']);

$router->get('/change', [LoginController::class, 'changePassword']);
$router->post('/change', [LoginController::class, 'changePassword']);

$router->get('/confirmar', [LoginController::class, 'confirmar']);

$router->get('/mensaje', [LoginController::class, 'mensaje']);

//API
$router->get('/api/grupos', [APIController::class, 'grupos']);
$router->get('/api/sesion', [APIController::class, 'sesion']);
$router->post('/api/nomGrupo', [APIController::class, 'nomGrupo']);


$router->comprobarRutas();