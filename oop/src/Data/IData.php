<?php

namespace negocios\Data;

interface IData
{
    public function guardarDatos(array $datos): void;
    public function obtenerDatos(): array;
}
