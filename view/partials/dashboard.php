<?php
if (isset($_SESSION['login_exitoso']) && $_SESSION['login_exitoso']) {
    unset($_SESSION['login_exitoso']);
    $nombreBienvenida = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo'] : (isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : '');
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            swal({
                title: "¡Inicio de sesión exitoso!",
                text: "Bienvenido<?php echo $nombreBienvenida !== '' ? ', ' . addslashes($nombreBienvenida) : ''; ?> a Geomovilidad.",
                icon: "success",
                timer: 2500,
                buttons: false
            });
        });
    </script>
    <?php
}

if (isset($_SESSION['error_permisos'])) {
    ?>
    <div class="container-fluid">
        <div class="page-inner">

            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">

                <?php
                echo $_SESSION['error_permisos'];
                unset($_SESSION['error_permisos']);
                ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>

        </div>
    </div>
    <?php
}

$mostrarCapaReportesCiudadanos = true;
$capasReportesCiudadanos = "reportes_accidentes vias_mal_estado nueva_senal nuevo_reductor reductor_mal_estado";

$mapFileBase = 'C:/ms4w/Apache/htdocs/Geomovilidad/miprimermapa.map';
$mapFileParaVisor = $mapFileBase;

if (esCiudadano() && isset($_SESSION['id_usuario'])) {

    $capasReportesCiudadanos = "reportes_accidentes vias_mal_estado nueva_senal nuevo_reductor";

    $mapTempDir = 'C:/ms4w/tmp/ms_tmp';
    if (!is_dir($mapTempDir)) {
        @mkdir($mapTempDir, 0777, true);
    }

    $idUsuario = intval($_SESSION['id_usuario']);
    $mapTempFile = $mapTempDir . '/miprimermapa_usuario_' . $idUsuario . '.map';
    $contenidoMapa = @file_get_contents($mapFileBase);

    if ($contenidoMapa !== false) {
        $reemplazos = array(
            '/FROM solicitudes_reporte_accidentes\s+WHERE sra_coordenadas IS NOT NULL/i' =>
                'FROM solicitudes_reporte_accidentes WHERE sra_coordenadas IS NOT NULL AND usu_id = ' . $idUsuario,
            '/FROM solicitudes_via_mal_estado\s+WHERE svme_coord_x IS NOT NULL AND svme_coord_y IS NOT NULL/i' =>
                'FROM solicitudes_via_mal_estado WHERE svme_coord_x IS NOT NULL AND svme_coord_y IS NOT NULL AND usu_id = ' . $idUsuario,
            '/FROM solicitudes_nueva_senal\s+WHERE sns_coord_x IS NOT NULL AND sns_coord_y IS NOT NULL/i' =>
                'FROM solicitudes_nueva_senal WHERE sns_coord_x IS NOT NULL AND sns_coord_y IS NOT NULL AND usu_id = ' . $idUsuario,
            '/FROM solicitudes_nuevo_reductor\s+WHERE snr_coord_x IS NOT NULL AND snr_coord_y IS NOT NULL/i' =>
                'FROM solicitudes_nuevo_reductor WHERE snr_coord_x IS NOT NULL AND snr_coord_y IS NOT NULL AND usu_id = ' . $idUsuario
        );

        foreach ($reemplazos as $patron => $valor) {
            $contenidoMapa = preg_replace($patron, $valor, $contenidoMapa, 1);
        }

        if (@file_put_contents($mapTempFile, $contenidoMapa) !== false && is_file($mapTempFile)) {
            $mapFileParaVisor = $mapTempFile;
        }
    }
}
?>


<!-- Sección del contenido principal: mapa interactivo -->
<div class="container-fluid">
    <div class="page-inner">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">Mapa Interactivo</div>
                    </div>
                    <div class="card-body">
                        <div
                            style="position: relative; width: 100%; height: 800px; border: 1px solid #ddd; background: #f8f9fa;">
                            <div id="dc_main" class="mscross"
                                style="overflow:hidden; width:1522em; height:800px; -moz-user-select:none;">
                            </div>
                            <div id="Layer2"
                                style="position:absolute; right:10px; bottom:10px; width:190px; background:#fff; padding:10px; border:1px solid #ddd; z-index:101;">
                                <form name="select_layers">
                                    <p class="mb-2">
                                        <input checked onclick="chgLayers()" type="checkbox" name="Layer[0]"
                                            value="cali_area">
                                        <strong>Área de Cali</strong>
                                    </p>
                                    <p class="mb-2">
                                        <input checked onclick="chgLayers()" type="checkbox" name="Layer[1]"
                                            value="comunas">
                                        <strong>Comunas</strong>
                                    </p>
                                    <p class="mb-0">
                                        <input checked onclick="chgLayers()" type="checkbox" name="Layer[2]"
                                            value="barrios">
                                        <strong>Barrios</strong>
                                    </p>
                                    <p class="mb-0">
                                        <input checked onclick="chgLayers()" type="checkbox" name="Layer[3]"
                                            value="vias">
                                        <strong>Vias</strong>
                                    </p>
                                    <?php if ($mostrarCapaReportesCiudadanos): ?>
                                    <p class="mb-0 mt-2">
                                        <input checked onclick="chgLayers()" type="checkbox" name="Layer[4]"
                                            value="<?php echo $capasReportesCiudadanos; ?>">
                                        <strong>Reportes ciudadanos</strong>
                                    </p>
                                    <?php endif; ?>
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
</div>
<!-- Estilos personalizados para la sección del mapa -->
<style>
    .mapa {
        margin-top: 0%;
    }
</style>

<!-- Scripts de la plantilla, librerías y lógica del visor -->
<script src="../lib/mscross-1.1.9.js" type="text/javascript"></script>

<script>
    var mapStatus = document.getElementById("mapStatus");
    var myMap1 = null;
    var myMap2 = null;
    var capaReportesCiudadanos = <?php echo $mostrarCapaReportesCiudadanos ? "' " . $capasReportesCiudadanos . "'" : "''"; ?>;


    if (typeof msMap !== "undefined") {
        myMap1 = new msMap(document.getElementById("dc_main"), "standardUp");
        myMap1.setCgi("/cgi-bin/mapserv.exe");
        myMap1.setMapFile("<?php echo addslashes($mapFileParaVisor); ?>");
        myMap1.setFullExtent(1053867, 1068491, 860190, 879441);
        myMap1.setLayers("barrios cali_area comunas vias" + capaReportesCiudadanos);

        myMap2 = new msMap(document.getElementById("dc_main2"));
        myMap2.setActionNone();
        myMap2.setFullExtent(1053867, 1068491, 860190, 879441);
        myMap2.setMapFile("<?php echo addslashes($mapFileParaVisor); ?>");
        myMap2.setLayers("cali_area");

        myMap1.setReferenceMap(myMap2);
        myMap1.redraw();
        myMap2.redraw();
        chgLayers();
    } else if (mapStatus) {
        mapStatus.innerHTML = 'No se pudo cargar el visor.';
    }


    function chgLayers() {
        if (!myMap1 || !myMap2) return;
        var list = "";
        var objForm = document.forms["select_layers"];
        if (!objForm) return;

        for (var i = 0; i < objForm.elements.length; i++) {
            var elemento = objForm.elements[i];

            if (elemento && elemento.type === 'checkbox' && elemento.checked) {
                list += elemento.value + " ";
            }
        }
        if (list === "") list = "ninguna";
        myMap1.setLayers(list);
        myMap1.redraw();
        myMap2.redraw();
    }
    window.onresize = function () {
        if (myMap1) {
            myMap1.recalc_map_size();
            myMap1.redraw();
        }
        if (myMap2) {
            myMap2.recalc_map_size();
            myMap2.redraw();
        }
    };
</script>