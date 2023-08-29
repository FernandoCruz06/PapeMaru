<?php
	include 'conexion.php';
	$pdo = new Conexion();

	$data = json_decode(file_get_contents("php://input"), true);
	$id = $data['id'];
	$nombre = $data['nombre'];
	$telefono = $data['telefono'];
	$email = $data['email'];

	$sql = "UPDATE proveedores SET nombre=:nombre, telefono=:telefono, email=:email WHERE id=:id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':nombre', $nombre);
	$stmt->bindValue(':telefono', $telefono);
	$stmt->bindValue(':email', $email);
	$stmt->bindValue(':id', $id);
	$stmt->execute();

	header("Content-Type: application/json");
	echo json_encode("Contacto editado con éxito");
	exit;
?>