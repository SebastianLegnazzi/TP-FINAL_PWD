<?php
include_once("../../configuracion.php");

$datos = data_submitted();
$objCompra = new C_Compra();
$objSesion = new C_Session();
$objCompraItem = new C_CompraItem();
$ObjUsuario = $objSesion->getUsuario();
if($ObjUsuario != null){
    $idUsuario["idUsuario"] = $ObjUsuario->getIdUsuario();
    $arrayCompra = $objCompra->buscar($idUsuario);
    if($arrayCompra == null){
        $objCompra->alta($idUsuario);
        $arrayCompra = $objCompra->buscar($idUsuario);
    }
    $arrayCompraItem = $objCompraItem->buscar($datos);
    if($arrayCompraItem == null){
        $datos["idCompra"] = $arrayCompra[0]->getIdCompra();
        if(!$objCompraItem->alta($datos)){
            echo json_encode(array('success'=>0));
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