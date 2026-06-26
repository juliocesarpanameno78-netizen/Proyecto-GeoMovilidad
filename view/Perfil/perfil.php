<?php 

include_once dirname(__FILE__) . '/../partials/header.php'; 
include_once dirname(__FILE__) . '/../partials/navbar.php'; 
?>

<div class="container-fluid">
    <div class="page-inner">

        <div class="row mt-4 mb-2">
            <div class="col-md-12">
                <div class="page-header">
                    <h3 class="fw-bold mb-1">Mi Perfil</h3>
            
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="<?php echo getUrl('Login', 'Login', 'dashboard') ?>">
                               <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <span>Mi Perfil</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <?php if (isset($_SESSION['success_perfil'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo htmlspecialchars($_SESSION['success_perfil']);
                unset($_SESSION['success_perfil']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_perfil'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?php echo htmlspecialchars($_SESSION['error_perfil']);
                unset($_SESSION['error_perfil']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row">

            <div class="col-md-4 mb-4">
                <div class="card card-round h-100">
                    <div class="card-body text-center py-5">

                        <div class="avatar-perfil mx-auto mb-3">
                            <img src="../view/assets/img/usuario.png"
                                 alt="Foto de perfil"
                                 class="rounded-circle shadow"
                                 style="width: 110px; height: 110px; object-fit: cover; border: 4px solid #f1f1f1;">
                        </div>

                        <h4 class="fw-bold mb-1">
                            <?php echo isset($_SESSION['nombre_completo']) ? htmlspecialchars($_SESSION['nombre_completo']) : 'Invitado'; ?>
                        </h4>
                        <span class="badge bg-secondary fs-6 px-3 py-2 mb-3">
                            <i class="fas fa-user-tag me-1"></i>
                            <?php echo isset($_SESSION['nombre_rol']) ? htmlspecialchars($_SESSION['nombre_rol']) : ''; ?>
                        </span>

                        <hr>

                        <ul class="list-unstyled text-start px-3 mt-3">
                            <li class="mb-2 text-muted">
                                <i class="fas fa-envelope me-2 text-primary"></i>
                                <?php echo isset($_SESSION['usu_email']) ? htmlspecialchars($_SESSION['usu_email']) : '—'; ?>
                            </li>
                            <li class="mb-2 text-muted">
                                <i class="fas fa-user me-2 text-primary"></i>
                                @<?php echo isset($_SESSION['nombre_usuario']) ? htmlspecialchars($_SESSION['nombre_usuario']) : '—'; ?>
                            </li>
                        </ul>

                        <div class="mt-4">
                            <a href="<?php echo getUrl('Login', 'Login', 'logout'); ?>" class="btn btn-danger btn-sm px-4">
                                <i class="fas fa-sign-out-alt me-1"></i> Cerrar sesión
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 mb-4">

                <div class="card card-round">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="perfilTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">
                                    <i class="fas fa-id-card me-1"></i> Información
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="editar-tab" data-bs-toggle="tab" data-bs-target="#editar" type="button" role="tab">
                                    <i class="fas fa-edit me-1"></i> Editar datos
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="clave-tab" data-bs-toggle="tab" data-bs-target="#clave" type="button" role="tab">
                                    <i class="fas fa-lock me-1"></i> Cambiar contraseña
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body tab-content" id="perfilTabsContent">

                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            <div class="row mt-3">

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted small fw-semibold text-uppercase">Nombre</label>
                                    <div class="form-control p-2 bg-light border-0">
                                        <?php 
                                        if (isset($_SESSION['nombre_completo'])) {
                                            $partes_nombre = explode(' ', $_SESSION['nombre_completo']);
                                            echo htmlspecialchars($partes_nombre[0]);
                                        } else {
                                            echo '—';
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted small fw-semibold text-uppercase">Apellido</label>
                                    <div class="form-control p-2 bg-light border-0">
                                        <?php
                                        $partes = isset($_SESSION['nombre_completo']) ? explode(' ', $_SESSION['nombre_completo'], 2) : array();
                                        echo htmlspecialchars(isset($partes[1]) ? $partes[1] : '—');
                                        ?>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted small fw-semibold text-uppercase">Correo electrónico</label>
                                    <div class="form-control p-2 bg-light border-0">
                                        <?php echo isset($_SESSION['usu_email']) ? htmlspecialchars($_SESSION['usu_email']) : '—'; ?>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted small fw-semibold text-uppercase">Nombre de usuario</label>
                                    <div class="form-control p-2 bg-light border-0">
                                        <?php echo isset($_SESSION['nombre_usuario']) ? '@' . htmlspecialchars($_SESSION['nombre_usuario']) : '—'; ?>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted small fw-semibold text-uppercase">Rol asignado</label>
                                    <div class="form-control p-2 bg-light border-0">
                                        <?php echo isset($_SESSION['nombre_rol']) ? htmlspecialchars($_SESSION['nombre_rol']) : '—'; ?>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted small fw-semibold text-uppercase">ID de usuario</label>
                                    <div class="form-control p-2 bg-light border-0">
                                        #<?php echo isset($_SESSION['id_usuario']) ? htmlspecialchars($_SESSION['id_usuario']) : '—'; ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="editar" role="tabpanel">
                            <form action="<?php echo getUrl('Perfil', 'Perfil', 'postActualizar') ?>" method="POST">

                                <input type="hidden" name="id_usuario" value="<?php echo isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : ''; ?>">

                                <div class="row mt-3">

                                    <div class="col-md-6 mb-4">
                                        <label>Nombre:</label>
                                        <input type="text" name="nombre" class="form-control p-2"
                                               value="<?php echo isset($_SESSION['per_nombre']) ? htmlspecialchars($_SESSION['per_nombre']) : ''; ?>"
                                               placeholder="Tu nombre" required>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label>Apellido:</label>
                                        <input type="text" name="apellido" class="form-control p-2"
                                               value="<?php echo isset($_SESSION['per_apellido']) ? htmlspecialchars($_SESSION['per_apellido']) : ''; ?>"
                                               placeholder="Tu apellido" required>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label>Correo electrónico:</label>
                                        <input type="email" name="correo_electronico" class="form-control p-2"
                                               value="<?php echo isset($_SESSION['usu_email']) ? htmlspecialchars($_SESSION['usu_email']) : ''; ?>"
                                               required>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label>Nombre de usuario:</label>
                                        <input type="text" name="nombre_usuario" class="form-control p-2"
                                               value="<?php echo isset($_SESSION['nombre_usuario']) ? htmlspecialchars($_SESSION['nombre_usuario']) : ''; ?>"
                                               required>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label>Teléfono:</label>
                                        <input type="text" name="telefono" class="form-control p-2" maxlength="10"
                                               value="<?php echo isset($_SESSION['per_telefono']) ? htmlspecialchars($_SESSION['per_telefono']) : ''; ?>"
                                               placeholder="3001234567">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label>Dirección:</label>
                                        <input type="text" name="direccion" class="form-control p-2"
                                               value="<?php echo isset($_SESSION['per_direccion']) ? htmlspecialchars($_SESSION['per_direccion']) : ''; ?>"
                                               placeholder="Ejemplo: Cra 1 #0-00">
                                    </div>

                                </div>

                                <div class="d-flex justify-content-end mt-2">
                                    <button type="submit" class="btn btn-success px-5 p-2">
                                        <i class="fas fa-save me-1"></i> Guardar cambios
                                    </button>
                                </div>

                            </form>
                        </div>

                        <div class="tab-pane fade" id="clave" role="tabpanel">
                            <form action="<?php echo getUrl('Perfil', 'Perfil', 'postCambiarClave') ?>" method="POST">

                                <input type="hidden" name="id_usuario" value="<?php echo isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : ''; ?>">

                                <div class="row mt-3">

                                    <div class="col-md-12 mb-4">
                                        <label>Contraseña actual:</label>
                                        <div class="input-group">
                                            <input type="password" name="clave_actual" id="claveActual" class="form-control p-2" required placeholder="Ingresa tu contraseña actual">
                                            <button class="btn btn-outline-secondary" type="button" onclick="toggleClave('claveActual', this)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label>Nueva contraseña:</label>
                                        <div class="input-group">
                                            <input type="password" name="nueva_clave" id="nuevaClave" class="form-control p-2" required placeholder="Mínimo 6 caracteres">
                                            <button class="btn btn-outline-secondary" type="button" onclick="toggleClave('nuevaClave', this)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label>Confirmar nueva contraseña:</label>
                                        <div class="input-group">
                                            <input type="password" name="confirmar_clave" id="confirmarClave" class="form-control p-2" required placeholder="Repite la nueva contraseña">
                                            <button class="btn btn-outline-secondary" type="button" onclick="toggleClave('confirmarClave', this)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="text-muted small">Fortaleza de la contraseña:</label>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar" id="fortalezaBarra" role="progressbar" style="width: 0%"></div>
                                        </div>
                                        <small id="fortalezaTexto" class="text-muted"></small>
                                    </div>

                                </div>

                                <div class="d-flex justify-content-end mt-2">
                                    <button type="submit" class="btn btn-primary px-5 p-2">
                                        <i class="fas fa-key me-1"></i> Actualizar contraseña
                                    </button>
                                </div>

                            </form>
                        </div>

                    </div></div></div></div></div></div><script>
    // Mostrar / ocultar contraseña
    function toggleClave(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon  = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Indicador de fortaleza de contraseña
    document.getElementById('nuevaClave').addEventListener('input', function () {
        const val   = this.value;
        const barra = document.getElementById('fortalezaBarra');
        const texto = document.getElementById('fortalezaTexto');

        let fuerza = 0;
        if (val.length >= 6)  fuerza++;
        if (val.length >= 10) fuerza++;
        if (/[A-Z]/.test(val)) fuerza++;
        if (/[0-9]/.test(val)) fuerza++;
        if (/[^A-Za-z0-9]/.test(val)) fuerza++;

        const niveles = [
            { pct: '0%',   cls: '',               lbl: '' },
            { pct: '25%',  cls: 'bg-danger',      lbl: 'Muy débil' },
            { pct: '50%',  cls: 'bg-warning',     lbl: 'Débil' },
            { pct: '75%',  cls: 'bg-info',        lbl: 'Aceptable' },
            { pct: '90%',  cls: 'bg-primary',     lbl: 'Fuerte' },
            { pct: '100%', cls: 'bg-success',     lbl: 'Muy fuerte' }
        ];

        barra.style.width     = niveles[fuerza].pct;
        barra.className       = 'progress-bar ' + niveles[fuerza].cls;
        texto.textContent     = niveles[fuerza].lbl;
    });
</script>

<?php include_once '../view/partials/footer.php'; ?>