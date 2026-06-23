<?php

include_once '../model/MasterModel.php';

class ReportesGlobalesModel extends MasterModel {


    public function totalAccidentesPorBarrio($fecha_inicio = "", $fecha_fin = "") {

        $sql = "SELECT b.bar_nombre, COUNT(s.sra_id) AS total
                FROM solicitudes_reporte_accidentes s
                JOIN barrios b ON s.bar_id = b.bar_id
                WHERE 1 = 1";

        if ($fecha_inicio != "") {
            $sql .= " AND s.sra_fecha >= '".$fecha_inicio."'";
        }

        if ($fecha_fin != "") {
            $sql .= " AND s.sra_fecha <= '".$fecha_fin."'";
        }

        $sql .= " GROUP BY b.bar_nombre ORDER BY total DESC";

        return $this->select($sql);
    }

    public function totalAccidentesPorFecha($fecha_inicio = "", $fecha_fin = "") {

        $sql = "SELECT s.sra_fecha, COUNT(s.sra_id) AS total
                FROM solicitudes_reporte_accidentes s
                WHERE 1 = 1";

        if ($fecha_inicio != "") {
            $sql .= " AND s.sra_fecha >= '".$fecha_inicio."'";
        }

        if ($fecha_fin != "") {
            $sql .= " AND s.sra_fecha <= '".$fecha_fin."'";
        }

        $sql .= " GROUP BY s.sra_fecha ORDER BY s.sra_fecha DESC";

        return $this->select($sql);
    }

    public function listarAccidentes($fecha_inicio = "", $fecha_fin = "") {

        $sql = "SELECT s.sra_id, s.sra_fecha, s.sra_cantidad_lesionados, s.sra_cantidad_vehiculo,
                       s.sra_direccion, b.bar_nombre, c.cau_descripcion, t.tch_nombre, u.usu_nombre
                FROM solicitudes_reporte_accidentes s
                JOIN barrios b             ON s.bar_id  = b.bar_id
                JOIN causasaccidentes c    ON s.cau_id  = c.cau_id
                JOIN tipos_de_choque t     ON s.tch_id  = t.tch_id
                JOIN usuarios u            ON s.usu_id  = u.usu_id
                WHERE 1 = 1";

        if ($fecha_inicio != "") {
            $sql .= " AND s.sra_fecha >= '".$fecha_inicio."'";
        }

        if ($fecha_fin != "") {
            $sql .= " AND s.sra_fecha <= '".$fecha_fin."'";
        }

        $sql .= " ORDER BY s.sra_fecha DESC";

        return $this->select($sql);
    }


    public function solicitudesSenalesPorEstado() {
        $sql = "SELECT e.est_nombre, COUNT(s.sns_id) AS total
                FROM solicitudes_nueva_senal s
                JOIN estadoatencion e ON s.est_id = e.est_id
                GROUP BY e.est_nombre";
        return $this->select($sql);
    }

    public function solicitudesReductoresPorEstado() {
        $sql = "SELECT e.est_nombre, COUNT(s.snr_id) AS total
                FROM solicitudes_nuevo_reductor s
                JOIN estadoatencion e ON s.est_id = e.est_id
                GROUP BY e.est_nombre";
        return $this->select($sql);
    }

    public function solicitudesViasPorEstado() {
        $sql = "SELECT e.est_nombre, COUNT(s.svme_id) AS total
                FROM solicitudes_via_mal_estado s
                JOIN estadoatencion e ON s.est_id = e.est_id
                GROUP BY e.est_nombre";
        return $this->select($sql);
    }

    public function resumenSolicitudes() {
        $sql = "SELECT 'Señales' AS tipo, COUNT(*) AS total FROM solicitudes_nueva_senal
                UNION ALL
                SELECT 'Reductores' AS tipo, COUNT(*) AS total FROM solicitudes_nuevo_reductor
                UNION ALL
                SELECT 'Vías' AS tipo, COUNT(*) AS total FROM solicitudes_via_mal_estado";
        return $this->select($sql);
    }



    public function pqrsfPorEstado() {
        $sql = "SELECT pqr_estado_solicitud AS estado, COUNT(*) AS total
                FROM pqrsf
                GROUP BY pqr_estado_solicitud";
        return $this->select($sql);
    }

    public function pqrsfPorTipo() {
        $sql = "SELECT pqr_tipo AS tipo, COUNT(*) AS total
                FROM pqrsf
                GROUP BY pqr_tipo";
        return $this->select($sql);
    }



    public function usuariosPorRol() {
        $sql = "SELECT r.nombre_rol, COUNT(u.usu_id) AS total
                FROM usuarios u
                JOIN roles r ON r.id_rol = u.id_rol
                GROUP BY r.nombre_rol
                ORDER BY total DESC";
        return $this->select($sql);
    }

}
?>