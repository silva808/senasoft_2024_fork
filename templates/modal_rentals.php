<?php
require_once '../backend/config/db_connection.php';
include_once '../backend/class/Rent.php';
include_once '../backend/class/Bike.php';

$rentObj = new Rent($conn);
$userId = $_SESSION['idUser']; // Cambia esto por la forma en que obtienes el ID del usuario
$rentedBikes = $rentObj->rentedBikeByUser($userId);
$isRented = !empty($rentedBikes); // Verifica si el usuario tiene un alquiler activo

// Instantiate the Bike class
$bikeObj = new Bike($conn);

// Fetch the list of bikes using the getBikes() method
$bikes = $bikeObj->getBikes();

if ($bikes) {
    // Loop through each bike and generate the HTML for the card
    foreach ($bikes as $bike) {
        echo '
        <div class="col-md-4 col-sm-6 d-flex justify-content-center">
            <div class="card bike-card">
                <img src="https://gwbicycles.com/cdn/shop/files/1-negra-2_1800x1800.jpg?v=1726761027" class="card-img-top img-fluid" alt="Bicicleta ' . htmlspecialchars($bike["brand"]) . '">
                <div class="card-body">
                    <h5 class="card-title">' . htmlspecialchars($bike["brand"]) . ' - ' . htmlspecialchars($bike["color"]) . '</h5>
                    <p class="card-text">
                        Estado: ' . htmlspecialchars($bike["bike_condition"]) . '<br>
                        Disponibilidad: ' . ($bike["availability"] == 1 ? "Sí" : "No") . '<br>
                        <strong>Precio Alquiler: $' . number_format($bike["rent_price"], 0) . '</strong>
                    </p>
                    <div class="d-flex justify-content-between">
                        <a href="#" class="btn btn-outline-green">Ver detalles</a>
                        
                        <button type="button" class="btn btn-green" data-bs-toggle="modal" data-bs-target="#rentModal' . $bike["id"] . '">Alquilar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Rental -->
        <div class="modal fade" id="rentModal' . $bike["id"] . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rentModalLabel' . $bike["id"] . '" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rentModalLabel' . $bike["id"] . '">Alquilar Bicicleta ' . htmlspecialchars($bike["brand"]) . '</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form id="rentalForm' . $bike["id"] . '" method="post" action="">
                            <p> Estado: ' . htmlspecialchars($bike["bike_condition"]) . '</p>
                            <p> ID: ' . htmlspecialchars($bike["id"]) . '</p>

                            <input type="hidden" id="bikeId" value="' . $bike["id"] . '" name="bikeId">
                            <input type="hidden" id="rentPrice" value="' . $bike["rent_price"] . '" name="rentPrice">

                            <!-- Campo para que el usuario ingrese la ubicación -->
                            <label for="location">Ubicación a la que irá (dirección o lugar):</label>
                            <input type="text" id="location' . $bike["id"] . '" name="location" placeholder="Ej: Parque central" required><br><br>

                            <!-- Mostrar distancia calculada -->
                            <p>Distancia a recorrer: <span id="distance' . $bike["id"] . '">0</span> km</p>

                            <!-- Campos ocultos para la latitud y longitud -->
                            <input type="hidden" id="latitude' . $bike["id"] . '" name="latitude">
                            <input type="hidden" id="longitude' . $bike["id"] . '" name="longitude">

                            <button type="button" onclick="searchLocation(' . $bike["id"] . ')">Buscar ubicación</button><br><br>
                            <p id="status' . $bike["id"] . '"></p>

                            <button type="submit" class="btn btn-primary">Confirmar Alquiler</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>';
    }
} else {
    echo '<p>No hay bicicletas disponibles.</p>';
}
?>
<!-- <script src="../js/distance_km.js"></script> -->
<!-- <button type="button" class="btn btn-green' . ($isRented ? ' hidden' : '') . '" data-bs-toggle="modal" data-bs-target="#rentModal' . $bike["id"] . '"' . ($isRented ? ' disabled' : '') . '>Alquilar</button> -->
