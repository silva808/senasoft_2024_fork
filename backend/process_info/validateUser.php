<?php
session_start();
require_once '../config/db_connection.php';
include_once '../class/User.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $user = new User($conn);

    $id = $_POST["id"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    // Validar Usuario
    $validate = $user->validateUser($id, $email, $pass);

    // Validar Existencia del Usuario
    if ($validate) {
        // Separar nombre completo y obtener primer nombre
        $fullname = $validate['name'];
        $partsname = explode(' ', $fullname);
        $firstname = $partsname[0];

        // Iniciar variables de sesión
        $_SESSION['name'] = $firstname;
        $_SESSION['idUser'] = $validate['id'];

        if ($validate) {
            if ($validate['role_id'] == 1) {
                echo 'admin';  // Devuelve 'admin' para redirigir
            } else if ($validate['role_id'] == 2) {
                echo 'Aprendiz';   // Devuelve 'user' para redirigir
            } else {
                echo 'Rol no reconocido';  // Enviar mensaje de error si el rol no coincide
            }
        } else {
            echo 'Usuario no existe';  // Si el usuario no existe
        }
    }   
}
?>
