<?php

namespace negocios\Controller\Productos;

class ProductoPersonalizado
{
    private array $decorators;
    private Producto $producto;

    public function __construct(Producto $producto)
    {
        $this->producto = $producto;
        $this->decorators = [];
    }

    public function addDecorator(ProductoDecorador $decorador)
    {
        $this->decorators[] = $decorador;
    }

    public function getPrice()
    {
        $precio = $this->producto->Precio;
        foreach ($this->decorators as $decorador) {
            $precio = $decorador->calcularPrecio($this->producto->Precio, $precio);
        }
        return $precio;
    }
}
