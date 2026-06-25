<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5">
            <div class="col-md-5">
                <h3 class="m-3 display-3 text-nowrap">Historial de solicitudes de reductores</h3>
            </div>
        </div>

        <div class="mt-5">
            <table class="table table-striped table-hover" id="tablaReductores">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Solicitante</th>
                        <th>Categoría</th>
                        <th>Tipo de reductor</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Imagen</th>
                        <?php if (esAdministrador() || esFuncionario()): ?>
                        <th>Acción</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reductores as $r): ?>
                    <tr>
                        <td><?php echo $r['snr_id']?></td>
                        <td><?php echo $r['usu_nombre']?></td>
                        <td><?php echo $r['catr_nombre']?></td>
                        <td><?php echo $r['tred_nombre']?></td>
                        <td><?php echo $r['snr_descripcion']?></td>
                        <td>
                            <?php $badge = $r['est_nombre'] == 'Pendiente' ? 'warning' : ($r['est_nombre'] == 'Resuelto' ? 'success' : ($r['est_nombre'] == 'Rechazado' ? 'danger' : 'info')); ?>
                            <span class="badge badge-<?php echo $badge?>"><?php echo $r['est_nombre']?></span>
                        </td>
                        <td>
                            <?php if ($r['snr_imagen']): ?>
                            <img src="<?php echo $r['snr_imagen']?>" alt="imagen" style="width:60px;height:60px;object-fit:cover;border-radius:4px;">
                            <?php else: ?>
                            <span class="text-muted">Sin imagen</span>
                            <?php endif; ?>
                        </td>
                        <?php if (esAdministrador() || esFuncionario()): ?>
                        <td>
                            <form action="<?php echo getUrl('Reductor', 'Reductor', 'postUpdateEstado'); ?>" method="post" class="d-flex gap-1">
                                <input type="hidden" name="snr_id" value="<?php echo $r['snr_id']?>">
                                <select name="est_id" class="form-control form-control-sm">
                                    <option value="1" <?php echo $r['est_id'] == 1 ? 'selected' : ''; ?>>Pendiente</option>
                                    <option value="2" <?php echo $r['est_id'] == 2 ? 'selected' : ''; ?>>En proceso</option>
                                    <option value="3" <?php echo $r['est_id'] == 3 ? 'selected' : ''; ?>>Resuelto</option>
                                    <option value="4" <?php echo $r['est_id'] == 4 ? 'selected' : ''; ?>>Rechazado</option>
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
        $('#tablaReductores').DataTable({ language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' } });
    }
});
</script>