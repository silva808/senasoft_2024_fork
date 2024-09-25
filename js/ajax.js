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
            } else {
                // Si hubo un error o el usuario no existe
                $('#error').html(response);
            }
           },
       });
   });
});

// ajax para registrar un usuario
$(document).ready(function(){
    $('#form-register').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '../backend/process_info/createUser.php',
            type: 'post',
            data: $(this).serialize(),
            success: function(data){
             console.log("registro");
             console.log(data);
             //    if(data == 'Usuario no existe'){
             //        $('#error').html(data);
             //    }else{
             //        $('.modal-content').html(data);
             //    }
            }
        });
    });
 });
 
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