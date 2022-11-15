<?php
include_once('../estructura/Cabecera.php');

$objMenuRol=new C_MenuRol();
$permisos=$objMenuRol->buscar(null);
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