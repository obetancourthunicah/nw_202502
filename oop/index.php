<?php

use negocios\Controller\Productos\Producto;
use negocios\Controller\Productos\Productos;
use negocios\Data\SessionData;
use negocios\Data\JsonData;

session_start();
require_once "vendor/autoload.php";

$sessionStore = new SessionData("productos");
$jsonStore = new JsonData("productos.json");

$controlador = new Productos($sessionStore);

$producto = new Producto();
$producto->SKU = "001";
$producto->Descripcion = "Prueba de Producto";
$producto->Precio = 10.00;
$producto->Cantidad = 100;


$controlador->addProducto($producto);

$controlador2 = new Productos($jsonStore);


$producto = new Producto();
$producto->SKU = "002";
$producto->Descripcion = "Prueba de Producto 2";
$producto->Precio = 10.00;
$producto->Cantidad = 100;

$controlador2->addProducto($producto);

$producto = new Producto();
$producto->SKU = "003";
$producto->Descripcion = "Prueba de producto 4";
$producto->Precio = 100.00;
$producto->Cantidad = 100;

$controlador2->addProducto($producto);




$bootstrap = new negocios\Bootstrap();
$bootstrap->PrintHello();

print_r($_SESSION);
