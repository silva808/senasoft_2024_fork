<?php
class User{

    public $db_connect;

    public function __construct($db_connect){

        $this -> db_connect = $db_connect;
    }

    public function getUser($id){
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this -> db_connect -> prepare($sql);
        $stmt -> bind_param("i", $id);
        $stmt -> execute();
        $result = $stmt -> get_result();
        $row = $result -> fetch_assoc();
        return $row;
    }

    public function validateUser($id, $email, $password){
        $sql = "SELECT * FROM users WHERE id = ? AND email = ? AND password = ?";
        $stmt = $this -> db_connect -> prepare($sql);
        $stmt -> bind_param("iss", $id, $email, $password);
        $stmt -> execute();
        if($stmt -> get_result() -> num_rows > 0){
            return true;
        }else{
            return false;
        }
    }
    public createUser($name, $email, $phone_number, $password, $economic_id){
        $sql = "INSERT INTO users (name, email, phone_number, password, economic_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this -> db_connect -> prepare($sql);
        $stmt -> bind_param("ssssi", $name, $email, $phone_number, $password, $economic_id);
        $stmt -> execute();
        return true;
    }
}