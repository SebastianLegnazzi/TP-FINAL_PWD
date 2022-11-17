<?php
include_once('../estructura/Cabecera.php');
if($_SESSION['vista']!=NULL){
    if ($_SESSION["vista"]->getIdRol() == 3) {
    $objCompra = new C_Compra();
    $arrayCompra = $objCompra->buscar();
    if ($arrayCompra != null) {
        $objCompraEstado = new C_CompraEstado();
        $arrayComprasRealiazadas = $objCompraEstado->buscarCompras($arrayCompra);
        if (count($arrayComprasRealiazadas) > 0) {
?>
            <div class="container-fluid" style="margin-bottom: 19%">
                <div class="container col-md-10 text-white mt-5">
                    <h2 class="text-white">Gestinar Compras:</h2>
                    <table class="container table table-dark table-hover">
                        <tr>
                            <th>IdCompra</th>
                            <th>Estado</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Editar</th>
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
                                <td><a class="text-white" href="#" id="editar_estado"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
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
    }else{
        header('Location: ../paginas/home.php');
    }
}else{
    header('Location: ../paginas/home.php');
}
include_once("../estructura/Pie.php")
?>
<script src="../js/gestinarEstadoCompra.js"></script>