<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\Propiedadcontroller;
$router= new Router();
$router->get('/admin', [Propiedadcontroller::class, 'index']);
$router->get('/propiedades/crear', [Propiedadcontroller::class, 'crear']);
$router->post('/propiedades/crear', [Propiedadcontroller::class, 'crear']);
$router->get('/propiedades/actualizar', [Propiedadcontroller::class, 'actualizar']);
$router->post('/propiedades/actualizar', [Propiedadcontroller::class, 'actualizar']);
$router->post('/propiedades/eliminar', [Propiedadcontroller::class, 'eliminar']);
$router->comprobarRutas();