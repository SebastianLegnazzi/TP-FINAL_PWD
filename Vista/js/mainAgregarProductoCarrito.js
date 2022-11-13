$(document).ready(function () {
    $('form').submit(function (e) {
        e.preventDefault();
        const forms = document.querySelectorAll('.needs-validation');
        if (forms[0].checkValidity()) {
            $.ajax({
                type: "POST",
                url: '../Accion/accionCargarProductoCarrito.php',
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
                    } else if (jsonData.success == "-1") {
                        captchaFailure();
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
        title: 'La cuenta se creo correctamente!',
        showConfirmButton: false,
        timer: 1500
    })
    setTimeout(function () {
        redireccionarIndexUser();
    }, 1500);
}

function redireccionarIndexUser() {
    //location.href = "../paginas/index.php"
}

function registerFailure() {
    Swal.fire({
        icon: 'error',
        title: 'La cuenta no se pudo crear en la base de datos!',
        showConfirmButton: false,
        timer: 1500
    })
    setTimeout(function () {
        recargarPagina();
    }, 1500);
}

function captchaFailure() {
    Swal.fire({
        icon: 'error',
        title: 'El captcha no se realizo correctamente!',
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
