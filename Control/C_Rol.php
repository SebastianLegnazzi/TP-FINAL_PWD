<?php
include_once('../configuracion.php');

class C_Rol{
    private function cargarObjeto($param){
        $obj=null;
        if(array_key_exists('idRol',$param) ){

            $obj=new Rol();
            $obj->cargar($param['idRol'], 
            $param['idDescripcion'],
            );
        }
        return $obj;
    }
}