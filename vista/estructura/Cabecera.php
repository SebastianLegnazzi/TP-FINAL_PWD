<?php
include "../../configuracion.php";
$objSession=new C_Session();
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
  <script src="../jQuery/jquery-3.6.1.min.js"></script>
</head>

<body>
<header class="p-3 bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="../../index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none pe-3">
          LOSEDIF
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="../../index.php" role="button" class="px-2 btn btn-lg btn-outline-light">Home</a></li>
          
        </ul>


        <div class="text-end">
          <?php if ($objSession->activa()){
            echo "<button class='btn btn-lg btn-outline-light me-2'>SALIR</button>";
            }else{
            echo "<a href='../sesion/IniciarSesion.php' class='btn btn-lg btn-outline-light me-2'>INGRESAR</a>";
            }?>
        </div>
      </div>
    </div>
  </header>