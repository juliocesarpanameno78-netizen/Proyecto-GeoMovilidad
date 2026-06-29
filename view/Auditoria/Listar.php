<div class="container-fluid">
    <div class="page-inner">

        <div class="row mt-4">
            <div class="col-md-12">
                <h3 class="m-3 display-3 text-nowrap">Auditoría del Sistema</h3>
            </div>
        </div>

        <!-- Filtros -->
        <form action="<?php echo getUrl('Auditoria', 'Auditoria', 'getListar'); ?>" method="get" class="row mb-3 px-3">
            <input type="hidden" name="modulo"      value="Auditoria">
            <input type="hidden" name="controlador" value="Auditoria">
            <input type="hidden" name="function"    value="getListar">

            <div class="col-md-4 mb-3">
                <label class="fw-semibold">Tabla afectada:</label>
                <select name="nombre_tabla" class="form-control p-2">
                    <option value="">-- Todas --</option>
                    <?php foreach ($tablas as $tabla):
                        $sel = ($filtro_tabla == $tabla['nombre_tabla']) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($tabla['nombre_tabla']) . "' $sel>"
                           . htmlspecialchars($tabla['nombre_tabla']) . "</option>";
                    endforeach; ?>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label class="fw-semibold">Operación:</label>
                <select name="operacion" class="form-control p-2">
                    <option value="">-- Todas --</option>
                    <option value="INSERT" <?php echo $filtro_operacion == 'INSERT' ? 'selected' : ''; ?>>INSERT</option>
                    <option value="UPDATE" <?php echo $filtro_operacion == 'UPDATE' ? 'selected' : ''; ?>>UPDATE</option>
                    <option value="DELETE" <?php echo $filtro_operacion == 'DELETE' ? 'selected' : ''; ?>>DELETE</option>
                </select>
            </div>

            <div class="col-md-4 mb-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary px-4">Filtrar</button>
                <a href="<?php echo getUrl('Auditoria', 'Auditoria', 'getListar'); ?>" class="btn btn-secondary px-4">Limpiar</a>
            </div>
        </form>

        <div class="px-3 mb-2 text-muted">
            <?php echo count($registros); ?> registro(s) encontrado(s)
        </div>

        <div class="px-3">
            <div style="height:560px; overflow-y:auto; border:1px solid #dee2e6; border-radius:6px;">
                <table class="table table-bordered table-hover mb-0" style="width:100%; min-width:900px;">
                    <thead style="position:sticky; top:0; z-index:2; background-color:#343a40; color:#fff;">
                        <tr>
                            <th style="width:55px;">ID</th>
                            <th style="width:160px;">Tabla</th>
                            <th style="width:90px;">Operación</th>
                            <th style="width:70px; text-align:center;">Reg.</th>
                            <th>Detalle</th>
                            <th style="width:120px;">Usuario BD</th>
                            <th style="width:150px;">Fecha y Hora</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (count($registros) == 0): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-clipboard-list fa-2x mb-2 d-block"></i>
                                    No hay registros de auditoría
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php foreach ($registros as $r):
                            $badge = 'secondary';
                            if ($r['operacion'] == 'INSERT') $badge = 'success';
                            if ($r['operacion'] == 'UPDATE') $badge = 'warning';
                            if ($r['operacion'] == 'DELETE') $badge = 'danger';

                            
                            $nombres_tabla = array(
                                'solicitudes_nueva_senal'        => 'Solicitud de Señal',
                                'solicitudes_reporte_accidentes' => 'Reporte de Accidente',
                                'pqrsf'                          => 'PQRSF',
                            );
                            $tabla = $r['nombre_tabla'];
                            $tabla_label = isset($nombres_tabla[$tabla]) ? $nombres_tabla[$tabla] : $tabla;
                        ?>
                        <tr style="vertical-align:top;">
                            <td><?php echo $r['id_auditoria']; ?></td>
                            <td>
                                <span style="font-size:0.82rem; font-weight:600;">
                                    <?php echo htmlspecialchars($tabla_label); ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-<?php echo $badge; ?> px-2 py-1">
                                    <?php echo $r['operacion']; ?>
                                </span>
                            </td>
                            <td class="text-center"><?php echo $r['id_registro']; ?></td>

                            
                            <td style="font-size:0.8rem; line-height:1.7;">

                                <?php if ($tabla == 'solicitudes_nueva_senal'): ?>
                                    <?php
                                    $filas = array(
                                        'Descripción' => $r['sns_descripcion'],
                                        'Dirección'   => $r['sns_direccion'],
                                        'Tipo Señal'  => $r['tsen_id'],
                                        'Categoría'   => $r['cats_id'],
                                        'Estado'      => $r['sns_est_id'],
                                        'Usuario ID'  => $r['sns_usu_id'],
                                    );
                                    foreach ($filas as $label => $val):
                                        if (isset($val) && $val !== ''): ?>
                                            <div>
                                                <span style="color:#6c757d; font-weight:600; margin-right:4px;"><?php echo $label; ?>:</span>
                                                <?php echo htmlspecialchars($val); ?>
                                            </div>
                                    <?php endif; endforeach; ?>

                                <?php elseif ($tabla == 'solicitudes_reporte_accidentes'): ?>
                                    <?php
                                    $filas = array(
                                        'Fecha'        => $r['sra_fecha'],
                                        'Dirección'    => $r['sra_direccion'],
                                        'Descripción'  => $r['sra_descripcion'],
                                        'Lesionados'   => $r['sra_cantidad_lesionados'],
                                        'Vehículos'    => $r['sra_cantidad_vehiculo'],
                                        'Barrio ID'    => $r['sra_bar_id'],
                                        'Causa ID'     => $r['sra_cau_id'],
                                        'Tipo Choque'  => $r['sra_tch_id'],
                                        'Usuario ID'   => $r['sra_usu_id'],
                                    );
                                    foreach ($filas as $label => $val):
                                        if (isset($val) && $val !== ''): ?>
                                            <div>
                                                <span style="color:#6c757d; font-weight:600; margin-right:4px;"><?php echo $label; ?>:</span>
                                                <?php echo htmlspecialchars($val); ?>
                                            </div>
                                    <?php endif; endforeach; ?>

                                <?php elseif ($tabla == 'pqrsf'): ?>
                                    <?php
                                    $filas = array(
                                        'Tipo'        => $r['pqr_tipo'],
                                        'Estado'      => $r['pqr_estado_solicitud'],
                                        'Descripción' => $r['pqr_descripcion'],
                                        'Usuario ID'  => $r['pqr_usu_id'],
                                    );
                                    foreach ($filas as $label => $val):
                                        if (isset($val) && $val !== ''): ?>
                                            <div>
                                                <span style="color:#6c757d; font-weight:600; margin-right:4px;"><?php echo $label; ?>:</span>
                                                <?php echo htmlspecialchars($val); ?>
                                            </div>
                                    <?php endif; endforeach; ?>

                                <?php endif; ?>

                            </td>

                            <td style="font-size:0.82rem;"><?php echo htmlspecialchars($r['usuario_db']); ?></td>
                            <td style="font-size:0.8rem; white-space:nowrap;"><?php echo $r['fecha_registro']; ?></td>
                        </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>