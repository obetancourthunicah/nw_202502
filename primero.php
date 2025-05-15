<?php

// Declarar variables
$txtNombre = "";
$txtEmail = "";
$txtMessage = "";
if (isset($_POST["btnProcesar"])) {
    $txtEmail = $_POST["txtEmail"];
    $txtNombre = $_POST["txtNombre"];
    $txtMessage = "Hola " . $txtNombre . ", tu correo es " . $txtEmail;
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Script de PHP</title>
</head>

<body>
    <h1>Captura de Datos</h1>
    <form action="primero.php" method="post">
        <div>
            <label for="txtNombre">Nombre Completo:</label>
            <input type="text" name="txtNombre" id="txtNombre"
                placeholder="ej. John Doe"
                value="<?php echo $txtNombre; ?>" />
        </div>
        <div>
            <label for="txtEmail">Correo:</label>
            <input type="email" name="txtEmail" id="txtEmail"
                placeholder="ej. john.doe@email.com"
                value="<?php echo $txtEmail; ?>" />
        </div>
        <div>
            <button type="submit" name="btnProcesar" value="Procesar">Procesar</button>
        </div>
    </form>
    <?php if ($txtMessage != "") { ?>
        <section>
            <?php echo $txtMessage; ?>
        </section>
    <?php } ?>
</body>

</html>