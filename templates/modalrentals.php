<?php
require_once '../backend/config/db_connection.php';
include_once '../backend/class/Bike.php';

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
                        <form id="rentalForm' . $bike["id"] . '">
                            <p> Estado: ' . htmlspecialchars($bike["bike_condition"]) . '</p>
                            <p> ID: ' . htmlspecialchars($bike["id"]) . '</p>

                        
                            <input type="hidden" id="bikeId" value="' . $bike["id"] . '">
                            <input type="" id="rentPrice" value="' . $bike["rent_price"] . '">

                            <!-- Campo para que el usuario ingrese la ubicación -->
                            <label for="location">Ubicación a la que irá (dirección o lugar):</label>
                            <input type="text" id="location' . $bike["id"] . '" name="location" placeholder="Ej: Parque central" required><br><br>

                            <!-- Campos ocultos para la latitud y longitud -->
                            <input type="hidden" id="latitude' . $bike["id"] . '" name="latitude">
                            <input type="hidden" id="longitude' . $bike["id"] . '" name="longitude">

                            <button type="button" onclick="searchLocation(' . $bike["id"] . ')">Buscar ubicación</button><br><br>
                            <p id="status' . $bike["id"] . '"></p>

                            <!-- Div para el mapa -->
                            <div id="map' . $bike["id"] . '" style="height: 400px; width: 100%;"></div>
                       
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Confirmar Alquiler</button>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                     </form>
                </div>
            </div>
        </div>

        <script>
            let map' . $bike["id"] . ';

            // Función para buscar la ubicación ingresada
            function searchLocation(bikeId) {
                let location = document.getElementById("location" + bikeId).value;

                // Límite geográfico alrededor de Florencia, Caquetá
                const bounds = [1.5575, -75.6789, 1.6237, -75.5955]; // Coordenadas aproximadas de los límites de Florencia

                // Si no se ingresa una ubicación, usar "Parque central, Florencia"
                if (!location) {
                    location = "Parque central, Florencia, Caquetá, Colombia";
                }

                if (location) {
                    // Llamar a la API de geocodificación de OpenStreetMap con límites geográficos
                    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${location}&bounded=1&viewbox=${bounds[1]},${bounds[0]},${bounds[3]},${bounds[2]}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.length > 0) {
                                const lat = data[0].lat;
                                const lon = data[0].lon;

                                // Mostrar resultado en la consola
                                console.log("Ubicación encontrada:", data[0].display_name, "Latitud:", lat, "Longitud:", lon);

                                // Asignar las coordenadas a los campos ocultos del formulario
                                document.getElementById("latitude" + bikeId).value = lat;
                                document.getElementById("longitude" + bikeId).value = lon;

                                document.getElementById("status" + bikeId).innerHTML = "Ubicación encontrada: " + data[0].display_name;

                                // Mostrar el mapa con Leaflet centrado en la ubicación ingresada
                                if (!map' . $bike["id"] . ') {
                                    map' . $bike["id"] . ' = L.map("map" + bikeId).setView([lat, lon], 14);
                                } else {
                                    map' . $bike["id"] . '.setView([lat, lon], 14);
                                }

                                // Agregar capa de OpenStreetMap
                                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                                    attribution: "&copy; <a href=\'https://www.openstreetmap.org/copyright\'>OpenStreetMap</a> contributors"
                                }).addTo(map' . $bike["id"] . ');

                                // Agregar marcador en la ubicación
                                L.marker([lat, lon]).addTo(map' . $bike["id"] . ')
                                    .bindPopup("Ubicación ingresada")
                                    .openPopup();
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
