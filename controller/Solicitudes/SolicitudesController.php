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

    public function getDetalle()
    {
        requiereAlgunPermiso(array(
            array("Gestion de Solicitudes", "Listar"),
            array("Mis Solicitudes", "Listar")
        ));

        $obj = new SolicitudesModel();

        $tipo = isset($_GET['tipo']) ? strtolower(trim($_GET['tipo'])) : '';
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($id <= 0 || !in_array($tipo, array('senal', 'reductor', 'via'))) {
            $_SESSION['error_generico'] = 'Debe seleccionar una solicitud valida.';
            redirect(getUrl('Solicitudes', 'Solicitudes', 'getListar'));
            return;
        }

        $detalle = $obj->obtenerDetalle($tipo, $id, $_SESSION['id_rol'], $_SESSION['id_usuario']);

        if (count($detalle) == 0) {
            $_SESSION['error_generico'] = 'No se encontro la solicitud seleccionada.';
            redirect(getUrl('Solicitudes', 'Solicitudes', 'getListar'));
            return;
        }

        $solicitud = $detalle[0];

        include_once '../view/Solicitudes/detalle.php';
    }

}
?>