<?php
require 'vendor/autoload.php'; // Carga la biblioteca FPDF

// Datos de conexión a la base de datos
$host = 'localhost';
$db = 'punto_venta_papeleria';
$user = 'root';
$pass = '';

// Conexión a la base de datos
try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Obtener el ID de la venta del formulario
$id_venta = isset($_POST['id_venta']) ? $_POST['id_venta'] : '';

if ($id_venta) {
    $sql = "SELECT * FROM ventas WHERE id = :id_venta";
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':id_venta', $id_venta);
    
    $stmt->execute();
    
    $venta = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$venta) {
        die("No se encontró la venta con el ID proporcionado.");
    }
    
    // Crear un nuevo documento PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    
    // Seteamos un color de fondo suave
    $pdf->SetFillColor(240, 240, 240);
    
    // Logo (reemplaza "logo.png" con la ruta de tu logo)
    $pdf->Image('logo.png', 10, 10, 50); // Aumenta el tercer parámetro para hacer el logo más grande
    
    // Espacio después del logo
    $pdf->Ln(30);
    
    // Título del reporte
    $pdf->SetFont('Arial', 'B', 18); // Aumentamos el tamaño de fuente
    $pdf->SetTextColor(0, 0, 0); // Color de texto negro
    
    // Sombreado de título (color gris claro)
    $pdf->SetFillColor(211, 211, 211); // Gris claro
    $pdf->Cell(0, 15, 'Reporte de Venta - Punto de Venta Papeleria', 0, 1, 'C', true);
    
    // Espacio después del título
    $pdf->Ln(15);
    
    // Detalles de la venta
    $pdf->SetFont('Arial', 'B', 14); // Aumentamos el tamaño de fuente
    $pdf->SetFillColor(255, 255, 255); // Blanco
    $pdf->SetTextColor(0, 0, 0); // Color de texto negro
    
    $pdf->Cell(50, 10, 'ID de Venta', 1, 0, 'C', true);
    $pdf->Cell(140, 10, $venta['id'], 1, 1, 'C', true);
    
    // Cambio de color de fondo a blanco para datos de ID de Venta
    $pdf->SetFillColor(255, 255, 255); // Blanco
    $pdf->Cell(50, 10, 'ID de Usuario', 1, 0, 'C', true);
    $pdf->Cell(140, 10, $venta['id_usuario'], 1, 1, 'C', true);
    
    $pdf->SetFillColor(255, 255, 255); // Blanco
    $pdf->Cell(50, 10, 'Fecha de Venta', 1, 0, 'C', true);
    $pdf->Cell(140, 10, $venta['fecha_venta'], 1, 1, 'C', true);
    
    $pdf->SetFillColor(206, 147, 216); // Morado claro
    $pdf->Cell(50, 10, 'Total', 1, 0, 'C', true);
    $pdf->Cell(140, 10, '$' . $venta['total_venta'], 1, 1, 'C', true);
    
    // Salida del PDF
    $pdf->Output();
} else {
    die("Por favor, introduzca el ID de la venta.");
}
?>
