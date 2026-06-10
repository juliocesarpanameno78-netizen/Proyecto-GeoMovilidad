<div class="mt-5">
    <h1 class="display-4">Registro Roles</h1>
</div>

<div class="mt-5">
    <form action="<?= getUrl('Roles', 'Roles', 'postCreate'); ?>" method="post">

        <div class="row">

            <div class="col-4 mt-3">
                <label for="rol_nombre">Nombre:</label>
                <input type="text" name="rol_nombre" id="rol_nombre" class="form-control" placeholder="Ingrese el rol">
            </div>

        </div>

        <div class="mt-5">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Acción/Módulo</th>

                        <?php
                        $modulosArray = [];

                        while ($modulo = pg_fetch_assoc($modulos)) {
                            echo "<th>" . $modulo['mod_nombre'] . "</th>";
                            $modulosArray[] = $modulo;
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($accion = pg_fetch_assoc($acciones)) {
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
        <div class="col-4">
            <input type="submit" value="Registrar" class="btn btn-success mt-4">
        </div>
    </form>
</div>