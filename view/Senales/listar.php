<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5">
            <div class="col-md-5">
                <h3 class="m-3 display-3 text-nowrap">Historial de solicitudes</h3>
            </div>
        </div>

        <div class="mt-5">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td>Tipo de señal</td>
                        <td>Orientación</td>
                        <td>Categoria</td>
                        <td>Estado de la solicitud</td>
                        <td>Descripción</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($senales as $sena){
                            echo "<tr>";
                            echo "<td>".$sena['tsen_nombre']."</td>";
                            echo "<td>".$sena['tsen_orientación']."</td>";
                            echo "<td>".$sena['cats_nombre']."</td>";
                            echo "<td>".$sena['est_nombre']."</td>";
                            echo "<td>".$sena['sns_descripcion']."</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>