<?php
include_once('../estructura/Cabecera.php');
if($_SESSION['vista']!=NULL){
    if ($_SESSION["vista"]->getIdRol() == 1) {
        header('Location: listaUsuarios.php');
    } else {
        header('Location: ../paginas/home.php');
    }
}else {
    header('Location: ../paginas/home.php');
}
?>