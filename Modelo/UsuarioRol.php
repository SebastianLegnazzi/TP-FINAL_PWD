<?php

include_once('Conector/BaseDatos.php');

class UsuarioRol{
    private $rol;
    private $usuario;
    private $mensajeOperacion;


    public function __construct(){
        $this->usuario = new Usuario();
        $this->rol = new Rol();
        $this->mensajeOperacion = "";
    }

    public function setear($usuario, $rol){
        $this->setRol($rol);
        $this->setUsuario($usuario);
    }

    //ver de agregar funcion setearConClave

    public function setearConClave($idUsuario,$idRol){
        $this->setRol($rol);
        $this->setUsuario($usuario);
    }

    public function getRol(){
        return $this->rol;
    }

    public function setRol($rol){
        $this->rol = $rol;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    public function getMensajeOperacion(){
        return $this->mensajeOperacion;
    }

    public function setMensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion = $mensajeOperacion;
    }

    //carga info de bd (idUsuario+IdRol+rolDescripcion) a objeto php
    public function cargar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuariorol WHERE idRol = " 
        .$this->getRol()->getIdRol(). "and idUsuario =" 
        .$this->getUsuario()->getIdUsuario();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $objUsuario = NULL;
                    if ($row['idUsuario'] != null) {
                        $objUsuario = new Usuario();
                        $objUsuario->setIdUsuario($row['idUsuario']);
                        //$objUsuario->setUsNombre($row['usNombre']);
                        //$objUsuario->setUsNombre($row['usMail']);
                    }
                    $objRol = NULL;
                    if ($row['idRol'] != null) {
                        $objRol = new Rol();
                        $objRol->setIdRol($row['idRol']);
                        $objRol->setIdDescripcion($row['idDescripcion']);
                    }
                    $this->setear($objUsuario, $objRol);
                }
            }
        } else {
            $this->setMensajeOperacion("usuariorol->listar: " . $base->getError());
        }
        return $resp;
    }


    public function insertar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO usuariorol (idUsuario,idRol)  VALUES ('" 
                . $this->getUsuario()->getIdUsuario() . "','" 
                .$this->getRol()->getIdRol(). "')";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("usuariorol->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("usuariorol->insertar: " . $base->getError());
        }
        return $resp;
    }


    public function eliminar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM usuariorol WHERE idUsuario = "
                .$this->getUsuario()->getIdUsuario() 
                ."and idRol =" .$this->getRol()->getIdRol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeOperacion("usuariorol->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("usuariorol->eliminar: " . $base->getError());
        }
        return $resp;
    }


    public static function listar($parametro = ""){
        $arreglo = array();
        $base = new BaseDatos();
        $consultasql = "SELECT * FROM usuariorol ";
        if ($parametro != "") {
            $consultasql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($consultasql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $objUsuario = NULL;
                    if ($row['idUsuario'] != null) {
                        $objUsuario = new Usuario();
                        $objUsuario->setIdUsuario($row['idUsuario']);
                        $objUsuario->cargar();
                    }
                    $objRol = NULL;
                    if ($row['idRol'] != null) {
                        $objRol = new Rol();
                        $objRol->setIdRol($row['idRol']);
                        $objRol->cargar();
                    }
                    $obj = new Usuariorol();
                    $obj->setear($objUsuario, $objRol);
                    array_push($arreglo, $obj);
                }
            }
        }
        return $arreglo;
    }

}