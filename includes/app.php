<?php
// archivo que mande a llamar todo
require 'funciones.php';
require 'config/database.php';
require __DIR__ .'/../vendor/autoload.php';

// copnectar a la base de datos
$db=conectarDB();


use Model\Activerecord;

Activerecord::setDB($db);