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
    $orden = obtenerOrdenPorCodigo($numOrden, $store);
    $isInOrder = false;
    $newProductos = [];
    foreach ($orden["productos"] as $prodInOrden) {
        if ($codigo === $prodInOrden["codigo"]) {
            $producto = $prodInOrden;
            $producto["cantidad"] += $cantidad;
            $producto["subtotal"] = $producto["cantidad"] * $producto["precio"];
            $newProductos[] = $producto;
            $isInOrder = true;
        } else {
            $newProductos[] = $prodInOrden;
        }
    }
    if (!$isInOrder) {
        $producto = obtenerProductoDeInventario($codigo, $store);
        $producto["cantidad"] = $cantidad;
        $producto["subtotal"] = $producto["cantidad"] * $producto["precio"];
        $orden["productos"][] = $producto;
    } else {
        $orden["productos"] = $newProductos;
    }
    $orden["total"] = 0;
    foreach ($orden["productos"] as $prodInOrden) {
        $orden["total"] += $prodInOrden["subtotal"];
    }
    actualizarOrden($orden, $store);
}

function quitarProductoAOrden($codigo, $cantidad, $numOrden, &$store)
{
    $orden = obtenerOrdenPorCodigo($numOrden, $store);
    $newProductos = [];
    foreach ($orden["productos"] as $prodInOrden) {
        if ($codigo === $prodInOrden["codigo"]) {
            $producto = $prodInOrden;
            $producto["cantidad"] -= $cantidad;
            $producto["subtotal"] = $producto["cantidad"] * $producto["precio"];
            if ($producto["cantidad"] != 0) {
                $newProductos[] = $producto;
            }
        } else {
            $newProductos[] = $prodInOrden;
        }
    }
    $orden["productos"] = $newProductos;
    $orden["total"] = 0;
    foreach ($orden["productos"] as $prodInOrden) {
        $orden["total"] += $prodInOrden["subtotal"];
    }
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

function ventaFallidaOrden($numOrden, &$store)
{
    $orden = obtenerOrdenPorCodigo($numOrden, $store);
    $orden["estado"] = "Cancelado";
    actualizarOrden($orden, $store);
    setNumOrdenActiva(null);
}
function finalizarOrden($numOrden, &$store)
{
    $orden = obtenerOrdenPorCodigo($numOrden, $store);
    $orden["estado"] = "Finalizado";
    foreach ($orden["productos"] as $prodInOrder) {
        $producto = obtenerProductoDeInventario($prodInOrder["codigo"], $store);
        $producto["stock"] -= $prodInOrder["cantidad"];
        actualizarProducto($producto, $store);
    }
    actualizarOrden($orden, $store);
    setNumOrdenActiva(null);
}
function postearOrden($numOrden, &$store)
{
    $orden = obtenerOrdenPorCodigo($numOrden, $store);
    $orden["estado"] = "Posteado";
    actualizarOrden($orden, $store);
}
