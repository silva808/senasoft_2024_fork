$(document).ready(function(){   
    $('#form_bike').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '../backend/process_info/add_bike.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response){
                console.log(response);
            }
        })
    })

});