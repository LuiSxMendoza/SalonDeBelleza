<?php

namespace Classes;

use Exception;
require_once ('../vendor/autoload.php');

class EmailAuth {

    public $email;
    public $nombre;
    public $token;
    
    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    //! E-Mails Auth-Notificaciones

    public function enviarConfirmacionRegistro() {
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("juanluis123ar@gmail.com", "SalonDeBelleza.com");
        $email->setSubject("Confirma tu cuenta");
        $email->addTo($this->email, 'Cuentas Salon de Belleza');

        $email->addContent(
            "text/html", 
            "<p> <h1> ¡Hola: " . $this->nombre . "! </h1>
                <strong>  
                    Has creado tu cuenta en App - Salon de Belleza, para poder Acceder primero
                    debes confirmarla haciendo clic en el siguiente enlace:
                </strong> 
            </p>" .
            "<p> Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/confirma-cuenta?token=" 
                . $this->token . "'> Confirmar Cuenta </a> </p>" .
            "<p> Si tu no solicitaste esta cuenta puedes ignorar este mensaje. </p>" . 
            "<p> ¿Necesitas Ayuda? <a href='https://api.whatsapp.com/send?phone=+7292628462&text=Necesito%20ayuda%20para%20recuperar%20mi%20cuenta'> Contactar a Soporte </a> </p>" 
        );

        $apiKey = $_ENV['API_KEY'];
        $sg = new \SendGrid($apiKey);
        try {
            $sg->send($email);
            /*
            $response = 
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
            */
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

    public function enviarInstruccionesPassword() {
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("juanluis123ar@gmail.com", "SalonDeBelleza.com");
        $email->setSubject("Cambia tu contraseña");
        $email->addTo($this->email, 'Cuentas Salon de Belleza');

        $email->addContent(
            "text/html", 
            "<p> <h1> ¡Hola: " . $this->nombre . "! </h1>
                    <strong> 
                        Si tu solicitaste cambiar tu contraseña puedes hacerlo haciendo
                        clic en el siguiente enlace:
                    </strong> 
            </p>" .
            "<p> Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/recuperar?token=" 
                . $this->token . "'> Cambiar contraseña </a> </p>" .
            "<p> Si tu no solicitaste esta cambio puedes ignorar este mensaje. </p>" . 
            "<p> ¿Necesitas Ayuda? <a href='https://api.whatsapp.com/send?phone=+7292628462&text=Necesito%20ayuda%20para%20recuperar%20mi%20cuenta'> Contactar a Soporte </a> </p>" 
        );

        $apiKey = $_ENV['API_KEY'];
        $sg = new \SendGrid($apiKey);
        try {
            $sg->send($email);
            /*
            $response = 
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
            */
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

    public function enviarAlertaPassword() {
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("juanluis123ar@gmail.com", "SalonDeBelleza.com");
        $email->setSubject("Cambiaste tu contraseña");
        $email->addTo($this->email, 'Cuentas Salon de Belleza');

        $email->addContent(
            "text/html", 
            "<p> <h1> ¡Hola: " . $this->nombre . "! </h1>
                    <strong> 
                        ¡Muy bien! Has cambiado exitosamente tu contraseña.
                    </strong> 
            </p>" .
            "<p> Si tu no solicitaste esta cambio alguien corrompio tus datos. </p>" . 
            "<p> ¿Necesitas Ayuda? <a href='https://api.whatsapp.com/send?phone=+7292628462&text=Necesito%20ayuda%20para%20recuperar%20mi%20cuenta'> Contactar a Soporte </a> </p>" 
        );

        $apiKey = $_ENV['API_KEY'];
        $sg = new \SendGrid($apiKey);
        try {
            $sg->send($email);
            /*
            $response = 
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
            */
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

    public function enviarNotificacionConfirmado() {
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("juanluis123ar@gmail.com", "SalonDeBelleza.com");
        $email->setSubject("Confirmaste tu Cuenta");
        $email->addTo($this->email, 'Cuentas Salon de Belleza');

        $email->addContent(
            "text/html", 
            "<p> <h1> ¡Hola: " . $this->nombre . "! </h1> 
                    <strong>
                        ¡Muy bien! Has confirmado exitosamente tu cuenta.
                    </strong> 
            </p>" .
            "<p> Ahora puedes acceder a la Aplicación Web - Salon de Belleza. </p>" . 
            "<p> ¿Necesitas Ayuda? <a href='https://api.whatsapp.com/send?phone=+7292628462&text=Necesito%20ayuda%20para%20recuperar%20mi%20cuenta'> Contactar a Soporte </a> </p>" 
        );

        $apiKey = $_ENV['API_KEY'];
        $sg = new \SendGrid($apiKey);
        try {
            $sg->send($email);
            /*
            $response = 
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
            */
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }
}
class EmailCitasEliminadas {

    public $fecha;
    public $hora;
    
    public function __construct($fecha, $hora) {
        $this->fecha = $fecha;
        $this->hora = $hora;
    }

    //! Citas Eliminadas

    public function enviarNotificacionCitaEliminadaAdmin() {

        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("juanluis123ar@gmail.com", "SalonDeBelleza.com");
        $email->setSubject("Cancelaron una Cita");
        $email->addTo('juanluis123pit@gmail.com', 'Administrador Salon de Belleza');

        $email->addContent(
            "text/html", 
            "<p> 
                <h1> ¡Hola: Juan Luis! </h1>
                    <strong>  
                        Te notificamos que el Usuario: <br><br> " . $_SESSION['nombre'] . "
                        ha Cancelado una cita con la fecha: <br> " . $this->fecha . " <br><br>
                        Y con la hora: <br> " . $this->hora . ".
                    </strong> 
            </p>" .
            "<p> Puedes consultar todas las citas desde tu panel de Administración. </p>" . 
            "<p> ¿Necesitas Ayuda? <a href='https://api.whatsapp.com/send?phone=+7292628462&text=Necesito%20ayuda%20para%20recuperar%20mi%20cuenta'> Contactar a Soporte </a> </p>" 
        );

        $apiKey = $_ENV['API_KEY'];
        $sg = new \SendGrid($apiKey);
        try {
            $sg->send($email);
            /*
            $response = $sg->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
            */
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

    public function enviarNotificacionCitaEliminadaUser() {

        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("juanluis123ar@gmail.com", "SalonDeBelleza.com");
        $email->setSubject("Cancelaste tu Cita");
        $email->addTo($_SESSION['email'], 'Cuentas Salon de Belleza');

        $email->addContent(
            "text/html", 
            "<p> 
                <h1> ¡Hola: " . $_SESSION['nombre'] . "! </h1>
                    <strong>  
                        Has Cancelado tu cita con la fecha: <br> " . $this->fecha . ". <br><br>
                        Y con la hora: <br> " . $this->hora . ".
                    </strong>
            </p>" .
            "<p> Puedes consultar tus citas desde la Sección - Mis Citas en la App Web. </p>" . 
            "<p> ¿Necesitas Ayuda? <a href='https://api.whatsapp.com/send?phone=+7292628462&text=Necesito%20ayuda%20para%20recuperar%20mi%20cuenta'> Contactar a Soporte </a> </p>" 
        );

        $apiKey = $_ENV['API_KEY'];
        $sg = new \SendGrid($apiKey);
        try {
            $sg->send($email);
            /*
            $response = 
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
            */
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }
}


class EmailApiCancelar {

    public $fecha;
    public $hora;
    public $email;
    public $nombre;
    public $apellidos;

    public function __construct($fecha, $hora, $email, $nombre, $apellidos) {
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->email = $email;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
    }

    //! Cita cancelada por Admin

    public function enviarNotificacionCitaAdminElimino() {

        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("juanluis123ar@gmail.com", "SalonDeBelleza.com");
        $email->setSubject("Cancelaron tu Cita");
        $email->addTo($this->email, 'Cuentas Salon de Belleza');

        $email->addContent(
            "text/html", 
            "<p> 
                <h1> ¡Hola: " . $this->nombre . " " . $this->apellidos . "! </h1>
                    <strong>  
                        Un Administrador ha Cancelado tu cita con la siguiente fecha y hora: 
                        <br> " . $this->fecha . " - " . $this->hora . ".
                    </strong>
            </p>" .
            "<p> Puedes consultar tus citas desde la Sección - Mis Citas en la App Web. </p>" . 
            "<p> ¿Necesitas Ayuda? <a href='https://api.whatsapp.com/send?phone=+7292628462&text=Necesito%20ayuda%20para%20recuperar%20mi%20cuenta'> Contactar a Soporte </a> </p>" 
        );

        $apiKey = $_ENV['API_KEY'];
        $sg = new \SendGrid($apiKey);
        try {
            //$sg->send($email);
            
            $response = $sg->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
            
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }
}

class EmailApiGuardar {

    public $fecha;
    public $hora;

    public function __construct($fecha, $hora) {
        $this->fecha = $fecha;
        $this->hora = $hora;
    }

    //! E-Mails Citas Creadas

    public function enviarNotificacionCitaCreadaAdmin() {
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("juanluis123ar@gmail.com", "SalonDeBelleza.com");
        $email->setSubject("Agendaron una Cita");
        $email->addTo('juanluis123pit@gmail.com', 'Administrador Salon de Belleza');

        $email->addContent(
            "text/html", 
            "<p> <h1>¡Hola: Juan Luis!</h1>
                <strong> 
                    El usuario: " . $_SESSION['nombre'] . " " . $_SESSION['apellidos'] . " 
                    a Agendado una cita con la siguiente fecha y hora: 
                    <br> " . $this->fecha . " - " . $this->hora . ".
                </strong>
            </p>" .
            "<p> Puedes consultar los servicios seleccionados desde el panel de Administración. </p>" . 
            "<p> ¿Necesitas Ayuda? <a href='https://api.whatsapp.com/send?phone=+7292628462&text=Necesito%20ayuda%20para%20recuperar%20mi%20cuenta'> Contactar a Soporte </a> </p>" 
        );

        $apiKey = $_ENV['API_KEY'];
        $sg = new \SendGrid($apiKey);
        try {
            
            
            $response = $sg->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
            
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

    public function enviarNotificacionCitaCreadaUser() {
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("juanluis123ar@gmail.com", "SalonDeBelleza.com");
        $email->setSubject("Agendaste una Cita");
        $email->addTo($_SESSION['email'], 'Cuentas Salon de Belleza');

        $email->addContent(
            "text/html", 
            "<p> <h1> ¡Hola: " . $_SESSION['nombre'] . " " . $_SESSION['apellidos'] . "! </h1>
                <strong>   
                    Has Agendado una cita con la siguiente fecha y hora: 
                    <br> " . $this->fecha . " - " . $this->hora . ".
                </strong>
            </p>" .
            "<p> Puedes consultar los detalles desde la sección - Mis Citas. </p>" . 
            "<p> ¿Necesitas Ayuda? <a href='https://api.whatsapp.com/send?phone=+7292628462&text=Necesito%20ayuda%20para%20recuperar%20mi%20cuenta'> Contactar a Soporte </a> </p>" 
        );

        $apiKey = $_ENV['API_KEY'];
        $sg = new \SendGrid($apiKey);
        try {
            $sg->send($email);
            /*
            $response = 
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
            */
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }
}