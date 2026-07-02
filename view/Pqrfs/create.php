<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5">
            <div class="col-md-5">
                <h3 class="m-3 display-3 text-nowrap">Radicar PQRSF</h3>
            </div>
        </div>

        <form method="post" action="<?php echo getUrl('Pqrfs','Pqrfs','postCreate')?>">
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <label for="nombre">Solicitante:</label>
                    <input type="text" id="nombre" class="form-control p-2"
                        value="<?php echo $_SESSION['nombre_usuario']?>" disabled>
                </div>

                <div class="col-md-4 mb-4">
                    <label for="tipo">Tipo de solicitud<span style="color: red;">*</span></label>
                    <select name="tipo" id="tipo" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona el tipo</option>
                        <option value="Petición">Petición</option>
                        <option value="Queja">Queja</option>
                        <option value="Reclamo">Reclamo</option>
                        <option value="Sugerencia">Sugerencia</option>
                        <option value="Felicitación">Felicitación</option>
                    </select>
                </div>

                <div class="col-md-12 mb-4">
                    <label for="descripcion">Descripción<span style="color: red;">*</span></label>
                    <textarea name="descripcion" id="descripcion" class="form-control p-2" rows="5"
                        placeholder="Describe detalladamente tu solicitud..."></textarea>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <input type="submit" value="Enviar PQRSF" class="btn btn-success mt-4 p-2">
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    <?php if(isset($_GET['status']) && $_GET['status'] == 'exito'): ?>
    swal({ 
        title: "¡PQRSF enviada!",
        text: "Tu solicitud fue registrada con éxito.",
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
    <?php elseif(isset($_GET['status']) && $_GET['status'] == 'vacio'):
    $campo = isset($_GET['campo']) ? $_GET['campo'] : '';
    $mensajes = array(
        'tipo' => 'Debes seleccionar el tipo de solicitud de pqrfs.',
        'descripcion' => 'Debes debes describir el motivo de la solicitud.'
    );
    $mensaje = isset($mensajes[$campo]) ? $mensajes[$campo] : 'Debes completar todos los campos obligatorios.'
    ?>
    swal({
        title: "Campo requerido",
        text: "<?php echo addslashes($mensaje); ?>",
        icon: "warning",
        button: "Aceptar"
    });
    <?php endif; ?>
});
</script>
