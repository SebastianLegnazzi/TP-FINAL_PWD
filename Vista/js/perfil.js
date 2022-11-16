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
                        registerSuccess();
                    }
                    else if (jsonData.success == "0") {
                        registerFailure();
                    } 
                }
            });
        } else {
            forms[0].classList.add('was-validated');
        }
    });
});
