<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\ApiController;
use Controllers\CitaController;
use Controllers\LoginController;
use Controllers\ServicioController;
use MVC\Router;

$router = new Router();

//! Iniciar Sesion
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//! Recuperar Password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

//! Crear Cuenta
$router->get('/registrar', [LoginController::class, 'registrar']);
$router->post('/registrar', [LoginController::class, 'registrar']);

//! Confirmar cuenta
$router->get('/confirma-cuenta', [LoginController::class, 'confirma']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

//TODO: Area privada
$router->get('/cita', [CitaController::class, 'index']);
$router->get('/citas', [CitaController::class, 'citas']);
$router->post('/citas', [CitaController::class, 'eliminar']);

$router->get('/admin', [AdminController::class, 'index']);

//! API de citas
$router->get('/api/servicios', [ApiController::class, 'index']);
$router->post('/api/citas', [ApiController::class, 'guardar']);
$router->post('/api/eliminar', [ApiController::class, 'eliminar']);

//! CRUD Servicios
$router->get('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/crear', [ServicioController::class, 'crear']);
$router->post('/servicios/crear', [ServicioController::class, 'crear']);
$router->get('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServicioController::class, 'eliminar']);

//! Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();