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
            $Sql = $this->db_connect->prepare(
                "SELECT r.date_final, u.name, SUM(r.final_price) AS total
                FROM rentals r
                JOIN users u ON r.user_id = u.id
                WHERE r.final_price IS NOT NULL 
                AND r.final_price != ''
                AND MONTH(r.date_final) = ?
                AND YEAR(r.date_final) = ?
                GROUP BY u.name"
            );
            
            // Vinculación de parámetros
            $Sql->bind_param('ii', $mesActual, $anioActual);
        
            // Ejecutar la consulta
            $Sql->execute();
        
            // Obtener los resultados
            $Resultado = $Sql->get_result();
        
            // Verificar si se obtuvo algún resultado
            if ($Resultado->num_rows > 0) {
                // Obtener todos los resultados como un array asociativo
                return $Resultado->fetch_all(MYSQLI_ASSOC);
            }
            return [];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function rentedBikeByUser($user_id) {
        try {
            // Realizar INNER JOIN con la tabla bikes y users
            $query = $this->db_connect->prepare("SELECT rentals.*, bikes.*, users.name, users.email, users.phone_number 
            FROM rentals 
            INNER JOIN bikes ON rentals.bike_id = bikes.id 
            INNER JOIN users ON rentals.user_id = users.id 
            WHERE rentals.user_id = ? AND rentals.date_final IS NULL
            ");

            $query->bind_param("i", $user_id); // Solo necesitas el user_id aquí
            $query->execute();
    
            $result = $query->get_result();
            $rentals = $result->fetch_all(MYSQLI_ASSOC);
    
            return $rentals;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
    

      // Método para guardar un alquiler
      public function saveRental($bike_id, $user_id, $origin_start, $final_destination, $start_date, $total_cost_initial) {
        try {
            $query = $this->db_connect->prepare("INSERT INTO rentals (bike_id, user_id, origin_start, final_destination, date_started, initial_price) VALUES (?, ?, ?, ?, ?, ?)");
            $query->bind_param("iisssd", $bike_id, $user_id, $origin_start, $final_destination, $start_date, $total_cost_initial);

            if ($query->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Error al guardar el alquiler: " . $e->getMessage();
            return false;
        }
    }

    // Metodo para finalizar el alquiler actualizando los campos faltantes
    public function finalizeRental($bike_id, $user_id, $current_date) {
        try {
            // Preparar la consulta para actualizar la fecha de finalización
            $query = $this->db_connect->prepare("
                UPDATE rentals 
                SET date_final = ? 
                WHERE bike_id = ? AND user_id = ? AND date_final IS NULL
            ");
            $query->bind_param("sii", $current_date, $bike_id, $user_id); // Asignar los valores
    
            if ($query->execute()) {
                return true; // Actualización exitosa
            } else {
                return false; // Error en la actualización
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false; // Devolver false si ocurre un error
        }
    }
    
}