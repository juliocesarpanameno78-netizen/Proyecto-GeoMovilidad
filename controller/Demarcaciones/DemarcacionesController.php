<?php

include_once '../model/Demarcaciones/DemarcacionesModel.php';

class DemarcacionesController
{
    public function getCreate()
    {
        requierePermiso("Gestion de Solicitudes", "Registrar");

        include_once '../view/Demarcaciones/create.php';
    }

}
?>