<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar reporte de venta Papelería</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <?php include '../navbar.php'; ?>
    <div class="content">
        <h1>Generar reporte de venta Papelería</h1>
        
        <form action="generar_reporte.php" method="post" class="simple-form">
            <label for="id_venta">ID de Venta:</label>
            <input type="number" name="id_venta" required>
            
            <input type="submit" value="Generar Reporte">
        </form>
    </div>
</body>
</html>
