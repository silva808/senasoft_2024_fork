<?php
include_once 'Region.php';

class User{

    public $db_connect;

    public function __construct($db_connect){
        $this -> db_connect = $db_connect;
    }

    public function getUser($id){
      
    }
    
    public function validateUser($id, $email, $password){
        try{
            // Consulta preparada
            $sql = $this->db_connect->prepare("SELECT id, name, role_id, email, password FROM users WHERE id = ? AND email = ? AND password = ? ");
                            
            $sql->bind_param("iss", $id, $email, $password);  // Vinculación de parámetros
            $sql->execute();  // Ejecutar la consulta
            $resultado = $sql->get_result()->fetch_assoc();   // Obtener los resultados

            if ($resultado) {
                return $resultado; // Se encontró el usuario y la contraseña coincide
            }
            return false; // No se encontró el usuario o la contraseña es incorrecta

        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    // Método de inicio de sesión
    public function login($id, $email, $password) {
        $user = $this->validateUser($id, $email, $password);

        if ($user) {
            $region = new Region($this->db_connect);
            $id_user = $user['id'];
            $userRegion = $region->validateUserRegion($id_user);
            return [
                'user' => $user,
                'region' => $userRegion
            ];
        }
        return false; // Credenciales inválidas
    }

    // public function getUserByBike($bike_id){
    //     try{
    //         $sql = $this->db_connect->prepare("SELECT * FROM users INNER JOIN rentals ON users.id = rentals.user_id WHERE rentals.bike_id = ?");
    //         $sql->bind_param("i", $bike_id); 
    //         $sql->execute(); 
              
    //         $resultado = $sql->get_result()->fetch_assoc();   
    //         if ($resultado) {
    //             return $resultado;
    //         }
    //         return false;
    //     }catch(Exception $e){
    //         echo $e->getMessage();
    //     }
    // }

        // por arreglar agregar usuarios aunque no seria necesario que se puediera crear la cuenta ya que se manejaria la bd del sena hipoteticamente
    public function createUser($name, $iduser, $telefono, $estrato, $email, $password, $regional){
        $Sql = $this->db_connect->prepare("INSERT INTO users (name, id, phone_number, economic_id, email, password, region_id, role_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $Sql -> bind_param("sisisss", $name, $iduser, $telefono, $estrato, $email, $password, $regional);
        $Sql -> execute();
        if($Sql -> affected_rows > 0){
            return true;
        }else{
            return false;
        }
    }
}