<?php

session_start();
require_once '../config/db_connection.php';
include_once '../class/Post.php';

$postObj = new Post($conn);

$title = $_POST['event_title'];
$description = $_POST['event_description'];
$date = $_POST['event_date'];
$user_id = $_SESSION['idUser'];

if ($title && $description && $date && $user_id) {
    $postObj->addPost($title, $description, $date, $user_id);
    echo "Post creado exitosamente";
} else {
    echo "Error al crear el post";
    print_r($_POST);
}