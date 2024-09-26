<?php 
class Bike{

    public $db_connect;

    public function __construct($db_connect){
        
        $this -> db_connect = $db_connect;
    }

    public function addBike($brand, $color, $condition, $availability, $price){

        try {
            $query = $this -> db_connect -> prepare("INSERT INTO bikes (brand, color, bike_condition, availability, rent_price) VALUES (?,?,?,?,?)");
            $query -> bind_param("sssid", $brand, $color, $condition, $availability, $price);
            $query -> execute();
                if($query -> affected_rows > 0){
                    return true;
                }
                return false;
        } catch (Exception $e) {
            echo"Error".$e -> getMessage();
            return false;
            $query -> close();
        }
    }

    public function getBikes(){

        try {
            $query = $this -> db_connect -> prepare("SELECT * FROM bikes");
            $query -> execute();
            $result = $query -> get_result();
            $bikes = $result -> fetch_all(MYSQLI_ASSOC);
            $query -> close();

            if($bikes){
                return $bikes;
            }

        } catch (Exception $e) {
            echo"Error".$e -> getMessage();
            return false;
            $query -> close();
        }
    }
    // CONSEGUIR LAS BICILETAS QUE ESTAN DISPONIBLES
    public function getBikesavailability(){

        try {
            $query = $this -> db_connect -> prepare("SELECT * FROM bikes WHERE availability = 1");
            $query -> execute();
            $result = $query -> get_result();
            $bikes = $result -> fetch_all(MYSQLI_ASSOC);
            $query -> close();

            if($bikes){
                return $bikes;
            }

        } catch (Exception $e) {
            echo"Error".$e -> getMessage();
            return false;
            $query -> close();
        }
    }
}