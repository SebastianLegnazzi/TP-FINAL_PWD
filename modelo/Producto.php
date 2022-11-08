<?php
class Producto
{
    private $idProducto;
    private $nombre;
    private $detalle;
    private $cantStock;
    private $mensajeFuncion;


    /**************************************/
    /**************** SET *****************/
    /**************************************/

    /**
     * Establece el valor de idProducto
     */
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
    }

    /**
     * Establece el valor de nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Establece el valor de detalle
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;
    }

    /**
     * Establece el valor de cantStock
     */
    public function setCantStock($cantStock)
    {
        $this->cantStock = $cantStock;
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
     * Obtiene el valor de idProducto
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Obtiene el valor de nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Obtiene el valor de detalle
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Obtiene el valor de cantStock
     */
    public function getCantStock()
    {
        return $this->cantStock;
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
        $this->idProducto = "";
        $this->nombre = "";
        $this->detalle = "";
        $this->cantStock = "";
    }

    public function setear($idProducto, $nombre, $detalle, $cantStock)
    {
        $this->setIdProducto($idProducto);
        $this->setNombre($nombre);
        $this->setDetalle($detalle);
        $this->setCantStock($cantStock);
    }

    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $consulta = "INSERT INTO producto (idproducto, pronombre, prodetalle, procantstock) VALUES (
		'" . $this->getIdProducto() . "',
		'" . $this->getNombre() . "',
		'" . $this->getDetalle() . "',
		'" . $this->getCantStock() . "')";
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
        $consulta = "UPDATE producto
        SET idproducto = '{$this->getIdProducto()}',
        pronombre = '{$this->getNombre()}',
        prodetalle = '{$this->getDetalle()}',
        procantstock = '{$this->getCantStock()}',
        WHERE idproducto = '{$this->getIdProducto()}'";
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
        $consulta = "SELECT * FROM producto WHERE idproducto ='" . $param["idproducto"] . "'";
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($producto = $base->Registro()) {
                    $this->setIdProducto($producto['idproducto']);
                    $this->setNombre($producto['pronombre']);
                    $this->setDetalle($producto['prodetalle']);
                    $this->setCantStock($producto['procantstock']);
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
        $consultaPersona = "SELECT * FROM producto ";
        if ($condicion != "") {
            $consultaPersona = $consultaPersona . ' WHERE ' . $condicion;
        }
        $consultaPersona .= " ORDER BY idproducto ";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaPersona)) {
                $arregloProductos = array();
                while ($Producto = $base->Registro()) {
                    $objProducto = new Producto();
                    $objProducto->buscar($Producto['idproducto']);
                    array_push($arregloProductos, $objProducto);
                }
            } else {
                $this->setMensajeFuncion($base->getError());
            }
        } else {
            $this->setMensajeFuncion($base->getError());
        }
        return $arregloProductos;
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
