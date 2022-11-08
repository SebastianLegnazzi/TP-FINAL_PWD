<?php
class CompraItem
{
    private $idCompraItem;
    private $objProducto;
    private $idCompra;
    private $cantidad;
    private $mensajeFuncion;


    /**************************************/
    /**************** SET *****************/
    /**************************************/

    /**
     * Establece el valor de idCompraItem
     */
    public function setIdCompraItem($idCompraItem)
    {
        $this->idCompraItem = $idCompraItem;
    }

    /**
     * Establece el valor de objProducto
     */
    public function setObjProducto($objProducto)
    {
        $this->objProducto = $objProducto;
    }

    /**
     * Establece el valor de idCompra
     */
    public function setIdCompra($idCompra)
    {
        $this->idCompra = $idCompra;
    }

    /**
     * Establece el valor de cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    /**
     * Establece el valor de mensajeFuncion
     */
    public function setMensajeFuncion($mensajeFuncion)
    {
        $this->mensajeFuncion = $mensajeFuncion;
    }

    /**************************************/
    /**************** GET *****************/
    /**************************************/
    /**
     * Obtiene el valor de idCompraItem
     */
    public function getIdCompraItem()
    {
        return $this->idCompraItem;
    }

    /**
     * Obtiene el valor de objProducto
     */
    public function getObjProducto()
    {
        return $this->objProducto;
    }

    /**
     * Obtiene el valor de idCompra
     */
    public function getIdCompra()
    {
        return $this->idCompra;
    }

    /**
     * Obtiene el valor de cantidad
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Obtiene el valor de mensajeFuncion
     */
    public function getMensajeFuncion()
    {
        return $this->mensajeFuncion;
    }

    /**************************************/
    /************** FUNCIONES *************/
    /**************************************/

    public function __construct()
    {
        $this->idCompraItem = "";
        $this->objProducto = new Producto;
        $this->idCompra = "";
        $this->cantidad = ""; 
    }

    public function setear($idCompraItem, $idProducto, $idCompra, $cantidad)
    {
        $resp = false;
        if($this->objProducto->buscar($idProducto)){
            $this->setIdCompraItem($idCompraItem);
            $this->setIdCompra($idCompra);
            $this->setCantidad($cantidad);
            $resp = true;
        }
        return $resp;
    }

    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $consulta = "INSERT INTO compraitem (idCompraItem, idProducto, idCompra, ciCantidad) VALUES (
		'" . $this->getIdCompraItem() . "',
		'" . $this->getObjProducto()->getIdProducto() . "',
		'" . $this->getIdCompra() . "',
		'" . $this->getCantidad() . "')";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $resp =  true;
            } else {
                $this->setMensajeFuncion($base->getError());
            }
        } else {
            $this->setMensajeFuncion($base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $consulta = "UPDATE compraitem
        SET idCompraItem = '{$this->getIdCompraItem()}',
        idProducto = '{$this->getObjProducto()->getIdProducto()}',
        idCompra = '{$this->getIdCompra()}',
        ciCantidad = '{$this->getCantidad()}',
        WHERE idCompraItem = '{$this->getIdCompra()}'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $resp =  true;
            } else {
                $this->setMensajeFuncion($base->getError());
            }
        } else {
            $this->setMensajeFuncion($base->getError());
        }
        return $resp;
    }

    public function buscar($param)
    {
        $base = new BaseDatos();
        $consulta = "SELECT * FROM compraitem WHERE idCompraItem ='" . $param["idCompraItem"] . "'";
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($producto = $base->Registro()) {
                    $this->setIdCompraItem($producto['idCompraItem']);
                    $this->setObjProducto($this->getObjProducto()->buscar($producto['idProducto']));
                    $this->setIdCompra($producto['idCompra']);
                    $this->setCantidad($producto['ciCantidad']);
                    $resp = true;
                }
            } else {
                $this->setMensajeFuncion($base->getError());
            }
        } else {
            $this->setMensajeFuncion($base->getError());
        }
        return $resp;
    }

    public function listar($condicion = "")
    {
        $arregloProductos = null;
        $base = new BaseDatos();
        $consultaCompraItem = "SELECT * FROM compraitem ";
        if ($condicion != "") {
            $consultaCompraItem = $consultaCompraItem . ' WHERE ' . $condicion;
        }
        $consultaCompraItem .= " ORDER BY idCompraItem ";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaCompraItem)) {
                $arregloComraitem = array();
                while ($compraItem = $base->Registro()) {
                    $objCompraItem = new CompraItem();
                    $objCompraItem->buscar($compraItem['idCompraItem']);
                    array_push($arregloComraitem, $objCompraItem);
                }
            } else {
                $this->setMensajeFuncion($base->getError());
            }
        } else {
            $this->setMensajeFuncion($base->getError());
        }
        return $arregloComraitem;
    }

    public function eliminar()
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consulta = "DELETE FROM producto WHERE idproducto = '" . $this->getIdProducto() . "'";
            if ($base->Ejecutar($consulta)) {
                $resp =  true;
            } else {
                $this->setMensajeFuncion($base->getError());
            }
        } else {
            $this->setMensajeFuncion($base->getError());
        }
        return $resp;
    }
}
