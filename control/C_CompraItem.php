<?php
class C_CompraItem
{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object
     */
    private function cargarObjeto($param)
    {
        $objCompraItem = null;

        if (array_key_exists('idCompraItem', $param) and array_key_exists('idProducto', $param) and array_key_exists('idCompra', $param) and array_key_exists('ciCantidad', $param)) {
            $objCompraItem = new Compra();
            if(!$objCompraItem->cargar($param['idCompraItem'], $param['idProducto'], $param['idCompra'], $param['ciCantidad'])){
                $objCompraItem = null;
            }
        }
        return $objCompraItem;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idCompraItem'])) {
            $resp = true;
        }
        return $resp;
    }

    /**
     *
     * @param array $param
     * @return boolean
     */
    public function alta($param)
    {
        $resp = false;
        $param['idCompraItem'] = null;
        $objCompraItem = $this->cargarObjeto($param);
        if ($objCompraItem!=null) {
            if($objCompraItem->insertar()){
                $resp = true;
            }
        }
        return $resp;
    }
    /**
     * permite eliminar un objeto
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objCompraItem = $this->cargarObjeto($param);
            if ($objCompraItem!=null and $objCompraItem->eliminar()) {
                $resp = true;
            }
        }

        return $resp;
    }

    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        //echo "Estoy en modificacion";
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objCompraItem = $this->cargarObjeto($param);
            if ($objCompraItem!=null and $objCompraItem->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param = "")
    {
        $where = " true ";
        if ($param<>null) {
            if (isset($param)) {
                $where.=" and idCompraItem ='".$param["idCompraItem"]."'";
            }
        }
        $objCompraItem= new Compra();
        $arregloCompraItem = $objCompraItem->listar($where);
        return $arregloCompraItem;
    }
}
?>