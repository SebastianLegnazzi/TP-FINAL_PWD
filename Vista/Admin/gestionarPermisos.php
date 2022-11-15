<?php
include_once('../estructura/Cabecera.php');

$objMenuRol=new C_MenuRol();
$objRol=new Rol();
$permisos=$objMenuRol->buscar(null);
$roles=$objRol->listar();
if ($permisos != null) {
    $cantPermisos=count($permisos);
} else{
    $cantRoles=-1;
}
$i = 0;
?>

<div class="container-md mx-auto m-5">
<?php
    if ($cantPermisos > -1) {
    ?>
<div class="rounded p-3 mb-2 bg-dark text-white">
        <table class="table table-dark table-hover p-5">
            <thead class="text-center">
            <tr>
            <th scope="col-6">NOMBRE MENU</th>
            <th scope="col-6">RUTA RELATIVA</th>
            <th scope="col-4">ID ROL</th>
            <th scope="col-4">ROL</th>
            <th scope="col-2">ACCIONES</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach($permisos as $permiso){
                    ?>
                    <tr> 
                    <th scope="row" class="text-center"><?php echo $permiso->getMenu()->getMeNombre()?></th>
                    <td><?php echo $permiso->getMenu()->getMeDescripcion() ?></td>
                    <td class="text-center"> <?php echo $permiso->getRol()->getIdRol() ?> </td>
                    <td class="text-center"> <?php echo $permiso->getRol()->getRolDescripcion()  ?> 
                    </td>
                    <td class="text-center">
                        <button type="button" class="ms-3 text-decoration-none btn btn-outline-warning"> QUITAR PERMISO </button>
                    </td>
                </tr>
                <?php
                }
            ?>
            </tbody>
            </table>
            </div>
            <?php
    }else{
        ?>
        <div class="alert alert-warning" role="alert">
            No existen roles cargados...
        </div>
        <?php
    }
    ?>
</div>
<div class="container-md w-50 text-center rounded p-3 mb-2 bg-dark text-white mt-5">
    <div class="row justify-content-center">
    <div class="col-10">
        <h5>Agregar Nuevo Permiso</h5>
    </div>
    <div class="col-lg-7 col-12 mt-2">
                <label>Nombre Menú </label>
                <input type="text" pattern="[a-zA-Z]+\s?[a-zA-Z]*\s?[a-zA-Z]*\s?[a-zA-Z]*\s?[a-zA-Z]*" 
                name="" minlength="3" class="form-control text mt-2" required>
                <div class="invalid-feedback">
                    Porfavor ingrese un nombre valido! No se aceptan numeros y tiene que ser mayor a 3 letras.
                </div>
                <div class="valid-feedback">
                    Correcto!
                </div>
            </div>
            <div class="col-lg-7 col-12 mt-2">
                <label>Ruta Relativa </label>
                <input type="text" pattern="" name="" minlength="3" 
                class="form-control text mt-2" required>
                <div class="invalid-feedback">
                    Porfavor ingrese una ruta válida.
                </div>
                <div class="valid-feedback">
                    Correcto!
                </div>
            </div>
            <div class="col-lg-7 col-12 mt-2">
                
                <label>Rol que puede acceder </label>
                <select class="form-select mb-3" aria-label=".form-select example">
                <option selected>Seleccionar</option>
                <?php
                foreach($permisos as $permiso){
                    ?>
                    <option value="rol[]"><?php echo $permiso->getRol()->getRolDescripcion() ?> </option>
                    <?php
                }
                ?>
                </select>
                
            </div>
    </div>
<div>