/**************************************/
/************* CARRITO ****************/
/**************************************/

function sumarCarrito() {
    let tabla, fila, celda0, celda1, celda2, celda3, celda4;
    tabla = document.getElementById("lista__carrito");
    fila = tabla.insertRow(tabla.rows.length);
    celda0 = fila.insertCell(0);
    celda1 = fila.insertCell(1);
    celda2 = fila.insertCell(2);
    celda3 = fila.insertCell(3);
    celda4 = fila.insertCell(4);
    celda0.innerHTML = "<img src='" + arrayDatosProducto[0] + "'>";
    celda1.innerHTML = arrayDatosProducto[1];
    celda2.innerHTML = arrayDatosProducto[2];
    celda3.innerHTML = arrayDatosProducto[3];
    celda4.innerHTML = "<a href='#' onclick='borrarProducto(this.parentNode.parentNode.rowIndex); contadorCarrito()'>Eliminar</a>";
    Swal.fire({
        icon: 'success',
        title: 'El producto se agrego al carrito correctamente!',
        showConfirmButton: false,
        timer: 1000
    })
    cerrarDetalle();
    sumCompra();
}

function borrarProducto(numero) {
    let tabla = document.getElementById("lista__carrito");
    tabla.deleteRow(numero);
    Swal.fire({
        icon: 'success',
        title: 'Producto eliminado!',
        showConfirmButton: false,
        timer: 1000
    })
    sumCompra();
}

function sumCompra() {
    let totalCompra, sumaTot, tabla
    tabla = document.getElementById("lista__carrito");
    totalCompra = document.getElementById("total-Compra");
    sumaTot = 0;
    for (i = 1; i < tabla.rows.length; i++) {
        sumaTot += parseInt(tabla.rows[i].cells[3].innerHTML);
    }
    totalCompra.innerHTML = "Precio Total: $ " + sumaTot;
}


/**************************************/
/************* DETALLE ****************/
/**************************************/
var arrayDatosProducto = [];

function verDetalle(datos) {
    let imagenInput, nombreInput, descripcionInput, precioInput;
    imagenInput = document.getElementById("foto__detalle");
    nombreInput = document.getElementById("nombre__detalle");
    descripcionInput = document.getElementById("descripcion__detalle");
    precioInput = document.getElementById("precio__detalle");
    imagenInput.src = datos.children[1].children[0].children[0].children[0].src;
    nombreInput.innerHTML = datos.children[1].children[0].children[1].childNodes[1].childNodes[0].nodeValue;
    descripcionInput.innerHTML = datos.children[1].children[0].children[1].childNodes[3].childNodes[0].nodeValue;
    precioInput.innerHTML = "Precio: $ " + datos.children[1].children[0].children[1].childNodes[5].childNodes[0].nodeValue;
}

/**************************************/
/************* FILTER *****************/
/**************************************/

function filtrar(textFilter) {
    let tarjetas;
    tarjetas = document.getElementsByClassName("tarjetas-productos");
    for (i = 0; i < tarjetas.length; i++) {
        console.log(tarjetas[i].textContent.toLocaleLowerCase().includes(textFilter.toLowerCase()))
        if (tarjetas[i].textContent.toLocaleLowerCase().includes(textFilter.toLowerCase())) {
            tarjetas[i].classList.remove("filter");
        } else {
            tarjetas[i].classList.add("filter");
        }
    }
}

/**************************************/
/************* COMPRAR ****************/
/**************************************/
function redireccionarPaginaInicio() {
    location.href = 'index.php'
}

function confirmarCompra() {
    let tabla = document.getElementById("lista__carrito");
    if (tabla.rows.length > 1) {
        if (localStorage.getItem("inicio") == "si") {
            Swal.fire({
                icon: 'success',
                title: 'Su compra fue confirmada correctamente!',
                showConfirmButton: false,
                timer: 1500
            })
            setTimeout("redireccionarPaginaInicio()", 1450);
        }else{
            Swal.fire({
                title: 'No tienes cuenta!',
                text: "Desea crear una?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
              }).then((result) => {
                if (result.isConfirmed) {
                    location.href= "registrarse.php"
                }
              })
        }
    } else {
        Swal.fire({
            icon: 'error',
            title: 'No hay elementos en el carrito!',
            showConfirmButton: false,
            timer: 1500
        })
    }
}

/**************************************/
/************* MODULOS ****************/
/**************************************/

function contadorCarrito() {
    let contador, carrito;
    contador = document.getElementById("contador__carrito");
    carrito = document.getElementById("lista__carrito");
    if (carrito.rows.length > 1) {
        contador.innerHTML = carrito.rows.length - 1
    } else {
        contador.innerHTML = ""
    }
}