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

    // Obtener los detalles de la venta a modificar
    $query = "SELECT * FROM ventas WHERE id = $ventaId";
    $result = mysqli_query($con, $query);
    $venta = mysqli_fetch_assoc($result);

    if (!$venta) {
        echo "La venta no existe.";
        exit();
    }
} else {
    echo "ID de venta no especificado.";
    exit();
}

if (isset($_POST['modificar_venta'])) {
    // Recoger los datos del formulario
    $nuevaFecha = $_POST['nueva_fecha'];
    $nuevoTotal = $_POST['nuevo_total'];

    // Actualizar los datos en la base de datos
    $query = "UPDATE ventas SET fecha_venta = '$nuevaFecha', total_venta = $nuevoTotal WHERE id = $ventaId";
    $result = mysqli_query($con, $query);

    if ($result) {
        header('Location: Ventas.php');
        exit();
    } else {
        echo "Error al modificar la venta.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Venta</title>
</head>
<body>
    <h1>Modificar Venta</h1>
    <form method="post" action="">
        <label for="nueva_fecha">Nueva Fecha:</label>
        <input type="date" name="nueva_fecha" value="<?php echo $venta['fecha_venta']; ?>" required>

        <label for="nuevo_total">Nuevo Total:</label>
        <input type="number" name="nuevo_total" value="<?php echo $venta['total_venta']; ?>" required>

        <input type="submit" name="modificar_venta" value="Modificar Venta">
    </form>
</body>
</html>
