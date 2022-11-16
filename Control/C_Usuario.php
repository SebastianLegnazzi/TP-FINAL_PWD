<?php

class C_Usuario
{

    //este es para crear un usuario
    private function cargarObjeto($param)
    {
        //print_r($param);
        $obj = null;
        if (array_key_exists('idUsuario', $param) and array_key_exists('usNombre', $param) and array_key_exists('usPass', $param) and array_key_exists('usMail', $param)) {
            $obj = new Usuario();
            if (array_key_exists('usDeshabilitado', $param)) {
                $obj->setear($param["idUsuario"], $param["usNombre"], $param["usPass"], $param["usMail"], $param["usDeshabilitado"]);
            } else {
                $obj->setear($param["idUsuario"], $param["usNombre"], $param["usPass"], $param["usMail"], NULL);
            }
        }
        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idUsuario'])) {
            $obj = new Usuario();
            $obj->setear($param['idUsuario'], null, null, null, null);
        }
        return $obj;
    }


    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idUsuario'])) {
            $resp = true;
        }
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        if ($this->buscar($param) == null) {
            $param['idUsuario'] = null;  // Se comenta ya que esta line es para cuando la base de datos tiene su clave principal Usuario incrementable
            $objUsuario = $this->cargarObjeto($param);
            if ($objUsuario != null && $objUsuario->insertar()) {
                if ($this->altaRol($objUsuario)) {
                    $resp = true;
                    //aca hice el alta del rolUsuario
                }
            }
        }
        return $resp;
    }

    public function altaRol($objUs)
    {
        $idUsCreado = $objUs->getIdUsuario();
        $usRol = new C_UsuarioRol();
        //por defecto al crearse el usuario se le asigna el rol de USER (id:2)
        $datosUsRol['idRol'] = 2;
        $datosUsRol['idUsuario'] = $idUsCreado;
        $resp = $usRol->alta($datosUsRol);
        return $resp;
    }

    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objUsuario = $this->cargarObjetoConClave($param);
            if ($objUsuario != null && $objUsuario->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param)
    {
        //echo "Estoy en modificacion";
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objUsuario = $this->cargarObjeto($param);
            if ($objUsuario != null and $objUsuario->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param)
    {
        $where = "true";
        if ($param <> NULL) {
            if (isset($param['idUsuario']))
                $where .= " and idUsuario=" . $param['idUsuario'];
            if (isset($param['usNombre']))
                $where .= " and usNombre='" . $param['usNombre'] . "'";
            if (isset($param['usPass']))
                $where .= " and usPass='" . $param['usPass'] . "'";
            if (isset($param['usMail']))
                $where .= " and usMail='" . $param['$usMail'] . "'";
        }
        $objUsuario = new Usuario();
        $arreglo = $objUsuario->listar($where);
        return $arreglo;
    }


    public function agregarRolAdmin($param)
    {
        $agregado = false;
        $datos['idUsuario'] = $param['idUsuario'];
        $usuarios = $this->buscar($datos);
        $objUsuarioRol = new C_UsuarioRol();
        //aca obtengo los roles que tiene antes de modificar el usuario:
        $rolesDesc = $objUsuarioRol->darDescripcionRoles($usuarios);
        //ahora obtengo los roles que pase por POST
        $roles = $param['rol'];
        //controlar primero que el usuario solo tenga el rol_user
        //y que se haya cliqueado la opcion admin
        if (count($rolesDesc[0]) < 2 && in_array('ROLE_ADMIN', $roles)) {
            $idUsuario = $param['idUsuario'];
            $modUsRol = new UsuarioRol();
            $modUsRol->setearConClave($idUsuario, 1);
            $agregado = $modUsRol->insertar();
        }
        return $agregado;
    }

    function deshabilitar($param)
    {
        $resp = false;
        $arrayObjUsuarios = $this->buscar($param);
        $fecha = new DateTime();
        $fechaStamp = $fecha->format('Y-m-d H:i:s');
        $objUsuario = $arrayObjUsuarios[0];
        $objUsuario->setUsDeshabilitado($fechaStamp);
        if ($objUsuario != null and $objUsuario->modificar()) {
            $resp = true;
        }
        return $resp;
    }

    function habilitar($param)
    {
        $resp = false;
        $arrayObjUsuarios = $this->buscar($param);
        $objUsuario = $arrayObjUsuarios[0];
        $objUsuario->setUsDeshabilitado('habilitar');
        if ($objUsuario != null and $objUsuario->modificar()) {
            $resp = true;
        }
        return $resp;
    }
}
