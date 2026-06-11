<body>
<div class="wrapper">
  <!-- Barra lateral de navegación -->
  <div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <div class="logo-header" data-background-color="dark">
        <a href="index.html" class="logo">
          <img src="../view/assets/img/GEOMOVILIDAD-LOGO-FINAL.svg" alt="navbar brand" class="navbar-brand" height="40"
            style="max-width: 100%; width: auto;">
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
          <li class="nav-item active">
            <a data-bs-toggle="collapse" href="#solicitud" class="collapsed" aria-expanded="false">
              <i class="fas fa-home"></i>
              <p>Hacer una Solicitud</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="solicitud">
              <ul class="nav nav-collapse">
                <li>
                  <a href="<?php echo getUrl("SolicitudSeñales","SolicitudSeñales","getCreate")?>">
                    <span class="sub-item">Solicitud de Señal</span>
                  </a>
                </li>
                <li>
                  <a href="?modulo=dashboard">
                    <span class="sub-item">Solicitud de Reductor</span>
                  </a>
                </li>
                <li>
                  <a href="?modulo=dashboard">
                    <span class="sub-item">Solicitud de Vía</span>
                  </a>
                </li>
                <li>
                  <a href="?modulo=dashboard">
                    <span class="sub-item">Solicitud de Demarcación</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
        <ul class="nav nav-secondary">
          <li class="nav-item active">
            <a data-bs-toggle="collapse" href="#reporte" class="collapsed" aria-expanded="false">
              <i class="fas fa-home"></i>
              <p>Hacer un Reporte</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="reporte">
              <ul class="nav nav-collapse">
                <li>
                  <a href="?modulo=dashboard">
                    <span class="sub-item">Hacer un reporte</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
        <ul class="nav nav-secondary">
          <li class="nav-item active">
            <a data-bs-toggle="collapse" href="#pqrsf" class="collapsed" aria-expanded="false">
              <i class="fas fa-home"></i>
              <p>Hacer una PQRSF</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="pqrsf">
              <ul class="nav nav-collapse">
                <li>
                  <a href="?modulo=dashboard">
                    <span class="sub-item">Hacer una PQRSF</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
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
          <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
            <div class="input-group">
              <div class="input-group-prepend">
                <button type="submit" class="btn btn-search pe-1">
                  <i class="fa fa-search search-icon"></i>
                </button>
              </div>
              <input type="text" placeholder="Search ..." class="form-control">
            </div>
          </nav>

          <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"
                aria-haspopup="true">
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
                  <img src="../view/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
                <span class="profile-username">
                  <span class="op-7">Bienvenido,</span> <span class="fw-bold">Invitad@</span>
                </span>
              </a>
              <ul class="dropdown-menu dropdown-user animated fadeIn">
                <div class="dropdown-user-scroll scrollbar-outer">
                  <li>
                    <div class="user-box">
                      <div class="avatar-lg"><img src="../view/assets/img/profile.jpg" alt="image profile"
                          class="avatar-img rounded"></div>
                      <div class="u-text">
                        <h4>Hizrian</h4>
                        <p class="text-muted">hello@example.com</p>
                        <a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View
                          Profile</a>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">My Profile</a>
                    <a class="dropdown-item" href="#">My Balance</a>
                    <a class="dropdown-item" href="#">Inbox</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Account Setting</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Logout</a>
                  </li>
                </div>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <!-- End Navbar -->
    </div>


    <!-- Sección del contenido principal: mapa interactivo -->
    <!-- <div class="container-fluid mapa">
      <div class="page-inner">

        <div class="row mb-4">
          <div class="col-md-12">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-title">Mapa Interactivo</div>
              </div>
              <div class="card-body">
                <div id="mapStatus" class="alert alert-warning mb-3" role="alert"></div>
                <div
                  style="position: relative; width: 100%; height: 500px; border: 1px solid #ddd; background: #f8f9fa;">
                  <div id="dc_main" class="mscross"
                    style="overflow:hidden; width:100%; height:100%; position:relative; -moz-user-select:none;">
                  </div>
                  <div id="Layer2"
                    style="position:absolute; right:10px; bottom:10px; width:190px; background:#fff; padding:10px; border:1px solid #ddd; z-index:101;">
                    <form name="select_layers">
                      <p class="mb-2">
                        <input checked onclick="chgLayers()" type="checkbox" name="Layer[0]" value="Poligonos">
                        <strong>Polígonos</strong>
                      </p>
                      <p class="mb-2">
                        <input checked onclick="chgLayers()" type="checkbox" name="Layer[1]" value="Puntos">
                        <strong>Puntos</strong>
                      </p>
                      <p class="mb-0">
                        <input checked onclick="chgLayers()" type="checkbox" name="Layer[2]" value="Lineas">
                        <strong>Líneas</strong>
                      </p>
                    </form>
                  </div>
                  <div id="Layer1"
                    style="position:absolute; right:10px; top:10px; width:140px; height:140px; z-index:102;">
                    <div id="dc_main2" style="overflow:auto; width:100%; height:100%; position:relative;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->


    <!-- Estilos personalizados para la sección del mapa -->
    <!-- <style>
      .mapa {
        margin-top: 5%;
      }
    </style> -->




