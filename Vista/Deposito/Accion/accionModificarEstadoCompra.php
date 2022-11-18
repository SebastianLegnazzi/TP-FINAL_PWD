<?php
include_once("../../../configuracion.php");

/**************************************/
/********* PROGRAMA GENERAL ***********/
/**************************************/
$datos = data_submitted();
if (modificarEstadoCompra($datos)) {
    echo json_encode(array('success' => 1));
} else {
    echo json_encode(array('success' => 0));
}

/**************************************/
/**************** MODULOS *************/
/**************************************/

function modificarEstadoCompra($datos)
{
    $objCompraEstado = new C_CompraEstado();
    $resp = false;
    $paramCompraEstadoAnterior = null;
    $paramCompraEstadoNuevo = null;
    $fecha = new DateTime();
    $fechaHoy = $fecha->format('Y-m-d H:i:s');
    $paramCompraEstadoAnterior = [
        "idCompraEstado" => $datos["idCompraEstado"],
        "idCompra" => $datos["idCompra"],
        "idCompraEstadoTipo" => $datos["idCompraEstadoTipoAnterior"],
        "ceFechaIni" => $datos["ceFechaIni"],
        "ceFechaFin" => $fechaHoy,
    ];
    $paramCompraEstadoNuevo = [
        "idCompraEstado" => $datos["idCompraEstado"],
        "idCompra" => $datos["idCompra"],
        "idCompraEstadoTipo" => $datos["idCompraEstadoTipoActualizado"],
        "ceFechaIni" => $fechaHoy,
        "ceFechaFin" => null,
    ];
    if ($objCompraEstado->modificacion($paramCompraEstadoAnterior) && $objCompraEstado->alta($paramCompraEstadoNuevo)) {
        $resp = true;
    }
    return $resp;
}
