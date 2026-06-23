<?php

include_once '../model/ReportesGlobales/ReportesGlobalesModel.php';

class ReportesGlobalesController {

    public function getListar() {

        requiereRol(array(1)); // Solo Administrador

        $obj = new ReportesGlobalesModel();

        $seccion = isset($_GET['seccion']) ? trim($_GET['seccion']) : 'accidentes';
        $fecha_inicio = isset($_GET['fecha_inicio']) ? trim($_GET['fecha_inicio']) : "";
        $fecha_fin = isset($_GET['fecha_fin']) ? trim($_GET['fecha_fin']) : "";

        $accidentes_por_barrio = array();
        $accidentes_por_fecha  = array();
        $lista_accidentes      = array();

        $resumen_solicitudes   = array();
        $senales_estado        = array();
        $reductores_estado     = array();
        $vias_estado           = array();

        $pqrsf_estado          = array();
        $pqrsf_tipo            = array();

        $usuarios_rol          = array();

        if ($seccion == 'accidentes') {
            $accidentes_por_barrio = $obj->totalAccidentesPorBarrio($fecha_inicio, $fecha_fin);
            $accidentes_por_fecha  = $obj->totalAccidentesPorFecha($fecha_inicio, $fecha_fin);
            $lista_accidentes      = $obj->listarAccidentes($fecha_inicio, $fecha_fin);
        }

        if ($seccion == 'solicitudes') {
            $resumen_solicitudes = $obj->resumenSolicitudes();
            $senales_estado      = $obj->solicitudesSenalesPorEstado();
            $reductores_estado   = $obj->solicitudesReductoresPorEstado();
            $vias_estado         = $obj->solicitudesViasPorEstado();
        }

        if ($seccion == 'pqrsf') {
            $pqrsf_estado = $obj->pqrsfPorEstado();
            $pqrsf_tipo   = $obj->pqrsfPorTipo();
        }

        if ($seccion == 'usuarios') {
            $usuarios_rol = $obj->usuariosPorRol();
        }

        include_once '../view/ReportesGlobales/listar.php';
    }

}
?>