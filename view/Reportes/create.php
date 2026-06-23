<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5">
            <div class="col-md-5">
                <h3 class="m-3 display-3 text-nowrap">Reporte de accidentes</h3>
            </div>
        </div>
        

        <form method="post" action="<?php echo getUrl("Reportes","Reportes","postCreate")?>" enctype="multipart/form-data">
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <label for="nombre">Reportador:</label>
                    <input type="text" id="nombre" class="form-control p-2" value="<?php echo htmlspecialchars($_SESSION['nombre_usuario']) ?>"disabled>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="leccionado">Número de lesionados:</label>
                    <input type="number" name="leccionado" id="leccionado" class="form-control p-2" min=0>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion" id="dirección" class="form-control p-2" placeholder="Ejemplo: Carrera 1 #0-0">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="causas">Causas del accidente</label><br>
                    <select name="causas" id="causas" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona la causas</option>
                        <?php 
                            foreach($causas as $cau){
                        ?>
                        <option value="<?php echo $cau['cau_id'];?>">
                            <?php echo $cau['cau_descripcion']?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="tipochoque">Tipo de choque</label><br>
                    <select name="tipochoque" id="tipochoque" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona el choque</option>
                        <?php 
                            foreach($catechoque as $cho){
                        ?>
                        <option value="<?php echo $cho['catch_id'];?>">
                            <?php echo $cho['catch_nombre']?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="catechoque">¿El choque fue con?</label><br>
                    <select name="catechoque" id="catechoque" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona con que fue el choque</option>
                        <?php 
                            foreach($tipochoque as $choque){
                        ?>
                        <option value="<?php echo $choque['tch_id'];?>"
                            data-choqueCon="<?php echo $choque['catch_id']; ?>">
                            <?php echo $choque['tch_nombre']?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="cativehiculo">Cantidad de vehículos afectados:</label>
                    <input type="number" name="cativehiculo" id="cativehiculo" class="form-control p-2" placeholder="" min=0>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="barrio">Barrio:</label><br>
                    <select name="barrio" id="barrio" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona el barrio</option>
                        <?php 
                            foreach($barrio as $bar){
                        ?>
                        <option value="<?php echo $bar['bar_id'];?>">
                            <?php echo $bar['bar_nombre']?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="imagenes">Insetar imagen del accidente:</label>
                    <input type="file" name="imagen" id="imagen" class="form-control p-2" accept="image/*">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="tipovehiculo">Tipo de vehículo:</label><br>
                    <select name="tipovehiculo" id="tipovehiculo" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona el vehículo</option>
                        <?php 
                            foreach($tipovehi as $vehi){
                        ?>
                        <option value="<?php echo $vehi['tveh_id'];?>">
                            <?php echo $vehi['tveh_nombre']?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="marca">Marca y modelo del vehículo:</label>
                    <input type="text" name="marca" id="marca" class="form-control p-2" placeholder="">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="placa">Placa del vehículo:</label>
                    <input type="text" name="placa" id="placa" class="form-control p-2" placeholder="">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="color">Color del vehículo:</label>
                    <input type="text" name="color" id="color" class="form-control p-2" placeholder="">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control p-2" placeholder="">
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

    // Cuando se cambia el Tipo de Señal
    selectTipoChoque.addEventListener('change', function () {
        const opcionSeleccionada = this.options[this.selectedIndex];
        
        // Con esto se trae la información de los atributos data-*
        const choquefue = opcionSeleccionada.getAttribute('data-choqueCon');

        selectTipoChoquefue.value = choque ? choque : '';
    });
});
</script>