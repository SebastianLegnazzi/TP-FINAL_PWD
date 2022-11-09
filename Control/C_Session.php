<?php
class C_Session{
    private $objUsuario;
    private $listaRoles;
    
    public function __construct(){
        if(session_start()){
            $this->objUsuario=new C_Usuario();
            $this->listaRoles=[];
        }
    }
    public function getObjUsuario(){
        return $this->objUsuario;
    }

    public function setObjUsuario($objUsuario){
        $this->objUsuario = $objUsuario;
    }

    public function getListaRoles(){
        return $this->listaRoles;
    }

    public function setListaRoles($listaRoles){
        $this->listaRoles = $listaRoles;
    }

    //Actualiza las variables de sesión con los valores ingresados:
    public function iniciar(){
        //$_SESSION['idSesion']=session_id();
        $_SESSION['idUsuario']=$this->getObjUsuario()->getIdUsuario();
        $_SESSION['usNombre']=$this->getObjUsuario()->getUsNombre();
        return $_SESSION;
    }

    //Valida si los datos ingresados son validos: Aca pasarle la contraseña ya encriptada
    public function valida($param){
        $valida=false;
        $objUsuario=new C_Usuario();
        $listaUsuarios=$objUsuario->buscar($param);
        if(count($listaUsuarios)>0){
            $this->setObjUsuario($listaUsuarios[0]);
            $valida=true;
        }
        return $valida;
    }
    
    public function activa(){
        $activa=false;
        //si hay un objeto logueado. Lo hago mediante las variables de SESSION
        if($_SESSION['idSesion']!=null){
            $activa=true;
        }
        return $activa;
    }
    
    public function getUsuario(){
        if ($this->activa()) {
            $objUsuario=new C_Usuario();
            $where =['usNombre'=>$_SESSION['usNombre'],'idUsuario'=>$_SESSION['idUsuario']];
            $listaUsuarios=$objUsuario->buscar($where);
            if($listaUsuarios>=1){
                $usuarioLog=$listaUsuarios[0];
            }
        }
        return $usuarioLog;
    }
    
    //si tiene dos roles me devuelve un array
    public function getRol(){
        $objRol=new C_Rol();
        $objUsuarioRol=new C_UsuarioRol();
        $usuario=$this->getUsuario();
        $idUsuario=$usuario->getIdUsuario();
        $param=['idUsuario'=>$idUsuario];
        $listaRolesUsu=$objUsuarioRol->buscar($param);
        if($listaRolesUsu>1){
            $rol=$listaRolesUsu;
        }else{
            $rol=$listaRolesUsu[0];
        }
        $_SESSION['rol']=$rol;
        return $rol; 
    }
    
    public function cerrar(){
        $cerrar=false;
        if(session_destroy()){
            $cerrar=true;
        }
        return $cerrar;
    }
} 