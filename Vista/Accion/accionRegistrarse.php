<?php
include_once("../../configuracion.php");
$datos = data_submitted();
$objPersona = new C_Usuario();
$objCaptcha = new c_testCaptchas();
if ($objCaptcha->reCaptchav2($datos["g-recaptcha-response"])) {
    if ($objPersona->alta($datos)) {
        echo "cuenta creada correctamente";
?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'La cuenta se creo correctamente!',
                showConfirmButton: false,
                timer: 1500
            })

            /* function redireccionarPagina() {
                location.href = "index.php"
            }
            setTimeout("redireccionarPagina()", 1450); */
        </script>
<?php
    } else {
        echo "la cuenta no pudo crearse";
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'La cuenta no se pudo crear en la base de datos!',
                showConfirmButton: false,
                timer: 1500
            })

            /* function redireccionarPagina() {
                location.href = "registrarse.php"
            }
            setTimeout("redireccionarPagina()", 1450); */
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

        /* function redireccionarPagina() {
            location.href = "registrarse.php"
        }
        setTimeout("redireccionarPagina()", 1450); */
    </script>
    <?php
}
?>