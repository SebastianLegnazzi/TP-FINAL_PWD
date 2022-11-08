<?php

include_once('conector/BaseDatos.php');

class MenuRol{
    private $menu;
    private $rol;
    private $mensajeOperacion;


    public function __construct(){
        $this->menu = new Menu();
        $this->rol = new Rol();
        $this->mensajeOperacion = "";
    }

    public function setear($menu, $rol){
        $this->setMenu($menu);
        $this->setRol($rol);
    }

    //ver de agregar funcion setearConClave
    public function setearRol($rol){
        $this->setRol($rol);
    }

    public function getRol(){
        return $this->rol;
    }

    public function setRol($rol){
        $this->rol = $rol;
    }
    public function getMenu(){
        return $this->menu;
    }
    public function setMenu($menu){
        $this->menu = $menu;
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
        
        $sql = "SELECT * FROM usuariorol WHERE 
                idRol = ".$this->getRol()->getIdRol(). "
                and idMenu =".$this->getMenu()->getIdMenu();
        
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    
                    $menu = null;
                    if ($row['idMenu'] != null) {
                        $menu = new Menu();
                        $menu->setIdMenu($row['idMenu']);
                        $menu->cargar();
                    }

                    $rol = null;
                    if ($row['idRol'] != null) {
                        $rol = new Rol();
                        $rol->setIdRol($row['idRol']);
                        $rol->cargar();
                    }
                    $this->setear($menu, $rol);
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
                    $obj->setearRol($objRol);
                    array_push($arreglo, $obj);
                }
            }
        }
        return $arreglo;
    }
    
}