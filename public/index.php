<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\Propiedadcontroller;
use Controllers\vendedorcontrollers;

$router= new Router();
$router->get('/admin', [Propiedadcontroller::class, 'index']);
$router->get('/propiedades/crear', [Propiedadcontroller::class, 'crear']);
$router->post('/propiedades/crear', [Propiedadcontroller::class, 'crear']);
$router->get('/propiedades/actualizar', [Propiedadcontroller::class, 'actualizar']);
$router->post('/propiedades/actualizar', [Propiedadcontroller::class, 'actualizar']);
$router->post('/propiedades/eliminar', [Propiedadcontroller::class, 'eliminar']);

// $router= new Router();
$router->get('/vendedores/crear', [vendedorcontrollers::class, 'crear']);
$router->post('/vendedores/crear', [vendedorcontrollers::class, 'crear']);
$router->get('/vendedores/actualizar', [vendedorcontrollers::class, 'actualizar']);
$router->post('/vendedores/actualizar', [vendedorcontrollers::class, 'actualizar']);
$router->post('/vendedores/eliminar', [vendedorcontrollers::class, 'eliminar']);


$router->comprobarRutas();