<?php

namespace negocios\Data;

use Exception;

class SessionData implements IData
{
    private string $sessionKey;
    public function __construct(string $sessionKey)
    {
        if (!isset($_SESSION)) {
            throw new Exception("Session must but initialized with session_start()");
        }
        $this->sessionKey = $sessionKey;
    }

    public function obtenerDatos(): array
    {
        if (isset($_SESSION[$this->sessionKey])) {
            return $_SESSION[$this->sessionKey];
        }
        return [];
    }
    public function guardarDatos(array $datos): void
    {
        $_SESSION[$this->sessionKey] = $datos;
    }
}
