<div class="container-fluid">
    <div class="page-inner">
        <div class="row mt-5">
            <div class="col-md-5">
                <h3 class="m-3 display-3 text-nowrap">Historial de reportes de reductores</h3>
            </div>
        </div>

        <div class="mt-5">
            <table class="table table-striped table-hover" id="tablaReporeductores">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Categoría</th>
                        <th>Tipo de reductor</th>
                        <th>Orientación</th>
                        <th>Tipo de daño</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($reporeductores as $rep): ?>
                    <tr>
                        <td><?php echo $rep['srme_id']?></td>
                        <td><?php echo $rep['catr_nombre']?></td>
                        <td><?php echo $rep['tred_nombre']?></td>
                        <td><?php echo $rep['tred_orientacion']?></td>
                        <td><?php echo $rep['srme_tipo_danio']?></td>
                        <td><?php echo $rep['srme_descripcion']?></td>
                        <td>
                            <?php if($rep['srme_imagen']): ?>
                            <img src="<?php echo $rep['srme_imagen']?>" alt="imagen" style="width:60px;height:60px;object-fit:cover;border-radius:4px;">
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
        $('#tablaReporeductores').DataTable({ language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' } });
    }
});
</script>
