<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5">
            <div class="col-md-5">
                <h3 class="m-3 display-3 text-nowrap">Solicitar una Demarcación</h3>
            </div>
            <div class="col-md-7 d-flex justify-content-end">
                <button class="btn btn-primary m-4 p-2 text-nowrap">Ver mis solicitudes</button>
            </div>
        </div>

        <form method="post" action="<?php echo getUrl("Demarcaciones","Demarcaciones","postCreate")?>">
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <label for="nombre">Nombre completo:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control p-2" placeholder="nombre">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="cedula">Numero de cédula:</label>
                    <input type="number" name="cedula" id="cedula" class="form-control p-2" placeholder="11******">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion" id="dirección" class="form-control p-2" placeholder="Ejemplo: Carrera 1 #0-0">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="tiposeñal">Tipo de señal</label><br>
                    <select name="tiposeñal" id="tiposeñal" class="form-control p-2">
                        <option value="" disabled selected hidden>seleciona una señal</option>
                        <?php 
                            foreach($tiposeñales as $señal){
                        ?>
                        <option value="<?php echo $señal['id_tipo_senal'];?>">
                            <?php echo $señal['tipo_senal']?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="catergoriaseñal">Categoría de la señal </label><br>
                    <select name="catergoriaseñal" id="catergoriaseñal" class="form-control p-2">
                        <option value="" disabled selected hidden>seleciona la categoría</option>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control p-2" placeholder="">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="barrio">Barrio:</label>
                    <input type="text" name="barrio" id="barrio" class="form-control p-2" placeholder="Ejemplo: villa sur">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="comuna">Comuna:</label>
                    <input type="text" name="comuna" id="comuna" class="form-control p-2" placeholder="ejemplo: Comuna 0">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="imagenes">Insetar imagen:</label>
                    <input type="file" name="imagenes" id="imagenes" class="form-control p-2" accept="image/*">
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <input type="submit" value="Enviar solicitud" class="btn btn-success mt-4 p-2">
            </div>
        </form>
    </div>
</div>