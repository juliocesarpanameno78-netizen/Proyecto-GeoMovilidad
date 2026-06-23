<div class="container-fluid">
    <div class="page-inner">

        <div class="row mt-5">
            <div class="col-md-12">
                <h3 class="m-3 display-3 text-nowrap">Auditoría del Sistema</h3>
            </div>
        </div>

        <!-- Filtros -->
        <form action="<?php echo getUrl('Auditoria', 'Auditoria', 'getListar'); ?>" method="get" class="row mb-4 px-3">

            <input type="hidden" name="modulo" value="Auditoria">
            <input type="hidden" name="controlador" value="Auditoria">
            <input type="hidden" name="function" value="getListar">

            <div class="col-md-4 mb-3">
                <label>Tabla afectada:</label>
                <select name="nombre_tabla" class="form-control p-2">
                    <option value="">-- Todas --</option>
                    <?php foreach ($tablas as $tabla) {
                        $sel = ($filtro_tabla == $tabla['nombre_tabla']) ? "selected" : "";
                        echo "<option value='".$tabla['nombre_tabla']."' ".$sel.">".$tabla['nombre_tabla']."</option>";
                    } ?>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Operación:</label>
                <select name="operacion" class="form-control p-2">
                    <option value="">-- Todas --</option>
                    <option value="INSERT" <?php echo ($filtro_operacion == "INSERT") ? "selected" : ""; ?>>INSERT</option>
                    <option value="UPDATE" <?php echo ($filtro_operacion == "UPDATE") ? "selected" : ""; ?>>UPDATE</option>
                    <option value="DELETE" <?php echo ($filtro_operacion == "DELETE") ? "selected" : ""; ?>>DELETE</option>
                </select>
            </div>

            <div class="col-md-4 mb-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary p-2">Filtrar</button>
                <a href="<?php echo getUrl('Auditoria', 'Auditoria', 'getListar'); ?>" class="btn btn-secondary p-2 ms-2">Limpiar</a>
            </div>

        </form>

        <div class="mt-3">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tabla</th>
                        <th>Operación</th>
                        <th>Registro Afectado</th>
                        <th>Valor Anterior</th>
                        <th>Valor Nuevo</th>
                        <th>Usuario BD</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($registros) == 0) {
                        echo "<tr><td colspan='8' class='text-center'>No se encontraron registros de auditoría</td></tr>";
                    }

                    foreach ($registros as $r) {

                        $badge = "secondary";
                        if ($r['operacion'] == "INSERT") $badge = "success";
                        if ($r['operacion'] == "UPDATE") $badge = "warning";
                        if ($r['operacion'] == "DELETE") $badge = "danger";

                        echo "<tr>";
                        echo "<td>" . $r['id_auditoria'] . "</td>";
                        echo "<td>" . htmlspecialchars($r['nombre_tabla']) . "</td>";
                        echo "<td><span class='badge bg-" . $badge . "'>" . htmlspecialchars($r['operacion']) . "</span></td>";
                        echo "<td>" . $r['id_registro_afectado'] . "</td>";
                        echo "<td style='max-width:200px; overflow:hidden; text-overflow:ellipsis;'>" . htmlspecialchars($r['valor_anterior']) . "</td>";
                        echo "<td style='max-width:200px; overflow:hidden; text-overflow:ellipsis;'>" . htmlspecialchars($r['valor_nuevo']) . "</td>";
                        echo "<td>" . htmlspecialchars($r['usuario_db']) . "</td>";
                        echo "<td>" . $r['fecha_registro'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>