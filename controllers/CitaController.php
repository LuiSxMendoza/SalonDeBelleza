<?php

namespace Controllers;

use Model\Cita;
use Model\Usuario;
use MVC\Router;

class CitaController {

    public static function index(Router $router) {

        session_start();
        isAuth();

        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre'],
            'titulo' => 'Agendar Cita',
            'id' => $_SESSION['id']
        ]);
    }

    public static function citas(Router $router) {
        session_start();
        isAuth();

        $id = $_SESSION['id'];

        $citas = Cita::belongsTo('usuarioId', $id);
        $user = Usuario::find($_SESSION['id']);

        //debuguear($citas);

        $router->render('cita/citas', [
            'titulo' => 'Mis Citas',
            'citas' => $citas,
            'usuario' => $user,
        ]);  
    }

    public static function eliminar() {
        //! Iniciamos sesion
        session_start();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //? Identificamos el id al que dimos click
            $id = $_POST['id'];

            //? Identificamos la cita por medio del ID
            $cita = Cita::find($id);

            //debuguear($id);
            //? Eliminar registro
            $cita->eliminar();

            //? Redireccionar
            header('Location: /citas');
        }
        
    }
}