$(document).ready(function() {
    $('#deshabilitar').onclick(function() {
        $.ajax({
            type: "POST",
            url: '../Accion/deshabilitarUsuario.php',
            data: $(this).serialize(),
            success: function(response){
                var jsonData = JSON.parse(response);
 
                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1"){
                    deshabilitarSuccess();
                }
                else if (jsonData.success == "0"){
                    deshabilitarFailure();
                }
           }
       });
     });
});