<div class="container-fluid">
    <div class="page-inner">

        <div class="row mt-5">
            <div class="col-md-6">
                <h3 class="m-3 display-3 text-nowrap">Listado de Roles</h3>
            </div>

            <div class="col-md-6 d-flex justify-content-end">
                <a href="<?php echo getUrl("Roles", "Roles", "getCreate"); ?>">
                    <button class="btn btn-success m-4 p-2 text-nowrap">Nuevo Rol</button>
                </a>
            </div>
        </div>

        <div class="mt-5">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Rol</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($roles as $rol) {
                        echo "<tr>";
                        echo "<td>" . $rol['id_rol'] . "</td>";
                        echo "<td>" . $rol['nombre_rol'] . "</td>";

                        echo "<td>
                                <a href='" . getUrl("Roles", "Roles", "getUpdate") . "&rol_id=" . $rol['id_rol'] . "'>
                                    <button class='btn btn-warning'>Editar</button>
                                </a>
                            </td>";

                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>