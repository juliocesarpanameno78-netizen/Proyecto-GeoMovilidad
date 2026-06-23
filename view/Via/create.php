<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5">
            <div class="col-md-5">
                <h3 class="m-3 display-3 text-nowrap">Reporte de vía en mal estado</h3>
            </div>
        </div>

        <form method="post" action="<?php echo getUrl('Via','Via','postCreate')?>" enctype="multipart/form-data">
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <label for="nombre">Reportador:</label>
                    <input type="text" id="nombre" class="form-control p-2"
                        value="<?php echo htmlspecialchars($_SESSION['nombre_usuario'])?>" disabled>
                </div>

                <div class="col-md-4 mb-4">
                    <label for="tipovia">Tipo de vía</label>
                    <select name="tipovia" id="tipovia" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona el tipo de vía</option>
                        <?php foreach($tipvias as $via): ?>
                        <option value="<?php echo $via['tvia_id']?>">
                            <?php echo $via['tvia_nombre']?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4 mb-4">
                    <label for="tipodanio">Tipo de daño</label>
                    <select name="tipodanio" id="tipodanio" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona el tipo de daño</option>
                        <?php foreach($tiposdanio as $danio): ?>
                        <option value="<?php echo $danio['cdan_id']?>">
                            <?php echo $danio['cdan_nombre']?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-8 mb-4">
                    <label for="descripcion">Descripción detallada del mal estado</label>
                    <textarea name="descripcion" id="descripcion" class="form-control p-2" rows="3"
                        placeholder="Describe detalladamente el mal estado de la vía"></textarea>
                </div>

                <div class="col-md-4 mb-4">
                    <label for="imagenes">Imagen de la vía</label>
                    <input type="file" name="imagenes" id="imagenes" class="form-control p-2" accept="image/*">
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
    <?php if(isset($_GET['status']) && $_GET['status'] == 'exito'): ?>
    swal({ title: "¡Reporte enviado!", text: "Tu reporte de vía fue registrado con éxito.", icon: "success", button: "Aceptar" });
    <?php elseif(isset($_GET['status']) && $_GET['status'] == 'error'): ?>
    swal({ title: "Error al enviar", text: "Hubo un error al registrar tu reporte. Intenta nuevamente.", icon: "error", button: "Aceptar" });
    <?php endif; ?>
});
</script>
