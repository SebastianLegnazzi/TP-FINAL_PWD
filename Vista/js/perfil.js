$(document).on('click', '#boton_editarDatos', function() {

    document.getElementById('editarDatos').classList.remove('d-none');

});

$(document).on('click', '#boton_contra', function() {

    document.getElementById('editarDatos').classList.add('d-none');

});


$(document).on('click', '#boton_cancelar', function() {

    document.getElementById('editarDatos').classList.add('d-none');

});

$(document).ready(function () {
    $('form').submit(function (e) {
        e.preventDefault();
        const forms = document.querySelectorAll('.needs-validation');
        if (forms[0].checkValidity()) {
            
            
            $.ajax({
                type: "POST",
                url: '../Accion/accionActualizarPerfil.php',
                data: $(this).serialize(),
                success: function (response) {
                    var jsonData = JSON.parse(response);

                    if (jsonData.success == "1") {
                        success();
                    }
                    else if (jsonData.success == "0") {
                        failure();
                    } 
                }
            });
        } else {
            forms[0].classList.add('was-validated');
        }
    });
});


function success() {
    Swal.fire({
        icon: 'success',
        title: 'Tu email se ha modificado! 😉',
        showConfirmButton: false,
        timer: 1500
    })
    setTimeout(function () {
        location.reload();
    }, 1500);
}

function failure() {
    Swal.fire({
        icon: 'error',
        title: 'No se ha podido modificar el email! 😥',
        showConfirmButton: false,
        timer: 1500
    })
    setTimeout(function () {
        location.reload();
    }, 1500);
}


