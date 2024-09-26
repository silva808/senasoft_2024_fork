
<?php 
require_once '../backend/config/db_connection.php';
include_once '../backend/class/Region.php';
// include_once '../backend/class/economicstatus.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link css y icons bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../styles/register.css">
    <!-- link jquery y ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Registrar Usuario</title>
</head>
<body class="d-flex flex-column align-items-center justify-content-center vh-100 bg-light">
    <form action="" class="border p-4 rounded shadow-lg bg-white" style="width: 400px;" method="post" id="form-register"> 
        <div class="text-start">
            <a href="../index.html" class="text-decoration-none text-dark">
                <i class="bi bi-arrow-left-short fs-3"></i>
            </a>
        </div>
        <!-- formulario de registrar usuario -->
        <h1 class="text-center mb-4">Registrarse</h1>

        <!-- Nombre -->
        <div class="input-group mb-3">
            <span class="input-group-text">
                <i class="bi bi-person-fill"></i>
            </span>
            <input type="text" class="form-control" name="name" placeholder="Nombre completo" required>
        </div>

        <!-- Identificación -->
        <div class="input-group mb-3">
            <span class="input-group-text">
                <i class="bi bi-person-fill"></i>
            </span>
            <input type="text" class="form-control" name="iduser" placeholder="Identificación" required>
        </div>

        <!-- Teléfono -->
        <div class="input-group mb-3">
            <span class="input-group-text">
                <i class="bi bi-phone-fill"></i>
            </span>

            <input type="number" class="form-control" name="telefono" placeholder="Teléfono" min="3"  required>
        </div>

        <!-- Email -->
        <div class="input-group mb-3">
            <span class="input-group-text">
                <i class="bi bi-envelope-fill"></i>
            </span>
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
    <div class="join_inputs d-flex">
            <!-- Estrato -->
            <div class="input-group mb-3 border">
                <span class="input-group-text">
                    <i class="bi bi-building-fill"></i>
                </span>
                <!-- <input type="number" class="form-control" name="estrato" placeholder="Estrato" min="1" max="6" required> -->
                <select name="estrato" class="form-select">
                    <option value="0" selected>Seleccione su estrato</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    
                </select>
            </div>
            <!-- Regional
            <div class="form-floating mb-3 ms-3">
                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                    <?php
                        $region = new Region($conn);
                        $regions = $region -> getRegions();
                        foreach ($regions as $region){
                            echo "<option value=".$region['id'].">".$region['department']."</option>";
                        }
                    ?>
                </select>
                <label for="floatingSelect">Regional</label>
            </div> -->
            <!-- Regional -->
            <div class="input-group mb-3 ms-3">
                <span class="input-group-text">
                    <i class="bi bi-geo-alt-fill"></i>
                </span>
                <select name="regionales" class="form-select">
                    <?php
                        $region = new Region($conn);
                        $regions = $region -> getRegions();
                        foreach ($regions as $region){
                            echo "<option value=".$region['id'].">".$region['department']."</option>";
                        }
                    ?>
                </select>
            </div>
    </div>
      
        <!-- Contraseña -->
        <div class="input-group mb-4">
            <span class="input-group-text">
                <i class="bi bi-eye-slash-fill"></i>
            </span>
            <input type="password" class="form-control" name="pass" placeholder="Contraseña" required>
        </div>

        <!-- Botón de registro -->
        <button type="submit" class="btn btn-primary w-100" >Registrarse</button>
    </form>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Ev5C1r7yLgU5lbgJ9pqNVjq/3F30l5OgbvpL+DDsJZw1T" crossorigin="anonymous"></script>
    <script src="../js/ajax.js"></script>

</body>
</html>
