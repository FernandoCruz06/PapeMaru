<?php

$mysql = new mysqli("localhost", "root", "", "punto_venta_papeleria");

if ($mysql->connect_error) {
    die("Error de conexión a la base de datos: " . $mysql->connect_error);
}
