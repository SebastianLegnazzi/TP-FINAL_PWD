<?php
include_once('../estructura/Cabecera.php');

$datos=data_submitted();
$objMenu=new C_Menu();
$objMenuRol=new C_MenuRol();
$objRol=new C_Rol();
$menuModificar=$objMenu->buscar($datos);
$rolModificar=$objMenuRol->buscar($datos);
$roles=$objRol->buscar(null);
//$descRolesUsuario=$objMenuRol->darDescripcionRoles($usuarioModificar);
?>


<div class="container-md">
<main class="w-50 m-auto mt-5 text-center">
    <form class="row gy-2 text-center justify-content-center rounded bg-dark text-white needs-validation" novalidate>
    <div class="col-10" style="display:none;">
        <label for="floatingInput" class="form-label mt-2">ID</label>
        <input type="number" class="form-control" 
                name="idMenu" value="<?php echo $menuModificar[0]->getIdMenu()?>">
    </div>
    <div class="col-10 col-lg-7">
        <label for="floatingInput" class="form-label mt-2">NOMBRE DE MENU</label>
        <input type="text" class="form-control" placeholder="Username" 
                name="meNombre" value="<?php echo $menuModificar[0]->getMeNombre()?>" required>
    </div>
    <div class="col-10 col-lg-7">
    <label for="usNombre" class="form-label mt-2">ID PADRE</label>
        <input type="text" class="form-control" placeholder="Mail" 
                name="idPadre" value="<?php echo $menuModificar[0]->getPadre()?>" required>
    </div>
    <div class="col-10 col-lg-7">
    <label for="usPass" class="form-label mt-2">RUTA RELATIVA</label>
        <input type="text" class="form-control"
                name="meDescripcion" value="<?php echo $menuModificar[0]->getMeDescripcion()?>"required>
    </div>
    <div class="col-8 col-lg-7 mt-4">
        <label>Rol que puede acceder</label>
                <select class="form-select mb-3" aria-label=".form-select example">
                <option name="rol[]" selected><?php echo $rolModificar[0]->getRol()->getRolDescripcion() ?></option>
                <?php
                foreach($roles as $rol){
                    if($rol->getRolDescripcion()!=$rolModificar[0]->getRol()->getRolDescripcion()){
                    ?>
                    <option value="<?php echo $rol->getIdRol() ?>"><?php echo $rol->getRolDescripcion() ?> </option>
                    <?php
                    }
                }
                ?>
                </select>
    </div>
    <button onclick="modificar()" class="btn btn-lg btn-success my-3 col-10 col-lg-7 mt-4">MODIFICAR</button>
    </form>
</main>
</div>

<script src="../js/mainPermisos.js"></script>
<?php
include_once("../estructura/Pie.php")
?>