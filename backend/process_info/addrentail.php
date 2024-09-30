<?php
session_start();
require_once '../config/db_connection.php';
include_once '../class/Rent.php';

// Obtener los valores del formulario
$bike_id = $_POST['bikeId'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
// $total_cost_initial = $_POST['totalCost']; 
$idUser = $_SESSION['idUser'];
$start_date = date("Y-m-d");

$origin_start = '1.6154,-75.6132'; // Coordenadas predefinidas del sena
// Coordenadas de destino final basadas en el input del usuario
$final_destination = $latitude . ',' . $longitude;
$start_date = date("Y-m-d"); // Fecha actual

// Crear instancia de la clase Rent
$rentObj = new Rent($conn);

// Llamar al método para guardar el alquiler
$isSaved = $rentObj->saveRental($bike_id, $idUser, $origin_start, $final_destination, $start_date);

if ($isSaved) {
    // Redirigir o mostrar mensaje de éxito
    // header("Location: success.php");
    echo "Bicicleta alquilada correctamente";
} else {
    echo "Error al guardar el alquiler.";
}
?>

