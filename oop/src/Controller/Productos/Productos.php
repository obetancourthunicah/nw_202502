<?php

namespace negocios\Controller\Productos;

use negocios\Data\IData;

class Productos
{
    private IData $datastore;

    public function __construct(IData $dataStore)
    {
        $this->datastore = $dataStore;
    }

    public function addProducto(Producto $nuevoProducto)
    {
        $datos = $this->datastore->obtenerDatos();
        $datos[] = $nuevoProducto;
        $this->datastore->guardarDatos($datos);
    }
}
