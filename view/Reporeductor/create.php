<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5">
            <div class="col-md-5">
                <h3 class="m-3 display-3 text-nowrap">Reportar reductor en mal estado</h3>
            </div>
        </div>

        <form method="post" action="<?php echo getUrl('Reporeductor','Reporeductor','postCreate')?>" enctype="multipart/form-data">
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <label for="nombre">Reportador:</label>
                    <input type="text" id="nombre" class="form-control p-2"
                        value="<?php echo $_SESSION['nombre_usuario']?>" disabled>
                </div>

                <div class="col-md-4 mb-4">
                    <label for="categoriareduc">Categoría del reductor</label>
                    <select name="categoriareduc" id="categoriareduc" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona la categoría</option>
                        <?php foreach($categoriareduc as $cat): ?>
                        <option value="<?php echo $cat['catr_id']?>">
                            <?php echo $cat['catr_nombre']?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4 mb-4">
                    <label for="tiporeductor">Tipo de reductor</label>
                    <select name="tiporeductor" id="tiporeductor" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona el tipo de reductor</option>
                        <?php foreach($tiposreductor as $reduc): ?>
                        <option value="<?php echo $reduc['tred_id']?>"
                            data-categoria="<?php echo $reduc['catr_id']?>"
                            data-descripcion="<?php echo $reduc['tred_descripcion']?>"
                            data-orientacion="<?php echo $reduc['tred_orientacion']?>">
                            <?php echo $reduc['tred_nombre']?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4 mb-4">
                    <label for="orientacion">Orientación del reductor</label>
                    <input type="text" id="orientacion" class="form-control p-2" readonly>
                </div>

                <div class="col-md-4 mb-4">
                    <label for="info_reductor">Información del reductor seleccionado</label>
                    <input type="text" id="info_reductor" class="form-control p-2" readonly>
                </div>

                <div class="col-md-4 mb-4">
                    <label for="barrio">Barrio</label>
                    <select name="barrio" id="barrio" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona el barrio</option>
                        <?php foreach($barrios as $bar): ?>
                        <option value="<?php echo $bar['bar_id']?>">
                            <?php echo $bar['bar_nombre']?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4 mb-4">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control p-2"
                        placeholder="Ejemplo: Carrera 1 #0-0">
                </div>

                <div class="col-md-4 mb-4">
                    <label for="tipodanio">Tipo de daño</label>
                    <input type="text" name="tipodanio" id="tipodanio" class="form-control p-2"
                        placeholder="Describe el tipo de daño">
                </div>

                <div class="col-md-4 mb-4">
                    <label for="imagen">Imagen del reductor</label>
                    <input type="file" name="imagen" id="imagen" class="form-control p-2" accept="image/*">
                </div>

                <div class="col-md-8 mb-4">
                    <label for="descripcion">Descripción del problema</label>
                    <textarea name="descripcion" id="descripcion" class="form-control p-2" rows="3"
                        placeholder="Describe detalladamente el mal estado del reductor"></textarea>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <input type="submit" value="Enviar reporte" class="btn btn-success mt-4 p-2">
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    <?php if(isset($_GET['status']) && $_GET['status'] == 'exito'): ?>
    swal({ title: "¡Reporte enviado!", text: "Tu reporte fue registrado con éxito.", icon: "success", button: "Aceptar" });
    <?php elseif(isset($_GET['status']) && $_GET['status'] == 'error'): ?>
    swal({ title: "Error al enviar", text: "Hubo un error al registrar tu reporte. Intenta nuevamente.", icon: "error", button: "Aceptar" });
    <?php elseif(isset($_GET['status']) && $_GET['status'] == 'vacio'):
        $campo = isset($_GET['campo']) ? $_GET['campo'] : '';
        $mensajes = array(
            'categoria'   => 'Debes seleccionar la categoría del reductor.',
            'tipo'        => 'Debes seleccionar el tipo de reductor.',
            'barrio'      => 'Debes seleccionar el barrio.',
            'direccion'   => 'Debes ingresar la dirección.',
            'tipodanio'   => 'Debes describir el tipo de daño.',
            'descripcion' => 'Debes escribir la descripción del problema.'
        );
        $mensaje = isset($mensajes[$campo]) ? $mensajes[$campo] : 'Debes completar todos los campos obligatorios.';
    ?>
    swal({ title: "Campo requerido", text: "<?php echo addslashes($mensaje); ?>", icon: "warning", button: "Aceptar" });
    <?php endif; ?>

    const selectCategoria  = document.getElementById('categoriareduc');
    const selectTipo       = document.getElementById('tiporeductor');
    const inputOrientacion = document.getElementById('orientacion');
    const inputInfo        = document.getElementById('info_reductor');

    const todasLasOpciones = Array.from(selectTipo.options);

    selectCategoria.addEventListener('change', function () {
        const categoriaSeleccionada = this.value;
        selectTipo.innerHTML = '<option value="" disabled selected hidden>Selecciona el tipo de reductor</option>';
        inputOrientacion.value = '';
        inputInfo.value = '';
        selectTipo.disabled = false;

        todasLasOpciones.forEach(opcion => {
            if (opcion.getAttribute('data-categoria') === categoriaSeleccionada) {
                selectTipo.appendChild(opcion.cloneNode(true));
            }
        });
    });

    selectTipo.addEventListener('change', function () {
        const op = this.options[this.selectedIndex];
        inputOrientacion.value = op.getAttribute('data-orientacion') || '';
        inputInfo.value        = op.getAttribute('data-descripcion') || '';
    });
});
</script>
