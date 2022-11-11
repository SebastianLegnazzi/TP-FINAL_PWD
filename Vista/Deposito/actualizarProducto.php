<?php
include_once("../estructura/Cabecera.php");
$metodo = data_submitted();
$objProducto = new C_Producto();
$arrayProductos = $objProducto->buscar($metodo);
?>
<div class="container-fluid">
    <div class="container col-md-5 text-white">
        <?php
        if ($arrayProductos != null) {
        ?>
            <form action="../Accion/accionActualizarProductos.php" method="get" class="needs-validation" novalidate>
                <div>
                    <label class="mt-3">ID: </label><input type="text" name="idProducto" id="idProducto" class="form-control" value="<?php echo $arrayProductos[0]->getIdProducto() ?>" disabled>
                    <div class="d-none">
                        <input type="text" name="idProducto" id="idProducto" class="form-control" value="<?php echo $arrayProductos[0]->getIdProducto() ?>">
                    </div>
                </div>
                <div>
                    <label class="mt-3">Nombre: </label><input type="text" name="proNombre" id="proNombre" class="form-control" required value="<?php echo $arrayProductos[0]->getNombre() ?>" pattern="[a-zA-Z]+">
                    <div class="invalid-feedback">
                        Porfavor ingrese un nombre valido!
                    </div>
                    <div class="valid-feedback">
                        Correcto!
                    </div>
                </div>
                <div>
                    <label class="mt-3">Detalle: </label><input type="password" name="proDetalle" id="proDetalle" class="form-control" required value="<?php echo $arrayProductos[0]->getDetalle() ?>">
                    <div class="invalid-feedback">
                        Porfavor ingrese una descripcion!
                    </div>
                    <div class="valid-feedback">
                        Correcto!
                    </div>
                </div>
                <div>
                    <label class="mt-3">Cantidad de Stock: </label><input type="number" name="proCantStock" id="proCantStock" class="form-control" required value="<?php echo $arrayProductos[0]->getCantStock() ?>">
                    <div class="invalid-feedback">
                        Porfavor ingrese una cantidad!
                    </div>
                    <div class="valid-feedback">
                        Correcto!
                    </div>
                </div>
                <div>
                    <label class="mt-3">Url Imagen: </label><input type="text" name="urlImagen" id="urlImagen" class="form-control" required value="<?php echo $arrayProductos[0]->getUrlImagen() ?>">
                    <div class="invalid-feedback">
                        Porfavor ingrese una url!
                    </div>
                    <div class="valid-feedback">
                        Correcto!
                    </div>
                </div>
                <div class="mt-2">
                    <a href="listaProductos.php" class="btn btn-dark">Volver</a>
                    <button type="submit" class="btn btn-dark">Modificar</button>
                </div>
            </form>
        <?php
        } else {
            echo ' <p class="lead text-danger">El producto no existe en la base de datos!</p>';
            echo '<a href="listaProductos.php" class="btn btn-dark">Volver</a>';
        }
        ?>

    </div>
</div>
<script src="../js/validarCamposVacios.js"></script>

<?php
include_once("../estructura/Pie.php");
?>