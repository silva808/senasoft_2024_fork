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

    public function SumarPreciosRentalsMesActual() {
        try {
            // Obtener el mes y año actual
            $mesActual = date('m');
            $anioActual = date('Y');
            
            // Consulta preparada para sumar los precios del mes actual, excluyendo valores nulos o vacíos
            $Sql = $this->Conexion->prepare(
                "SELECT SUM(final_price) AS total
                 FROM rentals
                 WHERE final_price IS NOT NULL 
                   AND final_price != ''
                   AND MONTH(date_final) = ?
                   AND YEAR(date_final) = ?"
            );
            
            // Vinculación de parámetros
            $Sql->bind_param('ii', $mesActual, $anioActual);
        
            // Ejecutar la consulta
            $Sql->execute();
        
            // Obtener los resultados
            $Resultado = $Sql->get_result();
        
            // Verificar si se obtuvo algún resultado
            if ($Resultado->num_rows > 0) {
                // Obtener el total de la suma
                $Resultado = $Resultado->fetch_assoc();
                return $Resultado['total'];
            }
            return 0; // Si no hay resultados, devolver 0
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function rentedBikeByUser($user_id) {
        try {
            $query = $this->db_connect->prepare("SELECT * FROM rentals INNER JOIN bikes ON rentals.bike_id = bikes.id WHERE rentals.user_id = ? AND rentals.date_started IS NULL");
            $query->bind_param("ii", $bike_id, $user_id);
            $query->execute();
            $result = $query->get_result();
            $rentals = $result->fetch_all(MYSQLI_ASSOC);
            return $rentals; // No necesitas el close() aquí
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
}