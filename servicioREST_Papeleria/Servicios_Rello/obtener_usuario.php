<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
require_once 'conexion.php';

if (isset($_GET['id'])) {
  $userId = $_GET['id'];
  
  $query = "SELECT * FROM usuarios WHERE id = $userId";

  $resultado = $mysql->query($query);

  $user = array();

  if ($resultado && $resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $user = array(
      'id' => $row['id'],
      'email' => $row['email'],
      'password' => $row['password'],
      'rol' => $row['rol']
    );
  }

  echo json_encode($user);
} else {
  echo json_encode(array('message' => 'No se proporcionó un ID de usuario.'));
}
?>
