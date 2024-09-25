<?php 
session_start();
require_once '../config/db_connection.php';
include_once '../class/User.php';
echo 'a ';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $user = new User($conn);
    
    $id= $_POST["id"];
    $email= $_POST["email"];
    $pass= $_POST["pass"];
    $validate = $user -> validateUser($id, $email, $pass);
    //Validar Existencia del usuario
    if($validate){

        if($validate){
            echo "hellous";
            $_SESSION['nombre'] = $validate['name'];
            $_SESSION['idUser'] = $validate['id'];
            echo $validate[$id];
            // echo "<script> window.location.href='../../Interfaz/Users/Usuario/usuario.php'</script>";
        }
        else{
            echo "Usuario no existe";
            // echo "<script> window.location='../../Interfaz/Users/Administrador/administrador_design.php'</script>";
        }

    }else{
        echo "Usuario no existe";
    }

}
?>