<?php
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
                            
            // Vinculación de parámetros
            $sql->bind_param("iss", $id, $email, $password);
                    
            // Ejecutar la consulta
            $sql->execute();
                // Obtener los resultados
            $resultado = $sql->get_result()->fetch_assoc();

            if ($resultado) {
                return $resultado; // Se encontró el usuario y la contraseña coincide
            }
            return false; // No se encontró el usuario o la contraseña es incorrecta

        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    
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