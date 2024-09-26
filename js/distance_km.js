// Coordenadas de origen del SENA
const originLat = 1.603611560709583; // Latitud del SENA
const originLon = -75.58453016562414; // Longitud del SENA

// Función para calcular la distancia en km usando la fórmula Haversine
function calculateDistance(lat1, lon1, lat2, lon2) {
    const earthRadius = 6371; // Radio de la Tierra en kilómetros

    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;

    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
              Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
              Math.sin(dLon / 2) * Math.sin(dLon / 2);

    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return earthRadius * c; // Retornar la distancia
}

// Función para buscar la ubicación ingresada
function searchLocation(bikeId) {
    let location = document.getElementById("location" + bikeId).value;

    // Límite geográfico alrededor de Florencia, Caquetá
    const bounds = [1.5575, -75.6789, 1.6237, -75.5955]; // Coordenadas aproximadas de los límites de Florencia

    // Asegúrate de que la ubicación se limite a Florencia
    location += ", Florencia, Caquetá, Colombia"; // Añadir Florencia y Caquetá

    if (location) {
        // Llamar a la API de geocodificación de OpenStreetMap con límites geográficos
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(location)}&bounded=1&viewbox=${bounds[1]},${bounds[0]},${bounds[3]},${bounds[2]}`)
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

                    const rentPrice = parseFloat(document.getElementById("rentPrice" + bikeId).value); // Obtener el precio de alquiler este bikeId
                    // Calcular el costo total
                    const totalCost = distance * rentPrice; // Multiplicar la distancia por el precio de alquiler
                    document.getElementById("totalCost" + bikeId).textContent = "$" + totalCost.toFixed(2);
                    
                    // ubicacion Encontrada 
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


