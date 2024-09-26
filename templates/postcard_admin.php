<?php
require_once '../backend/config/db_connection.php';
include_once '../backend/class/Post.php';
include_once '../backend/class/Like.php';

// Instantiate the Post class
$postObj = new Post($conn);
$likeObj = new Like($conn);

// Obtenemos la lista de posts y el user_id de la sesión
$posts = $postObj->getPosts();
$user_id = $_SESSION['idUser']; // Asegúrate de que el user_id esté disponible en la sesión

if ($posts) {

    foreach ($posts as $post) {
            echo '
            <div class="col-md-4 col-sm-6 d-flex justify-content-center">
                <div class="card event-card">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($post["title"]) . '</h5>
                        <p class="card-text">' . htmlspecialchars($post["description"]) . '</p>
                        <p class="event-date">Fecha: ' . htmlspecialchars($post["date"]) . '</p>
                    </div>
                </div>
            </div>
            ';
        }
    }
else {
    echo '<p>No hay actividades disponibles.</p>';
}
