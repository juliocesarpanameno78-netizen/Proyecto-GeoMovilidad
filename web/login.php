<?php

    include_once '../lib/helpers.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="bg-light">

    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row w-100">
            <div class="col-12 col-sm-10 col-md-6 col-lg-4 mx-auto">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4 p-md-5">

                    <h3 class="text-center mb-4 fw-bold">Iniciar Sesión</h3>

                    <form action="<?php echo getUrl("Acceso", "Acceso", "Login", false, "ajax") ?>" method="post">


                    <label for="email">Correo Electrónico</label>

                        <div class="form-group mb-3"></div>
                        <input type="email" class="form-control" id="email" placeholder="correo@ejemplo.com" name="usu_correo" required>


                    </div>

                    <label for="password">Contraseña</label>
                    <div class="form-group mb-4"></div>

                    <input type="password" class="form-control" id="password" placeholder="Contraseña" name="usu_clave" required>
                </div>

                    <div class="d-grid">
                        <button type="submit" class="btn-btn-primary btn-lg">
                            Iniciar Sesión
                        </button>

                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
    
</body>
</html>