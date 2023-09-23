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
        // basada en la url que estoy visitando gracias al router, me busca la funcion asociada a ese url
        $urlActual=$_SERVER['PATH_INFO'] ?? null;
        $metodo =$_SERVER['REQUEST_METHOD'];
        //    para validar la ruta
        if($metodo==='GET'){
           $fn=$this->rutasGET[$urlActual] ?? null;
        }else {
            $fn=$this->rutasPOST[$urlActual] ?? null;
        }
        if($fn){
            // la url existe y hay una funcion asociada
            // debuguear($fn);
            // cuando no sabemos el nombre de la funcion, esta la busca
            call_user_func($fn,$this);
        }else{
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