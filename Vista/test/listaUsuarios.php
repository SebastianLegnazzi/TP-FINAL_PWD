<?php
include_once('../estructura/Cabecera.php');

$objUsuario=new C_Usuario;
$objUsuarioRol=new C_UsuarioRol;
$arrayUsers=$objUsuario->buscar(NULL);
if ($arrayUsers != null) {
    $cantUsers = count($arrayUsers);
    $rolesUs=[];
    foreach($arrayUsers as $us){
        $param['idUsuario']=$us->getIdUsuario();
        array_push($rolesUs,$objUsuarioRol->buscar($param));//esto me devuelve un array de objetos usuario +rol
    }
    $rolesDesc=[];
    foreach($rolesUs as $rolUs){
        $roles=[];
        //aca me devuelve el array de roles de cada usuario:
        foreach($rolUs as $rolU){
            $rol=$rolU->getRol()->getRolDescripcion();
            array_push($roles,$rol);
        }
        array_push($rolesDesc,$roles);
    }
    print_r($rolesDesc);
} else {
    $cantUsers = -1;
}
$i = 0;
?>

<div class="container-md mx-auto m-5">
    <?php
    if ($cantUsers > -1) {
    ?>
        <div class="border rounded p-3 mb-2 bg-dark text-white">
        <table class="table table-dark table-hover P-5">
            <thead>
            <tr>
            <th scope="col-6">USER</th>
            <th scope="col-6">USERNAME</th>
            <th scope="col-4">MAIL</th>
            <th scope="col-4">ROL</th>
            <th scope="col-2">ACTIONS</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($i < $cantUsers) {
            ?>
                <tr> 
                    <th scope="row"><?php echo $i+1 ?></th>
                    <td><?php echo $arrayUsers[$i]->getUsNombre() ?></td>
                    <td> <?php echo $arrayUsers[$i]->getUsMail() ?> </td>
                    <td> <?php $msn="-"; 
                        foreach ($rolesDesc[$i] as $rol){
                            $msn=$msn.$rol."-";
                        } 
                        echo $msn ?> 
                    </td>
                    <td>
                        <form method='post' action='actualizarLogin.php'>
                        <input style="display:none;" name='idUsuario' id='idUsuario' value='<?php echo $arrayUsers[$i]->getIdUsuario()?>'>
                        <button type="submit" class="text-decoration-none btn btn-outline-warning"> EDITAR </button>
                        <button onclick="eliminar(<?php echo $arrayUsers[$i]->getIdUsuario()?>)" href="eliminarUsuario.php" class="text-decoration-none btn btn-outline-danger">
                        DESHABILITAR
                        </button>
                        </form>
                    </td>
                </tr>
                <?php
                $i++;
            }?>
            </tbody>
            </table>
            </div>
            <?php
    }else{
        ?>
        <div class="alert alert-warning" role="alert">
            No existen usuarios cargados...
        </div>
        <?php
    }
    ?>
