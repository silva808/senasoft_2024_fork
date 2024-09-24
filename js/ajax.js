$(document).on('click', '.custom-btn-sesion', function(){
    $.ajax({
        url: '.././templates/login.html',
        type: 'post',
        success: function(data){
            $('.modal-content').html(data);
        }
    });
});