<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5">
            <div class="col-md-5">
                <h3 class="m-3 display-3 text-nowrap">Historial de reportes de vías</h3>
            </div>
        </div>

        <div class="mt-5">
            <table class="table table-striped table-hover" id="tablaVias">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Reportado por</th>
                        <th>Tipo de daño</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($vias as $via): ?>
                    <tr>
                        <td><?php echo $via['svme_id']?></td>
                        <td><?php echo $via['usu_nombre']?></td>
                        <td><?php echo $via['cdan_nombre']?></td>
                        <td><?php echo $via['svme_descripcion_detallada']?></td>
                        <td>
                            <span class="badge badge-<?php echo $via['est_nombre'] == 'Pendiente' ? 'warning' : 'success'?>">
                                <?php echo $via['est_nombre']?>
                            </span>
                        </td>
                        <td>
                            <?php if($via['svme_imagen']): ?>
                            <img src="<?php echo $via['svme_imagen']?>" alt="imagen" style="width:60px;height:60px;object-fit:cover;border-radius:4px;">
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
        $('#tablaVias').DataTable({ language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' } });
    }
});
</script>
