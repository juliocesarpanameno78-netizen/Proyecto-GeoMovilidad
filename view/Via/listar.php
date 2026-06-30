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
                        <th>Coordenadas</th>
                        <th>Estado</th>
                        <th>Imagen</th>
                        <?php if (esAdministrador() || esFuncionario()): ?>
                        <th>Acción</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($vias as $via): ?>
                    <tr>
                        <td><?php echo $via['svme_id']?></td>
                        <td><?php echo $via['usu_nombre']?></td>
                        <td><?php echo $via['cdan_nombre']?></td>
                        <td><?php echo $via['svme_descripcion_detallada']?></td>
                        <td><?php echo ($via['svme_coord_x'] !== null && $via['svme_coord_y'] !== null) ? ($via['svme_coord_x'] . ', ' . $via['svme_coord_y']) : 'Sin coordenadas'; ?></td>
                        <td>
                            <?php $b = $via['est_nombre'] == 'Pendiente' ? 'warning' : ($via['est_nombre'] == 'Resuelto' ? 'success' : ($via['est_nombre'] == 'Rechazado' ? 'danger' : 'info')); ?>
                            <span class="badge badge-<?php echo $b?>">
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
                        <?php if (esAdministrador() || esFuncionario()): ?>
                        <td>
                            <form action="<?php echo getUrl('Via', 'Via', 'postUpdateEstado'); ?>" method="post" class="d-flex gap-1">
                                <input type="hidden" name="svme_id" value="<?php echo $via['svme_id']?>">
                                <select name="est_id" class="form-control form-control-sm">
                                    <option value="1" <?php echo $via['est_id'] == 1 ? 'selected' : ''; ?>>Pendiente</option>
                                    <option value="2" <?php echo $via['est_id'] == 2 ? 'selected' : ''; ?>>En proceso</option>
                                    <option value="3" <?php echo $via['est_id'] == 3 ? 'selected' : ''; ?>>Resuelto</option>
                                    <option value="4" <?php echo $via['est_id'] == 4 ? 'selected' : ''; ?>>Rechazado</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
                            </form>
                        </td>
                        <?php endif; ?>
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