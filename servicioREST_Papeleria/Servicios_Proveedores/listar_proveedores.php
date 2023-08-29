<?php
	include 'conexion.php';
	$pdo = new Conexion();
	
	$sql = $pdo->prepare("SELECT * FROM proveedores");
	$sql->execute();
	$sql->setFetchMode(PDO::FETCH_ASSOC);
	$proveedores = $sql->fetchAll();
	
	header("Content-Type: application/json");
	echo json_encode($proveedores);
	exit;
?>