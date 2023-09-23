<?php
    
// SI NO EXISTE SESSION, LA INICIAMOS
    if(!isset($_SESSION)){
        session_start();
    }

    $auth=$_SESSION['login'] ?? false;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/bienesraicespoo/build/css/app.css">
</head>
<body>
    <!-- aqui se define una variable que es 'inicio' si viene vacio y no se recibe esa variable, no se agrega la clase, pero de caso contrario si se agrega -->
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/bienesraicespoo/index.php">
                    <img src="/bienesraicespoo/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/bienesraicespoo/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/bienesraicespoo/build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <?php if($auth): ?>
                            <a href="cerrar-sesion.php">Cerrar Sesion</a>
                        <?php endif; ?>
                    </nav>
                </div>
   
                
            </div> <!--.barra-->

            <!-- se coloca ese h1 solo si exoste la variable de inicio, sino no se pone -->
            <?php if($inicio){ ?>
                 <h1>Venta de Casas y Departamentos  Exclusivos de Lujo</h1>
            <?php }?>
        </div>
    </header>