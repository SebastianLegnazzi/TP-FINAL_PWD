<?php
include "../../configuracion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trabajo Practico Final PWD</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/producto.css">
  <link rel="stylesheet" href="../alertas/dist/sweetalert2.min.css">
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../js/producto.js"></script>
  <script src="../alertas/dist/sweetalert2.all.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark" aria-label="Third navbar example" id="header">
    <div class="container-fluid">
      <span class="navbar-brand text-white" style="font-family: 'Chivo', sans-serif;">| De Todo Un Poco |</span>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample03">
        <ul class="navbar-nav me-auto mb-2 m-2 mb-sm-0">
          <li class="nav-item">
            <a class="nav-link text-white btn btn-primary m-2" href="../paginas/index.php" style="font-family: 'Chivo', sans-serif;">Inicio</a>
          </li>
        </ul>
        <div id="content__login" class="d-flex align-self-center">
            <a class="nav-link text-white btn btn-secondary m-2" href="../sesion/registrarse.php" style="font-family: 'Chivo', sans-serif;">Registrarse</a>
            <a class="nav-link text-white btn btn-secondary m-2" href="../sesion/IniciarSesion.php" style="font-family: 'Chivo', sans-serif;">Ingresar</a>
        </div>
      </div>
    </div>
  </nav>