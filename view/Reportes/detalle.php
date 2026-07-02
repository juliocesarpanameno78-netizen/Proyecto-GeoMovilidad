<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5 mb-4">
            <div class="col-md-8">
                <h3 class="m-0 display-4">Detalle de reporte</h3>
                <p class="text-muted mt-2 mb-0">Visualizando solo el reporte seleccionado.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="<?php echo getUrl('Reportes', 'Reportes', 'getListar'); ?>" class="btn btn-secondary">Volver al listado</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-bold">ID</label>
                        <div><?php echo $reporte['sra_id']; ?></div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Fecha</label>
                        <div><?php echo $reporte['sra_fecha']; ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Reportado por</label>
                        <div><?php echo $reporte['usu_nombre']; ?></div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Barrio</label>
                        <div><?php echo $reporte['bar_nombre']; ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Dirección</label>
                        <div><?php echo $reporte['sra_direccion']; ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Coordenadas</label>
                        <div><?php echo !empty($reporte['sra_coordenadas_texto']) ? $reporte['sra_coordenadas_texto'] : 'Sin coordenadas'; ?></div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Causa</label>
                        <div><?php echo $reporte['cau_descripcion']; ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tipo de choque</label>
                        <div><?php echo $reporte['tch_nombre']; ?></div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Lesionados</label>
                        <div><?php echo $reporte['sra_cantidad_lesionados']; ?></div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Vehículos</label>
                        <div><?php echo $reporte['sra_cantidad_vehiculo']; ?></div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tipo de vehículo</label>
                        <div><?php echo $reporte['tveh_nombre']; ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Modelo / Marca</label>
                        <div><?php echo $reporte['veh_modelo']; ?></div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Color</label>
                        <div><?php echo $reporte['veh_color']; ?></div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Placa</label>
                        <div><?php echo $reporte['veh_placa']; ?></div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold">Descripción</label>
                        <div class="border rounded p-3 bg-light"><?php echo !empty($reporte['sra_descripcion']) ? $reporte['sra_descripcion'] : 'Sin descripción'; ?></div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold">Imagen</label>
                        <div>
                            <?php if (!empty($reporte['sra_imagen'])): ?>
                                <img src="<?php echo $reporte['sra_imagen']; ?>" alt="Imagen del reporte" style="max-width:100%;max-height:360px;border-radius:8px;object-fit:contain;">
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