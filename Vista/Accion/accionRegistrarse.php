<?php
include_once("../estructura/Cabecera.php");
$datos = data_submitted();
$objPersona = new C_Usuario();
$objCaptcha = new c_testCaptchas();
if ($objCaptcha->reCaptchav2($datos["g-recaptcha-response"])) {
    $datos["usPass"] = md5($datos["usPass"]);
    if ($objPersona->alta($datos)) {
?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'La cuenta se creo correctamente!',
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
        echo "la cuenta no pudo crearse";
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'La cuenta no se pudo crear en la base de datos!',
                showConfirmButton: false,
                timer: 1500
            })

            function redireccionarPagina() {
                location.href = "../sesion/registrarse.php"
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
            location.href = "../sesion/registrarse.php"
        }
        setTimeout("redireccionarPagina()", 1450);
    </script>
    <?php
}
?>