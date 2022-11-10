$(document).ready(function() {
    $('form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '../Accion/accionIniciarSesion.php',
            data: $(this).serialize(),
            success: function(response){
                var jsonData = JSON.parse(response);
 
                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1"){
                    registerSuccess();
                }
                else if (jsonData.success == "0"){
                    registerFailure();
                }else if(jsonData.success == "-1"){
                    captchaFailure();
                }
           }
       });
     });
});

function registerSuccess(){
    Swal.fire({
        icon: 'success',
        title: 'Se inicio sesion correctamente!',
        showConfirmButton: false,
        timer: 1500
    })
    setTimeout("redireccionarIndex()", 1450);
}


function redireccionarIndex() {
    location.href = "../paginas/index.php"
}

function registerFailure(){
    Swal.fire({
        icon: 'error',
        title: 'La contraseña y/o el usuario no coinciden!',
        showConfirmButton: false,
        timer: 1500
    })
    location.reload();
}

function captchaFailure(){
    Swal.fire({
        icon: 'error',
        title: 'El captcha no se realizo correctamente!',
        showConfirmButton: false,
        timer: 1500
    })
    location.reload();
}