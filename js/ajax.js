$(document).on('click', '.custom-btn-sesion', function(){
    $.ajax({
        url: '.././templates/login.html',
        type: 'post',
        success: function(data){
            $('.modal-content').html(data);
        }
    });
});

$(document).ready(function(){
   $('#form-login').on('submit', function(e){
       e.preventDefault();
       $.ajax({
           url: '../backend/process_info/validateUser.php',
           type: 'post',
           data: $(this).serialize(),
           success: function(data){
            console.log("mirar datos");
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