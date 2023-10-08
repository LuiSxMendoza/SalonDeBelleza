<?php

namespace Model;

class Servicio extends ActiveRecord {
    //? Base DE DATOS
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    public function validarServicioNuevo() {
        if (!$this->nombre) {
            self::$alertas['error'][] = "Debes añadir un nombre";
        }
        if (!$this->precio) {
            self::$alertas['error'][] = "Debes añadir un precio";
        }
        if (!is_numeric($this->precio)) {
            self::$alertas['error'][] = "Precio no valido";
        }
        return self::$alertas;
    }
}