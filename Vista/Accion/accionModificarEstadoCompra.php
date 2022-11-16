<?php
include_once("../../configuracion.php");

/**************************************/
/********* PROGRAMA GENERAL ***********/
/**************************************/
$datos = data_submitted();
if(modificarEstadoCompra($datos)){
    echo json_encode(array('success'=>1));
}else{
    echo json_encode(array('success'=>0));

}

/**************************************/
/**************** MODULOS *************/
/**************************************/

function modificarEstadoCompra($datos){
    $objCompraEstado = new C_CompraEstado();
    $resp = false;
    $paramCompraEstado = null;
    $fechaFin = null;
    if($datos["idCompraEstadoTipo"] == 4){
        $fecha = new DateTime();
        $fechaFin = $fecha->format('Y-m-d H:i:s');
    }
    $fecha = new DateTime();
    $fechaIni = $fecha->format('Y-m-d H:i:s');
    $paramCompraEstado = [
        "idCompraEstado" => $datos["idCompraEstado"],
        "idCompra" => $datos["idCompra"],
        "idCompraEstadoTipo" => $datos["idCompraEstadoTipo"],
        "ceFechaIni" => $fechaIni,
        "ceFechaFin" => $fechaFin,
    ];
    if($objCompraEstado->modificacion($paramCompraEstado)){
        $resp = true;
    }
    return $resp;
}
