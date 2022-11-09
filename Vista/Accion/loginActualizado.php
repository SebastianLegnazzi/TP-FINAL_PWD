<?php
include_once("../estructura/Cabecera.php");
$datos=data_submitted();
$objUsuario=new C_Usuario();
$usuarioModificado=$objUsuario->modificacion($datos);
//esto da falso cuando no se pudo o cuando no se modifico el rol.VER
$rolAgregado=$objUsuario->agregarRolAdmin($datos);
echo json_encode($usuarioModificado);
echo json_encode($rolAgregado);
?>