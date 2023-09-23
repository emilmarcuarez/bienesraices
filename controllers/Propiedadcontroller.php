<?php 

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;
class Propiedadcontroller{
    public static function index(Router $router){
            $propiedades=Propiedad::all();
            $vendedores=Vendedor::all();
           // MUESTRA MENSAJE CONDICIONAL
$resultado = $_GET['resultado'] ?? null; //sino esta el valor resultado, se le pone null y no presenta error, solo le asigna null y no falla
        //    la ubicacion de la vista que va a abrir, se pasa a render para que haga eso
        $router->render('propiedades/admin',[
            'propiedades'=>$propiedades,
            'resultado' =>$resultado,
            'vendedores' =>$vendedores
        ]);
    }
    public static function crear(Router $router){
       
       $propiedad=new Propiedad;
       $vendedores= Vendedor::all();

       // ARREGLO CON MENSAJE DE ERRORES
        $errores = Propiedad::getErrores();

       if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // para mandarlo a la clase
        // crea una nueva instancia
        $propiedad = new Propiedad($_POST['propiedad']);
    
        // ----------------SUBIDA DE ARCHIVOS----------------
    
    
        // GENERARA NOMBRE UNICO PARA LAS IMAGENES
        $nombreImagen = md5(uniqid(rand(), true)) .  ".jpg"; //generan numeros aleatorios
    
        // SETEAR LA IMAGEN
        // Realiza un resize a la imagen con intervention
        // debuguear($_FILES['imagen']['tmp_name']);
        if ($_FILES['propiedad']['tmp_name']['imagen']) { //si existe la imagen
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            $propiedad->setImagen($nombreImagen);
        }
    
        // VALIDAR
        $errores = $propiedad->validar();
    
    
    
        // REVISAR QUE EL ARREGLO ESTE VACIO. ISSET REVISA QUE UNA VARIABLE ESTE CREADA Y EMPTY SI ESTA VACIO
        if (empty($errores)) { //en caso de que este vacio
    
            // PARA SABER SI LA CARPETA EXISTE SE USA IS_DIR
            if (!is_dir(CARPETA_IMAGENES)) { //SI NO EXISTE, SE CREA
                mkdir(CARPETA_IMAGENES); //cuando no hay errores, crea la carpeta
    
            }
    
            // Guardar la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);
    
            $propiedad->guardar();
    
        }
    }

        // render es metodo para crear una vista
        $router->render('propiedades/crear',[
            'propiedad'=>$propiedad,
            'vendedores'=>$vendedores,
            'errores'=>$errores
        ]);
    }
    public static function actualizar(Router $router){
        // redireccionar al admin
        $id= validarORedireccionar("/admin");

        $propiedad=Propiedad::find($id);

        $vendedores= Vendedor::all();

        $errores=Propiedad::getErrores();

        // metodo post para actualizar y mandarlo a la bd
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // asignar los atributos para que se almacenen mientras no se mandan a la base de datos
    $args = $_POST['propiedad'];

    $propiedad->sincronizar($args); //sincroniza los datos que el usuario escribio con lo que esta en memoria
    // validacion
    $errores = $propiedad->validar();

    // subida de archivos
     // GENERARA NOMBRE UNICO PARA LAS IMAGENES
     $nombreImagen = md5(uniqid(rand(), true)) .  ".jpg"; //generan numeros aleatorios

    if ($_FILES['propiedad']['tmp_name']['imagen']) { //si existe la imagen
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }
   
   
    // REVISAR QUE EL ARREGLO ESTE VACIO. ISSET REVISA QUE UNA VARIABLE ESTE CREADA Y EMPTY SI ESTA VACIO
    
    if (empty($errores)) { //en caso de que este vacio
        if ($_FILES['propiedad']['tmp_name']['imagen']) {
            // ALMACENAR IMAGEN
            $image->save(CARPETA_IMAGENES . $nombreImagen);
            
        }
        $propiedad->guardar();
    }
}

        // pasar a la vista
        $router->render('/propiedades/actualizar',[
            'propiedad'=>$propiedad,
            'errores'=>$errores,
            'vendedores'=>$vendedores
        ]);
    }
    public static function eliminar(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                // validar id
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);
            
                if ($id) {
            
                    $tipo=$_POST['tipo'];
                    if(validarTipoContenido($tipo)){
                        // comparar lo que se va eliminar
                      $propiedad=Propiedad::find($id);
                      $propiedad->eliminar();
                    }
                }
            }
        } 
}

