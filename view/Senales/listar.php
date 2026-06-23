<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5">
            <div class="col-md-5">
                <h3 class="m-3 display-3 text-nowrap">Historial de solicitudes de señales</h3>
            </div>
        </div>

        <div class="mt-5">
            <table class="table table-striped table-hover" id="tablaSenales">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tipo de señal</th>
                        <th>Orientación</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th>Dirección</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($senales as $sena): ?>
                    <tr>
                        <td><?php echo $sena['sns_id']?></td>
                        <td><?php echo $sena['tsen_nombre']?></td>
                        <td><?php echo $sena['tsen_orientacion']?></td>
                        <td><?php echo $sena['cats_nombre']?></td>
                        <td>
                            <?php
                                $est = $sena['est_nombre'];
                                $badge = $est == 'Pendiente' ? 'warning' : 'success';
                            ?>
                            <span class="badge badge-<?php echo $badge?>"><?php echo $est?></span>
                        </td>
                        <td><?php echo $sena['sns_direccion']?></td>
                        <td><?php echo $sena['sns_descripcion']?></td>
                        <td>
                            <?php if($sena['sns_imagen']): ?>
                            <img src="<?php echo $sena['sns_imagen']?>" alt="imagen" style="width:60px;height:60px;object-fit:cover;border-radius:4px;">
                            <?php else: ?>
                            <span class="text-muted">Sin imagen</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    if (typeof $.fn.DataTable !== 'undefined') {
        $('#tablaSenales').DataTable({ language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' } });
    }
});
</script>
