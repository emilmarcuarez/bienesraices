<?php
define('TEMPLATES_URL', __DIR__ . "/templates");
define('FUNCIONES_URL', __DIR__ . "funciones.php");
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');
define('CARPETA_IMAGENES_VENDEDOR', __DIR__ . '/../imagenes_vendedor/');
function incluirTemplate($nombre, $inicio=false){

    include TEMPLATES_URL . "/$nombre.php";
}
function estaautenticado() : bool{
    session_start();

    if(!$_SESSION['login']){
        header('location: /bienesraicespoo/login.php');
    }
    return false;
}
// funcion para poder ver el contenido de alguna variable y observar su funcionamiento
function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// escapar / sanitizar el html
function s($html){
    $s=htmlspecialchars($html);
    return $s;
}

// validar tipo de contenido
function validarTipoContenido($tipo){
    $tipos=['vendedor', 'propiedad'];

    // busca un elemento en un arreglo, primero el elemento a buscar y el segundo es el arreglo en donde va a buscar
    return in_array($tipo, $tipos);
}

// MUESTRAS LOS MENSAJES

function mostrarNotificacion($codigo){
    $mensaje='';
    switch($codigo){
        case 1:
            $mensaje="Creado correctamente";
            break;
        case 2:
            $mensaje="Actualizado correctamente";
            break;
        case 3:
            $mensaje="Eliminado correctamente";
            break;
        default:
            $mensaje=false;
            break;
    }
    return $mensaje;
}

function validarORedireccionar(string $url){
    // ID QUE SE TRAE DEL INDEX.PHP CUANDO SE LE DA CLICK AL BOTON actualizar para traerse el id de la casa que se esta dando click
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        // VALIDAR URL
        if (!$id) {
            header("location: $url");
        }
    return $id;
}

?>