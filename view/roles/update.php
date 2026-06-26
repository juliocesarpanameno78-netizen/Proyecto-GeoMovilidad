<div class="container-fluid">
    <div class="page-inner">

        <div class="mt-5">
            <h1 class="display-4">Editar Rol</h1>
        </div>

        <?php
        if (isset($_SESSION['error_roles'])) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <?php
                echo $_SESSION['error_roles'];
                unset($_SESSION['error_roles']);
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php
        }
        ?>

        <div class="mt-5">

            <?php
            foreach ($roles as $rol) {
            ?>

                <form action="<?php echo getUrl("Roles", "Roles", "postUpdate"); ?>" method="post">

                    <div class="row">

                        <div class="col-4 mt-3">
                            <label for="rol_nombre">Nombre:</label>

                            <input
                                type="text"
                                name="rol_nombre"
                                id="rol_nombre"
                                class="form-control"
                                placeholder="Ingrese el rol"
                                value="<?php echo $rol['nombre_rol']; ?>">

                            <input
                                type="hidden"
                                name="rol_id"
                                value="<?php echo $rol['id_rol']; ?>">

                        </div>

                    </div>

                    <div class="mt-5">

                        <table class="table table-striped table-hover">

                            <thead>
                                <tr>
                                    <th>ACCION/MODULO</th>

                                    <?php
                                    $modulosArray = array();

                                    foreach ($modulos as $modulo) {
                                        echo "<th>" . $modulo['mod_nombre'] . "</th>";
                                        $modulosArray[] = $modulo;
                                    }
                                    ?>

                                </tr>
                            </thead>

                            <tbody>

                                <?php

                                foreach ($acciones as $accion) {

                                    echo "<tr>";
                                    echo "<td>" . $accion['acc_nombre'] . "</td>";

                                    foreach ($modulosArray as $mod) {

                                        $checked = "";

                                        if (
                                            isset($permisos_rol[$mod['mod_id']]) &&
                                            in_array($accion['acc_id'], $permisos_rol[$mod['mod_id']])
                                        ) {
                                            $checked = "checked";
                                        }

                                        echo "<td>
                                                <input
                                                    type='checkbox'
                                                    name='permisos[" . $mod['mod_id'] . "][" . $accion['acc_id'] . "]'
                                                    value='1'
                                                    " . $checked . ">
                                              </td>";
                                    }

                                    echo "</tr>";
                                }

                                ?>

                            </tbody>

                        </table>

                    </div>

                    <div class="col-4">

                        <input
                            type="submit"
                            value="Actualizar"
                            class="btn btn-success mt-4">

                    </div>

                </form>

            <?php
            }
            ?>

        </div>

    </div>
</div>