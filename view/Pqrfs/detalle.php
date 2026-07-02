<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5 mb-4">
            <div class="col-md-8">
                <h3 class="m-0 display-4">Detalle de PQRSF</h3>
                <p class="text-muted mt-2 mb-0">Visualizando solo la solicitud seleccionada.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="<?php echo getUrl('Pqrfs', 'Pqrfs', 'getListar'); ?>" class="btn btn-secondary">Volver al historial</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-bold">ID</label>
                        <div><?php echo $pqr['pqr_id']; ?></div>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-bold">Solicitante</label>
                        <div><?php echo $pqr['usu_nombre']; ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Estado</label>
                        <div>
                            <?php
                                $estado = $pqr['pqr_estado_solicitud'];
                                $badge = $estado == 'Pendiente' ? 'warning' : ($estado == 'Resuelto' ? 'success' : ($estado == 'Rechazado' ? 'danger' : 'info'));
                            ?>
                            <span class="badge badge-<?php echo $badge; ?>"><?php echo $estado; ?></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold">Tipo</label>
                        <div><?php echo $pqr['pqr_tipo']; ?></div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold">Descripción</label>
                        <div class="border rounded p-3 bg-light">
                            <?php echo !empty($pqr['pqr_descripcion']) ? $pqr['pqr_descripcion'] : 'Sin descripción'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
