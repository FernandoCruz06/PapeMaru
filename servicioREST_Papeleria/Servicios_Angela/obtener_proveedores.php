<?php

header("Access-Control-Allow-Origin: *"); // Permite todas las solicitudes desde cualquier origen
header("Access-Control-Allow-Methods: GET"); // Permite solo solicitudes GET
header("Access-Control-Allow-Headers: Content-Type"); // Permite solo el encabezado Content-Type
require_once 'conexion.php'; // Incluir el archivo de conexión a la base de datos

$query = 'SELECT * FROM proveedores'; // Consulta para obtener todos los productos

$resultado = $mysql->query($query);

$products = array();

if ($resultado && $resultado->num_rows > 0) {
  while ($row = $resultado->fetch_assoc()) {
    // Agregar cada producto a un arreglo
    $product = array(
      'id' => $row['id'],
      'nombre' => $row['nombre']
      
    );
    $products[] = $product;
  }
}

// Devolver los productos en formato JSON
echo json_encode($products);
?>
