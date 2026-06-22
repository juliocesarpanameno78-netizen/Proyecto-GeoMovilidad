<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5">
            <div class="col-md-5">
                <h3 class="m-3 display-3 text-nowrap">Solicitud de vía en mal estado</h3>
            </div>
        </div>

        <form method="post" action="<?php echo getUrl("Via","Via","postCreate")?>">
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
                    <label for="tipovia">Tipo de Vía</label><br>
                    <select name="tipovia" id="tipovia" class="form-control p-2">
                        <option value="" disabled selected hidden>Selecciona el tipo de vía</option>
                        <?php 
                            foreach($tipvias as $via){
                        ?>
                        <option value="<?php echo $via['tvia_id'];?>">
                            <?php echo $via['tvia_nombre']?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control p-2" placeholder="Haz una descripcion detalla del mal estado de la via">
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
                    <label for="imagenes">Insetar imagen de la vía:</label>
                    <input type="file" name="imagenes" id="imagenes" class="form-control p-2" accept="image/*">
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <input type="submit" value="Enviar solicitud" class="btn btn-success mt-4 p-2">
            </div>
        </form>
    </div>
</div>