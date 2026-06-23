<?php

require_once dirname(__FILE__) . '/../MasterModel.php';
class RegistroModel extends MasterModel
{

    public function getTiposDocumento()
    {
        $sql = "SELECT tdoc_id, tdoc_nombre FROM tipos_de_documento ORDER BY tdoc_id";
        return pg_query($this->getConnection(), $sql);
    }


    public function existeCorreo($correo)
    {
        $sql = "SELECT per_id FROM personas WHERE per_email = $1";
        $result = pg_query_params($this->getConnection(), $sql, array($correo));
        return pg_num_rows($result) > 0;
    }


    public function existeIdentificacion($numero)
    {
        $sql = "SELECT per_id FROM personas WHERE per_identificacion = $1";
        $result = pg_query_params($this->getConnection(), $sql, array($numero));
        return pg_num_rows($result) > 0;
    }

    public function registrar($datos)
    {

        $per_id = $this->autoincrement('personas', 'per_id');


        $sql_persona = "INSERT INTO personas 
                        (per_id, tdoc_id, per_identificacion, per_apellido, per_nombre, per_email, per_telefono, per_direccion)
                        VALUES ($1, $2, $3, $4, $5, $6, $7, $8)";

        $result_persona = pg_query_params($this->getConnection(), $sql_persona, array(
            $per_id,
            $datos['tdoc_id'],
            $datos['per_identificacion'],
            $datos['per_apellido'],
            $datos['per_nombre'],
            $datos['per_correo_electronico'],
            $datos['per_telefono'],
            $datos['per_direccion']
        ));

        if (!$result_persona) {
            return false;
        }


        $usu_id = $this->autoincrement('usuarios', 'usu_id');


        $sql_usuario = "INSERT INTO usuarios 
                        (usu_id, per_id, bar_id, id_rol, usu_nombre, usu_contrasena, usu_email)
                        VALUES ($1, $2, $3, $4, $5, $6, $7)";

        $result_usuario = pg_query_params($this->getConnection(), $sql_usuario, array(
            $usu_id,
            $per_id,
            1,
            2,
            $datos['usu_nombre'],
            md5($datos['usu_contrasena']),
            $datos['per_correo_electronico']
        ));

        return $result_usuario ? true : false;
    }
}
?>