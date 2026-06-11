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
                                            <input checked onclick="chgLayers()" type="checkbox" name="Layer[0]"
                                                value="Poligonos">
                                            <strong>Polígonos</strong>
                                        </p>
                                        <p class="mb-2">
                                            <input checked onclick="chgLayers()" type="checkbox" name="Layer[1]"
                                                value="Puntos">
                                            <strong>Puntos</strong>
                                        </p>
                                        <p class="mb-0">
                                            <input checked onclick="chgLayers()" type="checkbox" name="Layer[2]"
                                                value="Lineas">
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

    $('#lineChart').sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: 'line', height: '70', width: '100%',
        lineWidth: '2', lineColor: '#177dff',
        fillColor: 'rgba(23, 125, 255, 0.14)'
    });
    $('#lineChart2').sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: 'line', height: '70', width: '100%',
        lineWidth: '2', lineColor: '#f3545d',
        fillColor: 'rgba(243, 84, 93, .14)'
    });
    $('#lineChart3').sparkline([105, 103, 123, 100, 95, 105, 115], {
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
        myMap1.setMapFile("/xampp/htdocs/ProyectoTerravision/miprimermapa.map");
        myMap1.setFullExtent(-88, -5, -62, 13);
        myMap1.setLayers("Poligonos Lineas Puntos");

        myMap2 = new msMap(document.getElementById("dc_main2"));
        myMap2.setActionNone();
        myMap2.setFullExtent(-88, -5, -62, 13);
        myMap2.setMapFile("/xampp/htdocs/ProyectoTerravision/miprimermapa.map");
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