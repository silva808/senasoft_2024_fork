<?php
session_start(); // Asegúrate de que la sesión está iniciada
require_once '../config/db_connection.php'; // Asegúrate de ajustar la ruta según tu estructura de carpetas
include_once '../class/Like.php'; // Ajusta la ruta según sea necesario

// Instanciar la clase Like
$likeObj = new Like($conn);

// Validar la entrada
$user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
$post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);

if ($user_id && $post_id) {
    // Llamar al método addLike para insertar el like en la base de datos
    if ($likeObj->addLike($user_id, $post_id)) {
        // Devolver una respuesta JSON de éxito
        echo json_encode(['status' => 'success']);
    } else {
        // Devolver una respuesta JSON de error
        echo json_encode(['status' => 'error', 'message' => 'Error al añadir el like.']);
    }
} else {
    // Responder con error si los datos son inválidos
    echo json_encode(['status' => 'error', 'message' => 'Datos inválidos.']);
}
