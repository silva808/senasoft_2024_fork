
<?php
require_once '../backend/config/db_connection.php';
include_once '../backend/class/Bike.php';

// Instanciar la clase Bike
$bikeObj = new Bike($conn);

// Obtener la lista de bicicletas usando el método getBikes()
$bikes = $bikeObj->getBikes();

if ($bikes) {
    // Recorrer cada bicicleta y generar el HTML para la tarjeta
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

        <!-- Modal para Alquiler -->
        <div class="modal fade" id="rentModal' . $bike["id"] . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rentModalLabel' . $bike["id"] . '" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rentModalLabel' . $bike["id"] . '">Alquilar Bicicleta ' . htmlspecialchars($bike["brand"]) . '</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form id="rentalForm' . $bike["id"] . '" method="post" action="process_rental.php">
                            <p> Estado: ' . htmlspecialchars($bike["bike_condition"]) . '</p>
                            <p> ID: ' . htmlspecialchars($bike["id"]) . '</p>

                            <input type="hidden" id="bikeId" value="' . $bike["id"] . '" name="bikeId">
                            <input type="hidden" id="rentPrice" value="' . $bike["rent_price"] . '" name="rentPrice">

                            <label for="location">Ubicación a la que irá (dirección o lugar):</label>
                            <input type="text" id="location' . $bike["id"] . '" name="location" placeholder="Ej: Parque central" required><br><br>

                            <p>Distancia a recorrer: <span id="distance' . $bike["id"] . '">0</span> km</p>

                            <input type="hidden" id="latitude' . $bike["id"] . '" name="latitude">
                            <input type="hidden" id="longitude' . $bike["id"] . '" name="longitude">

                            <button type="button" onclick="searchLocation(' . $bike["id"] . ')">Calcular distancia</button><br><br>
                            <p id="status' . $bike["id"] . '"></p>

                            <button type="submit" class="btn btn-primary">Confirmar Alquiler</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Coordenadas de origen del SENA
            const originLat = 1.6154; // Latitud del SENA
            const originLon = -75.6132; // Longitud del SENA

            // Función para calcular la distancia en km usando la fórmula Haversine
            function calculateDistance(lat1, lon1, lat2, lon2) {
                const earthRadius = 6371; // Radio de la Tierra en kilómetros

                const dLat = (lat2 - lat1) * Math.PI / 180;
                const dLon = (lon2 - lon1) * Math.PI / 180;

                const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                          Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                          Math.sin(dLon / 2) * Math.sin(dLon / 2);

                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                return earthRadius * c; // Distancia en km
            }

            // Función para buscar la ubicación ingresada
            function searchLocation(bikeId) {
                let location = document.getElementById("location" + bikeId).value;

                // Si no se ingresa una ubicación, usar "Parque central, Florencia"
                if (!location) {
                    location = "Parque central, Florencia, Caquetá, Colombia";
                }

                if (location) {
                    // Llamar a la API de geocodificación de OpenStreetMap
                    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${location}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.length > 0) {
                                const lat = parseFloat(data[0].lat);
                                const lon = parseFloat(data[0].lon);

                                // Asignar las coordenadas a los campos ocultos del formulario
                                document.getElementById("latitude" + bikeId).value = lat;
                                document.getElementById("longitude" + bikeId).value = lon;

                                // Calcular la distancia
                                const distance = calculateDistance(originLat, originLon, lat, lon);
                                document.getElementById("distance" + bikeId).textContent = distance.toFixed(2);

                                document.getElementById("status" + bikeId).innerHTML = "Ubicación encontrada: " + data[0].display_name;
                            } else {
                                document.getElementById("status" + bikeId).innerHTML = "No se encontró la ubicación. Inténtalo de nuevo.";
                            }
                        })
                        .catch(error => {
                            console.error("Error al obtener las coordenadas: ", error);
                            document.getElementById("status" + bikeId).innerHTML = "Hubo un error al buscar la ubicación.";
                        });
                } else {
                    document.getElementById("status" + bikeId).innerHTML = "Por favor, ingresa una ubicación.";
                }
            }
        </script>';
    }
} else {
    echo '<p>No hay bicicletas disponibles.</p>';
}
?>

<!-- <button type="submit" form="rentalForm' . $bike["id"] . '" class="btn btn-primary">Confirmar Alquiler</button> -->


