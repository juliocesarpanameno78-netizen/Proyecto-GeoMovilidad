<?php
include_once '../model/MasterModel.php';

class LoginModel extends MasterModel {

    public function login($correo, $contrasena) {

        $sql = "SELECT u.id_usuario, u.nombre_usuario, u.correo_electronico, u.id_rol
                FROM usuarios u
                WHERE u.correo_electronico = $1
                AND u.contrasena = $2
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