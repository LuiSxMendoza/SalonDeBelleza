<?php

namespace Controllers;

require_once ('../classes/Email.php');

use Classes\EmailCitasEliminadas;
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
        //? Iniciar y validar Sesion
        session_start();
        isAuth();

        //? Identificar ID de la sesion
        $id = $_SESSION['id'];

        //? Obtener datos de Usuario y Cita
        $citas = Cita::belongsTo('usuarioId', $id);
        $user = Usuario::find($_SESSION['id']);
        //debuguear($_SESSION);

        //! Renderizar y mandar datos a la vista
        $router->render('cita/citas', [
            'titulo' => 'Mis Citas',
            'citas' => $citas,
            'usuario' => $user,
        ]);  
    }

    public static function eliminar() {
        //! Iniciamos sesion
        session_start();
        isAuth();

        //? Obtenemos datos del Usuario
        $usuario = Usuario::find($_SESSION['id']);
        //debuguear($cita);
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            //? Identificamos el id al que dimos click
            $id = $_POST['id'];

            //? Identificamos la cita por medio del ID
            $cita = Cita::find($id);
            //debuguear($datos);

            //? Eliminar registro
            $cita->eliminar();

            //? Enviamos E-Mails
            $email = new EmailCitasEliminadas($cita->fecha, $cita->hora);
            $email->enviarNotificacionCitaEliminadaAdmin();
            $email->enviarNotificacionCitaEliminadaUser();

            //? Redireccionar
            header('Location: /citas');
        }
    }
}