<?php
include_once("../../configuracion.php");

$datos=data_submitted();
$objUsuario=new C_Usuario();
$usuarioModificado=$objUsuario->deshabilitar($datos);
if($usuarioModificado){
    echo json_encode(array('success'=>1));
}else{
    echo json_encode(array('success'=>0));
}
?>