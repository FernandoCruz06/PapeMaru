<?php
header("Access-Control-Allow-Origin: *"); // Permite todas las solicitudes desde cualquier origen
header("Access-Control-Allow-Methods: GET"); // Permite solo solicitudes GET
header("Access-Control-Allow-Headers: Content-Type"); // Permite solo el encabezado Content-Type
require_once 'conexion.php'; // Incluir el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Obtener el ID del producto de la consulta GET
    $productId = $_GET["id"];

    // Crear la consulta SQL para obtener los detalles del producto
    $query = "SELECT * FROM productos WHERE id = '$productId'";

    $resultado = $mysql->query($query);

    if ($resultado && $resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $product = array(
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'precio' => $row['precio'],
            'cantidad_inventario' => $row['cantidad_inventario'],
            'proveedor' => $row['proveedor_id']
        );
        echo json_encode($product);
    } else {
        echo json_encode(array("message" => "Producto no encontrado"));
    }
}
?>
