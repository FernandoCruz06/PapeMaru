<!DOCTYPE html>
<html>

<head>
    <title>Menú de Navegación</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="content">
        <h1 class="center">Página de Inicio</h1>
        <p class="center">Bienvenido a la página de inicio.</p>
        <div class="center">
            <a href="Zuriaga/ventas.php"><button class="large-button ventas">Ventas</button></a>
            <a href="ReportesPDF/index.php"><button class="large-button inventario">Reporte de ventas</button></a>
            <a href="Angela/index.php"><button class="large-button proveedores">Inventario</button></a>
            <a href="Fer/proveedores.php"><button class="large-button ventas">Proveedores</button></a>
            <a href="Rello/index.php"><button class="large-button inventario">Usuarios</button></a>
        </div>

    </div>
</body>

</html>