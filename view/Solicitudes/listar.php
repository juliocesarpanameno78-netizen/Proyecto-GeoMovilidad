<div class="container-fluid">
    <div class="page-inner">

        <div class="row mt-5">
            <div class="col-md-12">
                <h3 class="m-3 display-3 text-nowrap">Gestión de Solicitudes</h3>
            </div>
        </div>

        <!-- Filtro por tipo -->
        <ul class="nav nav-tabs mb-4 px-3">
            <li class="nav-item">
                <a class="nav-link <?php echo ($filtro_tipo == '') ? 'active' : ''; ?>"
                   href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'getListar'); ?>">Todas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($filtro_tipo == 'Señal') ? 'active' : ''; ?>"
                   href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'getListar'); ?>&tipo_solicitud=Señal">Señales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($filtro_tipo == 'Reductor') ? 'active' : ''; ?>"
                   href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'getListar'); ?>&tipo_solicitud=Reductor">Reductores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($filtro_tipo == 'Vía') ? 'active' : ''; ?>"
                   href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'getListar'); ?>&tipo_solicitud=Vía">Vías</a>
            </li>
        </ul>

        <div class="row mb-4 px-3">
            <div class="col-12">
                <span class="me-2">Orientación:</span>
                <div class="btn-group" role="group" aria-label="Filtrar por orientación">
                    <button type="button" class="btn btn-outline-primary btn-sm filtro-orientacion active" data-orientacion="todas">Todas</button>
                    <button type="button" class="btn btn-outline-primary btn-sm filtro-orientacion" data-orientacion="vertical">Vertical</button>
                    <button type="button" class="btn btn-outline-primary btn-sm filtro-orientacion" data-orientacion="horizontal">Horizontal</button>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <table class="table table-striped table-hover" id="tablaSolicitudes">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Tipo</th>
                        <th>Detalle</th>
                        <th>Orientación</th>
                        <th>Descripción</th>
                        <th>Solicitante</th>
                        <th>Estado</th>
                        <th>Ir a gestionar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($solicitudes) == 0) {
                        echo "<tr><td colspan='8' class='text-center'>No hay solicitudes registradas</td></tr>";
                    }

                    foreach ($solicitudes as $s) {
                        $badge = $s['est_nombre'] == 'Pendiente' ? 'warning' : ($s['est_nombre'] == 'Resuelto' ? 'success' : ($s['est_nombre'] == 'Rechazado' ? 'danger' : 'info'));
                        $orientacion = isset($s['orientacion']) ? trim($s['orientacion']) : '';

                        // Cada tipo de solicitud se gestiona (cambia de estado) desde su propio módulo
                        if ($s['tipo_solicitud'] == 'Señal') {
                            $url_gestion = getUrl('Senales', 'Senales', 'getListar');
                        } else if ($s['tipo_solicitud'] == 'Reductor') {
                            $url_gestion = getUrl('Reductor', 'Reductor', 'getListar');
                        } else {
                            $url_gestion = getUrl('Via', 'Via', 'getListar');
                        }

                        echo "<tr data-orientacion='" . strtolower($orientacion) . "'>";
                        echo "<td>" . $s['id'] . "</td>";
                        echo "<td>" . ($s['tipo_solicitud']) . "</td>";
                        echo "<td>" . ($s['detalle']) . "</td>";
                        echo "<td>" . ($orientacion !== '' ? $orientacion : '<span class=\"text-muted\">N/A</span>') . "</td>";
                        echo "<td>" . ($s['descripcion']) . "</td>";
                        echo "<td>" . ($s['usu_nombre']) . "</td>";
                        echo "<td><span class='badge badge-" . $badge . "'>" . ($s['est_nombre']) . "</span></td>";
                        echo "<td><a href='" . $url_gestion . "' class='btn btn-sm btn-primary text-white'>Gestionar</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let tabla = null;

    if (typeof $.fn.DataTable !== 'undefined') {
        tabla = $('#tablaSolicitudes').DataTable({ language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' } });
    }

    const botones = document.querySelectorAll('.filtro-orientacion');

    botones.forEach(function (boton) {
        boton.addEventListener('click', function () {
            botones.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const orientacion = this.getAttribute('data-orientacion');

            if (tabla) {
                // Orientación es la columna índice 3 (#, Tipo, Detalle, Orientación...)
                if (orientacion === 'todas') {
                    tabla.column(3).search('').draw();
                } else {
                    tabla.column(3).search(orientacion, true, false).draw();
                }
            } else {
                document.querySelectorAll('#tablaSolicitudes tbody tr').forEach(function (fila) {
                    const filaOrientacion = fila.getAttribute('data-orientacion');
                    fila.style.display = (orientacion === 'todas' || filaOrientacion === orientacion) ? '' : 'none';
                });
            }
        });
    });
});
</script>