<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Productos</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include '../navbar.php'; ?>
<div class="content">
  <h1>Productos</h1>
  <button id="addProductBtn">Agregar Producto</button>
  <table id="productTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Cantidad en Inventario</th>
        <th>Proveedor</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id="productList">
      <!-- Aquí se agregarán las filas de productos -->
    </tbody>
  </table>
  <div id="modal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2 id="modalTitle">Agregar Producto</h2>
      <form id="modalForm">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" required><br>
        <label for="cantidad_inventario">Cantidad en Inventario:</label>
        <input type="number" id="cantidad_inventario" name="cantidad_inventario" required><br>
        <label for="proveedor_id">Proveedor:</label>
        <select id="proveedor_id" name="proveedor_id" required>
          <option value="" disabled selected>Selecciona un proveedor</option>
        </select><br>
        <button type="submit" id="modalSubmitBtn">Agregar</button>
      </form>
    </div>
  </div>
</div>
<script src="script.js"></script>
</body>
</html>
