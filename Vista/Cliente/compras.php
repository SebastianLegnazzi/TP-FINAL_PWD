<?php
include_once('../estructura/Cabecera.php');
$objUsuario = $objSession->getUsuario();
if ($objUsuario != null) {
    $objCompra = new C_Compra();
    $idUsuario["idUsuario"] = $objUsuario->getIdUsuario();
    $arrayCompra = $objCompra->buscar($idUsuario);
    if ($arrayCompra != null) {
        $objCompraEstado = new C_CompraEstado();
        $arrayComprasRealiazadas = $objCompraEstado->buscarCompras($arrayCompra);
        if (count($arrayComprasRealiazadas) > 0) {
?>
            <div style="margin-bottom: 15%;">
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
                                        <tr>
                                            <td class="col-md-2"><img src="" id="urlImagen_tabla" class="img-thumbnail"></td>
                                            <td id="nombre_tabla"></td>
                                            <td id="detalle_tabla"></td>
                                            <td id="precio_tabla"></td>
                                            <td id="cantidad_tabla"></td>
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
                <table class="container table table-dark table-hover">
                    <tr>
                        <th>IdCompra</th>
                        <th>Estado</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Ver productos</th>
                    </tr>
                    <?php
                    if ($arrayComprasRealiazadas != null) {
                        foreach ($arrayComprasRealiazadas as $compraRealizada) {
                            echo '
                            <tr>
                                <td>' . $compraRealizada->getIdCompraEstado() . '</td>
                                <td>' . $compraRealizada->getCompraEstadoTipo()->getCetDescripcion() . '</td>
                                <td>' . $compraRealizada->getCeFechaIni() . '</td>
                                <td>' . $compraRealizada->getCeFechaFin() . '</td>
                                <td class="d-none" id="idCompra">' . $compraRealizada->getCompra()->getIdCompra() . '</td>
                                ?>
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
<?php
        }
    }
    if ($arrayCompra == null || count($arrayComprasRealiazadas) == 0) {
        echo "<h2 class='text-warning text-center' style='margin-bottom:20%;margin-top:5%'> Todavia no realizaste ninguna compra! </h2>";
    }
}
include_once("../estructura/Pie.php")
?>
<script src="../js/verProductoMisCompras.js"></script>