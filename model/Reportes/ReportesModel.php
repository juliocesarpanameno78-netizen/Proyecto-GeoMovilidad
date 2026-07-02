<?php

    include_once '../model/MasterModel.php';

    class ReportesModel extends MasterModel {
        public function obtenerDetalle($id, $id_rol, $id_usuario)
        {
            $id = (int)$id;
            if ($id <= 0) {
                return array();
            }

            $sql = "SELECT s.sra_id, s.sra_fecha, s.sra_cantidad_lesionados, s.sra_cantidad_vehiculo,
                           s.sra_descripcion, s.sra_direccion, s.sra_imagen,
                           ST_AsText(s.sra_coordenadas) AS sra_coordenadas_texto,
                           b.bar_nombre, c.cau_descripcion, t.tch_nombre,
                           u.usu_nombre,
                           v.veh_placa, v.veh_modelo, v.veh_color, tv.tveh_nombre
                    FROM solicitudes_reporte_accidentes s
                    JOIN barrios b             ON s.bar_id  = b.bar_id
                    JOIN causasaccidentes c    ON s.cau_id  = c.cau_id
                    JOIN tipos_de_choque t     ON s.tch_id  = t.tch_id
                    JOIN usuarios u            ON s.usu_id  = u.usu_id
                    JOIN vehiculos v           ON s.veh_id  = v.veh_id
                    JOIN tipos_de_vehiculos tv ON v.tveh_id = tv.tveh_id
                    WHERE s.sra_id = " . $id;

            if ($id_rol == 2) {
                $sql .= " AND s.usu_id = " . (int)$id_usuario;
            }

            return $this->select($sql);
        }
    }

?>