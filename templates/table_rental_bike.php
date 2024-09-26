<?php
require_once '../backend/config/db_connection.php';
include_once '../backend/class/Rent.php';

$user_id = $_SESSION['idUser']; // Obtener el ID del usuario desde la sesión

// Crear instancia de la clase Rent
$rentObj = new Rent($conn);

// Obtener los alquileres activos del usuario
$activeRentals = $rentObj->rentedBikeByUser($user_id);

?>

<?php if (!empty($activeRentals)): ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID Bicicleta</th>
                <th>Marca</th>
                <th>Condición</th>
                <th>Usuario</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Fecha de Inicio</th>
                <th>Acciones</th> <!-- Nueva columna para el botón -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activeRentals as $rental): ?>
                <tr>
                    <td><?php echo htmlspecialchars($rental['bike_id']); ?></td>
                    <td><?php echo htmlspecialchars($rental['brand']); ?></td>
                    <td><?php echo htmlspecialchars($rental['bike_condition']); ?></td>
                    <td><?php echo htmlspecialchars($rental['name']); ?></td>
                    <td><?php echo htmlspecialchars($rental['email']); ?></td>
                    <td><?php echo htmlspecialchars($rental['phone_number']); ?></td>
                    <td><?php echo htmlspecialchars($rental['date_started']); ?></td>
                    <td>
                        <!-- Botón para entregar bicicleta -->
                        <button class="btn btn-success" onclick="finalizeRental(<?php echo $rental['bike_id']; ?>)">Entregar y Pagar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No tienes alquileres activos en este momento.</p>
<?php endif; ?>
