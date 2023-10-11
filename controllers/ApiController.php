<?php

namespace Controllers;

require_once ('../classes/Email.php');

use Classes\EmailApiCancelar;
use Classes\EmailApiGuardar;
use Model\Cita;
use Model\CitasServicios;
use Model\Servicio;
use Model\Usuario;

class ApiController {
    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardar() {
        //? Iniciamos sesion y autenticamos
        session_start();
        isAuth();
        
        //? Almacena cita y devuelve id
        $cita = new Cita($_POST);

        if ($resultado = $cita->guardar()) {
            //? Enviamos E-Mails
            $email = new EmailApiGuardar($cita->fecha);
            $email->enviarNotificacionCitaCreadaAdmin();
            $email->enviarNotificacionCitaCreadaUser();
        }

        $id = $resultado['id'];

        //? Almacena los servicios con el id de la cita
        $idServicios = explode(",", $_POST['servicios']);
        foreach($idServicios as $idServicio) {
            $args = [
                'citaId' => $id, 
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitasServicios($args);
            $citaServicio->guardar();
        }

        //? Retornamos una respuesta
        echo json_encode(['resultado' => $resultado]);     
    }

    public static function eliminar() {
        
        //! Iniciamos sesion
        session_start();
        isAuth();
        //debuguear($usuario);
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            //? Identificamos el id al que dimos click
            $id = $_POST['id'];

            //? Identificamos la cita por medio del ID
            $cita = Cita::find($id);

            //? Identificamos al propietario de la cita
            $idCita = $cita->usuarioId;
            $usuario = Usuario::find($idCita);
            //debuguear($usuario);

            //? Eliminar registro
            $cita->eliminar();

            //? Enviamos E-Mails
            $email = new EmailApiCancelar($cita->fecha, $usuario->email, $usuario->nombre, $usuario->apellidos);
            $email->enviarNotificacionCitaAdminElimino();

            //? Redireccionar
            header('Location: /admin');
        }
    }
}