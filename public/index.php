<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\PaginasController;
use Controllers\Propiedadcontroller;
use Controllers\vendedorcontrollers;
use MVC\Router;
$router= new Router();
$router->get('/', [PaginasController::class, 'index']);
// zona privada
$router->get('/admin', [Propiedadcontroller::class, 'index']);
$router->get('/propiedades/crear', [Propiedadcontroller::class, 'crear']);
$router->post('/propiedades/crear', [Propiedadcontroller::class, 'crear']);
$router->get('/propiedades/actualizar', [Propiedadcontroller::class, 'actualizar']);
$router->post('/propiedades/actualizar', [Propiedadcontroller::class, 'actualizar']);
$router->post('/propiedades/eliminar', [Propiedadcontroller::class, 'eliminar']);


$router->get('/vendedores/crear', [vendedorcontrollers::class, 'crear']);
$router->post('/vendedores/crear', [vendedorcontrollers::class, 'crear']);
$router->get('/vendedores/actualizar', [vendedorcontrollers::class, 'actualizar']);
$router->post('/vendedores/actualizar', [vendedorcontrollers::class, 'actualizar']);
$router->post('/vendedores/eliminar', [vendedorcontrollers::class, 'eliminar']);

// zona publica
$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/propiedades', [PaginasController::class, 'propiedades']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

$router->comprobarRutas();