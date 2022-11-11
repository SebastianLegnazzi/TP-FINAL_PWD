<?php

class C_MenuRol{


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object
     */
    private function cargarObjeto($param){
        
        $obj = null;
           
        if(array_key_exists('idMenu',$param) and array_key_exists('idRol',$param)){
            
            $obj = new MenuRol();
            
            $objMenu = null;
            if (isset($param['idMenu'])){
                $objMenu = new Menu();
                $objMenu->setIdmenu($param['idpadre']);
                $objMenu->cargar();
            }

            $objRol = null;
            if (isset($param['idRol'])){
                $objRol = new Rol();
                $objRol->setIdRol($param['idRol']);
                $objRol->cargar();
            }
            
            $obj->setear($param['idMenu'], $param['idRol']); 
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
        if (isset($param['idMenu'],$param['idRol']))
            $resp = true;
        return $resp;
    }

    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $param['idMenu'] =null;
        $param['idRol'] = null;
        $objMenuRol = $this->cargarObjeto($param);
       
        if($objMenuRol!=null and $objMenuRol->insertar()){
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
            $objMenuRol = $this->cargarObjeto($param);
            if ($objMenuRol!=null and $objMenuRol->eliminar()){
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
            $objMenuRol = $this->cargarObjeto($param);
            if($objMenuRol !=null and $objMenuRol ->modificar()){
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
            if  (isset($param['idRol']))
                 $where.=" and idRol ='".$param['idRol']."'";
        }

        $objMenuRol = new MenuRol();
        $arreglo = $objMenuRol->listar($where);  
        return $arreglo; 
    }

    //obtengo los objetos menu a partir del array de idRoles
    public function menuesByIdRol($idRoles){
        foreach($idRoles as $idRol){
            $param['idRol']=$idRol;
            $arreglo=$this->buscar($param);
        }
        $menues=[];
        foreach($arreglo as $objMenuRol){
            array_push($menues,$objMenuRol->getMenu());
        }
        return $menues;
    }
}
?>