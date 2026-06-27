<?php

include_once '../model/Auditoria/AuditoriaModel.php';

class AuditoriaController
{
    public function getListar()
    {
        // Verifica si lleva la 'e' o es requirePermiso
        requierePermiso("Auditoria", "Listar");

        $obj = new AuditoriaModel();

        $filtro_tabla = isset($_GET['nombre_tabla']) ? trim($_GET['nombre_tabla']) : "";
        $filtro_operacion = isset($_GET['operacion']) ? trim($_GET['operacion']) : "";

        $registros = $obj->listarRegistros($filtro_tabla, $filtro_operacion);
        $tablas = $obj->listarTablasDistintas();

        include_once '../view/Auditoria/Listar.php';
    }
}
?>