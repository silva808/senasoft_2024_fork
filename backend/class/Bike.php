<?php 
class Bike{

    public $db_connect;

    public function __construct($db_connect){
        
        $this -> db_connect = $db_connect;
    }

    public function addBike($brand, $color, $condition, $availability, $price){

        try {
            $query = $this -> db_connect -> prepare("INSERT INTO bikes (brand, color, bike_condition, availability, rent_price) VALUES (?,?,?,?,?)");
            $query -> bind_param("sssigit d", $brand, $color, $condition, $availability, $price);
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
}