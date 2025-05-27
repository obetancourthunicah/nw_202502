<?php

require_once "data.php";
require_once "productos.php";
require_once "ordenes.php";

$truchaStore = [];
if (!loadFromDisk($truchaStore)) {
    $inventarioInicial = iniciarCatalogo($truchaStore);
    agregarAPersistencia("inventario", $inventarioInicial, $truchaStore);
};
