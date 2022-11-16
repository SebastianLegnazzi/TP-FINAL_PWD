<?php
include_once('../estructura/Cabecera.php');

$datos['UsNombre'] = $_SESSION['nombreUsuario'];
$usuario = new C_Usuario;
$usuario = $usuario->buscar($datos)[0];

?>

<div class="container-fluid" style="margin-bottom: 15%">
<div class="container col-md-5 text-white mt-5 ">
        <h2>Mis Datos:</h2>
        <div class="mb-3">
                
                <table class="table table-striped table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                    </tr>

                <?php
               
                    echo '<tr>';
                    echo '<td>' . $usuario->getIdUsuario() . '</td>';
                    echo '<td>' . $usuario->getUsNombre() . '</td>';
                    echo '<td>' . $usuario->getUsMail() . '</td>';
                    
                    echo '</tr>';
        
                ?>
                </table>

                <input class="btn btn-secondary mt-2 col-3" type="button" name="boton_editarDatos"  id="boton_editarDatos" value="EDITAR EMAIL">
                <input class="btn btn-secondary mt-2 mx-3 col-5" type="button" name="boton_contra"  id="boton_contra" value="CAMBIAR MI CONTRASEÑA">
        </div>
    </div>
    <div class="container-fluid col-md-5 text-white mt-5 d-none" id='editarDatos'>
        <h2>Editar Datos:</h2>
        <div class="mb-3">
            
        <form  id='form-editar' method="post" action="../Accion/accionActualizarPerfil.php"class="needs-validation row text-white justify-content-center col-12" novalidate>
                <table class="table table-striped table-dark">
                    <tr>
                         
                        <th>Username:</th>
                        <th>Email:</th>
                    
                    </tr>
 
                    <tr>

                    <td><div class="col-lg-7 col-12"><?php echo $usuario->getUsNombre()?></div><div class="col-lg-7 col-12 d-none"><input value = '<?php echo $usuario->getUsNombre()?>' type="text" style="width: 150px;" pattern="[a-zA-Z]+\s?[0-9]*" name="usNombre"></input>
                    </div><div class="col-lg-7 col-12 d-none"><input value = '<?php echo $usuario->getUsPass()?>' type="text" name="usPass"></input></div></td>

                    <td><div class="col-lg-7 col-12 "><input value = '<?php echo $usuario->getUsMail()?>' type="email" style="width: 250px;" pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*\.([a-z]{3})(\.[a-z]{2})*$" name="usMail" required></input><div class="invalid-feedback">
                    Ingrese un email valido!</div>
                    <div class="valid-feedback">
                    Correcto!</div></div><div class="col-lg-7 col-12 d-none"><input value = '<?php echo $usuario->getIdUsuario()?>' type="number"  name="idUsuario" required></input></div></td>
                    
                    </tr>
            

                </table>

                <input class="btn btn-success mt-2 col-3" type="submit" name="boton_enviar"  id="boton_enviar" value="GUARDAR">
                <input class="btn btn-danger mx-4 mt-2 col-3" name="boton_cancelar" type="button" id="boton_cancelar" value="CANCELAR">
            </form>
        </div>
    </div>
</div>

<script src="../js/perfil.js"></script>
<?php

include_once("../estructura/Pie.php")
?>