<?php

namespace negocios\Controller\Productos\Decoradores;

use negocios\Controller\Productos\ProductoDecorador;

class ExtraHuevos extends ProductoDecorador
{
    public function __construct(float $precio)
    {
        parent::__construct($precio, 4, false);
    }
}
