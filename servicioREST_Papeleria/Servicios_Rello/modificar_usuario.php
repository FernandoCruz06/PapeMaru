<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'conexion.php';

    $id = $_POST["id"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $rol = $_POST["rol"];

    $query = "UPDATE usuarios 
          SET email = '$email', password = '$password', rol = '$rol' 
          WHERE id = '$id'";

    $resultado = $mysql->query($query);

    if ($resultado == true) {
        echo "El usuario se modificó de forma exitosa";
    } else {
        echo "Error al modificar el usuario";
    }
}
