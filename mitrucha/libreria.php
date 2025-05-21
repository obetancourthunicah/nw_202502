<?php


// Puntero  apunta a un espacio en memoria
// mx000123 = abc
// mx000124 = hola
//  agregarAPersistencia ( "abc", "hola");

$truchaStore = [];

function agregarAPersistencia($key, $value, &$store, $autoSave = true)
{
    $store[$key] = $value;
    if ($autoSave) {
        saveToDisk($store);
    }
}
function obtenerDePersistencia($key, &$store)
{
    if (isset($store[$key])) {
        return $store[$key];
    }
    return null;
}

function saveToDisk(&$store)
{
    $fileToSave = fopen("truchaStore.json", "a");
    fwrite($fileToSave, json_encode($store, JSON_PRETTY_PRINT));
    fclose($fileToSave);
}

function loadFromDisk(&$store)
{
    if (file_exists("truchaStore.json")) {
        $fileToRead = fopen("truchaStore.json", "r");
        $jsonContent = fread($fileToRead, filesize("truchaStore.json"));
        $store = json_decode(($jsonContent), true);
    }
}

function iniciarCatalogo(&$store)
{
    $arrInventario = [
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
    agregarAPersistencia("inventario", $arrInventario, $store, false);
}

iniciarCatalogo($truchaStore);
loadFromDisk($truchaStore);
echo '<pre>' . json_encode($truchaStore, JSON_PRETTY_PRINT) . '</pre>';
