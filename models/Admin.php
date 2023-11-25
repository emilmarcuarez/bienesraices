<?php

namespace Model;
class Admin extends ActiveRecord{
    // base de datos
    protected static $tabla='usuarios';
    protected static $columnasDB=['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args =[]){
        $this->id=$args['id'] ?? null;
        $this->email=$args['email'] ?? null;
        $this->password=$args['password'] ?? null;
    }
    public function validar(){
        if(!$this->email){
            self::$errores[]='El email es obligatorio';
        }
        if(!$this->password){
            self::$errores[]='El Password es obligatorio';
        }

        return self::$errores;
    }
    public function existeUsuario(){
        // revisamos si el susuario existe o no
        $query="SELECT * FROM ".self::$tabla. " WHERE email = '".$this->email ."' LIMIT 1";
        $resultado=self::$db->query($query);
        // num_rows tiene un 1 si el usuario existe, asi que si no existe es que NO EXISTE
        if(!$resultado->num_rows){
            self::$errores[]='El Usuario no existe';
            return; //se deja de ejecutar esta funcion
        }
        return $resultado;
    }
    public function comprobarPassword($resultado){
        $usuario=$resultado->fetch_object();

        // verifica que la copntraseña que se escribio en el formulario es la misma que esta hasheada en la base de datos
        $autenticado=password_verify($this->password, $usuario->password);
        
        if(!$autenticado){//es un bool, true o false
            self::$errores[]='El password es incorrecto'; //lo agrega al final del arreglo
        }

        return $autenticado;
    }

    public function autenticar(){   
        session_start();

        // llenar el arreglo de sesiones
        $_SESSION['usuario']=$this->email;
        $_SESSION['login']=true;

        header('Location: /admin');
    }
}