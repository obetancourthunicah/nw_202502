<?php
// Dominio de Ordenes
/*
include
include_once
require
require_once
*/
session_start();

require_once "libreria.php";

function crearOrden($nombre, &$store)
{
    // retorna el id de la orden
    $ordenes = obtenerOrdenesDePersistencia($store);
    $orden = [
        "codigo" => explode(".", gettimeofday(true))[0],
        "nombreCliente" => $nombre,
        "productos" => [],
        "total" => 0,
        "estado" => "Abierto"
    ];
    $ordenes[] = $orden;
    guardarOrdenesAPersistencia($ordenes, $store);
    return $orden;
}

function obtenerOrdenesDePersistencia(&$store)
{
    $ordenes = obtenerDePersistencia("ordenes", $store);
    return $ordenes;
}
function guardarOrdenesAPersistencia($ordenes, &$store)
{
    agregarAPersistencia("ordenes", $ordenes, $store);
}

function obtenerOrdenPorCodigo($numOrden, &$store)
{
    $ordenes = obtenerOrdenesDePersistencia($store);
    foreach ($ordenes as $orden) {
        if ($orden["codigo"] === $numOrden) {
            return $orden;
        }
    }
    return null;
}
function actualizarOrden($updOrden, &$store)
{
    $ordenes = obtenerOrdenesDePersistencia($store);
    $newOrdenes = [];
    foreach ($ordenes as $orden) {
        if ($orden["codigo"] === $updOrden["codigo"]) {
            $newOrdenes[] = $updOrden;
        } else {
            $newOrdenes[] = $orden;
        }
    }
    guardarOrdenesAPersistencia($newOrdenes, $store);
}

function agregarProductoAOrden($codigo, $cantidad, $numOrden, &$store)
{
    $producto = obtenerProductoDeInventario($codigo, $store);
    $producto["cantidad"] = $cantidad;
    $producto["subtotal"] = $cantidad * $producto["precio"];
    $orden = obtenerOrdenPorCodigo($numOrden, $store);
    $orden["productos"][] = $producto;
    $orden["total"] += $producto["subtotal"];
    actualizarOrden($orden, $store);
}

function obtenerNumOrdenActiva()
{
    if (isset($_SESSION["ordenActiva"])) {
        return $_SESSION["ordenActiva"];
    }
    return null;
}

function setNumOrdenActiva($numOrden)
{
    $_SESSION["ordenActiva"] = $numOrden;
}

function finalizarOrden($numOrden, &$store) {}
