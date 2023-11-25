<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;
class PaginasController{
    public static function index(Router $router ){
        $propiedades=Propiedad::get(3);
        $inicio=true;//para que aparezca el header
        $router->render('paginas/index', [ ///RENDER ES METODO PARA MOSTRAR UNA VISTA   
            'propiedades'=> $propiedades,
            'inicio'=>$inicio
        ]);
    }
   
    public static function nosotros(Router $router){
       $router->render('paginas/nosotros');
    }
    public static function propiedades(Router $router){
      $propiedades=Propiedad::all();
        $router->render('paginas/propiedades',[
            'propiedades'=>$propiedades
        ]);
    }
    public static function propiedad(Router $router){
        $id=validarORedireccionar('/propiedades');
       
    //    buscar la propiedad por su id
    $propiedad=Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad'=>$propiedad
        ]);
    }
    public static function blog(Router $router){
        $router->render('paginas/blog');
    }
    public static function entrada(Router $router){
       $router->render('paginas/entrada');
    }
    public static function contacto(Router $router){
        $mensaje =null;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $respuestas=$_POST['contacto']; //Se pasan las respuestas del formulario (se reciben)

            // CREAR INSTANCIA DE PHPMAILER
            $mail=new PHPMailer();

            // configurar SMTP : PROTOCOLO PARA EL ENVIO DE EMAILS
            $mail->isSMTP();
            $mail->Host='sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth=true;//que si vamos a autenticarnos
            $mail->Username= 'cb7609258a61b6'; //Datos que estan en la pagina de mailtrap
            $mail->Password= '26311da4ffc456';
            $mail->SMTPSecure= 'tls'; //para que los emails vayan segurps y no logren interceptarlos
            $mail->Port=2525;

            // configurar el contenido del email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject= 'Tienes un nuevo Mensaje';

            // habilitar html
            $mail->isHTML(true);
            $mail->CharSet= 'UTF-8';
            // definir contenido

            $contenido ='<html>';
            $contenido .='<p>Tienes un nuevo mensaje</p>';
            $contenido .='<p>Nombre: ' . $respuestas['nombre'] . '</p>';
            // enviar de forma condicional unos campos de email y tlf
            if($respuestas['contactar']==='telefono'){
                $contenido .='<p>Eligio ser contactado por Telefono: </p>';
                $contenido .='<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .='<p>Fecha de contacto: ' . $respuestas['fecha'] . '</p>';
                $contenido .='<p>Hora: ' . $respuestas['hora'] . '</p>';
            }else{
                // Es email, entonces agregamos el campo email 
                $contenido .='<p>Eligio ser contactado por email: </p>';
                $contenido .='<p>Email: ' . $respuestas['email'] . '</p>';
            }
           
            $contenido .='<p>Mensaje: ' . $respuestas['nombre'] . '</p>';
            $contenido .='<p>Vende o compra: ' . $respuestas['tipo'] . '</p>';
            $contenido .='<p>Precio o presupuesto: $' . $respuestas['precio'] . '</p>';
            $contenido .='<p>Prefiere ser contactado por: ' . $respuestas['contactar'] . '</p>';
            $contenido .='</html>';
            $mail->Body= $contenido;
            $mail->AltBody= 'Esto es tecto alternativo sin HTML';
            // Enviar el email
            if($mail->send()){
                $mensaje="Mensaje enviado correctamente";
            }else{
                $mensaje="El mensaje no se pudo enviar...";
            }
        
        }

        $router->render('paginas/contacto',[
            'mensaje'=>$mensaje
        ]);
    }
}