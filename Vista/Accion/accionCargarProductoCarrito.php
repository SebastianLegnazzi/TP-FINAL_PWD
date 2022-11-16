<?php
include_once("../../configuracion.php");

/**************************************/
/********* PROGRAMA GENERAL ***********/
/**************************************/
$datos = data_submitted();
$objCompraEstadoInciada = null;
$arrayCompras = null;
$objSesion = new C_Session();
$objUsuario = $objSesion->getUsuario();
$idUsuario["idUsuario"] = $objUsuario->getIdUsuario();
$arrayCompras = buscarComprasUsuario($idUsuario);
if ($arrayCompras != null) {
    $objCompraEstadoInciada = verificarCompra($arrayCompras);
    if ($objCompraEstadoInciada != null) {
        cargarProducto($objCompraEstadoInciada, $datos);
    }
}
if (($arrayCompras == null) && ($objCompraEstadoInciada == null)) {
    $objCompraEstadoInciada = crearCompra($idUsuario);
    cargarProducto($objCompraEstadoInciada, $datos);
}

/**************************************/
/**************** MODULOS *************/
/**************************************/

/* Busca con el id usuario todos las compras que realizo */
function buscarComprasUsuario($idUsuario)
{
    $objCompra = new C_Compra();
    $arrayCompra = $objCompra->buscar($idUsuario);
    return $arrayCompra;
}

/* Lo que realiza es cargarle el producto deseado */
function cargarProducto($objCompraEstadoInciada , $datos)
{
    $objCompraItem = new C_CompraItem();
    $arrayCompraItem = $objCompraItem->buscar($datos);
    if ($arrayCompraItem == null) {
        $datos["idCompra"] = $objCompraEstadoInciada->getCompra()->getIdCompra();
        if ($objCompraItem->alta($datos)) {
            echo json_encode(array('success' => 1));
        } else {
            echo json_encode(array('success' => 0));
        }
    }else{
        $cantStockDisp = $arrayCompraItem[0]->getObjProducto()->getCantStock();
        $cantTot = $datos["ciCantidad"] + $arrayCompraItem[0]->getCantidad();
        if($cantTot > $cantStockDisp){
            echo json_encode(array('success'=>0));
        }else{
            $param = ["idCompraItem" => $arrayCompraItem[0]->getIdCompraItem(),
            "idProducto" => $arrayCompraItem[0]->getObjProducto()->getIdProducto(),
            "idCompra" => $arrayCompraItem[0]->getObjCompra()->getIdCompra(),
            "ciCantidad" => $cantTot];
            $objCompraItem->modificacion($param);
            echo json_encode(array('success'=>1));
        }
    }
}

/* Crea una compra con el idusuario */
function crearCompra($idUsuario)
{
    $objCompra = new C_Compra();
    $objCompraEstado = new C_CompraEstado();
    $arrayObjCompraEstado = null;
    if ($objCompra->alta($idUsuario)) {
        $arrayCompra = $objCompra->buscar($idUsuario);
        $paramCompraEstado = [
            "idCompra" => $arrayCompra[0]->getIdCompra(),
            "idCompraEstadoTipo" => 1,
            "ceFechaIni" => "CURRENT_TIMESTAMP",
            "ceFechaFin" => null
        ];
        if ($objCompraEstado->alta($paramCompraEstado)) {
            $idCompra["idCompra"] = $arrayCompra[0]->getIdCompra();
            $arrayObjCompraEstado = $objCompraEstado->buscar($idCompra);
        }
    }
    return $arrayObjCompraEstado[0];
}

/* Busca si en todas las compras que realizo, no hay alguna iniciada */
function verificarCompra($arrayCompra)
{
    $objCompraEstado = new C_CompraEstado();
    $objCompraEstadoInciada = null;
    $i = 0;
    /* Busca en el arraycompra si hay alguna que este con el estado "iniciada" */
    while (($objCompraEstadoInciada == null) && ($i < count($arrayCompra))) {
        $idCompra["idCompra"] = $arrayCompra[$i]->getIdCompra();
        $arrayCompraEstado = $objCompraEstado->buscar($idCompra);
        if ($arrayCompraEstado[0]->getCompraEstadoTipo()->getCetDescripcion() == "iniciada") {
            $objCompraEstadoInciada = $arrayCompraEstado[0];
        } else {
            $i++;
        }
    }
    return $objCompraEstadoInciada;
}
