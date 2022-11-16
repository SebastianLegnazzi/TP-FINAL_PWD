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
            <table class="table table-dark table-hover">
                <tr>
                    <th>IdCompra</th>
                    <th>Estado</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                </tr>
                <?php
                if ($arrayCompraItem != null) {
                    foreach ($arrayComprasRealiazadas as $compraRealizada) {
                        echo '
                            <tr>
                                <td>' . $compraRealizada->getIdCompraEstado() . '</td>
                                <td>' . $compraRealizada->getCompraEstadoTipo() . '</td>
                                <td>' . $compraRealizada->getCeFechaIni() . '</td>
                                <td>' . $compraRealizada->getCeFechaFin() . '</td>
                                <td class="d-none" id="idCompra">' . $compraRealizada->getCompra()->getIdCompra() . '</td>
                            </tr>
                        ';
                    }
                }
                ?>
            </table>
<?php
        }
    } else {
        echo "<h2 class='text-warning text-center'> Todavia no realizaste ninguna compra! </h2>";
    }
}
include_once("../estructura/Pie.php")
?>