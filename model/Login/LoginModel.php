<?php
include_once '../model/MasterModel.php';

class LoginModel extends MasterModel {

    public function login($correo, $contrasena) {

        $sql = "SELECT u.usu_id AS id_usuario, u.usu_nombre AS nombre_usuario, u.usu_email AS correo_electronico, u.id_rol
                FROM usuarios u
                WHERE u.usu_email = $1
                AND u.usu_contrasena = $2
                LIMIT 1";

        $result = pg_query_params($this->getConnection(), $sql, array($correo, md5($contrasena)));

        if ($result && pg_num_rows($result) > 0) {
            return pg_fetch_assoc($result);
        } else {
            return false;
        }
    }
}
?>