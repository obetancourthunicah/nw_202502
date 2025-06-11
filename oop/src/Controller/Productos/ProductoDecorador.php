<?php

namespace negocios\Controller\Productos;

abstract class ProductoDecorador
{
    protected float $factor;
    protected int $operador;
    protected bool $useRoot;

    public function __construct(float $factor, int $operador, bool $useRoot = false)
    {
        $this->factor = $factor;
        $this->operador = $operador;
        $this->useRoot = $useRoot;
    }

    public function calcularPrecio(float $rootPrice, float $currentPrice)
    {

        switch ($this->operador) {
            case 1: // Multiplicador Replace
                return $this->factor * ($this->useRoot ? $rootPrice : $currentPrice);
            case 2: // Adicion Replace
                return $this->factor + ($this->useRoot ? $rootPrice : $currentPrice);
            case 3: //Acumulate Percentage
                return $currentPrice + ($this->factor * ($this->useRoot ? $rootPrice : $currentPrice));
            case 4: //Acumulate Factor
                return $currentPrice + ($this->factor);
            default:
                return $currentPrice;
        }
    }
}
