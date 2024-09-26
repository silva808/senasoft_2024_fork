<?php
require_once '../backend/config/db_connection.php';
include_once '../backend/class/Bike.php';

// Crear instancia de la clase Bike y obtener las bicicletas
$bikes = new Bike($conn);
$bikeList = $bikes->getBikes(); // Obtener las bicicletas desde la base de datos

?>

<div class="container p-5 over-flow-auto">
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Imagen</th>
                <th scope="col">Nombre</th>
                <th scope="col">Color</th>
                <th scope="col">Disponibilidad</th>
                <th scope="col">Condición</th>
                <th scope="col">Precio alquiler</th>

                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bikeList as $bike): ?>
                <!-- Asignar clase 'table-success' si la disponibilidad es 'Si' -->
                <tr class="<?= $bike['availability'] === 1 ? 'table-success' : 'table-danger'; ?>">
                    <td>
                        <!-- <img src="<?= $bike['imagen'] ?>" alt="Bicicleta" width="100"> -->
                    </td>
                    <td><?= $bike['brand'] ?></td>
                    <td><?= $bike['color'] ?></td>
                    <td><?= $bike['availability']  === 1 ? 'Sí' : 'No'; ?></td>
                    <td><?= $bike['bike_condition'] ?></td>
                    <td>$<?= $bike['rent_price'] ?></td>
               
                    <td>
                        <a href="#" class="btn btn-green">Editar</a>
                        <a href="#" class="btn btn-outline-danger">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

