<?php 
session_start();
require_once '../config/db_connection.php';
include_once '../class/User.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id= $_POST["id"];
    $email= $_POST["email"];
    $pass= $_POST["pass"];

    //Validar Existencia del usuario
    if(){

        if($DatosFinca[2] == 7){
            echo "<script> window.location.href='../../Interfaz/Users/Usuario/usuario.php'</script>";
        }
        else if($DatosFinca[2] == 5){
            echo "<script> window.location='../../Interfaz/Users/Administrador/administrador_design.php'</script>";
        }

    }else{
        echo "Usuario no existe";
    }

}
?>