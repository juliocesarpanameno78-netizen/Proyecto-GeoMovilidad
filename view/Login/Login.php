<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Geomovilidad - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="Login.css" rel="stylesheet">
</head>
<body>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card" style="width: 380px;">
        <div class="card-header text-center fw-bold">
            <img src="../assets/img/geomovilidad.ico" alt="Logo Geomovilidad" style="width: 150px; height:auto;">
            <br>
            Inicio de Sesión
        </div>
        <div class="card-body">

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">Correo o contraseña incorrectos.</div>
            <?php endif; ?>

            <form action="/Geomovilidad/web/index.php?modulo=Login&controlador=Login&function=postLogin" method="POST">
                <div class="mb-3">
                    <strong><label class="form-label">Correo electrónico</label></strong>
                    <input type="email" name="correo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <strong><label class="form-label">Contraseña</label></strong>
                    <input type="password" name="contrasena" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                <p>¿No tiene una cuenta? <a href="../Registro/Registro.php">Regístrese</a></p>
            </form>

        </div>
    </div>
</div>

</body>
</html>