<?php

header("Access-Control-Allow-Origin: *"); // Permite todas las solicitudes desde cualquier origen
header("Access-Control-Allow-Methods: POST"); // Permite solo solicitudes POST
header("Access-Control-Allow-Headers: Content-Type"); // Permite solo el encabezado Content-Type

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'conexion.php'; // Mandar llamar la conexión a la base de datos

    // Obtener el ID del producto a eliminar
    $id = $_POST["id"];

    // Crear la consulta SQL para eliminar el producto

    //https:localhost/punto_venta_papeleria/servicio/eliminar.php
    $query = "DELETE FROM productos WHERE id = '$id'";

    // Ejecutar la consulta
    $resultado = $mysql->query($query);

    if ($resultado == true) {
        echo "El producto se eliminó de forma exitosa";
    } else {
        echo "Error al eliminar el producto";
    }
}
