<div class="container-fluid">
    <div class="page-inner">


        <div class="row mt-5">
            <div class="col-md-12">
                <h3 class="m-3 display-3">Registro Roles</h3>
            </div>
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


        <form action="<?php echo getUrl('Roles', 'Roles', 'postCreate'); ?>" method="post">

            <div class="row mt-5">

                <div class="col-md-4 mb-4">
                    <label for="rol_nombre">Nombre:</label>
                    <input type="text" name="rol_nombre" id="rol_nombre" class="form-control p-2"
                        placeholder="Ingrese el rol" minlength="3" maxlength="50" required>
                </div>

            </div>

            <div class="mt-5">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Accion/Modulo</th>

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

                                echo "<td>
                                        <input type='checkbox' name='permisos[" . $mod['mod_id'] . "][" . $accion['acc_id'] . "]'
                                        value='1'>
                                      </td>";
                            }

                            echo "</tr>";
                        }
                        ?>
                    </tbody>

                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <input type="submit" value="Registrar" class="btn btn-warning mt-4 p-2">
            </div>

        </form>

    </div>
</div>