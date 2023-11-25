<?php
namespace MVC;
class Router{

    public $rutasGET=[];
    public $rutasPOST=[];

    public function get($url,$fn){
        $this->rutasGET[$url]=$fn;
    }
    public function post($url,$fn){
        $this->rutasPOST[$url]=$fn;
    }
    public function comprobarRutas(){

        session_start();
        $auth=$_SESSION['login'] ?? null;

        // ARREGLO DE RUTAS PROTEGIDAS
        $rutas_protegidas=['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar','/vendedor/crear', '/vendedor/actualizar', '/vendedor/eliminar'];


        // basada en la url que estoy visitando gracias al router, me busca la funcion asociada a ese url
        $urlActual=$_SERVER['PATH_INFO'] ?? '/';
        $metodo =$_SERVER['REQUEST_METHOD'];
        //    para validar la ruta
        if($metodo==='GET'){
           $fn=$this->rutasGET[$urlActual] ?? null;
           
        }else {
            $fn=$this->rutasPOST[$urlActual] ?? null;
        }

        // PROTEGER LAS RUTAS
        if(in_array($urlActual, $rutas_protegidas)&& !$auth){ ///si no esta autenticado
            header('location: /');
        }

        if($fn){
            // la url existe y hay una funcion asociada
            // cuando no sabemos el nombre de la funcion, esta la busca
            // debuguear($fn);
            call_user_func($fn,$this);

        }else{
            // debuguear($fn);
            echo 'Pagina No encontrada';
        }
    }

    // muestra una vista
    public function render($view, $datos=[]){

        foreach($datos as $key => $value){
         $$key =$value;
         
        }
      
         ob_start();//empieza almacenar datos en memoria
         include __DIR__ . "/views/$view.php";
         
         $contenido=ob_get_clean();//limpia el buffer
 
         include __DIR__ . "/views/layout.php";
     }
}