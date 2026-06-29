<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5">
            <div class="col-md-6">
                <h3 class="m-3 display-3 text-nowrap">Historial de reportes de accidentes</h3>
            </div>
        </div>

        <div class="mt-5">
            <table class="table table-striped table-hover" id="tablaReportes">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Reportado por</th>
                        <th>Barrio</th>
                        <th>Dirección</th>
                        <th>Causa</th>
                        <th>Tipo choque</th>
                        <th>Lesionados</th>
                        <th>Vehículos</th>
                        <th>Vehículo</th>
                        <th>Placa</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($reportes as $rep): ?>
                    <tr>
                        <td><?php echo $rep['sra_id']?></td>
                        <td><?php echo $rep['sra_fecha']?></td>
                        <td><?php echo $rep['usu_nombre']?></td>
                        <td><?php echo $rep['bar_nombre']?></td>
                        <td><?php echo $rep['sra_direccion']?></td>
                        <td><?php echo $rep['cau_descripcion']?></td>
                        <td><?php echo $rep['tch_nombre']?></td>
                        <td><?php echo $rep['sra_cantidad_lesionados']?></td>
                        <td><?php echo $rep['sra_cantidad_vehiculo']?></td>
                        <td><?php echo $rep['tveh_nombre'].' - '.$rep['veh_modelo'].' ('.$rep['veh_color'].')'?></td>
                        <td><?php echo $rep['veh_placa']?></td>
                        <td><?php echo $rep['sra_descripcion']?></td>
                        <td>
                            <?php if($rep['sra_imagen']): ?>
                            <img src="<?php echo $rep['sra_imagen']?>" alt="imagen" style="width:60px;height:60px;object-fit:cover;border-radius:4px;">
                            <?php else: ?>
                            <span class="text-muted">Sin imagen</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    if (typeof $.fn.DataTable !== 'undefined') {
        $('#tablaReportes').DataTable({ language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' } });
    }
});
</script>
