<?php
include_once("../../configuracion.php");

$datos = data_submitted();
$objCompra = new C_Compra();
$objSesion = new C_Session();
$objCompraItem = new C_CompraItem();
$ObjUsuario = $objSesion->getUsuario();
if($ObjUsuario != null){
    $idUsuario["idUsuario"] = $ObjUsuario->getIdUsuario();
    $arrayCompra = $objCompra->buscar($idUsuarioBuscar);
    if($arrayCompra == null){
        $objCompra->alta($idUsuario);
        $arrayCompra = $objCompra->buscar($idUsuarioBuscar);
    }
    $arrayCompraItem = $objCompraItem->buscar($datos);
    if($arrayCompraItem == null){
        $datos["idCompra"] = $arrayCompra[0]->getIdCompra();
        $objCompraItem->alta($datos);
    }else{
        $cantStockDisp = $arrayCompraItem[0]->getObjProducto()->getCantStock();
        $cantTot = $datos["ciCantidad"] + $cantStockDisp;
        if($cantTot > $cantStockDisp){
            echo json_encode(array('success'=>0));
        }else{
            $arrayCompraItem[0]->setear($arrayCompraItem[0]->getIdCompraItem(), $arrayCompraItem[0]->getObjProducto(), $arrayCompraItem[0]->getObjCompra(), $cantTot, $arrayCompraItem[0]->getMensajeFuncion());
            $arrayCompraItem[0]->modificar();
            echo json_encode(array('success'=>1));
        }
    }
}



/* 
    if ($objProducto->alta($datos)) {
        echo json_encode(array('success'=>1));
    } else {
        echo json_encode(array('success'=>0));
    } */
