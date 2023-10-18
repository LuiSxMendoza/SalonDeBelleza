<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController {
    public static function index(Router $router) {

        session_start();
        isAdmin();

        $servicios = Servicio::all();
        debuguear($servicios);

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios,
            'titulo' => 'Admin Servicios'
        ]);
    }

    public static function crear(Router $router) {

        session_start();
        isAdmin();

        $servicio = new Servicio();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);

            //? Añadir validacion
            $alertas = $servicio->validarServicioNuevo();

            if(empty($alertas)) {
                //? Almacenar y redirigir
                $servicio->guardar();
                header('Location: /servicios');
            }
        }

        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas,
            'titulo' => 'Crear Servicio'
        ]);
    }

    public static function actualizar(Router $router) {

        session_start();
        isAdmin();

        if(!is_numeric($_GET['id'])) return;

        $servicio = Servicio::find($_GET['id']);

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);

            $alertas = $servicio->validarServicioNuevo();

            if(empty($alertas)) {
                //? Almacenar y redirigir
                $servicio->guardar();
                header('Location: /servicios');
            }
        }

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'alertas'=> $alertas,
            'servicio' => $servicio,
            'titulo' => 'Actualizar Servicio'
        ]);
    }

    public static function eliminar() {

        session_start();
        isAdmin();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $servicio = Servicio::find($id);
            //debuguear($servicio);
            $servicio->eliminar();
            
            header('Location: /servicios');
        }
        
    }
}