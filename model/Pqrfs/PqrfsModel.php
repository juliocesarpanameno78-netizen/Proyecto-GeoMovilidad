<?php

include_once '../model/MasterModel.php';

class PqrfsModel extends MasterModel{

	public function obtenerDetalle($id, $id_rol, $id_usuario)
	{
		$id = (int)$id;
		if ($id <= 0) {
			return array();
		}

		$sql = "SELECT p.pqr_id, p.pqr_tipo, p.pqr_estado_solicitud, p.pqr_descripcion,
					   u.usu_nombre
				FROM pqrsf p
				JOIN usuarios u ON p.usu_id = u.usu_id
				WHERE p.pqr_id = " . $id;

		if ($id_rol == 2) {
			$sql .= " AND p.usu_id = " . (int)$id_usuario;
		}

		return $this->select($sql);
	}
}
