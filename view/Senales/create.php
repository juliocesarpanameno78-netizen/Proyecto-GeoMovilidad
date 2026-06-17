<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5">
            <div class="col-md-5">
                <h3 class="m-3 display-3 text-nowrap">Solicitar una Señal</h3>
            </div>
            <div class="col-md-7 d-flex justify-content-end">
                <button class="btn btn-primary m-4 p-2 text-nowrap">Ver mis solicitudes</button>
            </div>
        </div>
        

        <form method="post" action="<?php echo getUrl("Señales","Señales","postCreate")?>">
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <label for="nombre">Nombre completo:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control p-2" placeholder="nombre">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion" id="dirección" class="form-control p-2" placeholder="Ejemplo: Carrera 1 #0-0">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="tiposenal">Tipo de señal</label><br>
                    <select name="tiposenal" id="tiposenal" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona una señal</option>
                        <?php 
                            foreach($tiposenales as $senal){
                        ?>
                        <option value="<?php echo $senal['id_tipo_senal'];?>">
                            <?php echo $senal['nombre_tipo_senal']?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="categoriasenal">Categoría de la señal </label><br>
                    <select name="categoriasenal" id="categoriasenal" class="form-control p-2">
                        <option value="" disabled selected hidden>seleciona la categoría</option>
                        <?php foreach($categoriasenales as $cate) {?>
                        <option value="<?php echo $cate['id_categoria'];?>">
                        <?php echo $cate['nombre_categoria']?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="orientacionsenal">Orientación de la señal </label><br>
                    <select name="orientacionsenal" id="orientacionsenal" class="form-control p-2">
                        <option value="" disabled selected hidden>seleciona la orientación</option>
                        <?php foreach($tiposenales as $senal) {?>
                        <option value="<?php echo $senal['id_tipo_senal'];?>">
                        <?php echo $senal['orientacion']?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control p-2" placeholder="">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="imagenes">Insertar imagen:</label>
                    <input type="file" name="imagenes" id="imagenes" class="form-control p-2" accept="image/*">
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <input type="submit" value="Enviar solicitud" class="btn btn-success mt-4 p-2">
            </div>
        </form>
    </div>
</div>