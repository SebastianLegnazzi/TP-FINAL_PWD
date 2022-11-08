<?php

include_once('conector/BaseDatos.php');

class Menu {
    private $idMenu;
    private $meNombre;
    private $padre;
    private $meDescripcion;
    private $meDeshabilitado;
    private $mensajeOperacion;

    public function __construct(){
        $this->idMenu = "";
        $this->meNombre = "";
        $this->padre = null;
        $this->meDeshabilitado = null;
        $this->mensajeOperacion = "";
    }
    
    public function getIdMenu(){
        return $this->idMenu;
    }
    public function setIdMenu($idMenu){
        $this->idMenu = $idMenu;
    }
    
    public function getMeNombre(){
        return $this->meNombre;
    }
    public function setMeNombre($meNombre){
        $this->meNombre = $meNombre;
    }
    
    public function getMeDeshabilitado(){
        return $this->meDeshabilitado;
    }
    public function setMeDeshabilitado($meDeshabilitado){
        $this->meDeshabilitado = $meDeshabilitado;
    }    
    
    public function getPadre(){
        return $this->padre;
    }
    public function setPadre($padre){
        $this->padre = $padre;
    }

    public function getMeDescripcion(){
        return $this->meDescripcion;
    }
    public function setMeDescripcion($meDescripcion){
        $this->meDescripcion = $meDescripcion;
    }
    
    public function getMensajeOperacion(){
        return $this->mensajeOperacion;
    }
    public function setMensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion = $mensajeOperacion;
    }
       
    public function setear($id, $nombre, $descripcion, $padre, $deshabilitado){
        $this->setIdMenu($id);
        $this->setMeNombre($nombre);
        $this->setMeDeshabilitado($deshabilitado);
        $this->setPadre($padre);
        $this->setMeDescripcion($descripcion);
    }


    //carga info de bd (idUsuario+IdRol+rolDescripcion) a objeto php
    public function cargar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM menu WHERE idMenu = " .$this->getIdMenu();
        
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    
                    $objPadre = null;
                    if ($row['idPadre'] != null) {
                        $objPadre = new Menu();
                        $objPadre->setIdMenu($row['idPadre']);
                        $objPadre->cargar();
                    }
                
                    $this->setear($row['idMenu'],$row['meNombre'],$row['meDescripcion'],$objPadre,$row['meDeshabilitado']);
                }
            }
        } else {
            $this->setMensajeOperacion("menu->listar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar(){
        $resp = false;
        $base = new BaseDatos();

        $idPadre = $this->getPadre();
        if($idPadre != null){
            $idPadre = "'".$idPadre->getIdMenu()."'";
        }

        $deshabilitado = $this->getMeDeshabilitado();
        if($deshabilitado != null){
            $deshabilitado = "'".$deshabilitado."'"; 
        }

        $sql = "INSERT INTO menu (idMenu, meNombre, meDescripcion, idPadre, meDeshabilitado)  VALUES (
                '".$this->getIdMenu(). "',
                '".$this->getMeNombre(). "',
                '".$this->getMeDescripcion(). "',
                ".$idPadre. ",
                ".$deshabilitado."
                )";

        if ($base->Iniciar()) {
            if ($id = $base->Ejecutar($sql)) {
                $this->setIdMenu($id);
                $resp = true;
            } else {
                $this->setMensajeOperacion("menu->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("menu->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base=new BaseDatos();

        $idPadre = $this->getPadre();
        if($idPadre != null){
            $idPadre = "'".$idPadre->getIdMenu()."'";
        }

        $deshabilitado = $this->getMeDeshabilitado();
        if($deshabilitado != null){
            $deshabilitado = "'".$deshabilitado."'"; 
        }

        $sql="UPDATE menu SET 
              meNombre='".$this->getMenombre()."',
              meDescripcion='".$this->getMedescripcion()."',
              idPadre=".$idPadre.",
              meDeshabilitado=".$deshabilitado.",
              ";
        
        $sql.= " WHERE idMenu = ".$this->getIdMenu();
        
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
                
            } else {
                $this->setmensajeoperacion("menu->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("menu->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base = new BaseDatos();
        
        $sql = "DELETE FROM menu WHERE idMenu = ".$this->getIdMenu();
       
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("menu->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("menu->eliminar: " . $base->getError());
        }
        return $resp;
    }


    public function listar($parametro=""){
        $arreglo = null;
        $base=new BaseDatos();
        $sql="SELECT * FROM menu ";

        if ($parametro != "") {
            $sql.='WHERE '.$parametro;
        }

        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                $arreglo = array();
                while ($row = $base->Registro()){
                    
                    $objMenu = new Menu();
                    $objPadre =null;
                    
                    if ($row['idpadre']!=null){
                        $objPadre = new Menu();
                        $objPadre->setIdMenu($row['idpadre']);
                        $objPadre->cargar();
                    }

                    $objMenu->setear($row['idMenu'], $row['meNombre'],$row['meDescripcion'],$objPadre,$row['meDeshabilitado']); 
                    array_push($arreglo, $objMenu);
                }
            }
        } 
        return $arreglo;
    }
}

?>
    

    
    

    
    

    