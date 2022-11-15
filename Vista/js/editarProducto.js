$(document).on('click', '.edit', function() {

    var fila = $(this).closest('tr');

    var id = fila[0].children[0].innerHTML;
    var nombre = fila[0].children[1].innerHTML;
    var detalle = fila[0].children[2].innerHTML;
    var stock = fila[0].children[3].innerHTML;
    var urlImg = fila[0].children[4].innerHTML;
    var precio = fila[0].children[5].innerHTML;

    var inputs = document.getElementById('form-editar').getElementsByTagName('input');
    inputs[0].value = id;
    inputs[1].value = nombre;
    inputs[2].value = detalle;
    inputs[3].value = stock;
    inputs[4].value = urlImg;
    inputs[5].value = precio;
});

$(document).ready(function () {
    $('form').submit(function (e) {
        e.preventDefault();
        const forms = document.querySelectorAll('.needs-validation');
        if (forms[0].checkValidity()) {
            
            
            $.ajax({
                type: "POST",
                url: '../Accion/accionActualizarProductos.php',
                data: $(this).serialize(),
                success: function (response) {
                    var jsonData = JSON.parse(response);

                    // user is logged in successfully in the back-end
                    // let's redirect
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


function registerSuccess() {
    Swal.fire({
        icon: 'success',
        title: 'El producto se ha modificado con exito!',
        showConfirmButton: false,
        timer: 1500
    })
    setTimeout(function () {
        recargarPagina();
    }, 1500);
}

function registerFailure() {
    Swal.fire({
        icon: 'error',
        title: 'No se ha podido modificar el producto!',
        showConfirmButton: false,
        timer: 1500
    })
    setTimeout(function () {
        recargarPagina();
    }, 1500);
}

function recargarPagina() {
    location.reload();
}
