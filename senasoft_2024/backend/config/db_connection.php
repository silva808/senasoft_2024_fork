<?php

$db_hostname = "localhost";
$db_username = "root";
$db_password = "";
$db_database = "senabike";

$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn -> connect_error);
}