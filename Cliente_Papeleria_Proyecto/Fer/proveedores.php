<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Proveedores</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <?php include '../navbar.php'; ?>

    <div class="content">
        <h1>Proveedores</h1>

        <!-- Formulario para agregar proveedores -->
        <div class="formulario-agregar">
            <h2>Agregar Proveedor</h2>
            <form id="formularioProveedor">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" required>

                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" required>

                <label for="email">Email:</label>
                <input type="email" id="email" required>

                <input type="submit" value="Guardar">
            </form>
        </div>

        <table id="tablaContactos">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </table>
    </div>

    <script src="script.js"></script> <!-- Agregado enlace al archivo script.js -->
    
</body>
</html>
