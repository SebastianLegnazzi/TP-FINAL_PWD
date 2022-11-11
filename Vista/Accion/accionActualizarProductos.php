<?php
include_once("../estructura/Cabecera.php");
$datos = data_submitted();
$objUsuario = new C_Producto();
?>
<div class="container-fluid">
    <div class="container col-md-10 text-white">
        <h2>Resultado:</h2>
        <div class="mb-3">
            <?php
            if ($objUsuario->modificacion($datos)) {
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'El usuario se modifico correctamente!',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    function redireccionarPagina() {
                        location.href = "../modUsuarios/listarUsuario.php"
                    }
                    setTimeout("redireccionarPagina()", 1450);
                </script>
            <?php
            } else {
            ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'El usuario no se ha podido modificar!',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    function redireccionarPagina() {
                        location.href = "../modUsuarios/listarUsuario.php"
                    }
                    setTimeout("redireccionarPagina()", 1450);
                </script>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
include_once("../estructura/Pie.php");
?>