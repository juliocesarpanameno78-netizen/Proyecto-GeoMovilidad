<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5 mb-4">
            <div class="col-md-8">
                <h3 class="m-0 display-4">Detalle de solicitud</h3>
                <p class="text-muted mt-2 mb-0">Visualizando solo la solicitud seleccionada.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'getListar'); ?>" class="btn btn-secondary">Volver al listado</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-bold">ID</label>
                        <div><?php echo $solicitud['id']; ?></div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Tipo</label>
                        <div><?php echo $solicitud['tipo_solicitud']; ?></div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Solicitante</label>
                        <div><?php echo $solicitud['usu_nombre']; ?></div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Estado</label>
                        <div><span class="badge bg-info text-dark"><?php echo $solicitud['est_nombre']; ?></span></div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Detalle</label>
                        <div><?php echo $solicitud['detalle']; ?></div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Orientación</label>
                        <div><?php echo !empty($solicitud['orientacion']) ? $solicitud['orientacion'] : 'N/A'; ?></div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Categoría</label>
                        <div><?php echo !empty($solicitud['categoria']) ? $solicitud['categoria'] : 'N/A'; ?></div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold">Descripción</label>
                        <div class="border rounded p-3 bg-light"><?php echo !empty($solicitud['descripcion']) ? $solicitud['descripcion'] : 'Sin descripción'; ?></div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Dirección</label>
                        <div><?php echo !empty($solicitud['direccion']) ? $solicitud['direccion'] : 'N/A'; ?></div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Coordenada X</label>
                        <div><?php echo $solicitud['coord_x'] !== null && $solicitud['coord_x'] !== '' ? $solicitud['coord_x'] : 'N/A'; ?></div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Coordenada Y</label>
                        <div><?php echo $solicitud['coord_y'] !== null && $solicitud['coord_y'] !== '' ? $solicitud['coord_y'] : 'N/A'; ?></div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold">Imagen</label>
                        <div>
                            <?php if (!empty($solicitud['imagen'])): ?>
                                <img src="<?php echo $solicitud['imagen']; ?>" alt="Imagen de la solicitud" style="max-width:100%;max-height:360px;border-radius:8px;object-fit:contain;">
                            <?php else: ?>
                                <span class="text-muted">Sin imagen adjunta</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>