$(document).ready(function() {
    $('form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '../Accion/accionRegistrarse.php',
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
        title: 'La cuenta se creo correctamente!',
        showConfirmButton: false,
        timer: 1500
    })
    setTimeout("redireccionarIndexUser()", 1450);
}

function redireccionarIndexUser() {
    //location.href = "../paginas/index.php"
}

function registerFailure(){
    Swal.fire({
        icon: 'error',
        title: 'La cuenta no se pudo crear en la base de datos!',
        showConfirmButton: false,
        timer: 1500
    })
}

function captchaFailure(){
    Swal.fire({
        icon: 'error',
        title: 'Debe confirmar que usted no es un robot',
        showConfirmButton: false,
        timer: 1500
    })
}
