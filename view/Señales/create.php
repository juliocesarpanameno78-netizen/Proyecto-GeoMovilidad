<div class="mt-3">
    <h3 class="display-3">Solicitar un Señal</h3>
</div>

<form method="post" action="<?php echo getUrl("Señales","Señales","postCreate")?>">
    <div class="row mt-5">
        <div class="col-md-4">
            <input type="text" placeholder="nombre">
        </div>


    </div>
    
    <input type="submit" value="Enviar solicitud">
</form>