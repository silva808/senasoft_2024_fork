<?php
class Post{

    public $db_connect;

    public function __construct($db_connect){

        $this -> db_connect = $db_connect;
    }
}