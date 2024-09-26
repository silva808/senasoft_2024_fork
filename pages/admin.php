<?php
    session_start();
    if (!isset($_SESSION['idUser'])) {
        echo "hola";
        // Redirección a index.html
        header('Location: .././index.php');
        exit(); // Asegúrate de que el script se detenga después de la redirección
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- link jquery y ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- map de leaflet CSS y JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="../styles/admin.css">

    <?php
        require_once '../backend/config/db_connection.php';
        include_once '../backend/class/Rent.php';
    ?>
</head>
<body>
    <div class="container-fluid d-flex">
        <div class="sidebar shadow d-flex w-25 flex-column align-items-center justify-content-between">
            <div class="p-5 mb-5 w-100 d-flex flex-column align-items-center">
                <div class="cont-admin d-flex align-items-center gap-2">
                    <div class="cont-img d-flex justify-content-center">
                        <img src="https://www.sena.edu.co/Style%20Library/alayout/images/logoSena.png" style="width: 5rem;" class="img-fluid">
                    </div>
                    <div class="cont-reg">
                        <a href="#" class="fs-2">SenaBike</a>
                        <p>Regional Caquetá</p>
                    </div>
                    
                </div>
                
            </div>
            <div class="w-100 py-3">
                <a href="#earnings"><div class="p-3 options d-flex justify-content-center">
                    Ver Ganancias
                </div></a>
                <a href="#manage_bikes"><div class="p-3 options d-flex justify-content-center">
                    Gestionar Bicicletas
                </div></a>
                <a href="#publish_event">
                    <div class="p-3 options d-flex justify-content-center">
                        Publicar un Evento
                    </div>
                </a>
                <a href="#event_list">
                    <div class="p-3 options d-flex justify-content-center">
                        Ver Eventos
                    </div>
                </a>
                <a href="#map_interactive">
                    <div class="p-3 options d-flex justify-content-center">
                        Mapa interactivo
                    </div>
                </a>
            </div>
            <div class="py-4 d-flex justify-content-center w-100 my-5">
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong><?php echo $_SESSION['name']; ?>- Administrador</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><p href="#" class="dropdown-item" id="sing-out">Sign out</p></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="w-75 d-flex">
            <main class="w-100 d-flex flex-column">
                <!-- Ver Ganancias -->
                <div class="cont-main d-flex" id="earnings">
                    <div class="container p-5 d-flex flex-column">
                        <h2>Ver Ganancias</h2>
                        <p>Detalles de las ganancias generadas hasta ahora...</p>
                        <div class="cont-earnings d-flex column-gap-5">
                            <?php

                                $rent = new Rent($conn);

                                $value = $rent->SumarPreciosRentalsMesActual();

                                $meses = [
                                    '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril',
                                    '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto',
                                    '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
                                ];                            
                                
                                $mesActualNumero = date('m'); // Get the month as a number
                                $anioActualNumero = date('Y'); // Get the year as a number
                                $mesActualNombre = $meses[$mesActualNumero]; // Get the name in Spanish
                                $totalEarning = 0;
                                foreach ($value as $earning){
                                    $totalEarning += $earning['total']; // Sum each total
                                }              
                                echo'<h4><span>'.$mesActualNombre.'</span> - <span>'.$anioActualNumero.'</span></h4> 
                                    <h4>Total Ganancias: <span>'.number_format($totalEarning, 2).'</span> </h4>
                                ';
                            ?>
                        </div>
                        <br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($value as $earning){
                                ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($earning['name']); // Display the user name ?></td>
                                        <td><?php echo '$' . number_format($earning['total'], 2); // Display the total price ?></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Gestionar Bicicletas -->
                <div class="cont-main d-flex" id="manage_bikes">
                <div class="container p-5">
                    <h2>Gestionar Bicicletas</h2>
                    <div class="row">
                        <div class="col-12">
                            <?php include('../templates/bike_tables.php'); ?>
                        </div>
                    </div>
                </div>
            </div>


                <!-- Publicar un Evento -->
                <div class="cont-main d-flex flex-column" id="publish_event">
                    <div class="container p-5">
                        <h2>Publicar un Evento</h2>
                        <form id="publish_post">
                            <div class="mb-3">
                                <label for="event_title" class="form-label">Título del Evento</label>
                                <input type="text" class="form-control" name="event_title">
                            </div>
                            <div class="mb-3">
                                <label for="event_date" class="form-label">Fecha del Evento</label>
                                <input type="date" class="form-control" name="event_date">
                            </div>
                            <div class="mb-3">
                                <label for="event_description" class="form-label">Descripción</label>
                                <textarea class="form-control" name="event_description" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-green">Publicar</button>
                        </form>
                    </div>
                </div>

                <!-- Ver Eventos -->
                <div class="cont-main d-flex flex-column p-3" id="event_list">
                <h3 class="text-center mb-4">Ver Eventos</h3>
                <div class="row row-gap-3">
                    <!-- Event Card 1 -->
                    <?php include_once '../templates/postcard_admin.php'; ?>
                </div>
            </div>

                <!--Mapa interactivo -->
                <div class="cont-main d-flex flex-column" id="map_interactive">
                    <div class="container p-5">
                        <?php include('../templates/map.php'); ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
<script src="../javascript/admin.js"></script>
<script src="../js/ajax.js"></script>

</html>