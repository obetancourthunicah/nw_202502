<?php
$intOperando1 = 0;
$intOperando2 = 0;
$resultado = 0;
$txtOperador = "";

if (isset($_POST["btnAdd"])) {
    $txtOperador = "ADD";
} elseif (isset($_POST["btnSub"])) {
    $txtOperador = "SUB";
} elseif (isset($_POST["btnMul"])) {
    $txtOperador = "MUL";
} elseif (isset($_POST["btnDiv"])) {
    $txtOperador = "DIV";
} else {
    $txtOperador = "";
}

// dif ==  ===
// igualdad de valores
// igualdad de tipo y valor
// 1 == "1"  =>  verdadero
// 1 === "1"   => falso
// 1 != "1"  =>  falso
// 1 !== "1"   => verdadero

if ($txtOperador !== "") {
    $intOperando1 = intval($_POST["intOperando1"]);
    $intOperando2 = intval($_POST["intOperando2"]);
    switch ($txtOperador) {
        case "ADD":
            $resultado = "La suma de " . $intOperando1 . " y " . $intOperando2 . " es " . ($intOperando1 + $intOperando2);
            break;
        case "SUB":
            $resultado = "La resta de " . $intOperando1 . " y " . $intOperando2 . " es " . ($intOperando1 - $intOperando2);
            break;
        case "MUL":
            $resultado = "La multiplicación de " . $intOperando1 . " y " . $intOperando2 . " es " . ($intOperando1 * $intOperando2);
            break;
        case "DIV":
            if ($intOperando2 !== 0) {
                $resultado = "La divición de " . $intOperando1 . " y " . $intOperando2 . " es " . ($intOperando1 / $intOperando2);
            } else {
                $resultado = "No se puede dividir por 0";
            }
            break;
        default:
            $resultado = "Este mensaje nunca debe suceder";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>

<body>
    <h1>Calculadora</h1>

    <form action="calculadora.php" method="post">
        <div>
            <label for="intOperando1">Operando 1:</label>
            <input
                type="number"
                name="intOperando1"
                id="intOperando1"
                value="<?php echo $intOperando1; ?>" />
        </div>
        <div>
            <label for="intOperando2">Operando 2:</label>
            <input
                type="number"
                name="intOperando2"
                id="intOperando2"
                value="<?php echo $intOperando2; ?>" />
        </div>
        <div>
            <button type="submit" name="btnAdd" value="add">Sumar</button>
            &nbsp;
            <button type="submit" name="btnSub" value="sub">Resta</button>
            &nbsp;
            <button type="submit" name="btnMul" value="mul">Multiplicación</button>
            &nbsp;
            <button type="submit" name="btnDiv" value="div">División</button>
        </div>
        <footer>Copy &copy; 2025</footer>
    </form>
    <section>
        <?php if ($resultado) {
            echo $resultado;
        }
        echo "<ol>";
        for ($i = 0; $i < 100; $i++) {
            echo '<li class="">Iterando ' . $i . '</li>';
        }
        echo "</ol>";
        $i = 0;
        while ($i < 100) {
            echo '<div>Iterando while ' . $i . '</div>';
            $i++;
        }

        $i = 101;
        do {
            echo '<div>Iterando do while ' . $i . '</div>';
            $i++;
        } while ($i < 100)
        ?>
    </section>

</body>

</html>