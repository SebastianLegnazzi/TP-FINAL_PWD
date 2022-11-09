<?php

class C_Usuario{
    
    //este es para crear un usuario
    private function cargarObjeto($param){
        //print_r($param);
        $obj=null;
        if(array_key_exists('usNombre',$param) && array_key_exists('usPass',$param)){
            $obj=new Usuario();
            $obj->setearSinId(
            $param['usNombre'],
            $param['usPass'],
            $param['usMail']
            );

        }
        return $obj;
    }

    //este es para modificar un objeto usuario
    private function cargarObjetoConId($param){
        //print_r($param);
        $obj=null;
        if(array_key_exists('usNombre',$param) && array_key_exists('usPass',$param)){

            $obj=new Usuario();
            $obj->setear(
            $param['idUsuario'],
            $param['usNombre'],
            $param['usPass'],
            $param['usMail']
            );
        }
        return $obj;
    }
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idUsuario'])){
            $resp = true;
            return $resp;
        }
    }

    public function alta($param){
        $resp=false;
        $objUsuario=$this->cargarObjeto($param);
        //print_r($objUsuario);
//        verEstructura($elObjtTabla);
        if ($objUsuario!=null && $objUsuario->insertar()){
            if($this->altaRol($objUsuario)){
                $resp=true;
                //aca hice el alta del rolUsuario
            }
        }
        return $resp;
        
    }

    public function altaRol($objUs){
        $idUsCreado=$objUs->getIdUsuario();
        $usRol=new C_UsuarioRol();
        //por defecto al crearse el usuario se le asigna el rol de USER (id:2)
        $datosUsRol['idRol']=2;
        $datosUsRol['idUsuario']=$idUsCreado;
        $resp=$usRol->alta($datosUsRol);
        return $resp;
    }

    public function baja($param){
        $resp=false;
        if ($this->seteadosCamposClaves($param)){
            $objUsuario=$this->cargarObjetoConId($param);
            if ($objUsuario!=null && $objUsuario->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param){
        //echo "Estoy en modificacion";
        $resp=false;
        if ($this->seteadosCamposClaves($param)){
            $objUsuario=$this->cargarObjetoConId($param);
            if($objUsuario!=null and $objUsuario->modificar()){
                $resp=true;
            }
        }
        return $resp;
    }

    public function buscar($param){
        $where = "true";
        if ($param<>NULL){
            if  (isset($param['idUsuario']))
                $where.=" and idUsuario=".$param['idUsuario'];
            if  (isset($param['usNombre']))
                $where.=" and usNombre='".$param['usNombre']."'";
            if  (isset($param['usPass']))
                $where.=" and usPass='".$param['usPass']."'";
            if  (isset($param['usMail']))
                $where.=" and usMail='".$param['$usMail']."'";
        }
        $objUsuario=new Usuario();
        $arreglo=$objUsuario->listar($where);  
        return $arreglo;
    }

    
    public function agregarRolAdmin($param){
        $agregado=false;
        $datos['idUsuario']=$param['idUsuario'];
        $usuarios=$this->buscar($datos);
        $objUsuarioRol=new C_UsuarioRol();
        //aca obtengo los roles que tiene antes de modificar el usuario:
        $rolesDesc=$objUsuarioRol->darDescripcionRoles($usuarios);
        //ahora obtengo los roles que pase por POST
        $roles=$param['rol'];
        //controlar primero que el usuario solo tenga el rol_user
        //y que se haya cliqueado la opcion admin
        if(count($rolesDesc[0])<2 && in_array('ROLE_ADMIN',$roles)){
            $idUsuario=$param['idUsuario'];
            $modUsRol=new UsuarioRol();
            $modUsRol->setearConClave($idUsuario,1);
            $agregado=$modUsRol->insertar();
        }
        return $agregado;
    } 

}



?>