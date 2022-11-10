<?php
include_once("../../configuracion.php");
$datos = data_submitted();
$objCaptcha = new c_testCaptchas();
$objSesion = new C_Session();
if ($objCaptcha->mtCaptcha($datos["mtcaptcha-verifiedtoken"])) {
    $datos["usPass"] = md5($datos["usPass"]);
    if ($objSesion->valida($datos)) {
        echo json_encode(array('success'=>1));
    } else {
        echo json_encode(array('success'=>0));
    }
} else {
    echo json_encode(array('success'=>-1));
}
?>