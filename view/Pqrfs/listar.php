<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5">
            <div class="col-md-5">
                <h3 class="m-3 display-3 text-nowrap">Historial de PQRSF</h3>
            </div>
        </div>

        <div class="mt-5">
            <table class="table table-striped table-hover" id="tablaPqrs">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Solicitante</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Ver detalle</th>
                        <?php if (esAdministrador() || esFuncionario()): ?>
                        <th>Acción</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($pqrs as $pqr): ?>
                    <tr>
                        <td><?php echo $pqr['pqr_id']?></td>
                        <td><?php echo $pqr['usu_nombre']?></td>
                        <td><?php echo $pqr['pqr_tipo']?></td>
                        <td><?php echo $pqr['pqr_descripcion']?></td>
                        <td>
                            <?php
                                $estado = $pqr['pqr_estado_solicitud'];
                                $badge = $estado == 'Pendiente' ? 'warning' : ($estado == 'Resuelto' ? 'success' : ($estado == 'Rechazado' ? 'danger' : 'info'));
                            ?>
                            <span class="badge badge-<?php echo $badge?>"><?php echo $estado?></span>
                        </td>
                        <td>
                            <a href="<?php echo getUrl('Pqrfs', 'Pqrfs', 'getDetalle') . '&id=' . $pqr['pqr_id']; ?>" class="btn btn-sm btn-info text-white">Ver</a>
                        </td>
                        <?php if (esAdministrador() || esFuncionario()): ?>
                        <td>
                            <form action="<?php echo getUrl('Pqrfs', 'Pqrfs', 'postAtender'); ?>" method="post" class="d-flex gap-1">
                                <input type="hidden" name="pqr_id" value="<?php echo $pqr['pqr_id']?>">
                                <select name="pqr_estado_solicitud" class="form-control form-control-sm">
                                    <option value="Pendiente" <?php echo $estado == 'Pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                                    <option value="En proceso" <?php echo $estado == 'En proceso' ? 'selected' : ''; ?>>En proceso</option>
                                    <option value="Resuelto" <?php echo $estado == 'Resuelto' ? 'selected' : ''; ?>>Resuelto</option>
                                    <option value="Rechazado" <?php echo $estado == 'Rechazado' ? 'selected' : ''; ?>>Rechazado</option>
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
        $('#tablaPqrs').DataTable({ language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' } });
    }
});
</script>