<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
require_once 'conexion.php';

$query = 'SELECT * FROM usuarios';

$resultado = $mysql->query($query);

$users = array();

if ($resultado && $resultado->num_rows > 0) {
  while ($row = $resultado->fetch_assoc()) {
    $user = array(
      'id' => $row['id'],
      'email' => $row['email'],
      'password' => $row['password'],
      'rol' => $row['rol']
    );
    $users[] = $user;
  }
}

echo json_encode($users);
?>
