<?php
function iniciarCatalogo()
{
    return [
        [
            "codigo" => "P001",
            "descripcion" => "Huevos",
            "precio" => 3,
            "stock" => 150
        ],
        [
            "codigo" => "P002",
            "descripcion" => "Platanos",
            "precio" => 12,
            "stock" => 100
        ],
        [
            "codigo" => "P003",
            "descripcion" => "Coca Cola 2 Lts",
            "precio" => 54,
            "stock" => 20
        ],
        [
            "codigo" => "P004",
            "descripcion" => "Frijoles Fritos Naturas 12oz",
            "precio" => 35,
            "stock" => 100
        ]
    ];
}


function obtenerInventario(&$store)
{
    $catalogo = obtenerDePersistencia("inventario", $store);
    if ($catalogo === null) {
        $catalogo = iniciarCatalogo();
        agregarAPersistencia("inventario", $catalogo, $store);
    }
    return $catalogo;
}

function obtenerProductoDeInventario($cod, &$store)
{
    $productos = obtenerInventario($store);
    foreach ($productos as $producto) {
        if ($producto["codigo"] === $cod) {
            return $producto;
        }
    }
    return null;
}

function actualizarProducto($producto, &$store)
{
    $productos = obtenerInventario($store);
    $newProductos = [];
    foreach ($productos as $prod) {
        if ($prod["codigo"] === $producto["codigo"]) {
            $newProductos[] = $producto;
        } else {
            $newProductos[] = $prod;
        }
    }
    agregarAPersistencia("inventario", $newProductos, $store);
}
