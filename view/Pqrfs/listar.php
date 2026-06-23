<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5">
            <div class="col-md-5">
                <h3 class="m-3 display-3 text-nowrap">Historial de PQRSF</h3>
            </div>
        </div>

        <div class="mt-5">
            <table class="table table-striped table-hover" id="tablaPqrs">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Solicitante</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Estado</th>
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
                                $badge = $estado == 'Pendiente' ? 'warning' : ($estado == 'Resuelto' ? 'success' : 'info');
                            ?>
                            <span class="badge badge-<?php echo $badge?>"><?php echo $estado?></span>
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
        $('#tablaPqrs').DataTable({ language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' } });
    }
});
</script>
