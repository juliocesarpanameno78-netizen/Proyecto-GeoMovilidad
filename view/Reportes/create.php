
<div class="container-fluid">
    <div class="page-inner">
        <?php if (isset($_SESSION['error_reporte'])): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <?php echo $_SESSION['error_reporte']; unset($_SESSION['error_reporte']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php
        $estadoFormulario = array();
        if (isset($_GET['state']) && $_GET['state'] !== '') {
            parse_str($_GET['state'], $estadoFormulario);
        }

        $lesionado = isset($estadoFormulario['leccionado']) ? trim($estadoFormulario['leccionado']) : '';
        $direccion = isset($estadoFormulario['direccion']) ? trim($estadoFormulario['direccion']) : '';
        $causaSeleccionada = isset($estadoFormulario['causas']) ? trim($estadoFormulario['causas']) : '';
        $tipoChoqueSeleccionado = isset($estadoFormulario['tipochoque']) ? trim($estadoFormulario['tipochoque']) : '';
        $cateChoqueSeleccionado = isset($estadoFormulario['catechoque']) ? trim($estadoFormulario['catechoque']) : '';
        $cativehiculo = isset($estadoFormulario['cativehiculo']) ? trim($estadoFormulario['cativehiculo']) : '';
        $barrioSeleccionado = isset($estadoFormulario['barrio']) ? trim($estadoFormulario['barrio']) : '';
        $tipovehiculoSeleccionado = isset($estadoFormulario['tipovehiculo']) ? trim($estadoFormulario['tipovehiculo']) : '';
        $marca = isset($estadoFormulario['marca']) ? trim($estadoFormulario['marca']) : '';
        $placa = isset($estadoFormulario['placa']) ? trim($estadoFormulario['placa']) : '';
        $color = isset($estadoFormulario['color']) ? trim($estadoFormulario['color']) : '';
        $descripcion = isset($estadoFormulario['descripcion']) ? trim($estadoFormulario['descripcion']) : '';
        $coord_x = '';
        $coord_y = '';

        if (isset($_GET['coords'])) {
            $partes = explode(',', $_GET['coords']);
            if (count($partes) === 2) {
                $coord_x = trim($partes[0]);
                $coord_y = trim($partes[1]);
            }
        }

        $url_retorno = getUrl('Reportes', 'Reportes', 'getCreate');
        $url_mapa = getUrl('Mapa', 'Mapa', 'getSelectLocation') . '&return=' . urlencode($url_retorno) . '&param=coords';
        ?>

        <div class="row mt-5">
            <div class="col-md-5">
                <h3 class="m-3 display-3 text-nowrap">Reporte de accidentes</h3>
            </div>
        </div>
        

        <form method="post" action="<?php echo getUrl("Reportes","Reportes","postCreate")?>" enctype="multipart/form-data">
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <label for="nombre">Reportador:</label>
                    <input type="text" id="nombre" class="form-control p-2" value="<?php echo ($_SESSION['nombre_usuario']) ?>"disabled>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="leccionado">Número de lesionados:<span style="color: red;">*</span></label>
                    <input type="number" name="leccionado" id="leccionado" class="form-control p-2" min=0 value="<?php echo $lesionado; ?>">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="direccion">Dirección:<span style="color: red;">*</span></label>
                    <input type="text" name="direccion" id="dirección" class="form-control p-2" placeholder="Ejemplo: Carrera 1 #0-0" value="<?php echo $direccion; ?>">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="causas">Causas del accidente<span style="color: red;">*</span></label><br>
                    <select name="causas" id="causas" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona la causas</option>
                        <?php 
                            foreach($causas as $cau){
                        ?>
                        <option value="<?php echo $cau['cau_id'];?>" <?php echo ($causaSeleccionada == $cau['cau_id']) ? 'selected' : ''; ?>>
                            <?php echo $cau['cau_descripcion']?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="tipochoque">Tipo de choque<span style="color: red;">*</span></label><br>
                    <select name="tipochoque" id="tipochoque" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona el choque</option>
                        <?php 
                            foreach($catechoque as $cho){
                        ?>
                        <option value="<?php echo $cho['catch_id'];?>" <?php echo ($tipoChoqueSeleccionado == $cho['catch_id']) ? 'selected' : ''; ?>>
                            <?php echo $cho['catch_nombre']?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="catechoque">¿El choque fue con?<span style="color: red;">*</span></label><br>
                    <select name="catechoque" id="catechoque" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona con que fue el choque</option>
                        <?php 
                            foreach($tipochoque as $choque){
                        ?>
                        <option value="<?php echo $choque['tch_id'];?>"
                            <?php echo ($cateChoqueSeleccionado == $choque['tch_id']) ? 'selected' : ''; ?>
                            data-choqueCon="<?php echo $choque['catch_id']; ?>">
                            <?php echo $choque['tch_nombre']?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="cativehiculo">Cantidad de vehículos afectados:<span style="color: red;">*</span></label>
                    <input type="number" name="cativehiculo" id="cativehiculo" class="form-control p-2" placeholder="" min=0 value="<?php echo $cativehiculo; ?>">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="barrio">Barrio:<span style="color: red;">*</span></label><br>
                    <select name="barrio" id="barrio" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona el barrio</option>
                        <?php 
                            foreach($barrio as $bar){
                        ?>
                        <option value="<?php echo $bar['bar_id'];?>" <?php echo ($barrioSeleccionado == $bar['bar_id']) ? 'selected' : ''; ?>>
                            <?php echo $bar['bar_nombre']?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="imagenes">Insetar imagen del accidente:<span style="color: red;">*</span></label>
                    <input type="file" name="imagen" id="imagen" class="form-control p-2" accept="image/*">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="tipovehiculo">Tipo de vehículo:<span style="color: red;">*</span></label><br>
                    <select name="tipovehiculo" id="tipovehiculo" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona el vehículo</option>
                        <?php 
                            foreach($tipovehi as $vehi){
                        ?>
                        <option value="<?php echo $vehi['tveh_id'];?>" <?php echo ($tipovehiculoSeleccionado == $vehi['tveh_id']) ? 'selected' : ''; ?>>
                            <?php echo $vehi['tveh_nombre']?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="marca">Marca y modelo del vehículo:<span style="color: red;">*</span></label>
                    <input type="text" name="marca" id="marca" class="form-control p-2" placeholder="" value="<?php echo $marca; ?>">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="placa">Placa del vehículo:<span style="color: red;">*</span></label>
                    <input type="text" name="placa" id="placa" class="form-control p-2" placeholder="" value="<?php echo $placa; ?>">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="color">Color del vehículo:<span style="color: red;">*</span></label>
                    <input type="text" name="color" id="color" class="form-control p-2" placeholder="" value="<?php echo $color; ?>">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="descripcion">Descripción:<span style="color: red;">*</span></label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control p-2" placeholder="" value="<?php echo $descripcion; ?>">
                </div>

                <div class="col-md-8 mb-4">
                    <label>Ubicación seleccionada</label>
                    <input type="text" class="form-control p-2" readonly
                        value="<?php echo ($coord_x !== '' && $coord_y !== '') ? ($coord_x . ', ' . $coord_y) : 'Sin coordenadas'; ?>">
                    <input type="hidden" name="coord_x" value="<?php echo $coord_x; ?>">
                    <input type="hidden" name="coord_y" value="<?php echo $coord_y; ?>">
                </div>

                <div class="col-md-4 mb-4 d-flex align-items-end">
                    <a href="<?php echo $url_mapa; ?>" id="btnMapaReportes" class="btn btn-outline-primary w-100">Seleccionar ubicación en mapa<span style="color: red;">*</span></a>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <input type="submit" value="Enviar solicitud" class="btn btn-success mt-4 p-2">
            </div>
        </form>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector('form[action="<?php echo getUrl("Reportes","Reportes","postCreate")?>"]');
    const botonMapa = document.getElementById('btnMapaReportes');
    const urlMapaBase = '<?php echo getUrl('Mapa', 'Mapa', 'getSelectLocation'); ?>';
    const urlRetornoBase = '<?php echo getUrl('Reportes', 'Reportes', 'getCreate'); ?>';

    <?php if(isset($_GET['status']) && $_GET['status'] == 'exito'): ?>
    swal({
        title: "¡Solicitud enviada!",
        text: "Tu solicitud de señal fue registrada con éxito.",
        icon: "success",
        button: "Aceptar"
    });
    <?php elseif(isset($_GET['status']) && $_GET['status'] == 'error'): ?>
    swal({
        title: "Error al enviar",
        text: "Hubo un error al registrar tu solicitud. Intenta nuevamente.",
        icon: "error",
        button: "Aceptar"
    });
    <?php endif; ?>

    const selectTipoChoque = document.getElementById('tipochoque');
    const selectTipoChoquefue = document.getElementById('catechoque');
    

    // Aqui se guardanlos tipo de choques en la memoria
    const todasLasOpciones = Array.from(selectTipoChoquefue.options);

    // Cuando se cambia la Categoría de los choques
    selectTipoChoque.addEventListener('change', function () {
        const choqueSeleccionado = this.value;

        // Reseteamos el select de tipos, limpiamos los inputs automáticos y habilitamos el select
        selectTipoChoquefue.innerHTML = '<option value="" disabled selected hidden>Selecciona con que fue el choque</option>';
        selectTipoChoquefue.value = '';
        selectTipoChoquefue.disabled = false;

        // Aqui se filtra y se agrega solo los tipos de señales de la categoría seleccionada
        todasLasOpciones.forEach(opcion => {
            if (opcion.getAttribute('data-choqueCon') === choqueSeleccionado) {
                selectTipoChoquefue.appendChild(opcion.cloneNode(true));
            }
        });
    });

    if (botonMapa && form) {
        botonMapa.addEventListener('click', function (event) {
            event.preventDefault();

            const datos = new FormData(form);
            const parametros = new URLSearchParams();

            ['leccionado', 'direccion', 'causas', 'tipochoque', 'catechoque', 'cativehiculo', 'barrio', 'tipovehiculo', 'marca', 'placa', 'color', 'descripcion'].forEach(function (nombre) {
                const valor = datos.get(nombre);
                if (valor !== null && valor !== '') {
                    parametros.set(nombre, valor);
                }
            });

            const separador = urlMapaBase.indexOf('?') === -1 ? '?' : '&';
            const state = parametros.toString();
            window.location.href = urlMapaBase + separador + 'return=' + encodeURIComponent(urlRetornoBase) + '&param=coords' + (state ? '&state=' + encodeURIComponent(state) : '');
        });
    }

});
</script>