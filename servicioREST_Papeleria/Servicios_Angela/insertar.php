<?php

header("Access-Control-Allow-Origin: *"); // Permite todas las solicitudes desde cualquier origen
header("Access-Control-Allow-Methods: POST"); // Permite solo solicitudes POST
header("Access-Control-Allow-Headers: Content-Type"); // Permite solo el encabezado Content-Type

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'conexion.php'; // Mandar llamar la conexión a la base de datos

    // Obtener los datos del POST
    $name = $_POST["nombre"];
    $price = $_POST["precio"];
    $inventory = $_POST["cantidad_inventario"];
    $supplierId = $_POST["proveedor_id"]; // Nuevo campo proveedor_id

    // Crear la consulta SQL para insertar el producto
    $query = "INSERT INTO productos (nombre, precio, cantidad_inventario, proveedor_id) 
              VALUES ('$name', '$price', '$inventory', '$supplierId')";

    // Ejecutar la consulta
    $resultado = $mysql->query($query);

    if ($resultado == true) {
        echo "El producto se insertó de forma exitosa";
    } else {
        echo "Error al insertar el producto";
    }
}
