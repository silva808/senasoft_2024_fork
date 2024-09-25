<?php
    session_start();
    echo $_SESSION['idUser'];
    if (!isset($_SESSION['idUser'])) {
        echo "hola";
        // Redirección a index.html
        header('Location: .././index.html');
        exit(); // Asegúrate de que el script se detenga después de la redirección
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- link jquery y ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="../styles/bruh.css">
</head>
<body>
    <div class="container-fluid d-flex">
        <div class="sidebar shadow d-flex w-25 flex-column align-items-center justify-content-between">
            <div class="p-5 mb-5 w-100 d-flex justify-content-center align-items-center gap-3">
                <img src="https://www.sena.edu.co/Style%20Library/alayout/images/logoSena.png" style="width: 4rem;">
                <a href="#" class="fs-4">SenaBike</a>
            </div>
            <div class="w-100 py-4">
                    <div class="p-3 options d-flex justify-content-center">
                        <p href="#">Alquilar Bicicleta</p>
                    </div>
                    <div class="p-3 options d-flex justify-content-center">
                        <p href="#">Entregar Bicicleta</p>
                    </div>
                    <div class="p-3 options d-flex justify-content-center">
                        <p href="#">Ver Eventos</p>
                    </div>
            </div>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong><?php echo $_SESSION['name']; ?></strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="#" id="sing-out">Sign out</a></li>
                </ul>
            </div>
            <!-- <div class="p-4 d-flex justify-content-center w-100 mt-5 justify-self-end">
                <p>Aleja</p>
            </div> -->
        </div>
        <div class="w-75 d-flex">
            <main class="w-100 d-flex justify-content-center">
                <div class="row row-gap-3">

                    <div class="col-12 d-flex justify-content-around">
                        <!-- carrdddddd -->
                        <div class="card d-flex align-items-center">
                            <div class="title-cont">
                                <h6 class="card-title fw-semibold pt-2">Bicicleta 700 Berlín GW 8Vel Hidráulico.</h6>
                            </div>
                            <img src="https://gwbicycles.com/cdn/shop/files/1-negra-2_1800x1800.jpg?v=1726761027" class="border card-img-top img-fluid" alt="...">
                            <div class="card-body">
                                <p class="card-text">Estado: Buenas condiciones
                                    <br> Disponibilidad: Si
                                    <br> <p class="fw-semibold">Precio Alquiler: $40.000</p>
                                </p>
                                <div class="d-flex justify-content-center">
                                    <div class="btn-group" aria-label="Basic outlined example">
                                        <button type="button" class="btn detail-btn btn-outline-success">Ver detalles</button>
                                        <button type="button" class="btn rent-btn btn-success py-1">Alquilar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- carrdddddd -->
                        <div class="card d-flex align-items-center">
                            <div class="title-cont">
                                <h6 class="card-title fw-semibold pt-2">Bicicleta 700 Berlín GW 8Vel Hidráulico.</h6>
                            </div>
                            <img src="https://gwbicycles.com/cdn/shop/files/1-negra-2_1800x1800.jpg?v=1726761027" class="border card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">Estado: Buenas condiciones
                                    <br> Disponibilidad: Si
                                    <br> <p class="fw-semibold">Precio Alquiler: $40.000</p>
                                </p>
                                <div class="d-flex justify-content-center">
                                    <div class="btn-group" aria-label="Basic outlined example">
                                        <button type="button" class="btn detail-btn btn-outline-success">Ver detalles</button>
                                        <button type="button" class="btn rent-btn btn-success py-1" id="alquilar" >Alquilar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-around">
                    </div>



                </div>
                
            </main>
        </div>
    </div>
    <script src="../js/ajax.js"></script>
</body>
</html>