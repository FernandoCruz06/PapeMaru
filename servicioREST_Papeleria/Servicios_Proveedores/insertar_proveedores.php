<?php

header("Access-Control-Allow-Origin: *"); // Permite todas las solicitudes desde cualquier origen

	include 'conexion.php';
	$pdo = new Conexion();

	$data = json_decode(file_get_contents("php://input"), true);
	$nombre = $data['nombre'];
	$telefono = $data['telefono'];
	$email = $data['email'];

	$sql = "INSERT INTO proveedores (nombre, telefono, email) VALUES (:nombre, :telefono, :email)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':nombre', $nombre);
	$stmt->bindValue(':telefono', $telefono);
	$stmt->bindValue(':email', $email);
	$stmt->execute();
	$idPost = $pdo->lastInsertId(); 

	header("Content-Type: application/json");
	if ($idPost) {
		echo json_encode("Contacto insertado con éxito");
	} else {
		header("HTTP/1.1 400 Bad Request");
		echo json_encode("Error al insertar el contacto");
	}
	exit;
?>