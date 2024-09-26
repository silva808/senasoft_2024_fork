<?php
// por arreglar al igual que la funcion de agregar usuario

require_once '../config/db_connection.php';
include_once '../class/User.php';
echo $_POST['estrato'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $iduser = $_POST['iduser'];
    $telefono = $_POST['telefono'];
    $estrato = $_POST['estrato'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $regional = $_POST['regionales'];
    
    // crear objeto de usuario
    $user = new User($conn);
    $adduser = $user->createUser($name, $iduser, $telefono, $estrato, $email, $password, $regional);

    if ($adduser) {
        echo "Datos guardados correctamente";
    } else {
        echo "Datos no guardados";
    }
}
?>