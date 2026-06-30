<div class="container-fluid">
    <div class="page-inner">
        <?php
        $coord_x = '';
        $coord_y = '';

        if (isset($_GET['coords'])) {
            $partes = explode(',', $_GET['coords']);
            if (count($partes) === 2) {
                $coord_x = trim($partes[0]);
                $coord_y = trim($partes[1]);
            }
        }

        $url_retorno = getUrl('Senales', 'Senales', 'getCreate');
        $url_mapa = getUrl('Mapa', 'Mapa', 'getSelectLocation') . '&return=' . urlencode($url_retorno) . '&param=coords';
        ?>

        <div class="row mt-5">
            <div class="col-md-5">
                <h3 class="m-3 display-3 text-nowrap">Solicitar una Señal</h3>
            </div>
        </div>

        <form method="post" enctype="multipart/form-data" action="<?php echo getUrl("Senales", "Senales", "postCreate") ?> ">
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <label for="nombre">Solicitante:</label>
                    <input type="text" class="form-control p-2" value="<?php echo $_SESSION['nombre_usuario'] ?>" disabled>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion" id="dirección" class="form-control p-2"
                        placeholder="Ejemplo: Carrera 1 #0-0">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="categoriasenal">Categoría de la señal:</label><br>
                    <select name="categoriasenal" id="categoriasenal" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona la categoría</option>
                        <?php foreach ($categoriasenales as $cate) { ?>
                            <option value="<?php echo $cate['cats_id']; ?>">
                                <?php echo $cate['cats_nombre'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="tiposenal">Tipo de señal:</label><br>
                    <select name="tiposenal" id="tiposenal" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona una señal</option>
                        <?php
                        foreach ($tiposenales as $senal) {
                            ?>
                            <option value="<?php echo $senal['tsen_id']; ?>"
                                data-categoria="<?php echo $senal['cats_id']; ?>"
                                data-descripcion="<?php echo $senal['tsen_descripcion']; ?>"
                                data-orientacion="<?php echo $senal['tsen_orientacion']; ?>">
                                <?php echo $senal['tsen_nombre'] ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="orientacionsenal">Orientación de la señal:</label><br>
                    <input type="text" id="orientacionsenal" class="form-control p-2" readonly
                        placeholder="se completa al elegir el tipo de señal">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="imagen">Insertar imagen:</label>
                    <input type="file" name="imagen" id="imagen" class="form-control p-2" accept="image/*">
                </div>
                <div class="col-md-6 mb-4">
                    <label for="descripcion">Información de la señal seleccionadad:</label>
                    <input type="text" id="descripcion" class="form-control p-2" readonly>
                </div>
                <div class="col-md-6 mb-4">
                    <label for="motivo">¿Por que solicitas esta señal?</label>
                    <textarea name="motivo" id="motivo"  class="form-control p-2" required></textarea>
                </div>

                <div class="col-md-8 mb-4">
                    <label>Ubicación seleccionada</label>
                    <input type="text" class="form-control p-2" readonly
                        value="<?php echo ($coord_x !== '' && $coord_y !== '') ? ($coord_x . ', ' . $coord_y) : 'Sin coordenadas'; ?>">
                    <input type="hidden" name="coord_x" value="<?php echo $coord_x; ?>">
                    <input type="hidden" name="coord_y" value="<?php echo $coord_y; ?>">
                </div>

                <div class="col-md-4 mb-4 d-flex align-items-end">
                    <a href="<?php echo $url_mapa; ?>" class="btn btn-outline-primary w-100">Seleccionar ubicación en mapa</a>
                </div>

                <input type="hidden" name="estadosenal" id="estadosenal" value="1">
            </div>

            <div class="d-flex justify-content-center mt-4">
                <input type="submit" value="Enviar solicitud" class="btn btn-success mt-4 p-2">
            </div>
        </form>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {

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

    const selectCategoria = document.getElementById('categoriasenal');
    const selectTipoSenal = document.getElementById('tiposenal');
    const inputOrientacion = document.getElementById('orientacionsenal');
    const inputDescripcion = document.getElementById('descripcion');

    // Aqui se guardanlos tipo de señal en la memoria
    const todasLasOpciones = Array.from(selectTipoSenal.options);

    // Cuando se cambia la Categoría de la Señal
    selectCategoria.addEventListener('change', function () {
        const categoriaSeleccionada = this.value;

        // Reseteamos el select de tipos, limpiamos los inputs automáticos y habilitamos el select
        selectTipoSenal.innerHTML = '<option value="" disabled selected hidden>Selecciona una señal</option>';
        inputOrientacion.value = '';
        inputDescripcion.value = '';
        selectTipoSenal.disabled = false;

        // Aqui se filtra y se agrega solo los tipos de señales de la categoría seleccionada
        todasLasOpciones.forEach(opcion => {
            if (opcion.getAttribute('data-categoria') === categoriaSeleccionada) {
                selectTipoSenal.appendChild(opcion.cloneNode(true));
            }
        });
    });

    // Cuando se cambia el Tipo de Señal
    selectTipoSenal.addEventListener('change', function () {
        const opcionSeleccionada = this.options[this.selectedIndex];
        
        // Con esto se trae la información de los atributos data-*
        const orientacion = opcionSeleccionada.getAttribute('data-orientacion');
        const descripcion = opcionSeleccionada.getAttribute('data-descripcion');

        // y aca se insertan los valores automáticamente en los inputs readonly
        inputOrientacion.value = orientacion ? orientacion : '';
        inputDescripcion.value = descripcion ? descripcion : '';
    });
});
</script>