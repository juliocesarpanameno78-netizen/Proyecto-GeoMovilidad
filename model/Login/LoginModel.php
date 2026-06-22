<?php
include_once '../model/MasterModel.php';

class LoginModel extends MasterModel {

    public function login($correo, $contrasena) {

        $sql = "SELECT u.usu_id, u.usu_nombre, u.usu_email, u.id_rol
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