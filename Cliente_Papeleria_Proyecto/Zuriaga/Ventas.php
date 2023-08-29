<?php
$host = 'localhost';
$usuario = 'root';
$contraseña = '';
$baseDeDatos = 'punto_venta_papeleria';

$con = mysqli_connect($host, $usuario, $contraseña, $baseDeDatos);

if (mysqli_connect_errno()) {
    echo "Error al conectar a la base de datos: " . mysqli_connect_error();
    exit();
}

if (isset($_POST['generar_venta'])) {
    $productoId = $_POST['producto'];
    $cantidad = $_POST['cantidad'];

    // Validar que se haya seleccionado un producto y una cantidad
    if (!empty($productoId) && !empty($cantidad)) {
        // Obtener la información del producto de la base de datos por su ID
        $query = "SELECT * FROM productos WHERE id = $productoId";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $productoNombre = $row['nombre'];
            $precio = $row['precio'];
            $cantidadInventario = $row['cantidad_inventario'];

            if ($cantidad <= $cantidadInventario) {
                $subtotal = $precio * $cantidad;

                // Insertar los datos en la tabla ventas
                $fechaVenta = date('Y-m-d'); // Fecha actual
                $query = "INSERT INTO ventas (id_usuario, fecha_venta, total_venta) VALUES (1,'$fechaVenta', $subtotal)";
                mysqli_query($con, $query);

                // Obtener el ID de la última venta insertada
                $idVenta = mysqli_insert_id($con);

                // Actualizar la cantidad_inventario en la tabla productos
                $nuevaCantidadInventario = $cantidadInventario - $cantidad;
                $query = "UPDATE productos SET cantidad_inventario = $nuevaCantidadInventario WHERE id = $productoId";
                mysqli_query($con, $query);

                // Insertar los detalles de la venta en la tabla detalles_ventas
                $query = "INSERT INTO detalles_ventas (id_venta, id_producto, cantidad_vendida, precio_unitario) VALUES ($idVenta, $productoId, $cantidad, $precio)";
                mysqli_query($con, $query);

                header('Location: Ventas.php');
                exit();
            } else {
                $error = "No hay suficiente cantidad en el inventario para la venta.";
            }
        } else {
            $error = "El producto seleccionado no existe.";
        }
    } else {
        $error = "Debes seleccionar un producto y especificar una cantidad.";
    }
}

$query = "SELECT id, nombre, precio, cantidad_inventario FROM productos";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página de Ventas</title>
    <link rel="stylesheet" type="text/css" href="styles.css"> <!-- Enlaza el archivo de estilos CSS -->
</head>
<body>
<?php include '../navbar.php'; ?>
<div class="content">
    <h1>Página de Ventas</h1>

    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="producto">Producto:</label>
        <select name="producto" id="producto" required>
            <option value="">Selecciona un producto</option>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" min="1" value="1" required>

        <input type="submit" name="generar_venta" value="Generar Venta">
    </form>

    <h2>Tabla de Ventas</h2>
    <table>
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Fecha Venta</th>
                <th>Total Venta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM ventas";
            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['fecha_venta'] . "</td>";
                echo "<td>" . $row['total_venta'] . "</td>";
                echo "<td>";
                echo '<button onclick="eliminarVenta(' . $row['id'] . ')">Eliminar</button>';
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        function eliminarVenta(id) {
            if (confirm("¿Estás seguro de eliminar la venta con ID " + id + "?")) {
                window.location.href = "eliminar_venta.php?id=" + id;
            }
        }
    </script>
    </div>

</body>
</html>
