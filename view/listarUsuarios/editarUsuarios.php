<div class="container-fluid">
    <div class="page-inner">

        <div class="row mt-5">
            <div class="col-md-12">
                <h3 class="m-3 display-3">Editar Usuario</h3>
            </div>
        </div>

        <?php
        if (isset($_SESSION['error_usuario'])) {
            ?>
            <div class="alert alert-danger mt-3">
                <?php
                echo $_SESSION['error_usuario'];
                unset($_SESSION['error_usuario']);
                ?>
            </div>
            <?php
        }
        ?>

        <form action="<?php echo getUrl('Usuarios', 'Usuarios', 'postUpdate'); ?>" method="post">

            <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">
            <input type="hidden" name="id_persona" value="<?php echo $usuario['id_persona']; ?>">

            <div class="row mt-5">

                <div class="col-md-4 mb-4">
                    <label>Tipo Documento:</label>
                    <input type="text" class="form-control p-2" value="<?php echo $usuario['nombre_tipos_doc']; ?>"
                        readonly>
                </div>

                <div class="col-md-4 mb-4">
                    <label>Número Identificación:</label>
                    <input type="text" class="form-control p-2" value="<?php echo $usuario['numero_identificacion']; ?>"
                        readonly>
                </div>

                <div class="col-md-4 mb-4">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" class="form-control p-2" value="<?php echo $usuario['nombre']; ?>">
                </div>

                <div class="col-md-4 mb-4">
                    <label>Apellido:</label>
                    <input type="text" name="apellido" class="form-control p-2"
                        value="<?php echo $usuario['apellido']; ?>">
                </div>

                <div class="col-md-4 mb-4">
                    <label>Teléfono:</label>
                    <input type="text" name="telefono" class="form-control p-2" maxlength="10"
                        value="<?= $usuario['telefono']; ?>">
                </div>

                <div class="col-md-4 mb-4">
                    <label>Dirección:</label>
                    <input type="text" name="direccion" class="form-control p-2"
                        value="<?php echo $usuario['direccion']; ?>">
                </div>

                <div class="col-md-4 mb-4">
                    <label>Correo Electrónico:</label>
                    <input type="email" name="correo_electronico" class="form-control p-2"
                        value="<?php echo $usuario['correo_electronico']; ?>" required>
                </div>

                <div class="col-md-4 mb-4">
                    <label>Nombre de Usuario:</label>
                    <input type="text" name="nombre_usuario" class="form-control p-2"
                        value="<?php echo $usuario['nombre_usuario']; ?>">
                </div>

                <div class="col-md-4 mb-4">
                    <label>Rol:</label>

                    <select name="id_rol" class="form-control p-2">

                        <?php
                        foreach ($roles as $rol) {

                            $selected = "";

                            if ($rol['id_rol'] == $usuario['id_rol']) {
                                $selected = "selected";
                            }

                            echo "<option value='" . $rol['id_rol'] . "' " . $selected . ">
                                    " . $rol['nombre_rol'] . "
                                  </option>";
                        }
                        ?>

                    </select>

                </div>

            </div>

            <div class="d-flex justify-content-center mt-4">

                <input type="submit" value="Actualizar Usuario" class="btn btn-success mt-4 p-2">

            </div>

        </form>

    </div>
</div>