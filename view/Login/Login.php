<?php
require_once dirname(__FILE__) . '/../../lib/helpers.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Geomovilidad - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="Login.css" rel="stylesheet">
</head>
<body>
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card" style="width: 380px;">
        <div class="card-header text-center fw-bold">
            <img src="../assets/img/geomovilidad.ico" alt="Logo Geomovilidad" style="width: 150px; height:auto;">
            <br>
            Inicio de Sesión
        </div>
        <div class="card-body">

            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'inhabilitado') {
                    echo '<div class="alert alert-warning"><strong>Acceso denegado.</strong> Usted ha sido inhabilitado por un administrador.</div>';
                } else {
                    echo '<div class="alert alert-danger">Correo o contraseña incorrectos.</div>';
                }
            }
            ?>

            <?php if (isset($_GET['registro']) && $_GET['registro'] == 'exitoso'): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    swal({
                        title: "¡Registro exitoso!",
                        text: "Tu cuenta fue creada correctamente. Ya puedes iniciar sesión.",
                        icon: "success",
                        button: "Aceptar"
                    });
                });
            </script>
            <?php endif; ?>

            <form action="/Geomovilidad/web/index.php?modulo=Login&controlador=Login&function=postLogin" method="POST">
                <div class="mb-3">
                    <strong><label class="form-label">Correo electrónico<span style="color: red;"> *</span></label></strong>
                    <input type="email" name="correo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <strong><label class="form-label">Contraseña<span style="color: red;"> *</span></label></strong>
                    <input type="password" name="contrasena" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                <p>¿No tiene una cuenta? <a href="/Geomovilidad/view/Registro/Registro.php">Regístrese</a></p>

                
            </form>
        </div>
    </div>
</div>

</body>
</html>