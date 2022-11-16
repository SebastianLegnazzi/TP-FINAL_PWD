$(document).on('click', '#ver_productos_compras', function () {
    var fila = $(this).closest('tr');
    limpiarTabla();
    let timerInterval
    Swal.fire({
        title: 'Buscando Productos!',
        timer: 500,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
            }, 500)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
        }
    })
    $.ajax({
        type: "POST",
        url: '../Accion/accionVerProductosMisCompras.php',
        data: { idCompra: fila[0].children[4].innerHTML },

        success: function (respuesta) {
            var jsonData = JSON.parse(respuesta);
            // user is logged in successfully in the back-end
            // let's redirect
            if (Array.isArray(jsonData.success)) {
                document.getElementById("nombre_tabla").innerHTML = jsonData.success[0].Nombre;
                document.getElementById("detalle_tabla").innerHTML = jsonData.success[0].Descripcion;
                document.getElementById("precio_tabla").innerHTML = jsonData.success[0].Precio;
                document.getElementById("cantidad_tabla").innerHTML = jsonData.success[0].Cantidad;
                document.getElementById("urlImagen_tabla").src = jsonData.success[0].UrlImagen;
            }
            else if (jsonData.success == "0") {
                registerFailure();
            }
        }
    });
});


function registerFailure() {
    Swal.fire({
        icon: 'error',
        title: 'El producto no se pudo mostrar!',
        showConfirmButton: false,
        timer: 1500
    })
    setTimeout(function () {
        recargarPagina();
    }, 1500);
}

function limpiarTabla() {
    document.getElementById("nombre_tabla").innerHTML = "";
    document.getElementById("detalle_tabla").innerHTML = "";
    document.getElementById("precio_tabla").innerHTML = "";
    document.getElementById("cantidad_tabla").innerHTML = "";
    document.getElementById("urlImagen_tabla").src = "";
}
