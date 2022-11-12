<?php
include_once("../estructura/Cabecera.php");
?>

<div class="container-fluid">
    <div class="container-md w-50">
        <form action="../Accion/accionCargarProducto.php" method="post" class="needs-validation row text-white my-4 justify-content-center" novalidate>
            <div class="col-lg-7 col-12 mt-2">
                <label>Nombre: </label><input type="text" pattern="[a-zA-Z]+\s?[a-zA-Z]*\s?[a-zA-Z]*\s?[a-zA-Z]*\s?[a-zA-Z]*" name="proNombre" minlength="3" id="input_nombre" class="form-control text" required>
                <div class="invalid-feedback">
                    Por favor ingrese un nombre valido! No se aceptan numeros y tiene que ser mayor a 3 letras.
                </div>
                <div class="valid-feedback">
                    Correcto!
                </div>
            </div>
            <div class="col-lg-7 col-12 mt-2">
                <label>Detalle: </label><input type="text" name="proDetalle" minlength="3" class="form-control text" required>
                <div class="invalid-feedback">
                    Por favor ingrese algún detalle.
                </div>
                <div class="valid-feedback">
                    Correcto!
                </div>
            </div>
            <div class="col-lg-7 col-12 mt-2">
                <label>Stock del Producto: </label><input type="number" name="proCantStock" id="input_stock" class="form-control" required>
                <div class="invalid-feedback">
                    Ingrese una cantidad válida!
                </div>
                <div class="valid-feedback password-correcta">
                    Correcto!
                </div>
            </div>
            <div class="col-lg-7 col-12 mt-2">
                <label>Repetir la Contraseña: </label><input type="password" id="input_contraseñaRep" class="form-control" required>
                <div class="invalid-feedback">
                    Ingrese una contraseña!
                </div>
                <div class="invalid-password" style="display: none; color: red;">
                    Las contraseñas no coinciden
                </div>
                <div class="valid-feedback password-correcta">
                    Correcto!
                </div>
            </div>
            <input class="btn btn-dark mt-2 col-8" type="submit" name="boton_enviar"  id="boton_enviar" value="REGISTRARSE">
            <a href="IniciarSesion.php" class="link-warning mt-4">Ya tengo cuenta</a>
            </div>
        </form>
        
    </div>
</div>
<script src="js/validarCamposVacios.js"></script>

<?php
include_once("../estructura/Pie.php");
?>