<?php
require_once "lib/libreria.php";
$catalogo = obtenerCatalogo($truchaStore);
$orden = null;


/*
        include
        include_once
        require
        require_once
    */

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
                                            <button type="submit"
                                                name="btnAddProduct">+</button>
                                            &nbsp;
                                            <button type="submit"
                                                name="btnRemoveProduct">-</button>
                                        </form>
                                    </td>
                                    <td class="right">
                                        <?php echo ($producto["cantidad"] * $producto["precio"]); ?>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="right">Total: </td>
                            <td class="right"></td>
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
        </section>
    </main>
    <footer>

    </footer>
</body>

</html>