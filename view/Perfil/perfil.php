<?php

include_once dirname(__FILE__) . '/../partials/header.php';
include_once dirname(__FILE__) . '/../partials/navbar.php';

?>

<div class="container-fluid">
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold">Configuración de la cuenta</h3>
        </div>

        <?php
        if (isset($_SESSION['success_perfil'])) {
            ?>

            <div class="alert alert-success">
                <?php
                echo $_SESSION['success_perfil'];
                unset($_SESSION['success_perfil']);
                ?>
            </div>

            <?php
        }

        if (isset($_SESSION['error_perfil'])) {
            ?>

            <div class="alert alert-danger">
                <?php
                echo $_SESSION['error_perfil'];
                unset($_SESSION['error_perfil']);
                ?>
            </div>

        <?php } ?>


        <div class="card">

            <div class="card-header">
                <h4>Mi Perfil</h4>
            </div>

            <div class="card-body">

                <div class="text-center mb-4">

                    <img src="../view/assets/img/usuario.png" class="rounded-circle" style="width:120px;height:120px;">

                    <h4 class="mt-3">
                        <?php
                        echo htmlspecialchars($usuario['nombre'] . " " . $usuario['apellido']);
                        ?>
                    </h4>

                    <span class="badge bg-secondary">
                        <?php echo htmlspecialchars($usuario['nombre_rol']); ?>
                    </span>

                </div>

                <hr>

                <form action="<?php echo getUrl('Perfil', 'Perfil', 'postActualizar'); ?>" method="POST">

                    <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Nombre</label>

                            <input type="text" class="form-control" name="nombre"
                                value="<?php echo htmlspecialchars($usuario['nombre']); ?>">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Apellido</label>

                            <input type="text" class="form-control" name="apellido"
                                value="<?php echo htmlspecialchars($usuario['apellido']); ?>">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Correo</label>

                            <input type="email" class="form-control" name="correo_electronico"
                                value="<?php echo htmlspecialchars($usuario['correo_electronico']); ?>">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Nombre de usuario</label>

                            <input type="text" class="form-control" name="nombre_usuario"
                                value="<?php echo htmlspecialchars($usuario['nombre_usuario']); ?>">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Teléfono</label>

                            <input type="text" maxlength="10" class="form-control" name="telefono"
                                value="<?php echo htmlspecialchars($usuario['telefono']); ?>">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Dirección</label>

                            <input type="text" class="form-control" name="direccion"
                                value="<?php echo htmlspecialchars($usuario['direccion']); ?>">

                        </div>
                        <div class="col-md-4 mb-3">

                            <label>Rol</label>

                            <input type="text" class="form-control"
                                value="<?php echo htmlspecialchars($usuario['nombre_rol']); ?>" disabled>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>Tipo de documento</label>

                            <input type="text" class="form-control"
                                value="<?php echo htmlspecialchars($usuario['nombre_tipos_doc']); ?>" disabled>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>Número de documento</label>

                            <input type="text" class="form-control"
                                value="<?php echo htmlspecialchars($usuario['numero_identificacion']); ?>" disabled>

                        </div>

                    </div>

                    <hr>

                    <h5 class="mb-3">
                        Cambiar contraseña (Opcional)
                    </h5>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label>Contraseña actual</label>

                            <input type="password" class="form-control" name="clave_actual">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>Nueva contraseña</label>

                            <input type="password" class="form-control" name="nueva_clave">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>Confirmar contraseña</label>

                            <input type="password" class="form-control" name="confirmar_clave">

                        </div>

                    </div>

                    <div class="text-end mt-3">

                        <button type="submit" class="btn btn-success">

                            <i class="fas fa-save"></i>
                            Guardar cambios

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?php
include_once '../view/partials/footer.php';
?>