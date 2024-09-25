<?php
session_start();
require_once '../config/db_connection.php';
include_once '../class/User.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = new User($conn);

    // Obtener datos del formulario
    $id = $_POST["id"];
    $email = $_POST["email"];
    $pass = $_POST["pass"]; 

    // Intentar iniciar sesión
    $loginResult = $user->login($id, $email, $pass); 

    // Validar el resultado del login
    if ($loginResult) {
        $userData = $loginResult['user'];
        $regionData = $loginResult['region'];

      
        // Separar nombre completo y obtener primer nombre
        $fullname = $userData['name'];
        $firstname = explode(' ', $fullname)[0];

        // Iniciar variables de sesión
        $_SESSION['name'] = $firstname;
        $_SESSION['idUser'] = $userData['id'];
        $_SESSION['department'] = $regionData['department']; 
   
        // Manejar roles de usuario
        switch ($userData['role_id']) {
            case 1:
                echo 'admin';  // Devuelve 'admin' para redirigir
                break;
            case 2:
                echo 'Aprendiz';   // Devuelve 'user' para redirigir
                break;
            default:
                echo 'Rol no reconocido';  // Mensaje de error si el rol no coincide
                break;
        }
    } else {
        echo 'Usuario no existe';  // Mensaje si las credenciales son incorrectas
    }
}
?>
