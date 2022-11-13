

function registerSuccess() {
    Swal.fire({
        icon: 'success',
        title: 'El producto se ha eliminado correctamente!',
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
        title: 'No se ha podido eliminar el producto!',
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

function seguroEliminar(){
Swal.fire({
    title: 'Estás seguro de que desea eliminar este producto?',
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: 'Eliminar',
    denyButtonText: 'Cancelar',
  
}).then((result) => {
   
    if (result.isConfirmed) {
      Swal.fire('Saved!', '', 'success')
    
    } else if (result.isDenied) {
    
        Swal.fire('Changes are not saved', '', 'info')
    }
  })

}

$(document).on('click', '.remove', function() {

    var fila = $(this).closest('tr');
    var img = fila[0].children[4].innerHTML;

    Swal.fire({
        title: '¿Estás seguro de que desea eliminar este producto?',
        imageUrl: img,
        showDenyButton: true,
        confirmButtonText: 'Eliminar',
        denyButtonText: 'Cancelar',
        
    }).then((result) => {
       
        if (result.isConfirmed) {
            
            eliminar(fila);
        
        } else if (result.isDenied) {
        
            
        }
      })
    

});

function eliminar(fila){
    
    var idProducto = fila[0].children[0].innerHTML;
    console.log(idProducto);
    
    $.ajax({
        type: "POST",
        url: '../Accion/accionEliminarProducto.php',
        data: {idProducto:idProducto},
        
        success: function (respuesta) {
            var jsonData = JSON.parse(respuesta);

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

};