<?php

use negocios\Controller\Productos\Producto;
use negocios\Controller\Productos\ProductoPersonalizado;
use negocios\Controller\Productos\Decoradores;
// use negocios\Controller\Productos\Productos;
// use negocios\Data\SessionData;
// use negocios\Data\JsonData;

session_start();
require_once "vendor/autoload.php";

// $sessionStore = new SessionData("productos");
// $jsonStore = new JsonData("productos.json");

// $controlador = new Productos($sessionStore);

// $producto = new Producto();
// $producto->SKU = "001";
// $producto->Descripcion = "Prueba de Producto";
// $producto->Precio = 10.00;
// $producto->Cantidad = 100;


// $controlador->addProducto($producto);

// $controlador2 = new Productos($jsonStore);


// $producto = new Producto();
// $producto->SKU = "002";
// $producto->Descripcion = "Prueba de Producto 2";
// $producto->Precio = 10.00;
// $producto->Cantidad = 100;

// $controlador2->addProducto($producto);

$producto = new Producto();
$producto->SKU = "003";
$producto->Descripcion = "Baleada Sencilla";
$producto->Precio = 20.00;
$producto->Cantidad = 100;

$productoPersonalizado = new ProductoPersonalizado($producto);

$agregarHuevo = new Decoradores\ExtraHuevos(10);
$agregarHuevo2 = new Decoradores\ExtraHuevos(10);

$descuentoCF = new Decoradores\ClienteFrecuente(10);

$productoPersonalizado->addDecorator($agregarHuevo);
$productoPersonalizado->addDecorator($agregarHuevo2);
$productoPersonalizado->addDecorator($descuentoCF);

echo "Precio final: " . $productoPersonalizado->getPrice();
// $controlador2->addProducto($producto);




// $bootstrap = new negocios\Bootstrap();
// $bootstrap->PrintHello();

// print_r($_SESSION);
