$(document).on('click', '.deshabilitar', function() {
    const form=$('form');
    mostrarAdvertencia(form);
}
)

function mostrarAdvertencia(form){
    Swal.fire({
        title: 'Realmente quiere deshabilitar el usuario?',
        showDenyButton: true,
        confirmButtonText: 'Si',
        denyButtonText: `Cancelar`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          deshabilitarUsuario(form);
        } else if (result.isDenied) {
          Swal.fire('El usuario no fue deshabilitado', '', 'info')
        }
      })
}

function deshabilitarUsuario(form){
    $.ajax({
        type: "POST",
        url: '../Accion/deshabilitarUsuario.php',
        data: form.serialize(),
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
}

function deshabilitarSuccess(){
    Swal.fire({
        icon: 'success',
        title: 'Se deshabilito el usuario correctamente!',
        showConfirmButton: false,
        timer: 1500
    })
    setTimeout(function(){
        location.reload();
    },1500);
}

function deshabilitarFailure(){
    Swal.fire({
        icon: 'error',
        title: 'No se pudo deshabilitar el usuario',
        showConfirmButton: false,
        timer: 1500
    })
}