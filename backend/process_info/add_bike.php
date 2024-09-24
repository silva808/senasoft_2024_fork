<?php
    require_once '../config/db_connection.php';
    include_once '../class/Bike.php';

    $bike = new Bike($conn);

    $brand = $_POST['bike_brand'];
    $color = $_POST['bike_color'];
    $condition = $_POST['bike_condition'];
    $availability = $_POST['bike_availability'];
    $price = $_POST['bike_price'];

    $func = $bike -> addBike($brand, $color, $condition, $availability, $price);
    
        if ($func){
            echo 'Bicicleta agregada';
        }