<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title>Geomovilidad</title>
		<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
		<link rel="icon" href="../Imagenes/geomovilidad.ico" type="image/x-icon"/>

		<!-- Fonts and icons -->
		<script src="assets/js/plugin/webfont/webfont.min.js"></script>
		<script>
			WebFont.load({
				google: {"families":["Public Sans:300,400,500,600,700"]},
				custom: {"families":["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['assets/css/fonts.min.css']},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
		</script>

		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/plugins.min.css">
		<link rel="stylesheet" href="assets/css/kaiadmin.min.css">
		<link rel="stylesheet" href="assets/css/demo.css">


		<link rel="stylesheet" type="text/css" href="../misc/img/dc.css">

		
	</head>
	<body>
		<!-- Contenedor principal de la página -->
		<div class="wrapper">

			<!-- Barra lateral de navegación -->
			<div class="sidebar" data-background-color="dark">
				<div class="sidebar-logo">
					<div class="logo-header" data-background-color="dark">
						<a href="index.html" class="logo">
							<img src="../Imagenes/GEOMOVILIDAD-LOGO-FINAL.svg" alt="navbar brand" class="navbar-brand" height="40" style="max-width: 100%; width: auto;">
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
								<a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
									<i class="fas fa-home"></i>
									<p>Dashboard</p>
									<span class="caret"></span>
								</a>
								<div class="collapse" id="dashboard">
									<ul class="nav nav-collapse">
										<li>
											<a href="../demo1/index.html">
												<span class="sub-item"></span>
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
									<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-haspopup="true">
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
											<img src="assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
										</div>
										<span class="profile-username">
											<span class="op-7">Bienvenido,</span> <span class="fw-bold">Invitad@</span>
										</span>
									</a>
									<ul class="dropdown-menu dropdown-user animated fadeIn">
										<div class="dropdown-user-scroll scrollbar-outer">
											<li>
												<div class="user-box">
													<div class="avatar-lg"><img src="assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
													<div class="u-text">
														<h4>Hizrian</h4>
														<p class="text-muted">hello@example.com</p>
														<a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
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
				<div class="container-fluid mapa">
					<div class="page-inner">

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card card-round">
            <div class="card-header">
                <div class="card-title">Mapa Interactivo</div>
            </div>
            <div class="card-body">
                <div id="mapStatus" class="alert alert-warning mb-3" role="alert"></div>
                <div style="position: relative; width: 100%; height: 500px; border: 1px solid #ddd; background: #f8f9fa;">
                    <div id="dc_main" class="mscross" style="overflow:hidden; width:100%; height:100%; position:relative; -moz-user-select:none;"></div>
                    <div id="Layer2" style="position:absolute; right:10px; bottom:10px; width:190px; background:#fff; padding:10px; border:1px solid #ddd; z-index:101;">
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
                    <div id="Layer1" style="position:absolute; right:10px; top:10px; width:140px; height:140px; z-index:102;">
                        <div id="dc_main2" style="overflow:auto; width:100%; height:100%; position:relative;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
					</div>
				</div>

                
<!-- Estilos personalizados para la sección del mapa -->
				<style>
                    .mapa{
                        margin-top: 5%;
                    }
                </style>


				
			</div>


		</div>

		<script src="assets/js/core/jquery-3.7.1.min.js"></script>
		<script src="assets/js/core/popper.min.js"></script>
		<script src="assets/js/core/bootstrap.min.js"></script>
		<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
		<script src="assets/js/plugin/chart.js/chart.min.js"></script>
		<script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
		<script src="assets/js/plugin/chart-circle/circles.min.js"></script>
		<script src="assets/js/plugin/datatables/datatables.min.js"></script>
		<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
		<script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
		<script src="assets/js/plugin/jsvectormap/world.js"></script>
		<script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>
		<script src="assets/js/kaiadmin.min.js"></script>
		<script src="assets/js/setting-demo.js"></script>
		<script src="assets/js/demo.js"></script>


		<!-- Scripts de la plantilla, librerías y lógica del visor -->
		<script src="../misc/lib/mscross-1.1.9.js" type="text/javascript"></script>

		<script>

			$('#lineChart').sparkline([102,109,120,99,110,105,115], {
				type: 'line', height: '70', width: '100%',
				lineWidth: '2', lineColor: '#177dff',
				fillColor: 'rgba(23, 125, 255, 0.14)'
			});
			$('#lineChart2').sparkline([99,125,122,105,110,124,115], {
				type: 'line', height: '70', width: '100%',
				lineWidth: '2', lineColor: '#f3545d',
				fillColor: 'rgba(243, 84, 93, .14)'
			});
			$('#lineChart3').sparkline([105,103,123,100,95,105,115], {
				type: 'line', height: '70', width: '100%',
				lineWidth: '2', lineColor: '#ffa534',
				fillColor: 'rgba(255, 165, 52, .14)'
			});

			var mapStatus = document.getElementById("mapStatus");
			var myMap1 = null;
			var myMap2 = null;

			if (typeof window.msMap !== "undefined") {
				myMap1 = new msMap(document.getElementById("dc_main"), "standardRight");
				myMap1.setCgi("/cgi-bin/mapserv.exe");
				myMap1.setMapFile("/Terravision/miprimermapa.map");
				myMap1.setFullExtent(-88, -5, -62, 13);
				myMap1.setLayers("Poligonos Lineas Puntos");

				myMap2 = new msMap(document.getElementById("dc_main2"));
				myMap2.setActionNone();
				myMap2.setFullExtent(-88, -5, -62, 13);
				myMap2.setMapFile("/Terravision/miprimermapa.map");
				myMap2.setLayers("Poligonos");

				myMap1.setReferenceMap(myMap2);
				myMap1.redraw();
				myMap2.redraw();
				chgLayers();
			} else if (mapStatus) {
				mapStatus.innerHTML = 'No se pudo cargar el visor porque faltan los archivos de MapServer o el archivo .map.';
			}

			function chgLayers() {
				if (!myMap1 || !myMap2) {
					return;
				}

				var list = "";
				var objForm = document.forms["select_layers"];
				for (var i = 0; i < 3; i++) {
					var elemento = objForm.elements["Layer[" + i + "]"];
					if (elemento && elemento.checked) {
						list += elemento.value + " ";
					}
				}
				myMap1.setLayers(list);
				myMap1.redraw();
				myMap2.redraw();
			}
		</script>

	</body>
</html>