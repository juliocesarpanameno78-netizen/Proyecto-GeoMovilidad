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

        $url_retorno = getUrl('Reductor', 'Reductor', 'getCreate');
        $url_mapa = getUrl('Mapa', 'Mapa', 'getSelectLocation') . '&return=' . urlencode($url_retorno) . '&param=coords';
        ?>

        <div class="row mt-5">
            <div class="col-md-5">
                <h3 class="m-3 display-3 text-nowrap">Solicitar un nuevo reductor</h3>
            </div>
        </div>

        <form method="post" action="<?php echo getUrl("Reductor","Reductor","postCreate")?>">
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <label for="nombre">Solicitante:</label>
                    <input type="text" id="nombre" class="form-control p-2" value="<?php echo $_SESSION['nombre_usuario']?>" disabled>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion" id="dirección" class="form-control p-2" placeholder="Ejemplo: Carrera 1 #0-0">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="categoriareductor">Categoría del reductor</label>
                    <select name="categoriareductor" id="categoriareductor" class="form-control p-2">
                        <option value="" disabled selected hidden>seleciona la categoría</option>
                        <?php 
                            foreach($categoriareduc as $catereduc){
                        ?>
                        <option value="<?php echo $catereduc['catr_id'];?>">
                            <?php echo $catereduc['catr_nombre']?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="tiporeductor">Tipo de Reductor</label><br>
                    <select name="tiporeductor" id="tiporeductor" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona el tipo de reductor</option>
                        <?php 
                            foreach($tiposreductor as $reduc){
                        ?>
                        <option value="<?php echo $reduc['tred_id'];?>"
                        data-categoria="<?php echo $reduc['catr_id'];?>"
                        data-descripcion="<?php echo $reduc['tred_descripcion'];?>"
                        data-orientacion="<?php echo $reduc['tred_orientacion'];?>">
                            <?php echo $reduc['tred_nombre']?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="orienta">Orientación del reductor</label>
                    <input type="text" id="orienta" class="form-control p-2" readonly>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="descripcion">Información del reductor selecionado:</label>
                    <input type="text" id="descripcion" class="form-control p-2" readonly>
                </div>
                <div class="col-md-8 mb-4">
                    <label for="motivo">¿Por que solicitas esté reductor?</label>
                    <textarea name="motivo" id="motivo" class="form-control p2"></textarea>
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
                <input type="hidden" name="estadoreductor" id="estadoreductor" value="1">
            </div>

            <div class="d-flex justify-content-center mt-4">
                <input type="submit" value="Enviar solicitud" class="btn btn-success mt-4 p-2">
            </div>
        </form> 
    </div>
</div>

<!-- y falta poner la imagen de los redutores -->
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

    const selectCategoria = document.getElementById('categoriareductor');
    const selectTipoSenal = document.getElementById('tiporeductor');
    const inputOrientacion = document.getElementById('orienta');
    const inputDescripcion = document.getElementById('descripcion');

    // Aqui se guardanlos tipo de señal en la memoria
    const todasLasOpciones = Array.from(selectTipoSenal.options);

    // Cuando se cambia la Categoría de la Señal
    selectCategoria.addEventListener('change', function () {
        const categoriaSeleccionada = this.value;

        // Reseteamos el select de tipos, limpiamos los inputs automáticos y habilitamos el select
        selectTipoSenal.innerHTML = '<option value="" disabled selected hidden>Selecciona el tipo de reductor</option>';
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