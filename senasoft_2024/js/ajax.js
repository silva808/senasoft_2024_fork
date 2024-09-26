// para manejar los modales o notificaciones esta en espera 
$(document).on('click', '.custom-btn-sesion', function(){
    $.ajax({
        url: '.././templates/login.html',
        type: 'post',
        success: function(data){
            $('.modal-content').html(data);
        }
    });
});

// validar usuario
$(document).ready(function(){
   $('#form-login').on('submit', function(e){
       e.preventDefault();
       $.ajax({
           url: '../backend/process_info/validateUser.php',
           type: 'post',
           data: $(this).serialize(),
           success: function(response){
            console.log(response);

            if (response === 'admin') {
                // Si el servidor indica que es un administrador
                window.location.href = '../pages/admin.php';
            } else if (response === 'Aprendiz') {
                console.log("caray");

                // Si el servidor indica que es un usuario normal
                window.location.href = '../pages/aprendiz.php';
            } else if (response === 'Usuario no existe') {
                $('#mensajeError').show(); 
                setTimeout(function() {
                    $('#mensajeError').hide(); 
                }, 3000); 
            }
            else {
                // Si hubo un error o el usuario no existe
                $('#error').html(response);
            }
           },
       });
   });
});

// ajax para registrar un usuario
// $(document).ready(function(){
//     $('#form-register').on('submit', function(e){
//         e.preventDefault();
//         $.ajax({
//             url: '../backend/process_info/createUser.php',
//             type: 'post',
//             data: $(this).serialize(),
//             success: function(data){
//              console.log("registro");
//              console.log(data);
//              //    if(data == 'Usuario no existe'){
//              //        $('#error').html(data);
//              //    }else{
//              //        $('.modal-content').html(data);
//              //    }
//             }
//         });
//     });
//  });
 
//  ajax para cerrar sesión 
 $(document).on('click', '#sing-out', function(){
    $.ajax({
        url: '../backend/process_info/sing_out.php',
        type: 'post',
        success: function(data){
            if(data){
                window.location.href='../index.php';
            }
        }
    });
});
 

// $(document).on('click', '', function(){
//     $.ajax({
//         url: '../backend/process_info/alquilar.php',
//         type: 'post',
//         success: function(data){
//             console.log(data);
//         }
//     });
// });

// PARTICIPACION EN EVENTO
$(document).ready(function() {
    $('.participate').click(function(event) {
        event.preventDefault(); // Evitar el comportamiento por defecto del enlace

        // Obtener los valores de user_id y post_id de los atributos data
        var userId = $(this).data('user-id');
        var postId = $(this).data('post-id');
        var $button = $(this); // Guarda referencia al botón

        // Crear un objeto de datos
        var formData = {
            user_id: userId,
            post_id: postId
        };

        // Hacer la petición AJAX
        $.ajax({
            url: '../backend/process_info/add_like.php', // Ajusta esta ruta según sea necesario
            type: 'POST',
            data: formData, // Enviamos el objeto formData
            success: function(response) {
                let res = JSON.parse(response);
                if (res.status === 'success') {
                    // Cambiar el texto del botón a "Participando" y el color a gris
                    $button.text('Participando');
                    $button.removeClass('btn-green').addClass('btn-gray');
                    $button.prop('disabled', true);
                } else {
                    alert('Error al añadir like.');
                }
            },
            error: function(xhr, status, error) {
                alert('Error al añadir like: ' + error);
            }
        });
    });
});


// CREAR POST
$(document).ready(function() {
    $('#publish_post').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '../backend/process_info/create_post.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(data) {
                console.log(data);
            }
        });
    });
});
// ajax para agregar alquiler de bicicleta
// validar usuario
$(document).ready(function(){
    $('#rentalForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '../backend/process_info/addrentail.php',
            type: 'post',
            data: $(this).serialize(),
            success: function(response){
                if(response){
                    console.log(response);
                    console.log('funciono');
                }
            }
        });
    });
 })
