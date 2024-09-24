<?php 
class Region{

    public $db_connect;

    public function __construct($db_connect){
        
        $this -> db_connect = $db_connect;
    }

    public function getRegions(){

        try {
            $query = $this -> db_connect -> prepare("SELECT * FROM regions");
            $query -> execute();
            $result = $query -> get_result();
            $regions = $result -> fetch_all(MYSQLI_ASSOC);
            $query -> close();

            if($regions){
                return $regions;
            }

        } catch (Exception $e) {
            echo"Error".$e -> getMessage();
            return false;
            $query -> close();
        }
    }
}