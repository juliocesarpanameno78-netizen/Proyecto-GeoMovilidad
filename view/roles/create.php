<div class="mt-5">
    <h1 class="display-4">Registro Roles</h1>
</div>

<div class="mt-5">
    <form action="<?= getUrl('Roles','Roles','postCreate'); ?>" method="post">

        <div class="row">

            <div class="col-4 mt-3">
                <label for="rol_nombre">Nombre:</label>
                <input type="text"
                       name="rol_nombre"
                       id="rol_nombre"
                       class="form-control"
                       placeholder="Ingrese el rol">
            </div>

            <div class="col-4 mt-3">
                <label for="rol_descripcion">Descripción:</label>
                <input type="text"
                       name="rol_descripcion"
                       id="rol_descripcion"
                       class="form-control"
                       placeholder="Ingrese la descripción">
            </div>

        </div>

        <div class="mt-5">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Acción/Módulo</th>

                        <?php
                        $modulosArray = [];

                        while($modulo = pg_fetch_assoc($modulos)){
                            echo "<th>".$modulo['mod_nombre']."</th>";
                            $modulosArray[] = $modulo;
                        }
                        ?>
                    </tr>
                </thead>