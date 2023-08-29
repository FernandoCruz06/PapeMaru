<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibieron los datos de email y password
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
    } else {
        // Intentar obtener los datos del cuerpo JSON en caso de que se haya enviado como JSON
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);

        if (isset($data['email']) && isset($data['password'])) {
            $email = $data['email'];
            $password = $data['password'];
        } else {
            // No se recibieron los datos esperados
            $response = ["error" => "Datos incompletos"];

            // Devolver la respuesta en formato JSON
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }

    // Realizar la validación en la base de datos
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "punto_venta_papeleria";

    // Conectarse a la base de datos
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Verificar si la conexión fue exitosa
    if ($conn->connect_error) {
        die(json_encode(["error" => "Error de conexión"]));
    }

    // Escapar los datos para prevenir inyección de SQL
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // Consultar la base de datos para verificar las credenciales
    $query = "SELECT id, rol FROM usuarios WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Credenciales válidas, el usuario existe en la base de datos
        $row = $result->fetch_assoc();
        $user_id = $row['id']; // Obtener el ID del usuario
        $rol = $row['rol']; // Obtener el rol del usuario

        $response = [
            "message" => "Ingreso correctamente",
            "user_id" => $user_id,
            "rol" => $rol
        ];
    } else {
        // Credenciales inválidas, el usuario no existe o la contraseña es incorrecta
        $error = "Credenciales incorrectas";
        header("Location: ../../Cliente_Papeleria_Proyecto/login.php?error=" . urlencode($error));
        exit;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();

    // Devolver la respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Método no permitido
    http_response_code(405);
    $response = ["error" => "Método no permitido"];

    // Devolver la respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}


// Redireccionar al usuario a la página de inicio
header("Location: ../../Cliente_Papeleria_Proyecto/index.php"); // Ajusta la ruta si es necesario
exit();


?>