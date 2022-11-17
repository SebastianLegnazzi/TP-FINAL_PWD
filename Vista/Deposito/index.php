<?php
include_once('../estructura/Cabecera.php');
if ($_SESSION["vista"]->getIdRol() == 3) {
    header('Location: listaProductos.php');
} else {
    header('Location: ../paginas/home.php');
}
?>