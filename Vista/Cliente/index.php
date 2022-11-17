<?php
include_once('../estructura/Cabecera.php');
if ($_SESSION["vista"]->getIdRol() == 2) {
    header('Location: productos.php');
} else {
    header('Location: ../paginas/home.php');
}
?>