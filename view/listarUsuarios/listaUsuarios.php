<div class="container-fluid">
    <div class="page-inner">

        <div class="row mt-5">
            <div class="col-md-6">
                <h3 class="m-3 display-3 text-nowrap">Listado de Usuarios</h3>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">

                <form action="<?= getUrl("Usuarios", "Usuarios", "buscarUsuario"); ?>" method="POST">

                    <div class="input-group">

                        <input
                            type="text"
                            name="cedula"
                            class="form-control"
                            placeholder="Ingrese número de identificación">

                        <button type="submit" class="btn btn-success ">
                            Buscar
                        </button>

                        <a href="<?= getUrl("Usuarios", "Usuarios", "getUsuarios"); ?>">
                            <button type="button" class="btn btn-secondary">
                                Mostrar Todos
                            </button>
                        </a>

                    </div>

                </form>

            </div>
        </div>

        <?php
        if (isset($_SESSION['success_usuario'])) {
        ?>
            <div class="alert alert-success mt-3">
                <?php
                echo $_SESSION['success_usuario'];
                unset($_SESSION['success_usuario']);
                ?>
            </div>
        <?php
        }
        ?>

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

        <div class="mt-5">

            <table class="table table-striped table-hover">

                <thead class="table-dark">
                    <tr>
                        <th>Tipo Documento</th>
                        <th>Identificación</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Editar</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    foreach ($usuarios as $usuario) {

                        echo "<tr>";

                        echo "<td>" . $usuario['nombre_tipos_doc'] . "</td>";

                        echo "<td>" . $usuario['numero_identificacion'] . "</td>";

                        echo "<td>" . $usuario['nombre'] . "</td>";

                        echo "<td>" . $usuario['apellido'] . "</td>";

                        echo "<td>" . $usuario['telefono'] . "</td>";

                        echo "<td>" . $usuario['correo_electronico'] . "</td>";

                        echo "<td>" . $usuario['nombre_rol'] . "</td>";

                        echo "<td>
                                <a href='" . getUrl("Usuarios", "Usuarios", "getUpdate") . "&id_usuario=" . $usuario['id_usuario'] . "'>
                                    <button class='btn btn-warning'>
                                        Editar
                                    </button>
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