var valorEstadoCompra
$(document).on('click', '#editar_estado', function () {
    var fila = $(this).closest('tr');
    Swal.fire({
        title: 'Elija el estado de la compra',
        input: 'select',
        inputOptions: {
          'Estados': {
            3: 'Aceptada',
            4: 'Enviada',
            5: 'Cancelada',
          },
        },
        inputPlaceholder: 'Selecciona el estado de la compra',
        showCancelButton: true,
        inputValidator: (value) => {
            valorEstadoCompra = value;
            enviarConsulta(fila)
        }
      })
});

function enviarConsulta(fila){
    $.ajax({
        type: "POST",
        url: '../Accion/accionModificarEstadoCompra.php',
        data: { 
            idCompraEstado: fila[0].children[0].innerHTML,
            idCompra: fila[0].children[4].innerHTML,
            idCompraEstadoTipo: valorEstadoCompra,
        },

        success: function (respuesta) {
            var jsonData = JSON.parse(respuesta);
            // user is logged in successfully in the back-end
            // let's redirect
            if (jsonData.success == "1") {
                estadoAcpetada()
            }
            else if (jsonData.success == "0") {
                estadoError();
            }
        }
    });
}


function estadoAcpetada() {
    Swal.fire({
        icon: 'success',
        title: 'El estado de la compra se modifico correctamente!',
        showConfirmButton: false,
        timer: 1000
    })
    setTimeout(function () {
        recargarPagina();
    }, 800);
}

function estadoError() {
    Swal.fire({
        icon: 'error',
        title: 'El estado de la compra no se pudo modificar!',
        showConfirmButton: false,
        timer: 1000
    })
    setTimeout(function () {
        recargarPagina();
    }, 800);
}

function recargarPagina() {
    location.reload();
}