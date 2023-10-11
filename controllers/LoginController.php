<?php

namespace Controllers;

require_once ('../classes/Email.php');

use Classes\EmailAuth;
use Model\Usuario;
use MVC\Router;

class LoginController {

    public static function login(Router $router) {

        //? Alertas vacias
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);

            //? Añadir validacion
            $alertas = $auth->validarLogin();

            if(empty($alertas)) {
                //? Comprobar usuario
                $usuario = Usuario::where('email', $auth->email);
                if($usuario) {
                    //? Comprobar password
                    if($usuario->comprobarRegistroAndStatus($auth->password)) {
                        //? Autenticar usuario
                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['apellidos'] = $usuario->apellidos;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //? Redireccionar
                        if($usuario->admin === "1") {
                            $_SESSION['admin'] = $usuario->admin ?? null;

                            header('Location: /admin');
                        } else {
                            header('Location: /cita');
                        }
                    }
                } else {
                    //? Msj error
                    Usuario::setAlerta('error', 'Usuario no existente');
                }
            }
        }

        //! Mostrar alertas
        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'titulo' => 'Login',
            'alertas' => $alertas
        ]);
    }

    public static function logout() {
        
        session_start();

        $_SESSION = [];

        header('Location: /');
    }

    public static function olvide(Router $router) {

        //? Alertas vacias
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);

            //? Añadir validacion
            $alertas = $auth->validarEmail();

            if (empty($alertas)) {
            //? Comprobar usuario
            $usuario = Usuario::where('email', $auth->email);
                //? Comprobar confirmado
                if ($usuario && $usuario->confirmado === '1') {
                    //? Enviar token
                    $usuario->crearToken();

                    //? Almacenar en BD
                    $usuario->guardar();

                    //? Enviar email
                    $email = new EmailAuth($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstruccionesPassword();
                    
                    //? Alerta exito
                    Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');

                } else {
                    //? Msj error
                    Usuario::setAlerta('error', 'Usuario no existente o no confirmado');
                }
            }
        }

        //! Mostrar alertas
        $alertas = Usuario::getAlertas();
        
        $router->render('auth/olvide-password', [
            'titulo' => 'Olvide',
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router) {
        
        //? Añadir arreglo de alertas vacias
        $alertas = [];
        $error = false;

        //? Buscar token
        $token = s($_GET['token']);

        //? Buscar usuario por token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            //? Mostrar msj de error
            Usuario::setAlerta('error', 'Token NO Valido');
            $error = true;

        }if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $password = new Usuario($_POST);

            //? Añadir validacion
            $alertas = $password->validarPassword();

            if(empty($alertas)) {
                //? Eliminamos password antiguo
                $usuario->password = null;

                //? Leemos nuevo password
                $usuario->password = $password->password;

                //? Hash password
                $usuario->hashPassword();

                //? Guardar en bd y eliminar token
                $usuario->token = null;
                $resultado =$usuario->guardar();

                //? Enviar email
                $email = new EmailAuth($usuario->email, $usuario->nombre, $usuario->token);
                $email->enviarAlertaPassword();

                //? Msj de exito
                Usuario::setAlerta('exito', 'Contraseña actualizada correctamente');

                //? Redireccionar
                if($resultado) {
                    header('Location: /');
                }
            }
        }

        //! Mostrar alertas
        $alertas = Usuario::getAlertas();

        $router->render('auth/recupera', [
            'titulo' => 'Recuperar',
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    public static function registrar(Router $router) {

        $usuario = new Usuario;

        //? Alertas vacias
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarCuentaNueva();

            //? Revizar que alertas este vacio
            if(empty($alertas)) {
                //? Verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows) {
                } else {
                    //? Hashear password
                    $usuario->hashPassword();

                    //? Crear token
                    $usuario->crearToken();

                    //? Almacenar en la base de datos
                    $resultado = $usuario->guardar();

                    //? Enviar Email
                    $email = new EmailAuth($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacionRegistro();
                    

                    if($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        //! Mostrar alertas
        $alertas = Usuario::getAlertas();

        $router->render('auth/crea-cuenta', [
            'titulo' => 'Crear Cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function confirma(Router $router) {

        $alertas = [];

        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            //? Mostrar msj de error
            Usuario::setAlerta('error', 'Token NO Valido');
        } else {
            //? Confirmar usuario
            $usuario->confirmado = "1";

            $usuario->token = null;

            $usuario->guardar();

            //? Enviar Email
            $email = new EmailAuth($usuario->email, $usuario->nombre, $usuario->token);
            $email->enviarNotificacionConfirmado();

            Usuario::setAlerta('exito', 'Cuenta confirmada correctamente');
        }

        //! Mostrar alertas
        $alertas = Usuario::getAlertas();

        //? Renderizar vista
        $router->render('auth/confirma-cuenta', [
            'titulo' => 'Confirmar',
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router) {
        
        $router->render('auth/mensaje');
    }
}
