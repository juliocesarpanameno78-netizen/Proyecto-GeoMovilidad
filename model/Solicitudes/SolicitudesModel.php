<?php

include_once '../model/MasterModel.php';

class SolicitudesModel extends MasterModel {

    public function listarSenales() {

    $id_rol = $_SESSION['id_rol'];
    $id_usuario = $_SESSION['id_usuario'];
  

    $sql = "SELECT s.sns_id AS id, 'Señal' AS tipo_solicitud,
                   t.tsen_nombre AS detalle, s.sns_descripcion AS descripcion,
                   t.tsen_orientacion AS orientacion,
                   e.est_nombre, e.est_id, u.usu_nombre
            FROM solicitudes_nueva_senal s
            JOIN tipos_de_senales t ON s.tsen_id = t.tsen_id
            JOIN estadoatencion e   ON s.est_id  = e.est_id
            JOIN usuarios u         ON s.usu_id  = u.usu_id";

    if ($id_rol == 2) {
        $sql .= " WHERE s.usu_id = " . $id_usuario;
    }

    return $this->select($sql);
}

    public function listarReductores() {

    $id_rol = $_SESSION['id_rol'];
    $id_usuario = $_SESSION['id_usuario'];

    $sql = "SELECT r.snr_id AS id, 'Reductor' AS tipo_solicitud,
                   tr.tred_nombre AS detalle, r.snr_descripcion AS descripcion,
                   tr.tred_orientacion AS orientacion,
                   e.est_nombre, e.est_id, u.usu_nombre
            FROM solicitudes_nuevo_reductor r
            JOIN tipos_de_reductores tr ON r.tred_id = tr.tred_id
            JOIN estadoatencion e       ON r.est_id  = e.est_id
            JOIN usuarios u             ON r.usu_id  = u.usu_id";

    if ($id_rol == 2) {
        $sql .= " WHERE r.usu_id = " . $id_usuario;
    }

    return $this->select($sql);
}

   public function listarVias() {

    $id_rol = $_SESSION['id_rol'];
    $id_usuario = $_SESSION['id_usuario'];

    $sql = "SELECT v.svme_id AS id, 'Vía' AS tipo_solicitud,
                   c.cdan_nombre AS detalle, v.svme_descripcion_detallada AS descripcion,
                   e.est_nombre, e.est_id, u.usu_nombre
            FROM solicitudes_via_mal_estado v
            JOIN categoriastipodanio c ON v.cdan_id = c.cdan_id
            JOIN estadoatencion e      ON v.est_id  = e.est_id
            JOIN usuarios u            ON v.usu_id  = u.usu_id";

    if ($id_rol == 2) {
        $sql .= " WHERE v.usu_id = " . $id_usuario;
    }

    return $this->select($sql);
}

    public function listarTodas() {
        $senales    = $this->listarSenales();
        $reductores = $this->listarReductores();
        $vias       = $this->listarVias();

        $todas = array_merge($senales, $reductores, $vias);

        // Ordenar por estado pendiente primero (ordenamiento simple en PHP, compatible con 5.2)
        usort($todas, array($this, 'compararPorId'));

        return $todas;
    }

    public function compararPorId($a, $b) {
        if ($a['id'] == $b['id']) return 0;
        return ($a['id'] < $b['id']) ? 1 : -1;
    }

}
?>