<body>
  <div class="wrapper">
    <!-- Barra lateral de navegación -->
    <div class="sidebar" data-background-color="white">
      <div class="sidebar-logo">
        <div class="logo-header" data-background-color="white">
          <a href="index.php">
            <img src="../view/assets/img/geomovilidad.ico" alt="navbar brand" class="navbar-brand"
              style="max-width: 100%; width: auto; height: 85px;">
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">



            <!-- Separación Ciudadano -->


           <?php if (tienePermiso("Gestion de Solicitudes", "Registrar")): ?>
              <li class="nav-item active">
                <a data-bs-toggle="collapse" href="#solicitud" class="collapsed" aria-expanded="false">
                  <i class="fas fa-home"></i>
                  <p>Hacer una Solicitud</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="solicitud">
                  <ul class="nav nav-collapse">
                    <li><a href="<?php echo getUrl("Senales", "Senales", "getCreate") ?>"><span class="sub-item">Solicitud
                          de Señal</span></a></li>
                    <li><a href="<?php echo getUrl("Reductor", "Reductor", "getCreate") ?>"><span
                          class="sub-item">Solicitud de Reductor</span></a></li>
                    <li><a href="<?php echo getUrl("Via", "Via", "getCreate") ?>"><span class="sub-item">Solicitud de
                          Vía</span></a></li>
                    <li><a href="<?php echo getUrl("Demarcaciones", "Demarcaciones", "getCreate") ?>"><span
                          class="sub-item">Solicitud de Demarcación</span></a></li>
                  </ul>
                </div>
              </li>
            <?php endif; ?>
          </ul>

          <ul class="nav nav-secondary">
            <?php if (tienePermiso("Reportes", "Registrar")): ?>
              <li class="nav-item active">
                <a data-bs-toggle="collapse" href="#reporte" class="collapsed" aria-expanded="false">
                  <i class="fas fa-home"></i>
                  <p>Hacer un Reporte</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="reporte">
                  <ul class="nav nav-collapse">
                    <li><a href="<?php echo getUrl("Reportes", "Reportes", "getCreate") ?>"><span class="sub-item">Hacer
                          un reporte</span></a></li>
                  </ul>
                </div>
              </li>
            <?php endif; ?>
          </ul>

          <ul class="nav nav-secondary">
           <?php if (tienePermiso("PQRSF", "Registrar")): ?>
              <li class="nav-item active">
                <a data-bs-toggle="collapse" href="#pqrsf" class="collapsed" aria-expanded="false">
                  <i class="fas fa-home"></i>
                  <p>Hacer una PQRSF</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="pqrsf">
                  <ul class="nav nav-collapse">
                    <li><a href="<?php echo getUrl("Pqrfs", "Pqrfs", "getCreate") ?>"><span class="sub-item">Hacer una
                          PQRSF</span></a></li>
                  </ul>
                </div>
              </li>
            <?php endif; ?>
          </ul>

          <ul class="nav nav-secondary">
           <?php if (
    tienePermiso("Solicitud de Señal", "Listar") ||
    tienePermiso("Reportes", "Listar") ||
    tienePermiso("PQRSF", "Listar")
): ?>
              <li class="nav-item active">
                <a data-bs-toggle="collapse" href="#historial" class="collapsed" aria-expanded="false">
                  <i class="fas fa-user-shield"></i>
                  <p>Mi historial</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="historial">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="<?php echo getUrl("Senales", "Senales", "listar") ?>">
                        <span class="sub-item">Historial de solicitudes</span>
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo getUrl("Reportes", "Reportes", "listar") ?>">
                        <span class="sub-item">Historial de reportes</span>
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo getUrl("Pqrfs", "Pqrfs", "listar") ?>">
                        <span class="sub-item">Historial de PQRFS</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            <?php endif; ?>
          </ul>


          <!-- Separación Funcionario -->

          <ul class="nav nav-secondary">

            <?php if (
              tienePermiso("Gestion de Solicitudes", "Listar") &&
              tienePermiso("Gestion de Solicitudes", "Editar")
            ): ?>
              <li class="nav-item active">
                <a data-bs-toggle="collapse" href="#gestionSolicitudes" class="collapsed" aria-expanded="false">
                  <i class="fas fa-tasks"></i>
                  <p>Gestión de Solicitudes</p>
                  <span class="caret"></span>
                </a>

                <div class="collapse" id="gestionSolicitudes">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="<?php echo getUrl("Solicitudes", "Solicitudes", "getListar") ?>">
                        <span class="sub-item">Listar Solicitudes</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            <?php endif; ?>


            <?php if (
              tienePermiso("Reportes", "Listar") 
            ): ?>
              <li class="nav-item active">
                <a data-bs-toggle="collapse" href="#reportesFuncionario" class="collapsed" aria-expanded="false">
                  <i class="fas fa-chart-bar"></i>
                  <p>Reportes</p>
                  <span class="caret"></span>
                </a>

                <div class="collapse" id="reportesFuncionario">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="<?php echo getUrl("Reportes", "Reportes", "getListar") ?>">
                        <span class="sub-item">Listar Reportes</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            <?php endif; ?>


            <?php if (
              tienePermiso("PQRSF", "Listar") &&
              tienePermiso("PQRSF", "Editar")
            ): ?>
              <li class="nav-item active">
                <a data-bs-toggle="collapse" href="#atencionPqrsf" class="collapsed" aria-expanded="false">
                  <i class="fas fa-headset"></i>
                  <p>Atención PQRSF</p>
                  <span class="caret"></span>
                </a>

                <div class="collapse" id="atencionPqrsf">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="<?php echo getUrl("Pqrfs", "Pqrfs", "getListar") ?>">
                        <span class="sub-item">Atender PQRSF</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            <?php endif; ?>

          </ul>

          <!-- Separación Administrador -->
          <ul class="nav nav-secondary">

            <?php if (tienePermiso("Gestion de Roles", "Listar")): ?>
              <li class="nav-item active">
                <a data-bs-toggle="collapse" href="#roles" class="collapsed" aria-expanded="false">
                  <i class="fas fa-user-shield"></i>
                  <p>Gestión de Roles</p>
                  <span class="caret"></span>
                </a>

                <div class="collapse" id="roles">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="<?php echo getUrl("Roles", "Roles", "getCreate") ?>">
                        <span class="sub-item">Registrar Rol</span>
                      </a>
                    </li>

                    <li>
                      <a href="<?php echo getUrl("Roles", "Roles", "getRoles") ?>">
                        <span class="sub-item">Listar Roles</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            <?php endif; ?>


            <?php if (tienePermiso("Gestion de Usuarios", "Listar")): ?>
              <li class="nav-item active">
                <a data-bs-toggle="collapse" href="#usuarios" class="collapsed" aria-expanded="false">
                  <i class="fas fa-users"></i>
                  <p>Gestión de Usuarios</p>
                  <span class="caret"></span>
                </a>

                <div class="collapse" id="usuarios">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="<?php echo getUrl("Usuarios", "Usuarios", "getUsuarios") ?>">
                        <span class="sub-item">Listar Usuarios</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            <?php endif; ?>



            <?php if (tienePermiso("Auditoria", "Listar")): ?>
              <li class="nav-item active">
                <a data-bs-toggle="collapse" href="#auditoria" class="collapsed" aria-expanded="false">
                  <i class="fas fa-clipboard-list"></i>
                  <p>Auditoría</p>
                  <span class="caret"></span>
                </a>

                <div class="collapse" id="auditoria">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="<?php echo getUrl("Auditoria", "Auditoria", "getListar") ?>">
                        <span class="sub-item">Ver registros</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            <?php endif; ?>


            <?php if (tienePermiso("Reportes Globales", "Listar")): ?>
              <li class="nav-item active">
                <a data-bs-toggle="collapse" href="#reportesGlobales" class="collapsed" aria-expanded="false">
                  <i class="fas fa-chart-line"></i>
                  <p>Reportes Globales</p>
                  <span class="caret"></span>
                </a>

                <div class="collapse" id="reportesGlobales">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="<?php echo getUrl("ReportesGlobales", "ReportesGlobales", "getListar") ?>">
                        <span class="sub-item">Ver reportes globales</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            <?php endif; ?>
          </ul>

          <!-- comentario épico -->

        </div>
      </div>
    </div>

    <!-- Panel principal del contenido -->
    <div class="main-panel">
      <!-- Cabecera superior de la aplicación -->
      <div class="main-header">
        <div class="main-header-logo">
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img src="../Imagenes/GEOMOVILIDAD-LOGO-FINAL.svg" alt="navbar brand" class="navbar-brand" height="20">

            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
        </div>


        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
          <div class="container-fluid">

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
              <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                  aria-expanded="false" aria-haspopup="true">
                  <i class="fa fa-search"></i>
                </a>
                <ul class="dropdown-menu dropdown-search animated fadeIn">
                  <form class="navbar-left navbar-form nav-search">
                    <div class="input-group">
                      <input type="text" placeholder="Search ..." class="form-control">
                    </div>
                  </form>
                </ul>
              </li>

              <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">

                  <div class="avatar-sm">
                    <img src="../view/assets/img/usuario.png" alt="..." class="avatar-img rounded-circle">
                  </div>

                  <div class="ms-2 d-none d-lg-block">
                    <small class="text-muted">Bienvenido,</small><br>
                    <strong>
                      <?= isset($_SESSION['nombre_completo']) ? htmlspecialchars($_SESSION['nombre_completo']) : 'Invitado'; ?>
                    </strong>
                  </div>

                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                  <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                      <div class="user-box">
                        <div class="avatar-lg"><img src="../view/assets/img/usuario.png" alt="image profile"
                            class="avatar-img rounded"></div>
                        <div class="u-text">
                          <h4>
                            <?= htmlspecialchars($_SESSION['nombre_completo']); ?>
                          </h4>

                          <p class="text-muted mb-1">
                            <i class="fas fa-envelope me-1"></i>
                            <?= htmlspecialchars($_SESSION['usu_email']); ?>
                          </p>

                          <p class="text-muted mb-2">
                            <i class="fas fa-user-tag me-1"></i>
                            <?= htmlspecialchars($_SESSION['nombre_rol']); ?>
                          </p>

                          <a href="<?php echo getUrl("Perfil", "Perfil", "getPerfil"); ?>"
                            class="btn btn-light">
                            Configuración de la cuenta
                          </a>
                          <a class="dropdown-item" href="<?php echo getUrl('Login', 'Login', 'logout'); ?>">Cerrar Sesión</a>
                        </div>
                      </div>
                  </div>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>