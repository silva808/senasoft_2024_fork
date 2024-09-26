
<?php
session_start();
require_once '../backend/config/db_connection.php';
include_once '../class/Bike.php';

// Obtener los valores del formulario
$bike_id = $_POST['bikeId'];
// $start_date = $_POST['startDate'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$rent_price = $_POST['rentPrice'];
$idUser = $_SESSION['idUser'];
// Unir la latitud y longitud en una cadena "lat,long"
$origin_start = 1.6154  . ',' . -75.6132;
$final_destination = $latitude . ',' . $longitude;
$start_date = date("Y-m-d");

// Insertar el alquiler en la base de datos
$sql = "INSERT INTO rentals (bike_id, user_id, origin_start, final_destination, rent_price, date_started) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isdss", $bike_id, $idUser, $origin_start, $final_destination, $rent_price, $start_date);

if ($stmt->execute()) {
    // echo "Alquiler guardado correctamente.";
    return true;
} else {
    echo "Error al guardar el alquiler: " . $conn->error;
}
?>
