<?php

include_once '../model/MasterModel.php';

class AuditoriaModel extends MasterModel {

    public function listarRegistros($filtro_tabla = "", $filtro_operacion = "") {

        $sql = "SELECT
                    id_auditoria,
                    nombre_tabla,
                    operacion,
                    id_registro_afectado,
                    valor_anterior,
                    valor_nuevo,
                    usuario_db,
                    fecha_registro
                FROM auditoria_global
                WHERE 1 = 1";

        if ($filtro_tabla != "") {
            $sql .= " AND UPPER(nombre_tabla) = UPPER('".$filtro_tabla."')";
        }

        if ($filtro_operacion != "") {
            $sql .= " AND UPPER(operacion) = UPPER('".$filtro_operacion."')";
        }

        $sql .= " ORDER BY fecha_registro DESC";

        return $this->select($sql);
    }

    public function listarTablasDistintas() {

        $sql = "SELECT DISTINCT nombre_tabla
                FROM auditoria_global
                ORDER BY nombre_tabla";

        return $this->select($sql);
    }

}
?>