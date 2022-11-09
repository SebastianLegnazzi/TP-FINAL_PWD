<script src="../js/iniciarSesion.js"></script>
<?php
include_once("../../configuracion.php");
$datos= data_submitted();
$objCaptcha = new c_testCaptchas();
$objSesion=new C_Session();
if ($objCaptcha->mtCaptcha($datos["mtcaptcha-verifiedtoken"])) {
        if($objSesion->valida($datos)){
            $objSesion->iniciar();
            //header('Location:paginaSegura.php');
            echo "Iniciaste sesion correctamente!";
        }else{
        echo "Error al iniciar sesion!"; 
        }
?>
    <script>
        comprobarCuenta();
    </script>
<?php
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
            location.href = "IniciarSesion.php"
        }
        setTimeout("redireccionarPagina()", 1450); */
    </script>
<?php
}
?>