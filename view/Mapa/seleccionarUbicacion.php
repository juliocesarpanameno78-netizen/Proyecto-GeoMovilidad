<?php
$returnUrl = isset($_GET['return']) ? $_GET['return'] : '';
$returnParam = isset($_GET['param']) ? $_GET['param'] : 'coords';
$state = isset($_GET['state']) ? $_GET['state'] : '';
?>

<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">Selecciona la ubicación en el mapa</div>
                    </div>
                    <div id="mapContainer" class="card-body" style="position: relative; height: 720px; padding: 0;">
                        <div id="dc_main" class="mscross" style="overflow:hidden; -moz-user-select:none;"></div>
                        <div id="coordPanel" style="position:absolute; left:10px; bottom:10px; width:260px; background:#ffffffcc; padding:10px; border:1px solid #ddd; z-index:103; font-size:0.9rem;">
                            <p class="mb-2" style="font-weight:700; margin:0 0 8px 0;">Selecciona en el mapa</p>
                            <div class="mt-3 d-flex justify-content-between">
                                <a id="btnCancel" href="<?php echo ($returnUrl ? $returnUrl : 'index.php'); ?>" class="btn btn-secondary btn-sm">Cancelar</a>
                                <button id="btnSelect" type="button" class="btn btn-success btn-sm" disabled>Seleccionar ubicación</button>
                            </div>
                            <input type="hidden" id="selectedCoords" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../lib/mscross-1.1.9.js" type="text/javascript"></script>
<script>
    var myMap1 = null;
    var selectedCoords = null;
    var mapContainer = document.getElementById('mapContainer');
    var mapDiv = document.getElementById('dc_main');

    function ajustarTamanoMapa() {
        if (!mapContainer || !mapDiv) {
            return;
        }

        mapDiv.style.width = mapContainer.clientWidth + 'px';
        mapDiv.style.height = mapContainer.clientHeight + 'px';

        if (myMap1) {
            myMap1.recalc_map_size();
            myMap1.redraw();
        }
    }

    ajustarTamanoMapa();

    if (typeof msMap !== "undefined") {
        myMap1 = new msMap(document.getElementById("dc_main"), "standardUp");
        myMap1.setCgi("/cgi-bin/mapserv.exe");
        myMap1.setMapFile("C:/ms4w/Apache/htdocs/Geomovilidad/miprimermapa.map");
        myMap1.setFullExtent(1053867, 1068491, 860190, 879441);
        myMap1.setLayers("barrios cali_area comunas vias");
        myMap1.recalc_map_size();
        myMap1.redraw();
        attachCoordControls();
    }

    window.addEventListener('resize', ajustarTamanoMapa);

    function attachCoordControls() {
        var btnSelect = document.getElementById('btnSelect');

        if (!myMap1 || !btnSelect) {
            return;
        }

        var obtenerCoordenadas = function (clientX, clientY) {
            var rect = mapDiv.getBoundingClientRect();
            var px = clientX - rect.left;
            var py = clientY - rect.top;

            if (px < 0) px = 0;
            if (py < 0) py = 0;
            if (px > mapDiv.clientWidth) px = mapDiv.clientWidth;
            if (py > mapDiv.clientHeight) py = mapDiv.clientHeight;

            var realX = myMap1.xPixel2Real(px);
            var realY = myMap1.yPixel2Real(py);
            return {
                x: realX,
                y: realY
            };
        };

        var updateClickPosition = function (event) {
            var coord = obtenerCoordenadas(event.clientX, event.clientY);
            selectedCoords = coord.x.toFixed(2) + ',' + coord.y.toFixed(2);
            btnSelect.disabled = false;
        };

        // Mantener comportamiento simple: actualizar coordenadas solo al hacer clic.
        mapDiv.addEventListener('click', updateClickPosition, true);

        btnSelect.addEventListener('click', function () {
            if (!selectedCoords) return;
            var returnField = '<?php echo $returnParam; ?>';
            var returnUrl = '<?php echo $returnUrl; ?>';
            var state = '<?php echo $state; ?>';
            if (!returnUrl) {
                window.location.href = 'index.php';
                return;
            }
            var separator = returnUrl.indexOf('?') === -1 ? '?' : '&';
            var target = returnUrl + separator;
            if (state) {
                target += 'state=' + encodeURIComponent(state) + '&';
            }
            window.location.href = target + encodeURIComponent(returnField) + '=' + encodeURIComponent(selectedCoords);
        });
    }
</script>
