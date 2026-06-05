<<<<<<< HEAD
<?php 
    include_once '../lib/helpers.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Colombia</title>
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row w-100">
            <div class="col-12 col-sm-10 col-md-6 col-lg-4 mx-auto">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p4 p-md-5">
                        <h3 class="text-center mb-4 fw-bold">Iniciar Sesion</h3>

                        <form action="<?php echo getUrl("","","","")?>" method="post">
                            <label for="email">Correo electronico</label>
                            <div class="form-group mb-3">
                                <input type="email" class="form-control" name="usu_correo" id="email" placeholder="correo@ejemplo.com" required>
                            </div>

                            <label for="password">Contraseña</label>
                            <div class="form-group mb-4">
                                <input type="password" class="form-control" name="usu_contrasena" id="password" placeholder="********" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Iniciar sesion
                                </button>
                            </div>
                            <div class="">
                                <a href="<?php echo getUrl("","","","")?>">¿No tienes una cuenta? Registrate</a>
                            </div>
                            <div class="">
                                <a href="<?php echo getUrl("","","","")?>">¿Olvidaste tu contraseña?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
=======
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Iniciar sesión</title>
  <style>
    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #e8eaed;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-card {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.10);
      padding: 40px 48px 36px;
      width: 100%;
      max-width: 420px;
    }

    .login-title {
      font-size: 1.45rem;
      font-weight: 600;
      color: #1a1a1a;
      text-align: center;
      margin-bottom: 28px;
    }

    .login-form {
      display: flex;
      flex-direction: column;
      gap: 18px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .form-label {
      font-size: 0.875rem;
      font-weight: 500;
      color: #333333;
    }

    .form-input {
      width: 100%;
      padding: 9px 12px;
      border: 1px solid #d0d5dd;
      border-radius: 6px;
      font-size: 0.9rem;
      color: #1a1a1a;
      background-color: #ffffff;
      outline: none;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-input::placeholder {
      color: #aab0bb;
      font-size: 0.875rem;
    }

    .form-input:focus {
      border-color: #1a73e8;
      box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.15);
    }

    .btn-ingresar {
      width: 100%;
      padding: 11px;
      margin-top: 6px;
      background-color: #1a73e8;
      color: #ffffff;
      font-size: 0.95rem;
      font-weight: 600;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      letter-spacing: 0.3px;
      transition: background-color 0.2s ease, transform 0.1s ease;
    }

    .btn-ingresar:hover {
      background-color: #1558b0;
    }

    .btn-ingresar:active {
      transform: scale(0.98);
    }

    @media (max-width: 480px) {
      .login-card {
        padding: 32px 24px 28px;
        margin: 0 16px;
      }
    }
  </style>
</head>
<body>

  <div class="login-card">
    <h1 class="login-title">Iniciar sesión</h1>

    <form class="login-form" action="#" method="post">

      <div class="form-group">
        <label for="usuario" class="form-label">Usuario o correo</label>
        <input
          type="text"
          id="usuario"
          name="usuario"
          class="form-input"
          placeholder="Ingresa tu usuario"
          autocomplete="username"
          required
        />
      </div>

      <div class="form-group">
        <label for="contrasena" class="form-label">Contraseña</label>
        <input
          type="password"
          id="contrasena"
          name="contrasena"
          class="form-input"
          placeholder="Ingresa tu contraseña"
          autocomplete="current-password"
          required
        />
      </div>

      <button type="submit" class="btn-ingresar">Ingresar</button>

    </form>
  </div>

>>>>>>> 7cb92db212b72a9eb05aa8cf897eca47722aec33
</body>
</html>