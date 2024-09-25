<?php
    require_once '../backend/config/db_connection.php';
    include_once '../backend/class/Rent.php';

    // Crear instancia del sistema de alquiler
    $bikeRentalSystem = new Rent($conn);
    $rentals = $bikeRentalSystem->getRentals();
    
?>

<h2>Mapa de Bicicletas Alquiladas</h2>
<div id="map" style="width: 100%; height: 400px;"></div>

<script>
    // Crear el mapa centrado en Florencia, Caquetá
    let map = L.map('map').setView([1.613, -75.606], 14); // Coordenadas generales de Florencia

    // Añadir la capa de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    let bikeIcon = L.icon({
    iconUrl: 'https://cdn-icons-png.flaticon.com/512/1210/1210243.png', // URL del ícono
    iconSize: [38, 38], // Tamaño del ícono
    iconAnchor: [22, 22], // Ajuste del ancla del ícono
    popupAnchor: [-3, -76] // Ajuste del popup
});



    // Obtener las ubicaciones desde PHP
    let rentals = <?php echo json_encode($rentals); ?>;

    // Comprobar si hay alquileres
    if (rentals.length === 0) {
        console.error("No hay alquileres disponibles.");
    } else {
        // Añadir marcadores en las ubicaciones obtenidas de la base de datos
        rentals.forEach(function(rental) {
            let coords = rental.origin_start.split(',');
            let lat = parseFloat(coords[0]);
            let lon = parseFloat(coords[1]);
            L.marker([lat, lon], {icon: bikeIcon})
                .addTo(map)
                .bindPopup('Bicicleta ID: ' + rental.bike_id);
        });
    }
</script>