<?php
include "../../configuracion.php";
$objSession = new C_Session();
$menues = [];
if ($objSession->activa()) {
  $idRoles = $_SESSION['roles'];
  $objMenuRol = new C_MenuRol();
  $menues = $objMenuRol->menuesByIdRol($idRoles);
}
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
  <link rel="stylesheet" href="../css/home.css">
  <link rel="stylesheet" href="../alertas/dist/sweetalert2.min.css">
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../alertas/dist/sweetalert2.all.min.js"></script>
  <script src="../jQuery/jquery-3.6.1.min.js"></script>
  <script src="../js/cerrarSesion.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
  <header class="navbar navbar-expand-lg navbar-dark bg-dark" >
    <div class="container-fluid">
        <a href="../../index.php" class="navbar-brand losadef text-white">
          Losadef
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample03">
          <ul class="navbar-nav me-auto mb-2 m-2 mb-sm-0">
            <li><a href="../../index.php" role="button" class="px-2 mx-1 btn btn-lg btn-outline-light">Home</a></li>
            <?php
            foreach ($menues as $objMenu) {
              if($objMenu->getMeDeshabilitado()==NULL){
                ?>
                <li><a href='<?php echo $objMenu->getMeDescripcion() ?>' role="button" class="px-2 mx-1 btn btn-lg btn-outline-light"><?php echo $objMenu->getMeNombre() ?></a></li>
                <?php
              }
            }
            ?>
          </ul>


          <div class="text-end d-flex align-items-center">
            <?php if ($objSession->activa()) {
            ?>
            <select class="form-select form-select-lg me-2" aria-label=".form-select-lg example">
              <?php
            foreach($idRoles as $idRol){
              ?>
              <option value="<?php echo $idRol ?>"><?php echo $idRol ?></option>
              <?php
            }
              ?>
            </select>
              <button type='button' class='btn btn-lg btn-outline-light me-2' onclick="cerrarSesion()">SALIR</button>
            <?php
            } else {
            ?>
              <a href='../sesion/IniciarSesion.php' class='btn btn-lg btn-outline-light me-2'>INGRESAR</a>
            <?php
            } ?>
        </div>
      </div>
    </div>
  </header>