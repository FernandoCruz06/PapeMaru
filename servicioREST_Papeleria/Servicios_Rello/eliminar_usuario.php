<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'conexion.php';

    $id = $_POST["id"];

    $query = "DELETE FROM usuarios WHERE id = '$id'";

    $resultado = $mysql->query($query);

    if ($resultado == true) {
        echo "El usuario se eliminó de forma exitosa";
    } else {
        echo "Error al eliminar el usuario";
    }
}
