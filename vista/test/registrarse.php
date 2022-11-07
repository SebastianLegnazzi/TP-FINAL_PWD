<?php
include_once("../estructura/Cabecera.php");
?>
<script src="../js/validarContraseñaIguales.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer> </script>
<div class="container-fluid">
    <div class="container-md w-50">
        <form action="accionRegistrarse.php" method="post" class="needs-validation row text-white my-4 justify-content-center" novalidate>
            <div class="col-lg-7 col-12 mt-2">
                <label>Nombre: </label><input type="text" pattern="[a-zA-Z]+\s?[a-zA-Z]*\s?[a-zA-Z]*\s?[a-zA-Z]*\s?[a-zA-Z]*" name="usNombre" minlength="3" id="input_nombre" class="form-control text" required>
                <div class="invalid-feedback">
                    Porfavor ingrese un nombre valido! No se aceptan numeros y tiene que ser mayor a 3 letras.
                </div>
                <div class="valid-feedback">
                    Correcto!
                </div>
            </div>
            <div class="col-lg-7 col-12 mt-2">
                <label>Mail: </label><input type="text" pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*\.([a-z]{3})(\.[a-z]{2})*$" name="usMail" minlength="3" class="form-control text" required>
                <div class="invalid-feedback">
                    Porfavor ingrese un email válido.
                </div>
                <div class="valid-feedback">
                    Correcto!
                </div>
            </div>
            <div class="col-lg-7 col-12 mt-2">
                <label>Contraseña: </label><input type="password" name="usPass" id="input_contraseña" class="form-control" required>
                <div class="invalid-feedback">
                    Ingrese una contraseña!
                </div>
                <div class="invalid-password" style="display: none;">
                    Las contraseñas no coinciden
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
            <div class="row text-center mx-auto justify-content-center">
                <div class="col-6 text-center mx-auto mx-5">
                <div style="" class="g-recaptcha m-4" data-sitekey="6Lf95XwiAAAAANd2Ey0ue87QCWiiD6_A17eONhTX"></div>
                </div>
            <input class="btn btn-dark mt-2 col-8" type="submit" name="boton_enviar" onclick="return verificarContraseñaIgual(document.getElementById('input_contraseña'), document.getElementById('input_contraseñaRep'))"  id="boton_enviar" value="REGISTRARSE">
            <a href="IniciarSesion.php" class="link-warning mt-4">Ya tengo cuenta</a>
            </div>
        </form>
        
    </div>
</div>
<script src="../js/validarCamposVacios.js"></script>
<?php
include_once("../estructura/Pie.php")
?>