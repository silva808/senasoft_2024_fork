<?php
class Post{

    public $db_connect;

    public function __construct($db_connect){

        $this -> db_connect = $db_connect;
    }

    public function getPosts() {
        try {
            $query = $this->db_connect->prepare("SELECT * FROM posts");
            $query->execute();
            $result = $query->get_result();
            $posts = $result->fetch_all(MYSQLI_ASSOC);
            return $posts;
    
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function addPost($title, $description, $date, $user_id){
        try {
            $query = $this -> db_connect -> prepare("INSERT INTO posts (title, description, date, user_id) VALUES (?,?,?,?)");
            $query -> bind_param("sssi", $title, $description, $date, $user_id);
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