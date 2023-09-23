<?php

namespace Model;

class Vendedor extends Activerecord{
    protected static $tabla='vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'imagen', 'telefono', 'email'];

    public $id;
    public $nombre;
    public $apellido;
    public $imagen;
    public $telefono;

    public $email;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
     
    }

    public function validar(){
        if (!$this->nombre) {
            self::$errores[] = "El nombre es obligatorio";
        }
        if (!$this->apellido) {
            self::$errores[] = "El apellido es obligatoria";
        }
        if (!$this->telefono) {
            self::$errores[] = "El telefono es obligatoria";
        }
        if (!$this->email) {
            self::$errores[] = "El email es obligatoria";
        }
        if (!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }
        // expresion regular para validar el telefono
        if(!preg_match('/[0-9]{11}/', $this->telefono)){
            self::$errores[] = "Formato no valido";
        }
        return self::$errores;
    }
}