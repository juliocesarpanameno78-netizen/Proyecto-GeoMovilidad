<?php

include_once '../model/Solicitudes/SolicitudesModel.php';

class SolicitudesController
{

    public function getListar()
    {
        requiereAlgunPermiso(array(
            array("Gestion de Solicitudes", "Listar"),
            array("Mis Solicitudes", "Listar")
        ));
        $obj = new SolicitudesModel();

        $filtro_tipo = isset($_GET['tipo_solicitud']) ? trim($_GET['tipo_solicitud']) : "";

        if ($filtro_tipo == "Señal") {
            $solicitudes = $obj->listarSenales();
        } else if ($filtro_tipo == "Reductor") {
            $solicitudes = $obj->listarReductores();
        } else if ($filtro_tipo == "Vía") {
            $solicitudes = $obj->listarVias();
        } else {
            $solicitudes = $obj->listarTodas();
        }

        include_once '../view/Solicitudes/listar.php';
    }

}
?>