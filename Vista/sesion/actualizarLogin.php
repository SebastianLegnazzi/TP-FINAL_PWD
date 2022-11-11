<?php
include_once('../estructura/Cabecera.php');

$datos=data_submitted();
$objUsuario=new C_Usuario();
$objUsuarioRol=new C_UsuarioRol();
$usuarioModificar=$objUsuario->buscar($datos);
$descRolesUsuario=$objUsuarioRol->darDescripcionRoles($usuarioModificar);
?>
<div class="container-md">
<main class="form-signin w-50 m-auto mt-5 text-center">
    <form class="row gy-2 text-center justify-content-center rounded bg-dark text-white" method="post" action="../Accion/loginActualizado.php">
    <div class="col-10" style="display:none;">
        <label for="floatingInput" class="form-label mt-2">ID</label>
        <input type="number" class="form-control" 
                name="idUsuario" id="idUsuario" value="<?php echo $usuarioModificar[0]->getIdUsuario()?>">
    </div>
    <div class="col-10 col-lg-7">
        <label for="floatingInput" class="form-label mt-2">NOMBRE DE USUARIO</label>
        <input type="text" class="form-control" placeholder="Username" 
                name="usNombre" id="usNombre" value="<?php echo $usuarioModificar[0]->getUsNombre()?>">
    </div>
    <div class="col-10 col-lg-7">
    <label for="usNombre" class="form-label mt-2">MAIL</label>
        <input type="text" class="form-control" placeholder="Mail" 
                name="usMail" id="usMail" value="<?php echo $usuarioModificar[0]->getUsMail()?>">
    </div>
    <div class="col-10 col-lg-7">
    <label for="usPass" class="form-label mt-2">CONTRASEÑA</label>
        <input type="password" class="form-control" placeholder="***********" 
                name="usPass" id="usPass">
    </div>
    <div class="col-8 col-lg-7 mt-4">
        <h6 class="text-center mb-3">ROLES</h6>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="ROLE_USER" id="user" name="rol[]" checked>
            <label class="form-check-label" for="user">
                USER
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="ROLE_ADMIN" name="rol[]" id="admin"
            <?php 
            foreach($descRolesUsuario[0] as $rol){
                if($rol=="ROLE_ADMIN"){
                    ?>checked
                    <?php
                }
            }
            ?>
            >
            <label class="form-check-label" for="admin">
                ADMIN
            </label>
        </div>
    </div>

    <button class="btn btn-lg btn-success my-3 col-10 col-lg-7 mt-4">MODIFICAR</button>

    </form>
</main>
</div>
<?php
include_once("../estructura/Pie.php")
?>