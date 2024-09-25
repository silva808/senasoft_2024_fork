<?php
class User{

    public $db_connect;

    public function __construct($db_connect){
        $this -> db_connect = $db_connect;
    }

    public function getUser($id){
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this ->$db_connect -> prepare($sql);
        $stmt -> bind_param("i", $id);
        $stmt -> execute();
        $result = $stmt -> get_result();
        $row = $result -> fetch_assoc();
        return $row;
    }

    public function validateUser($id, $email, $password){
        try{
            // Consulta preparada
            $Sql = $this->db_connect->prepare("SELECT id, email, password FROM users WHERE id = ? AND email = ? AND password = ? ");
                            
            // Vinculación de parámetros
            $Sql->bind_param("iss", $id, $email, $password);
                    
            // Ejecutar la consulta
            $Sql->execute();

            // Obtener los resultados
            if($Resultado = $Sql->get_result()->fetch_assoc()){
                //array_push($Datos,$Resultado['hora_inicio']);
                return $Resultado['id'];
            }
                return false;
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