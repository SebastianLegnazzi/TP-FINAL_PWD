<?php
include_once('../estructura/Cabecera.php');

$datos=data_submitted();
$objUsuario=new C_Usuario();
$usuarioModificar=$objUsuario->buscar($datos);
?>

<main class="form-signin w-25 m-auto mt-5 text-center">
    <form class="row gy-2 text-center justify-content-center" method="post" action="loginActualizado.php">
    <div class="col-10" style="display:none;">
        <label for="floatingInput" class="form-label mt-2">ID</label>
        <input type="number" class="form-control" 
                name="idUsuario" id="idUsuario" value="<?php echo $usuarioModificar[0]->getIdUsuario()?>">
    </div>
    <div class="col-10">
        <label for="floatingInput" class="form-label mt-2">USERNAME</label>
        <input type="text" class="form-control" placeholder="Username" 
                name="usNombre" id="usNombre" value="<?php echo $usuarioModificar[0]->getUsNombre()?>">
    </div>
    <div class="col-10">
    <label for="usNombre" class="form-label mt-2">MAIL</label>
        <input type="text" class="form-control" placeholder="Mail" 
                name="usMail" id="usMail" value="<?php echo $usuarioModificar[0]->getUsMail()?>">
    </div>
    <div class="col-10">
    <label for="usPass" class="form-label mt-2">PASSWORD</label>
        <input type="password" class="form-control" placeholder="Password" 
                name="usPass" id="usPass">
    </div>

        <button class="btn btn-lg btn-success my-3 col-10 mt-4">MODIFY</button>

    </form>
</main>