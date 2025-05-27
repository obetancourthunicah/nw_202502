<?php

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
    $fileToSave = fopen("truchaStore.json", "w");
    fwrite($fileToSave, json_encode($store, JSON_PRETTY_PRINT));
    fclose($fileToSave);
}

function loadFromDisk(&$store)
{
    if (file_exists("truchaStore.json")) {
        $fileToRead = fopen("truchaStore.json", "r");
        $jsonContent = fread($fileToRead, filesize("truchaStore.json"));
        $store = json_decode(($jsonContent), true);
        return true;
    } else {
        return false;
    }
}
