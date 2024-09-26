<?php
class Like{

    public $db_connect;

    public function __construct($db_connect){

        $this -> db_connect = $db_connect;
    }

    public function getLikes() {
        try {
            $query = $this->db_connect->prepare("SELECT * FROM likes");
            $query->execute();
            $result = $query->get_result();
            $likes = $result->fetch_all(MYSQLI_ASSOC);
            return $likes;
    
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function addLike($user_id, $post_id){
        try {
            $query = $this -> db_connect -> prepare("INSERT INTO likes (user_id, post_id) VALUES (?,?)");
            $query -> bind_param("ii", $user_id, $post_id);
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

    public function isUserParticipating($user_id, $post_id) {
        try {
            $query = $this->db_connect->prepare("SELECT * FROM likes WHERE user_id = ? AND post_id = ?");
            $query->bind_param("ii", $user_id, $post_id);
            $query->execute();
            $result = $query->get_result();
            return $result->num_rows > 0; // Si existe un registro, el usuario está participando
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}