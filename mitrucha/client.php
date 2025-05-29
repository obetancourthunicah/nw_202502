<?php
require_once "lib/libreria.php";
$catalogo = obtenerInventario($truchaStore);
$numOrdenActiva = obtenerNumOrdenActiva();
$orden = null;

if ($numOrdenActiva) {
    $orden = obtenerOrdenPorCodigo($numOrdenActiva, $truchaStore);
}

if (isset($_POST["btnNuevaOrden"])) {
    $nombre = $_POST["nombre"];
    $orden = crearOrden($nombre, $truchaStore);
    setNumOrdenActiva($orden["codigo"]);
    $numOrdenActiva = $orden["codigo"];
}
if (isset($_POST["btnAddProduct"])) {
    $producto = $_POST["codigo"];
    if ($_POST["numorden"] === $numOrdenActiva) {
        agregarProductoAOrden($producto, 1, $numOrdenActiva, $truchaStore);
    }
    $orden = obtenerOrdenPorCodigo($numOrdenActiva, $truchaStore);
}
if (isset($_POST["btnRemoveProduct"])) {
    $producto = $_POST["codigo"];
    if ($_POST["numorden"] === $numOrdenActiva) {
        quitarProductoAOrden($producto, 1, $numOrdenActiva, $truchaStore);
    }
    $orden = obtenerOrdenPorCodigo($numOrdenActiva, $truchaStore);
}
if (isset($_POST["btnEnviar"])) {
    postearOrden($numOrdenActiva, $truchaStore);
    $orden = obtenerOrdenPorCodigo($numOrdenActiva, $truchaStore);
}

if (isset($_POST["btnCancelar"])) {
    ventaFallidaOrden($numOrdenActiva, $truchaStore);
    $orden = null;
    $numOrdenActiva = null;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Trucha New Order</title>
    <link rel="stylesheet" href="assets/style.css" />
</head>

<body>
    <header>
        <div>
            <h1>La Trucha New Order</h1>
        </div>
        <nav>
            <ul>
                <li>
                    <a href="truchero.php">Truchero</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <?php
            if ($numOrdenActiva) {
                if ($orden["estado"] === "Posteado") {
            ?>
                    <div class="orden">
                        <table>
                            <thead>
                                <tr>
                                    <th>Cod </th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($orden) {
                                    foreach ($orden["productos"] as $producto) { ?>
                                        <tr>
                                            <td><?php echo $producto["codigo"]; ?></td>
                                            <td><?php echo $producto["descripcion"]; ?></td>
                                            <td class="right"><?php echo $producto["cantidad"]; ?></td>

                                            <td class="right">
                                                <?php echo ($producto["subtotal"]); ?>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="right">Total: </td>
                                    <td class="right"><?php if ($orden) {
                                                            echo $orden["total"];
                                                        } ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                <?php   } else {
                ?>

                    <div class="productos">
                        <table>
                            <thead>
                                <tr>
                                    <th>Cod</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($catalogo as $producto) { ?>
                                    <tr>
                                        <td><?php echo $producto["codigo"]; ?></td>
                                        <td><?php echo $producto["descripcion"]; ?></td>
                                        <td class="right"><?php echo $producto["precio"]; ?></td>
                                        <td class="center">
                                            <form action="client.php" method="post">
                                                <input type="hidden" value="<?php echo $producto["codigo"]; ?>" name="codigo" />
                                                <input type="hidden" value="<?php echo $numOrdenActiva; ?>" name="numorden" />
                                                <button type="submit" name="btnAddProduct">+</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="orden">
                        <table>
                            <thead>
                                <tr>
                                    <th>Cod </th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>&nbsp;</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($orden) {
                                    foreach ($orden["productos"] as $producto) { ?>
                                        <tr>
                                            <td><?php echo $producto["codigo"]; ?></td>
                                            <td><?php echo $producto["descripcion"]; ?></td>
                                            <td class="right"><?php echo $producto["cantidad"]; ?></td>
                                            <td class="center">
                                                <form action="client.php" method="post">
                                                    <input type="hidden"
                                                        value="<?php echo $producto["codigo"]; ?>"
                                                        name="codigo" />
                                                    <input type="hidden" value="<?php echo $numOrdenActiva; ?>" name="numorden" />
                                                    <button type="submit"
                                                        name="btnAddProduct">+</button>
                                                    &nbsp;
                                                    <button type="submit"
                                                        name="btnRemoveProduct">-</button>
                                                </form>
                                            </td>
                                            <td class="right">
                                                <?php echo ($producto["subtotal"]); ?>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="right">Total: </td>
                                    <td class="right"><?php if ($orden) {
                                                            echo $orden["total"];
                                                        } ?></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="right">
                                        <form action="client.php"
                                            method="post">
                                            <input type="hidden"
                                                name="orderID"
                                                value="order_id" />
                                            <button type="submit" name="btnEnviar">
                                                Enviar
                                            </button>
                                            &nbsp;
                                            <button type="submit" name="btnCancelar">
                                                Cancelar
                                            </button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php }
            } else { // if $numOrdenActiva 
                ?>
                <form action="client.php" method="post">
                    <label for="nombre">Nombre de Cliente</label>
                    <input type="text" name="nombre" id="nombre" placehold="Nombre del Cliente" />
                    <br />
                    <button type="submit" name="btnNuevaOrden">Iniciar Orden</button>
                </form>
            <?php }  // if $numOrdenActiva
            ?>
        </section>
    </main>
    <footer>

    </footer>
</body>

</html>