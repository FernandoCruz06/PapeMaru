<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'conexion.php';

    $email = $_POST["email"]; // Cambio de "nombre" a "email"
    $password = $_POST["password"];
    $rol = $_POST["rol"];

    $query = "INSERT INTO usuarios (email, password, rol) 
              VALUES ('$email', '$password', '$rol')"; // Cambio de "nombre" a "email"

    $resultado = $mysql->query($query);

    if ($resultado == true) {
        echo "El usuario se insertó de forma exitosa";
    } else {
        echo "Error al insertar el usuario";
    }
}

