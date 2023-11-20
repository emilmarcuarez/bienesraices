<?php

namespace Model;


class Activerecord
{
    // base de datos
    protected static $db;
    protected static $columnasDB = [];

    protected static $tabla='';

    // errores
    protected static $errores = [];

  // Visibilidad de los atributos
  public $id;
  public $imagen;
  public $titulo;
  public $precio;
  public $descripcion;
  public $habitaciones;
  public $wc;
  public $estacionamiento;
  public $creado;
  public $vendedorId;
  public $tipo;
 

    // definir la conexion a la base de datos
    public static function setDB($database)
    {
        self::$db = $database;
    }


    public function guardar()
    {
        if (!is_null($this->id)) {
            // actualizar
            $this->actualizar();
        } else {
            // crear un nuevo registro
            $this->crear();
        }
    }
    public function crear()
    {

        // sanitizar los datos
        $atributos = $this->sanitizarAtributos();


        // insertar a la BASE DE DATOS
        $query = "INSERT INTO ". static::$tabla. " (";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);
        //   return es un false or true
        // Mensaje de exito
        if ($resultado) {

            header('location: /admin?resultado=1');
        }
    }
    // actualizar
    public function actualizar()
    {
        // sanitizar los datos. siempre que se va a usar la bd
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "$key ='{$value}'";
        }
        $query = "UPDATE ". static::$tabla. " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);
        if ($resultado) {
            //    redirecciona al usuario para que se borra la info cuando se envie
            // esto se debe hacer poco, se puede hacer un loop de muchas redirecciones

            header('location: /admin?resultado=2');
        }
        return $resultado;
    }
    // eliminar un resgistro
    public function eliminar()
    {
        // ELIMINAR el registro
        $query = "DELETE FROM ". static::$tabla. " WHERE id= " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado) {
            $this->borrarImagen();
            // despues del link se pone un '?' y posterior el nombre de la variable que uno quiere y se iguala a un numero
            header('location: /admin?resultado=3');
        }
    }

    // mapear, identificar y unir los atributos de la BD
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // sanitizar
    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        // arreglo asociativo 
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // elimina el archivo
    public function borrarImagen()
    {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    //subida de archivos
    public function setImagen($imagen)
    {
        // elimina la imagen previa
        if (!is_null($this->id)) { //isset que exista y tenga valor

            $this->borrarImagen();
        }

        // asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    // validacion
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {
        static::$errores=[];
       return static::$errores;
    }

    // lista todas las propiedades
    public static function all()
    {
        $query = "SELECT * FROM ". static::$tabla;

        $resultado = static::consultarSQL($query);
        return $resultado;
    }

// obtiene determinado numero de registros
public static function get($cantidad)
{
    $query = "SELECT * FROM ". static::$tabla . " LIMIT ".$cantidad;
  
    $resultado = static::consultarSQL($query);
    return $resultado;
}

    // busca un registro por id
    public static function find($id)
    {
        $query = "SELECT * FROM ". static::$tabla. " WHERE id= $id";
        // se sigue el principio de active record que es tener todo en objetos
        $resultado = self::consultarSQL($query);
        return array_shift($resultado); //Retornaa el primer elemento
    }

    public static function consultarSQL($query)
    {
        // consultar la base de datos
        $resultado = self::$db->query($query);

        // iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }

    // de arreglo a objeto
    protected static function crearObjeto($registro)
    {
        $objeto = new static; //new self crea nuevos objetos de la clase actual

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
    // sincroniza el objeto en memoria con los cambios realizados por el usuario

    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}

