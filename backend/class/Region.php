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

    public function validateUserRegion($idUser){
        try{
            $sql = $this->db_connect->prepare("SELECT * FROM regions INNER JOIN users ON regions.id = users.region_id WHERE users.id = ?");
            $sql->bind_param("i", $idUser); 
            $sql->execute(); 
              
            $resultado = $sql->get_result()->fetch_assoc();   
            if ($resultado) {
                return $resultado;
            }
            return false;

        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}