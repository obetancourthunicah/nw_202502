<?php

$arrColores = array();

print_r($arrColores);
echo '<hr/>';

$arrColores = [1, 2, 3, 4, 5];
print_r($arrColores);
echo '<hr/>';


$arrColores = [1, 2, 3, "Rojo", "blue", "#fff", true];
print_r($arrColores);
echo '<hr/>';

$arrColores = ["Rojo", "Verde", 255, [255, 255, 255, [1, 2, 3, 4, [3, 4, 5, 6]]], "#fff"];
print_r($arrColores);
echo '<hr/>';
echo $arrColores[3][3][4][2];
echo '<hr/>';

$arrPseudoMatriz = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

echo $arrPseudoMatriz[2][2];


/* $symbolo[llave {numerico | texto}] */
// $arreglo ordinales
// $arreglo asociativos
echo '<hr/>';

$arrOrdinalNoOrdinal = array();
$arrOrdinalNoOrdinal[] = 2;

print_r($arrOrdinalNoOrdinal);
echo '<hr/>';

$arrOrdinalNoOrdinal[10] = 45;
print_r($arrOrdinalNoOrdinal);
echo '<hr/>';


$arrOrdinalNoOrdinal[] = 55;
print_r($arrOrdinalNoOrdinal);
echo '<hr/>';

echo $arrOrdinalNoOrdinal[7];
echo '<hr/>';


$arrAsociativoEj = [
    [
        "nombre" => "Orlando",
        "correo" => "obetancourthunicah@gmail.com",
        "telefono" => "123123123",
        "curso" => "Negocios Web"
    ],
    [
        "nombre" => "Jose",
        "correo" => "obetancourthunicah@gmail.com",
        "telefono" => "431234123",
        "curso" => "Portales Web 1"
    ],
    [
        "nombre" => "Marco",
        "correo" => "obetancourthunicah@gmail.com",
        "telefono" => "1029384756",
        "curso" => "Portales Web 2"
    ],
];

print_r($arrAsociativoEj);
echo '<hr/>';

echo "<table>";
foreach ($arrAsociativoEj as $curso) {
    echo "<tr>" .
        "<td>" . $curso["nombre"] . "</td>" .
        "<td>" . $curso["correo"] . "</td>" .
        "<td>" . $curso["telefono"] . "</td>" .
        "<td>" . $curso["curso"] . "</td>" .
        "</tr>";
}
echo "</table>";

echo '<hr/>';

echo "<table border=\"1\">";
foreach ($arrAsociativoEj as $curso) {
    echo "<tr>";
    foreach ($curso as $llave => $valor) {
        echo "<td>" . $llave . " | " . $valor  . "</td>";
    }
    echo  "</tr>";
}
echo "</table>";
