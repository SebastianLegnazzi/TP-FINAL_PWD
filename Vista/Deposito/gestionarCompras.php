<?php
include_once('../estructura/Cabecera.php');
if ($_SESSION['vista'] != NULL) {
    if ($_SESSION["vista"]->getIdRol() == 3) {
        $objCompra = new C_Compra();
        $arrayCompra = $objCompra->buscar();
        if ($arrayCompra != null) {
            $objCompraEstado = new C_CompraEstado();
            $arrayComprasRealiazadas = $objCompraEstado->buscarCompras($arrayCompra);
            if (count($arrayComprasRealiazadas) > 0) {
?>
                <div class="container-fluid" style="margin-bottom: 19%">

                <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title text-white" id="exampleModalToggleLabel">Productos de la compra</h1>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body row">
                                <div>
                                    <?php
                                    ?>
                                    <table id="lista__carrito" class="table table-dark">
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="container col-md-10 text-white mt-5">
                        <h2 class="text-white">Gestionar Compras:</h2>
                        <table class="container table table-dark table-hover">
                            <tr>
                                <th>ID Compra</th>
                                <th>Nombre Usuario</th>
                                <th>Estado</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Fin</th>
                                <th>Editar</th>
                                <th>Ver productos</th>
                            </tr>
                            <?php
                            if ($arrayComprasRealiazadas != null) {
                                foreach ($arrayComprasRealiazadas as $compraRealizada) {
                                    echo '
                            <tr>
                                <td>' . $compraRealizada->getIdCompraEstado() . '</td>
                                <td>' . $compraRealizada->getCompra()->getObjUsuario()->getUsNombre() . '</td>
                                <td>' . $compraRealizada->getCompraEstadoTipo()->getCetDescripcion() . '</td>
                                <td>' . $compraRealizada->getCeFechaIni() . '</td>
                                <td class="d-none" id="idCompra">' . $compraRealizada->getCompra()->getIdCompra() . '</td>
                                <td>' . $compraRealizada->getCeFechaFin() . '</td>
                                
                                <td><a class="text-white" href="#" id="editar_estado"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg></a></td>
                                <td><a class="link-light" id="ver_productos_compras" data-bs-toggle="modal" href="#exampleModalToggle2" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                </svg></a></td>
                            </tr>
                        ';
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
<?php
            }
        }
        if ($arrayCompra == null || count($arrayComprasRealiazadas) == 0) {
            echo "<h2 class='text-warning text-center' style='margin-bottom: 20%;margin-top:5%'> Todavia nadie creo compras! </h2>";
        }
    } else {
        header('Location: ../paginas/home.php');
    }
} else {
    header('Location: ../paginas/home.php');
}
include_once("../estructura/Pie.php")
?>
<script src="../js/gestinarEstadoCompra.js"></script>
<script src="../js/verProductoMisCompras.js"></script>