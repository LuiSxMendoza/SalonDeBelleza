<?php

namespace Model;

class Usuario extends ActiveRecord {
    //! Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellidos', 'email', 'password', 
    'telefono', 'admin', 'token', 'confirmado'];

    public $id;
    public $nombre;
    public $apellidos;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $token;
    public $confirmado;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '0';
    }

    //TODO: - Crear cuenta

    //! Validacion
    public function validarCuentaNueva() {
        if (!$this->nombre) {
            self::$alertas['error'][] = "Debes añadir un nombre";
        }
        if (!$this->apellidos) {
            self::$alertas['error'][] = "Debes añadir un apellido";
        }
        if (!$this->telefono) {
            self::$alertas['error'][] = "Debes añadir un telefono";
        }
        if (!$this->email) {
            self::$alertas['error'][] = "Debes añadir un email";
        }
        if (!$this->password) {
            self::$alertas['error'][] = "Debes añadir un password";
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = "El password debe contener al menos
            6 caracteres";
        }
        if(!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$alertas['error'][] = "Formato de telefono no valido";
        }
        if(!preg_match('^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})^', $this->email )) {
            self::$alertas['error'][] = "Ingresa un email valido";
        }
        return self::$alertas;
    }

    //! Revisa si el usuario existe
    public function existeUsuario() {
        $query = " SELECT * FROM " . self::$tabla . 
        " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado->num_rows) {
            self::$alertas['error'][] = 'El usuario ya esta registrado';
        }
       
        return $resultado;
    }

    //! Hash password
    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    //! Crear token 
    public function crearToken() {
        $this->token = uniqid();
    }

    //TODO: - Login

    //! Validar
    public function validarLogin() {
        if (!$this->email) {
            self::$alertas['error'][] = "Debes añadir un email";
        }
        if (!$this->password) {
            self::$alertas['error'][] = "Debes añadir un password";
        }
        return self::$alertas;
    }

    //! Comprobar si esta registrado y confirmado
    public function comprobarRegistroAndStatus($password) {

        $resultado = password_verify($password, $this->password);

        if(!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Password incorrecto o cuenta no confirmada';
        } else {
            return true;
        }
    }

    //TODO: - Olvide

    //! Validar
    public function validarEmail() {
        if (!$this->email) {
            self::$alertas['error'][] = "Debes añadir un email";
        }
        return self::$alertas;
    }

    //TODO: - Recupera

    //! Validar
    public function validarPassword() {
        if (!$this->password) {
            self::$alertas['error'][] = "Debes añadir un password";
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = "El password debe contener al menos
            6 caracteres";
        }
        return self::$alertas;
    }
}