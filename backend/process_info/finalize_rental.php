<?php
session_start();
require_once '../config/db_connection.php'; // Cambia según la estructura de tu proyecto
include_once '../class/Rent.php';

// Verificar si se ha recibido el ID de la bicicleta
if (isset($_POST['bikeId'])) {
    $bike_id = $_POST['bikeId'];
    $user_id = $_SESSION['idUser']; // ID del usuario desde la sesión
    $current_date = date("Y-m-d H:i:s"); // Fecha y hora actuales

    // Crear instancia de la clase Rent
    $rentObj = new Rent($conn);

    // Llamar al método para actualizar el alquiler
    $isUpdated = $rentObj->finalizeRental($bike_id, $user_id, $current_date);

    if ($isUpdated) {
        echo "Alquiler finalizado exitosamente.";
    } else {
        echo "Error al finalizar el alquiler.";
    }
} else {
    echo "ID de bicicleta no recibido.";
}
?>
