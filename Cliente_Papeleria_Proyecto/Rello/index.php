<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuarios</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include '../navbar.php'; ?>
<div class="content">
  <h1>Usuarios</h1>
  <button id="addUserBtn">Agregar Usuario</button>
  <table id="userTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Correo</th>
        <th>Password</th>
        <th>Rol</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id="userList">
      <!-- Aquí se agregarán las filas de usuarios -->
    </tbody>
  </table>
 <!-- Modal para agregar/editar usuario -->
<div id="modal" class="modal">
    <div class="modal-content">
      <span class="close" id="modalCloseBtn">&times;</span>
      <h2 id="modalTitle">Agregar Usuario</h2>
      <form id="modalForm">
        <input type="hidden" id="id" name="id">
        <label for="email">Email:</label>
<input type="text" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="rol">Rol:</label>
        <input type="text" id="rol" name="rol" required><br>
        <button type="button" id="modalSubmitBtn">Agregar</button>
      </form>
    </div>
  </div>
</div>
  
  <script src="script.js"></script>
</body>
</html>
