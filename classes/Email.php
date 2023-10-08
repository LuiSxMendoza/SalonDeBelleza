<?php

namespace Classes;

use Exception;
require_once '../vendor/autoload.php';

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("juanluis123ar@gmail.com", "AppSalon.com");
        $email->setSubject("Confirma tu cuenta");
        $email->addTo($this->email, 'Cuentas AppSalon');

        $email->addContent(
            "text/html", 
            "<p> <strong> Hola " . $this->nombre . " </strong> 
                Has creado tu cuenta en App Salon, solo debes confirmarla haciendo
                clic en el siguiente enlace:
            </p>" .
            "<p> Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/confirma-cuenta?token=" 
                . $this->token . "'> Confirmar Cuenta </a> </p>" .
            "<p> Si tu no solicitaste esta cuenta puedes ignorar este mensaje </p>"
        );

        $apiKey = $_ENV['API_KEY'];
        $sg = new \SendGrid($apiKey);
        try {
            //$response = 
            $sg->send($email);
            //print $response->statusCode() . "\n";
            //print_r($response->headers());
            //print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

    //! Resetear password email
    public function enviarInstrucciones() {
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("juanluis123ar@gmail.com", "AppSalon.com");
        $email->setSubject("Cambia tu contraseña");
        $email->addTo($this->email, 'Cuentas AppSalon');

        $email->addContent(
            "text/html", 
            "<p> <strong> Hola " . $this->nombre . " </strong> 
                Si tu solicitaste cambiar tu contraseña puedes hacerlo haciendo
                clic en el siguiente enlace:
            </p>" .
            "<p> Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/recuperar?token=" 
                . $this->token . "'> Cambiar contraseña </a> </p>" .
            "<p> Si tu no solicitaste esta cambio puedes ignorar este mensaje </p>"
        );

        $apiKey = $_ENV['API_KEY'];
        $sg = new \SendGrid($apiKey);
        try {
            //$response = 
            $sg->send($email);
            //print $response->statusCode() . "\n";
            //print_r($response->headers());
            //print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }
}