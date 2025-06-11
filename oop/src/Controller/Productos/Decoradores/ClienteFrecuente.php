<?php

namespace negocios\Controller\Productos\Decoradores;

use negocios\Controller\Productos\ProductoDecorador;

class ClienteFrecuente extends ProductoDecorador
{
    public function __construct(float $descuento)
    {
        if (!($descuento > 0 && $descuento <= 100)) {
            throw new \Exception("Descuento debe tener un valor mayor a 0 o menor e igual a 100!");
        }
        parent::__construct($descuento / 100 * -1, 3, true);
    }
}
