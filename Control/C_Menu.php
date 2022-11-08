<?php
class C_Menu{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Menu
     */
    private function cargarObjeto($param){
        
        $obj = null;
           
        if( array_key_exists('idMenu',$param) and array_key_exists('meNombre',$param) and array_key_exists('meDescripcion',$param)  ){
            
            $obj = new Menu();
            
            $objMenu = null;
            if (isset($param['idPadre'])){
                $objMenu = new Menu();
                $objMenu->setIdmenu($param['idpadre']);
                $objMenu->cargar();
            }
            
            if(!isset($param['medeshabilitado'])){
                $param['medeshabilitado']=null;
            }else{
                $param['medeshabilitado']= date("Y-m-d H:i:s");
            }
            $obj->setear($param['idMenu'], $param['meNombre'],$param['meDescripcion'],$objMenu,$param['meDeshabilitado']); 
        }
        return $obj;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Menu
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idmenu']) ){
            $obj = new Menu();
            $obj->setIdmenu($param['idmenu']);
        }
        return $obj;
    }
    
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idmenu']))
            $resp = true;
        return $resp;
    }
    
    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $param['idmenu'] =null;
        $param['medeshabilitado'] = null;
        $objMenu = $this->cargarObjeto($param);
       
        if($objMenu!=null and $objMenu->insertar()){
            $resp = true;
        }
      return $resp;
    }
    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
      
        if ($this->seteadosCamposClaves($param)){
            $objMenu = $this->cargarObjetoConClave($param);
            if ($objMenu!=null and $objMenu->eliminar()){
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
    public function modificacion($param){
       
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objMenu = $this->cargarObjeto($param);
            if($objMenu !=null and $objMenu ->modificar()){
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
    public function buscar($param){
        $where = " true ";
        if ($param != null){
            if  (isset($param['idMenu']))
                $where.=" and idMenu =".$param['idMenu'];
        }

        $objMenu = new Menu();
        $arreglo = $objMenu->listar($where);  
        return $arreglo; 
    }
   
}
?>