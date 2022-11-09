<?php
include_once("../estructura/Cabecera.php");
$datos = data_submitted();
$objCaptcha = new c_testCaptchas();
$objSesion = new C_Session();
if ($objCaptcha->mtCaptcha($datos["mtcaptcha-verifiedtoken"])) {
    $datos["usPass"] = md5($datos["usPass"]);
    if ($objSesion->valida($datos)) {
?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Se inicio sesion correctamente!',
                showConfirmButton: false,
                timer: 1500
            })

            function redireccionarPagina() {
                location.href = "../paginas/index.php"
            }
            setTimeout("redireccionarPagina()", 1450);
        </script>
    <?php
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'La contraseña y/o el usuario no coinciden!',
                showConfirmButton: false,
                timer: 1500
            })

            function redireccionarPagina() {
                location.href = "../sesion/iniciarSesion.php"
            }
            setTimeout("redireccionarPagina()", 1450);
        </script>
<?php
    }
} else {
    ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'El captcha no se realizo correctamente!',
            showConfirmButton: false,
            timer: 1500
        })

        function redireccionarPagina() {
            location.href = "../sesion/iniciarSesion.php"
        }
        setTimeout("redireccionarPagina()", 1450);
    </script>
<?php
}
?>