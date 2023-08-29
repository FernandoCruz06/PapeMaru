<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Inicio sesión</title>

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<div class="form-container">

   <form action="http://localhost/servicioREST_Papeleria/Servicio_login/login.php" method="post"> <!-- Ajusta la ruta del formulario -->
      <h3>Inicio sesión</h3>
      <?php
      if(isset($_GET['error'])){
         $error = $_GET['error'];
         echo '<span class="error-msg">'.$error.'</span>';
      }
      ?>
      <input type="email" name="email" required placeholder="Ingresa tu correo">
      <input type="password" name="password" required placeholder="Ingresa tu contraseña">
      <input type="submit" name="submit" value="Iniciar sesión" class="form-btn">
   </form>

</div>

</body>
</html>