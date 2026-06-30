<div class="container-fluid">
    <div class="page-inner">

        <div class="row mt-5">
            <div class="col-md-12">
                <h3 class="m-3 display-3 text-nowrap">Reportes Globales</h3>
            </div>
        </div>

        <ul class="nav nav-tabs mb-4 px-3">
            <li class="nav-item">
                <a class="nav-link <?php echo ($seccion == 'accidentes') ? 'active' : ''; ?>"
                    href="<?php echo getUrl('ReportesGlobales', 'ReportesGlobales', 'getListar'); ?>&seccion=accidentes">
                    Accidentes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($seccion == 'solicitudes') ? 'active' : ''; ?>"
                    href="<?php echo getUrl('ReportesGlobales', 'ReportesGlobales', 'getListar'); ?>&seccion=solicitudes">
                    Solicitudes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($seccion == 'pqrsf') ? 'active' : ''; ?>"
                    href="<?php echo getUrl('ReportesGlobales', 'ReportesGlobales', 'getListar'); ?>&seccion=pqrsf">
                    PQRSF
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($seccion == 'usuarios') ? 'active' : ''; ?>"
                    href="<?php echo getUrl('ReportesGlobales', 'ReportesGlobales', 'getListar'); ?>&seccion=usuarios">
                    Usuarios
                </a>
            </li>
        </ul>

        <?php if ($seccion == 'accidentes'): ?>


            <form action="<?php echo getUrl('ReportesGlobales', 'ReportesGlobales', 'getListar'); ?>" method="get"
                class="row mb-4 px-3">
                <input type="hidden" name="modulo" value="ReportesGlobales">
                <input type="hidden" name="controlador" value="ReportesGlobales">
                <input type="hidden" name="function" value="getListar">
                <input type="hidden" name="seccion" value="accidentes">

                <div class="col-md-3 mb-3">
                    <label>Desde:</label>
                    <input type="date" name="fecha_inicio" class="form-control p-2" value="<?php echo $fecha_inicio; ?>">
                </div>
                <div class="col-md-3 mb-3">
                    <label>Hasta:</label>
                    <input type="date" name="fecha_fin" class="form-control p-2" value="<?php echo $fecha_fin; ?>">
                </div>
                <div class="col-md-3 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary p-2">Filtrar</button>
                    <a href="<?php echo getUrl('ReportesGlobales', 'ReportesGlobales', 'getListar'); ?>&seccion=accidentes"
                        class="btn btn-secondary p-2 ms-2">Limpiar</a>
                </div>
            </form>

            <div class="row px-3">
                <div class="card">
                    <div class="card-header">
                        <strong>Accidentes por Barrio</strong>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive scroll-tabla">

                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Barrio</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    if (count($accidentes_por_barrio) == 0) {
                                        echo "<tr><td colspan='2' class='text-center'>Sin datos</td></tr>";
                                    }

                                    foreach ($accidentes_por_barrio as $a) {
                                        echo "<tr>";
                                        echo "<td>" . $a['bar_nombre'] . "</td>";
                                        echo "<td>" . $a['total'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <strong>Accidentes por Fecha</strong>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive scroll-tabla">

                            <table class="table table-striped">

                                <thead class="table-dark">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    if (count($accidentes_por_fecha) == 0) {
                                        echo "<tr><td colspan='2' class='text-center'>Sin datos</td></tr>";
                                    }

                                    foreach ($accidentes_por_fecha as $a) {
                                        echo "<tr>";
                                        echo "<td>" . $a['sra_fecha'] . "</td>";
                                        echo "<td>" . $a['total'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>

            <div class="px-3">

                <h5>Detalle de Reportes</h5>

                <div class="table-responsive scroll-detalle">

                    <table class="table table-striped table-hover">

                        <thead class="table-dark">

                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Barrio</th>
                                <th>Causa</th>
                                <th>Tipo Choque</th>
                                <th>Lesionados</th>
                                <th>Vehículos</th>
                                <th>Dirección</th>
                                <th>Reportado por</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            if (count($lista_accidentes) == 0) {
                                echo "<tr><td colspan='9' class='text-center'>No se encontraron reportes</td></tr>";
                            }

                            foreach ($lista_accidentes as $r) {

                                echo "<tr>";
                                echo "<td>" . $r['sra_id'] . "</td>";
                                echo "<td>" . $r['sra_fecha'] . "</td>";
                                echo "<td>" . $r['bar_nombre'] . "</td>";
                                echo "<td>" . $r['cau_descripcion'] . "</td>";
                                echo "<td>" . $r['tch_nombre'] . "</td>";
                                echo "<td>" . $r['sra_cantidad_lesionados'] . "</td>";
                                echo "<td>" . $r['sra_cantidad_vehiculo'] . "</td>";
                                echo "<td>" . $r['sra_direccion'] . "</td>";
                                echo "<td>" . $r['usu_nombre'] . "</td>";
                                echo "</tr>";

                            }

                            ?>

                        </tbody>

                    </table>

                </div>

            </div>

        <?php endif; ?>

        <?php if ($seccion == 'solicitudes'): ?>

            <div class="row px-3">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header"><strong>Resumen General</strong></div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($resumen_solicitudes as $r) {
                                        echo "<tr><td>" . $r['tipo'] . "</td><td>" . $r['total'] . "</td></tr>";
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header"><strong>Señales por Estado</strong></div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Estado</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($senales_estado) == 0)
                                        echo "<tr><td colspan='2' class='text-center'>Sin datos</td></tr>";
                                    foreach ($senales_estado as $r) {
                                        echo "<tr><td>" . $r['est_nombre'] . "</td><td>" . $r['total'] . "</td></tr>";
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header"><strong>Reductores por Estado</strong></div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Estado</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($reductores_estado) == 0)
                                        echo "<tr><td colspan='2' class='text-center'>Sin datos</td></tr>";
                                    foreach ($reductores_estado as $r) {
                                        echo "<tr><td>" . $r['est_nombre'] . "</td><td>" . $r['total'] . "</td></tr>";
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row px-3">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header"><strong>Vías en Mal Estado por Estado</strong></div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Estado</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($vias_estado) == 0)
                                        echo "<tr><td colspan='2' class='text-center'>Sin datos</td></tr>";
                                    foreach ($vias_estado as $r) {
                                        echo "<tr><td>" . $r['est_nombre'] . "</td><td>" . $r['total'] . "</td></tr>";
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        <?php endif; ?>

        <?php if ($seccion == 'pqrsf'): ?>

            <div class="row px-3">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header"><strong>PQRSF por Estado</strong></div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Estado</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($pqrsf_estado) == 0)
                                        echo "<tr><td colspan='2' class='text-center'>Sin datos</td></tr>";
                                    foreach ($pqrsf_estado as $r) {
                                        echo "<tr><td>" . $r['estado'] . "</td><td>" . $r['total'] . "</td></tr>";
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header"><strong>PQRSF por Tipo</strong></div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($pqrsf_tipo) == 0)
                                        echo "<tr><td colspan='2' class='text-center'>Sin datos</td></tr>";
                                    foreach ($pqrsf_tipo as $r) {
                                        echo "<tr><td>" . $r['tipo'] . "</td><td>" . $r['total'] . "</td></tr>";
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php if ($seccion == 'usuarios'): ?>

            <div class="row px-3">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header"><strong>Usuarios por Rol</strong></div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Rol</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($usuarios_rol) == 0)
                                        echo "<tr><td colspan='2' class='text-center'>Sin datos</td></tr>";
                                    foreach ($usuarios_rol as $r) {
                                        echo "<tr><td>" . $r['nombre_rol'] . "</td><td>" . $r['total'] . "</td></tr>";
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>

    </div>
</div>

<style>
    /* Contenedor de tablas pequeñas */
.scroll-tabla{
    max-height:300px;
    overflow-y:auto;
    overflow-x:hidden;
}

/* Contenedor detalle */
.scroll-detalle{
    max-height:400px;
    overflow:auto;
}

/* Mantener encabezado visible */
.scroll-tabla table thead,
.scroll-detalle table thead{
    position: sticky;
    top: 0;
    z-index: 1000;
}

/* Encabezados */
.scroll-tabla table thead th,
.scroll-detalle table thead th{
    background:#212529 !important; /* color Bootstrap table-dark */
    color:white !important;
    position: sticky;
    top:0;
    z-index:1000;
}

/* Eliminar espacios raros */
.table{
    margin-bottom:0;
}
</style>