<?php
class C_Producto
{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object
     */
    private function cargarObjeto($param)
    {
        $objProducto = null;

        if (array_key_exists('idproducto', $param) and array_key_exists('pronombre', $param) and array_key_exists('prodetalle', $param) and array_key_exists('procantstock', $param) and array_key_exists('urlImagen', $param)) {
            $objProducto = new UsuarioRol();
            if(!$objProducto->cargar($param['idproducto'], $param['pronombre'], $param['prodetalle'], $param['procantstock'], $param['urlImagen'])){
                $objProducto = null;
            }
        }
        return $objProducto;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idproducto'])) {
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
        $param['idproducto'] = null;
        $objProducto = $this->cargarObjeto($param);
        if ($objProducto!=null) {
            if($objProducto->insertar()){
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
            $objProducto = $this->cargarObjeto($param);
            if ($objProducto!=null and $objProducto->eliminar()) {
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
            $objProducto = $this->cargarObjeto($param);
            if ($objProducto!=null and $objProducto->modificar()) {
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
                $where.=" and idproducto ='".$param["idproducto"]."'";
            }
        }
        $objProducto= new Producto();
        $arregloProductos = $objProducto->listar($where);
        return $arregloProductos;
    }
}
?>