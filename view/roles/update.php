<div class="mt-5">
    <h1 class="display-4">Registro Roles</h1>
</div>

<div class="mt-5">
    <?php
        while($rol=pg_fetch_assoc($roles)){
    ?>
    <form action="<?php echo getUrl("Roles","Roles","postUpdate");?>" method="post">

        <div class="row">
            <div class="col-4 mt-3">
                <label for="rol_nombre">Nombre:</label>
                <input type="text" name="rol_nombre" id="rol_nombre" class="form-control" placeholder="Ingrese el rol" value="<?php
                echo $rol['rol_nombre'] ?>">
                <input type="hidden" name="rol_id" value="<?php echo $rol['rol_id'] ?>">
            </div>

            <div class="col-4 mt-3">
                <label for="rol_descripcion">Descripcion:</label>
                <input type="text" name="rol_descripcion" id="rol_descripcion" class="form-control" placeholder="Ingrese la descripcion">
            </div>
        </div>

        <div class="mt-5">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Accion/Modulo</th>
                        <?php
                        $modulosArray = [];

                        while($modulo=pg_fetch_assoc($modulos)){
                            echo "<th>".$modulo['mod_nombre']."</th>";
                            $modulosArray[] = $modulo;
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
    <?php

        while($accion=pg_fetch_assoc($acciones)){
            echo "<tr>";
                echo "<td>".$accion['acc_nombre']."</td>";

                foreach($modulosArray as $mod){

                    // Si quieres marcar checkbox según permisos existentes:
                    $checked = "";

                    if(isset($permisos_rol[$mod['mod_id']]) && in_array($accion['acc_id'], $permisos_rol[$mod['mod_id']])){
                        $checked = "checked";
                    }

                    echo "<td>
                        <input type='checkbox' name='permisos[".$mod['mod_id']."][".$accion['acc_id']."]' value='1'
                        $checked>
                    </td>";
                }

            echo "</tr>";
           }
        ?>
     </tbody>
   </table>
  </div>
        <div class="col-4">
            <input type="submit" value="Registrar" class="btn btn-succes mt-4">
        </div>
    </form>
    <?php
        }
    ?>
</div>

