<?php
$returnUrl = isset($_GET['return']) ? $_GET['return'] : '';
$returnParam = isset($_GET['param']) ? $_GET['param'] : 'coords';
?>

<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">Selecciona la ubicación en el mapa</div>
                    </div>
                    <div class="card-body" style="position: relative; height: 720px; padding: 0;">
                        <div id="dc_main" class="mscross" style="overflow:hidden; width:100%; height:100%;"></div>
                        <div id="coordPanel" style="position:absolute; left:10px; bottom:10px; width:260px; background:#ffffffcc; padding:10px; border:1px solid #ddd; z-index:103; font-size:0.9rem;">
                            <p class="mb-2" style="font-weight:700; margin:0 0 8px 0;">Selecciona en el mapa</p>
                            <p class="mb-1" style="margin:0;">Posición actual:<br>
                                <span id="coordStatus">Mueve el mouse sobre el mapa</span>
                            </p>
                            <p class="mb-1" style="margin:8px 0 0 0;">Último clic:<br>
                                <span id="coordClick">--, --</span>
                            </p>
                            <div class="mt-3 d-flex justify-content-between">
                                <a id="btnCancel" href="<?php echo ($returnUrl ?: 'index.php'); ?>" class="btn btn-secondary btn-sm">Cancelar</a>
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

    if (typeof msMap !== "undefined") {
        myMap1 = new msMap(document.getElementById("dc_main"), "standardUp");
        myMap1.setCgi("/cgi-bin/mapserv.exe");
        myMap1.setMapFile("C:/ms4w/Apache/htdocs/Geomovilidad/miprimermapa.map");
        myMap1.setFullExtent(1053867, 1068491, 860190, 879441);
        myMap1.setLayers("barrios cali_area comunas vias");
        myMap1.redraw();
        attachCoordControls();
    }

    function attachCoordControls() {
        var coordStatus = document.getElementById('coordStatus');
        var coordClick = document.getElementById('coordClick');
        var btnSelect = document.getElementById('btnSelect');

        if (!myMap1 || !coordStatus || !coordClick || !btnSelect) {
            return;
        }

        var updateMousePosition = function (event) {
            var px = myMap1.getClick_X(event);
            var py = myMap1.getClick_Y(event);
            var realX = myMap1.xPixel2Real(px);
            var realY = myMap1.yPixel2Real(py);
            coordStatus.innerText = 'X: ' + realX.toFixed(2) + ' , Y: ' + realY.toFixed(2);
        };

        var updateClickPosition = function (event) {
            var px = myMap1.getClick_X(event);
            var py = myMap1.getClick_Y(event);
            var realX = myMap1.xPixel2Real(px);
            var realY = myMap1.yPixel2Real(py);
            coordClick.innerText = realX.toFixed(2) + ' , ' + realY.toFixed(2);
            selectedCoords = realX.toFixed(2) + ',' + realY.toFixed(2);
            btnSelect.disabled = false;
        };

        add_event(myMap1.getTagEvent(), 'mousemove', updateMousePosition);
        add_event(myMap1.getTagEvent(), 'click', updateClickPosition);

        btnSelect.addEventListener('click', function () {
            if (!selectedCoords) return;
            var returnField = '<?php echo $returnParam; ?>';
            var returnUrl = '<?php echo $returnUrl; ?>';
            if (!returnUrl) {
                window.location.href = 'index.php';
                return;
            }
            var separator = returnUrl.indexOf('?') === -1 ? '?' : '&';
            window.location.href = returnUrl + separator + encodeURIComponent(returnField) + '=' + encodeURIComponent(selectedCoords);
        });
    }
</script>
