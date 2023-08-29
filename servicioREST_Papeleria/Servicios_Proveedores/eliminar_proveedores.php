<?php
	include 'conexion.php';
	$pdo = new Conexion();

	$id = $_GET['id'];

	$sql = "DELETE FROM proveedores WHERE id=:id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':id', $id);
	$stmt->execute();

	header("Content-Type: application/json");
	echo json_encode("Contacto eliminado con éxito");
	exit;
?>