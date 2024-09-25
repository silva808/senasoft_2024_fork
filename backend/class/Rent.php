<?php
class Rent{

    public $db_connect;

    public function __construct($db_connect){

        $this -> db_connect = $db_connect;
    }
    public function getRentals() {
        try {
            $query = $this->db_connect->prepare("SELECT bike_id, origin_start FROM rentals");
            $query->execute();
            $result = $query->get_result();
            $rentals = $result->fetch_all(MYSQLI_ASSOC);
            return $rentals; // No necesitas el close() aquí
    
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return []; // Retorna un arreglo vacío en caso de error
        }
    }
    
}