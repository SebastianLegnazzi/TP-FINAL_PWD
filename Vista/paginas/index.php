<?php
include_once("../estructura/Cabecera.php");
?>
<div class="">
    <div class="container">
        <h1 class="text-center text-white">Productos</h1>
        <hr>
    </div>
    <div id="detalle" class="text-white">
        <div id="detalle__content" class="row">
            <div id="content__foto__detalle" class="col-md-3">
                <img id="foto__detalle" class="img-thumbnail" src="" alt="">
            </div>
            <div id="content__info__detalle" class="col">
                <h3 id="nombre__detalle"></h3>
                <p id="descripcion__detalle"></p>
            </div>
        </div>
        <div id="content__precio__detalle">
            <p id="precio__detalle"></p>
        </div>
        <div class="content__botones mb-4">
            <button class="btn btn-success me-2" id="detalle__agregar__carrito" onclick="sumarCarrito(); contadorCarrito()">Agregar al Carrito</button>
            <button class="btn btn-danger" id="detalle__cerrar" onclick="cerrarDetalle()">Cerrar</button>
        </div>
    </div>



    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Detalle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detalle">
                    <div id="detalle__content" class="row">
                        <div id="content__foto__detalle" class="col-md-3">
                            <img id="foto__detalle" class="img-thumbnail" src="" alt="">
                        </div>
                        <div id="content__info__detalle" class="col">
                            <h3 id="nombre__detalle"></h3>
                            <p id="descripcion__detalle"></p>
                        </div>
                    </div>
                    <div id="content__precio__detalle">
                        <p id="precio__detalle"></p>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <div id="carrito">
        <div id="carrito__content">
            <div id="productos__carrito">
                <table id="lista__carrito">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <span id="total-Compra"></span>
            </div>
        </div>
        <div class="content__botones">
            <button class="btn btn-success me-2" id="detalle__comprar__carrito" onclick="confirmarCompra()">Comprar</button>
            <button class="btn btn-danger" id="detalle__cerrar__carrito" onclick="cerrarCarrito()">Cerrar</button>
        </div>
    </div>
    <div id="head__productos" class="container">
        <div id="content__filter">
            <input type="text" name="filtrador" id="filtrador" placeholder="Buscador" onkeyup="filtrar(this.value)">
        </div>
        <div id="content__carrito" onclick="abrirCarrito()">
            <p id="contador__carrito"></p>
            <img id="logo-carrito" src="../img/carritoCompra.png" alt="Logo de Carrito">
        </div>
    </div>
    <?php
    $objProducto = new C_Producto;
    $arrayProdcutos = $objProducto->buscar();
    if ($arrayProdcutos != null) {
        foreach ($arrayProdcutos as $producto) {
            echo '
        <div id="content__productos">
            <div class="tarjetas-productos">
                <a class="link-light" data-bs-toggle="modal" href="#exampleModalToggle" role="button">
                    <div class="tarjeta-producto__imagen">
                        <img class="foto__producto" src="' . $producto->getUrlImagen() . '" alt="">
                    </div>
                    <div class="tarjeta-producto__info">
                        <p class="nombre__producto">' . $producto->getNombre() . '</p>
                        <span class="descripcion__producto">' . $producto->getDetalle() . '</span>
                        <span class="precio__producto">' . $producto->getIdProducto() . '</span>
                    </div>
                </a>
            </div>
        </div>
        ';
        }
    }else{
        echo "<h2 class='text-warning text-center'> No se encuentran productos cargados!</h2>";
    }
    ?>
</div>
<?php
include_once("../estructura/Pie.php")
?>