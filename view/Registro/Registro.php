<?php
session_start();
require_once dirname(__FILE__) . '/../../model/Registro/RegistroModel.php';
$obj = new RegistroModel();
$tipos_documento = $obj->getTiposDocumento();
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Geomovilidad - Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="Registro.css" rel="stylesheet">
</head>
<body>

<div class="d-flex justify-content-center align-items-center min-vh-100 py-4">
    <div class="card" style="width: 500px;">
        <div class="card-header text-center fw-bold">
            <img src="../../view/assets/img/geomovilidad.png" alt="Logo Geomovilidad" style="width: 150px; height:auto;"><br>
            <h3>Crear cuenta</h3>
        </div>
        <div class="card-body">

            

            <?php
            if (isset($_GET['error'])) {

                switch ($_GET['error']) {

                    case 'correo':
                        echo '<div class="alert alert-danger" role="alert">
                                El correo electrónico ya está registrado.
                            </div>';
                        break;

                    case 'identificacion':
                        echo '<div class="alert alert-danger" role="alert">
                                La identificación ya está registrada.
                            </div>';
                        break;

                    case 'passwords':
                        echo '<div class="alert alert-danger" role="alert">
                                Las contraseñas no coinciden.
                            </div>';
                        break;

                    case 'general':
                        echo '<div class="alert alert-danger" role="alert">
                                Ocurrió un error al registrar el usuario.
                            </div>';
                        break;

                    case 'vacio':
                        $campo = isset($_GET['campo']) ? $_GET['campo'] : '';
                        $mensajes = array(
                            'tipo_documento'        => 'Debes seleccionar el tipo de documento.',
                            'identificacion'        => 'Debes ingresar el número de identificación.',
                            'nombre'                => 'Debes ingresar el nombre.',
                            'apellido'              => 'Debes ingresar el apellido.',
                            'correo'                => 'Debes ingresar el correo electrónico.',
                            'telefono'              => 'Debes ingresar el teléfono.',
                            'direccion'             => 'Debes ingresar la dirección.',
                            'usuario'               => 'Debes ingresar el nombre de usuario.',
                            'contrasena'            => 'Debes ingresar la contraseña.',
                            'confirmar_contrasena'  => 'Debes confirmar la contraseña.'
                        );
                        $mensaje = isset($mensajes[$campo]) ? $mensajes[$campo] : 'Debes completar todos los campos obligatorios.';
                        echo '<div class="alert alert-warning" role="alert">' . htmlspecialchars($mensaje) . '</div>';
                        break;
                }
            }
            ?>


            <form action="/Geomovilidad/web/index.php?modulo=Registro&controlador=Registro&function=postRegistro" method="POST">
                
                <h6 class="text-muted mb-3">Datos personales</h6>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="col">
                        <label class="form-label">Apellido</label>
                        <input type="text" name="apellido" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Tipo de documento</label>
                        <select name="id_tipo_documento" class="form-select" required>
                            <option value="">Seleccione...</option>
                            <?php if (isset($tipos_documento) && $tipos_documento): ?>
                                <?php while ($tipo = pg_fetch_assoc($tipos_documento)): ?>
                                    <option value="<?= $tipo['tdoc_id'] ?>">
                                        <?= $tipo['tdoc_nombre'] ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label">Número de identificación</label>
                        <input type="number" name="numero_identificacion" class="form-control" required min:>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo electrónico</label>
                    <input type="email" name="correo_electronico" class="form-control" required>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Teléfono</label>
                        <input type="number" name="telefono" class="form-control" required max="9999999999">
                    </div>
                    <div class="col">
                        <label class="form-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control" required>
                    </div>
                </div>

                <hr>
                <h6 class="text-muted mb-3">Datos de acceso</h6>

                <div class="mb-3">
                    <label class="form-label">Nombre de usuario</label>
                    <input type="text" name="nombre_usuario" class="form-control" required>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="contrasena" class="form-control" required>
                    </div>
                    <div class="col">
                        <label class="form-label">Confirmar contraseña</label>
                        <input type="password" name="confirmar_contrasena" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                <a href="/Geomovilidad/view/Login/Login.php" class="btn btn-link w-100 mt-2">
                    ¿Ya tienes cuenta? Inicia sesión
                </a>

            

            </form>
        </div>
    </div>
</div>

</body>
</html>