<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="../web/index.php" class="logo">
                <img src="../../assets/img/kaiadmin/logo_light.svg" alt="Logo" class="navbar-brand" height="20">
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
            </div>
            <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
        </div>
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                <li class="nav-item active">
                    <a href="index.php?modulo=Dashboard&controlador=Dashboard&funcion=index">
                        <i class="fas fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Módulos</h4>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#accidentes">
                        <i class="fas fa-car-crash"></i>
                        <p>Accidentes</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="accidentes">
                        <ul class="nav nav-collapse">
                            <li><a href="#"><span class="sub-item">Ver Accidentes</span></a></li>
                            <li><a href="#"><span class="sub-item">Reportar Accidente</span></a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#senales">
                        <i class="fas fa-sign"></i>
                        <p>Señales</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="senales">
                        <ul class="nav nav-collapse">
                            <li><a href="#"><span class="sub-item">Ver Señales</span></a></li>
                            <li><a href="#"><span class="sub-item">Solicitar Señal</span></a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#reductores">
                        <i class="fas fa-road"></i>
                        <p>Reductores</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="reductores">
                        <ul class="nav nav-collapse">
                            <li><a href="#"><span class="sub-item">Ver Reductores</span></a></li>
                            <li><a href="#"><span class="sub-item">Solicitar Reductor</span></a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-clipboard-list"></i>
                        <p>PQRSF</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>

<div class="main-panel">
    <div class="main-header">
        <div class="main-header-logo">
            <div class="logo-header" data-background-color="dark">
                <a href="index.php" class="logo">
                    <img src="../../assets/img/kaiadmin/logo_light.svg" alt="Logo" class="navbar-brand" height="20">
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                    <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
                </div>
                <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
            </div>
        </div>

        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
            <div class="container-fluid">
                <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                    <li class="nav-item topbar-user dropdown hidden-caret">
                        <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                            <div class="avatar-sm">
                                <img src="../../assets/img/profile.jpg" alt="perfil" class="avatar-img rounded-circle">
                            </div>
                            <span class="profile-username">
                                <span class="op-7">Hola,</span>
                                <span class="fw-bold"><?php echo $_SESSION['nombre']; ?></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">
                                        <div class="u-text">
                                            <h4><?php echo $_SESSION['nombre']; ?></h4>
                                            <p class="text-muted"><?php echo $_SESSION['correo']; ?></p>
                                            <p class="text-muted"><small><?php echo $_SESSION['rol']; ?></small></p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.php?modulo=Login&controlador=Login&funcion=logout">
                                        <i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión
                                    </a>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>