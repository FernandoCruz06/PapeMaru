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

if (isset($_GET['id'])) {
    $ventaId = $_GET['id'];

    // Obtener los detalles de la venta antes de eliminarla
    $detallesQuery = "SELECT id_producto, cantidad_vendida FROM detalles_ventas WHERE id_venta = $ventaId";
    $detallesResult = mysqli_query($con, $detallesQuery);

    // Eliminar los registros de detalles_ventas y la venta
    $queryEliminarDetalles = "DELETE FROM detalles_ventas WHERE id_venta = $ventaId";
    $resultEliminarDetalles = mysqli_query($con, $queryEliminarDetalles);

    if ($resultEliminarDetalles) {
        // Luego, eliminar la venta en la tabla ventas
        $queryEliminarVenta = "DELETE FROM ventas WHERE id = $ventaId";
        $resultEliminarVenta = mysqli_query($con, $queryEliminarVenta);

        if ($resultEliminarVenta) {
            while ($detalle = mysqli_fetch_assoc($detallesResult)) {
                $productoId = $detalle['id_producto'];
                $cantidadVendida = $detalle['cantidad_vendida'];

                // Actualizar la cantidad_inventario en la tabla productos
                $queryActualizarInventario = "UPDATE productos SET cantidad_inventario = cantidad_inventario + $cantidadVendida WHERE id = $productoId";
                mysqli_query($con, $queryActualizarInventario);
            }

            header('Location: Ventas.php');
            exit();
        } else {
            echo "Error al eliminar la venta.";
        }
    } else {
        echo "Error al eliminar los detalles de la venta.";
    }
} else {
    echo "ID de venta no especificado.";
}
?>
