<?php

namespace negocios\Data;

class JsonData implements IData
{
    private string $filePath;
    private array $data;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        $this->cargarArchivo();
    }
    private function cargarArchivo()
    {
        $this->data = [];
        if (file_exists($this->filePath)) {
            $file = fopen($this->filePath, "r");
            $content = fread($file, filesize($this->filePath));
            $this->data = json_decode($content, true);
            fclose($file);
        }
        return $this->data;
    }

    public function guardarDatos(array $datos): void
    {
        $file = fopen($this->filePath, "w");
        fwrite($file, json_encode($datos, JSON_PRETTY_PRINT));
        $this->data = $datos;
        fclose($file);
    }
    public function obtenerDatos(): array
    {
        return $this->data;
    }
}
