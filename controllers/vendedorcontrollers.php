<?php

namespace Controllers;
use MVC\Router;
use  Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;
class vendedorcontrollers{
    public static function crear(Router $router){
       

       $errores= Vendedor::getErrores();

        $vendedor=new Vendedor;

        // EJEECUTAR EL CODIGO DESPUES DE QUE EL USUARIO ENVIE EL FORMULARIO
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            // CREAR UNA NUEVA INSTANCIA
            $vendedor=new Vendedor($_POST['vendedor']); //Desde el objeto vendedor
            
            // -----foto----
            // GENERARA NOMBRE UNICO PARA LAS IMAGENES
            $nombreImagen = md5(uniqid(rand(), true)) .  ".jpg"; //generan numeros aleatorios
            if ($_FILES['vendedor']['tmp_name']['imagen']) { //si existe la imagen
                $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800, 600);
                $vendedor->setImagen($nombreImagen);
            }
        
            // validar que no haya campos vacios
            $errores=$vendedor->validar();
        
            // no hay errores
            if(empty($errores)){
        
                if (!is_dir(CARPETA_IMAGENES_VENDEDOR)) { //SI NO EXISTE, SE CREA
                    mkdir(CARPETA_IMAGENES_VENDEDOR); //cuando no hay errores, crea la carpeta
        
                }
        
                // Guardar la imagen en el servidor
                $image->save(CARPETA_IMAGENES_VENDEDOR . $nombreImagen);
                $vendedor->guardar();
            }
        }



        $router->render('vendedores/crear',[
            'errores'=>$errores,
            'vendedor' =>$vendedor
        ]);
    }
    public static function actualizar( Router $router){
       
        $errores= Vendedor::getErrores();
        $id= validarORedireccionar('/admin');

        // obtener datos del vendedor a actualizar
        $vendedor=Vendedor::find($id);

// EJEECUTAR EL CODIGO DESPUES DE QUE EL USUARIO ENVIE EL FORMULARIO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // asignar los valores
    $args=$_POST['vendedor'];
    $vendedor->sincronizar($args); //sincroniza los datos que se ingresaron al objeto en memoria


      // subida de archivos
     // GENERARA NOMBRE UNICO PARA LAS IMAGENES
     $nombreImagen = md5(uniqid(rand(), true)) .  ".jpg"; //generan numeros aleatorios

    if ($_FILES['vendedor']['tmp_name']['imagen']) { //si existe la imagen
        $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800, 600);
        $vendedor->setImagen($nombreImagen);
    }
       // validacion
       $errores=$vendedor->validar();
       
    if(empty($errores)){
        if ($_FILES['vendedor']['tmp_name']['imagen']) {
            // ALMACENAR IMAGEN
            $image->save(CARPETA_IMAGENES_VENDEDOR . $nombreImagen);
            
        }
        $vendedor->guardar();
    }
}

        $router->render('vendedores/actualizar',[
            'errores'=>$errores,
            'vendedor'=>$vendedor
        ]);
    }
    public static function eliminar(){
        echo 'eliminar vendedor';
    }
}