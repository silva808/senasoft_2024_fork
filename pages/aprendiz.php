<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/aprendiz.css">
</head>
<body>
    <div class="container-fluid d-flex">
        <div class="sidebar shadow d-flex w-25 flex-column align-items-center justify-content-between">
            <div class="p-5 mb-5 w-100 d-flex justify-content-center align-items-center gap-3">
                <img src="https://www.sena.edu.co/Style%20Library/alayout/images/logoSena.png" style="width: 4rem;">
                <a href="#" class="fs-4">SenaBike</a>
            </div>
            <div class="w-100 py-3">
                    <a href="#rent_bike"><div class="p-3 options d-flex justify-content-center">
                        Alquilar Bicicleta
                    </div></a>
                    <a href="#give_bike"><div class="p-3 options d-flex justify-content-center">
                        Entregar Bicicleta
                    </div></a>
                    <a href="#watch_events"><div class="p-3 options d-flex justify-content-center">
                        Ver Eventos
                    </div></a>
            </div>
            <div class="py-5 d-flex justify-content-center w-100 my-5 gap-3">
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong><?php echo $_SESSION['name']; ?></strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="#" id="sing-out">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="w-75 d-flex">
            <main class="w-100 d-flex flex-column">
                <div class="cont-main d-flex flex-column p-3" id="rent_bike">
                    <h3 class="text-center mb-4">Alquilar Bicicletas</h3>
                    <div class="row row-gap-3">
                        <!-- Bike Card 1 -->
                        <div class="col-md-4 col-sm-6 d-flex justify-content-center">
                            <div class="card bike-card">
                                <img src="https://gwbicycles.com/cdn/shop/files/1-negra-2_1800x1800.jpg?v=1726761027" class="card-img-top img-fluid" alt="Bicicleta 700 Berlín GW">
                                <div class="card-body">
                                    <h5 class="card-title">Bicicleta 700 Berlín GW</h5>
                                    <p class="card-text">Estado: Buenas condiciones<br>Disponibilidad: Sí<br><strong>Precio Alquiler: $40.000</strong></p>
                                    <div class="d-flex justify-content-evenly">
                                        <a href="#" class="btn btn-outline-green">Ver detalles</a>
                                        <a href="#" class="btn btn-green">Alquilar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Bike Card 2 -->
                        <div class="col-md-4 col-sm-6 d-flex justify-content-center">
                            <div class="card bike-card">
                                <img src="https://gwbicycles.com/cdn/shop/files/1-negra-2_1800x1800.jpg?v=1726761027" class="card-img-top img-fluid" alt="Bicicleta 700 Berlín GW">
                                <div class="card-body">
                                    <h5 class="card-title">Bicicleta 700 Berlín GW</h5>
                                    <p class="card-text">Estado: Buenas condiciones<br>Disponibilidad: Sí<br><strong>Precio Alquiler: $40.000</strong></p>
                                    <div class="d-flex justify-content-evenly">
                                        <a href="#" class="btn btn-outline-green">Ver detalles</a>
                                        <a href="#" class="btn btn-green">Alquilar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Bike Card 3 -->
                        <div class="col-md-4 col-sm-6 d-flex justify-content-center">
                            <div class="card bike-card">
                                <img src="https://gwbicycles.com/cdn/shop/files/1-negra-2_1800x1800.jpg?v=1726761027" class="card-img-top img-fluid" alt="Bicicleta 700 Berlín GW">
                                <div class="card-body">
                                    <h5 class="card-title">Bicicleta 700 Berlín GW</h5>
                                    <p class="card-text">Estado: Buenas condiciones<br>Disponibilidad: Sí<br><strong>Precio Alquiler: $40.000</strong></p>
                                    <div class="d-flex justify-content-evenly">
                                        <a href="#" class="btn btn-outline-green">Ver detalles</a>
                                        <a href="#" class="btn btn-green">Alquilar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            <div class="cont-main d-flex flex-column" id="give_bike">
                <h3 class="p-5">Entregar bicicleta</h3>
                <div class="form-cont d-flex p-5 justify-content-center">
                    <form>
                        <!-- Selección de bicicleta -->
                        <div class="mb-3">
                            <label for="bike" class="form-label">Bicicleta</label>
                            <input type="number" class="form-control" id="finalPrice" name="finalPrice" disabled>
                        </div>
            
                        <!-- Selección de destino -->
                        <div class="mb-3">
                            <label for="destination" class="form-label">Destino</label>
                            <select class="form-select" id="bike" name="bike">
                                <option selected disabled>Selecciona una bicicleta</option>
                                <option value="1">Trek</option>
                                <option value="2">Specialized</option>
                                <option value="3">Giant</option>
                                <option value="4">Scott</option>
                            </select>
                        </div>
            
                        <!-- Precio final -->
                        <div class="mb-3">
                            <label for="finalPrice" class="form-label">Precio Final</label>
                            <input type="number" class="form-control" id="finalPrice" name="finalPrice" disabled>
                        </div>
            
                        <!-- Botón de envío -->
                        <button type="submit" class="btn btn-green">Submit</button>
                    </form>
                </div>
            </div>
            <div class="cont-main d-flex flex-column p-3" id="watch_events">
                <h3 class="text-center mb-4">Ver Eventos</h3>
                <div class="row row-gap-3">
                    <!-- Event Card 1 -->
                    <div class="col-md-4 col-sm-6 d-flex justify-content-center">
                        <div class="card event-card">
                            <div class="card-body">
                                <h5 class="card-title">Evento Ciclovía Bogotá</h5>
                                <p class="card-text">Únete a la ciclovía más grande de Bogotá y disfruta de un recorrido especial.</p>
                                <p class="event-date">Fecha: 25 Septiembre 2024</p>
                                <a href="#" class="btn btn-green">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                    <!-- Event Card 2 -->
                    <div class="col-md-4 col-sm-6 d-flex justify-content-center">
                        <div class="card event-card">
                            <div class="card-body">
                                <h5 class="card-title">Reto en Montaña</h5>
                                <p class="card-text">Participa en el reto de ciclismo en montaña y demuestra tu resistencia.</p>
                                <p class="event-date">Fecha: 12 Octubre 2024</p>
                                <a href="#" class="btn btn-green">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                    <!-- Event Card 3 -->
                    <div class="col-md-4 col-sm-6 d-flex justify-content-center">
                        <div class="card event-card">
                            <div class="card-body">
                                <h5 class="card-title">Tour de Antioquia</h5>
                                <p class="card-text">Acompáñanos en el tour de Antioquia, un evento lleno de paisajes y diversión.</p>
                                <p class="event-date">Fecha: 5 Noviembre 2024</p>
                                <a href="#" class="btn btn-green">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
                
            </main>
        </div>
    </div>
</body>
<script src="../javascript/aprendiz.js"></script>
</html>