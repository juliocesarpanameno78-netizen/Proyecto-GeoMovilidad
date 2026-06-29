<?php

include_once '../model/MasterModel.php';

class UsuariosModel extends MasterModel
{

    public function listarUsuarios()
    {

        $sql = "SELECT
                    u.usu_id              AS id_usuario,
                    td.tdoc_nombre        AS nombre_tipos_doc,
                    u.per_identificacion  AS numero_identificacion,
                    u.per_nombre          AS nombre,
                    u.per_apellido        AS apellido,
                    u.per_telefono        AS telefono,
                    u.usu_nombre          AS nombre_usuario,
                    u.usu_email           AS correo_electronico,
                    u.id_estado,
                    r.nombre_rol
                FROM usuarios u
                INNER JOIN roles r
                    ON r.id_rol = u.id_rol
                INNER JOIN tipos_de_documento td
                    ON td.tdoc_id = u.tdoc_id
                ORDER BY u.usu_id";

        return $this->select($sql);
    }

    public function obtenerUsuario($id_usuario)
    {

        $sql = "SELECT
            u.usu_id AS id_usuario,
            u.id_rol,
            r.nombre_rol,
            u.usu_nombre AS nombre_usuario,
            u.usu_email AS correo_electronico,
            u.tdoc_id AS id_tipo_documento,
            u.per_identificacion AS numero_identificacion,
            u.per_nombre AS nombre,
            u.per_apellido AS apellido,
            u.per_telefono AS telefono,
            u.per_direccion AS direccion,
            td.tdoc_nombre AS nombre_tipos_doc
        FROM usuarios u
        INNER JOIN tipos_de_documento td
            ON td.tdoc_id = u.tdoc_id
        INNER JOIN roles r
            ON r.id_rol = u.id_rol
        WHERE u.usu_id = $id_usuario";

        $resultado = $this->select($sql);

        if (count($resultado) > 0) {
            return $resultado[0];
        }

        return null;
    }

    public function listarRoles()
    {

        $sql = "SELECT *
                FROM roles
                ORDER BY nombre_rol";

        return $this->select($sql);
    }

    public function existeCorreo($correo, $id_usuario)
    {

        $sql = "SELECT *
            FROM usuarios
            WHERE UPPER(usu_email)=UPPER('$correo')
            AND usu_id <> $id_usuario";

        return $this->select($sql);
    }
    public function existeUsuario($nombre_usuario, $id_usuario)
    {

        $sql = "SELECT *
                FROM usuarios
                WHERE UPPER(usu_nombre)=UPPER('$nombre_usuario')
                AND usu_id <> $id_usuario";

        return $this->select($sql);
    }

    public function existeRol($id_rol)
    {

        $sql = "SELECT *
                FROM roles
                WHERE id_rol = $id_rol";

        return $this->select($sql);
    }

    public function actualizarUsuario($datos)
    {

        $sql_usuario = "UPDATE usuarios SET
                            per_nombre = '" . $datos['nombre'] . "',
                            per_apellido = '" . $datos['apellido'] . "',
                            per_telefono = '" . $datos['telefono'] . "',
                            per_direccion = '" . $datos['direccion'] . "',
                            usu_email = '" . $datos['correo'] . "',
                            usu_nombre = '" . $datos['nombre_usuario'] . "',
                            id_rol = " . $datos['id_rol'] . "
                        WHERE usu_id = " . $datos['id_usuario'];

        return $this->update($sql_usuario);
    }
    public function actualizarPerfil($datos)
    {

        $sql = "UPDATE usuarios SET
                per_nombre = '" . $datos['nombre'] . "',
                per_apellido = '" . $datos['apellido'] . "',
                per_telefono = '" . $datos['telefono'] . "',
                per_direccion = '" . $datos['direccion'] . "',
                usu_email = '" . $datos['correo'] . "',
                usu_nombre = '" . $datos['nombre_usuario'] . "'
            WHERE usu_id = " . $datos['id_usuario'];

        return $this->update($sql);
    }

    public function buscarPorCedula($cedula)
    {

        $sql = "SELECT
                u.usu_id              AS id_usuario,
                td.tdoc_nombre        AS nombre_tipos_doc,
                u.per_identificacion  AS numero_identificacion,
                u.per_nombre          AS nombre,
                u.per_apellido        AS apellido,
                u.per_telefono        AS telefono,
                u.usu_nombre          AS nombre_usuario,
                u.usu_email           AS correo_electronico,
                u.id_estado,
                r.nombre_rol
            FROM usuarios u
            INNER JOIN roles r
                ON r.id_rol = u.id_rol
            INNER JOIN tipos_de_documento td
                ON td.tdoc_id = u.tdoc_id
            WHERE u.per_identificacion = '$cedula'
            ORDER BY u.usu_id";

        return $this->select($sql);
    }



    public function actualizarClave($id_usuario, $clave)
    {

        $sql = "UPDATE usuarios
            SET usu_contrasena = '$clave'
            WHERE usu_id = $id_usuario";

        return $this->update($sql);
    }

    public function obtenerClave($id_usuario)
{

    $sql = "SELECT usu_contrasena
            FROM usuarios
            WHERE usu_id = $id_usuario";

    $resultado = $this->select($sql);

    if (count($resultado) > 0) {
        return $resultado[0]['usu_contrasena'];
    }

    return null;
}

    public function cambiarEstado($id_usuario, $id_estado)
    {
        $sql = "UPDATE usuarios SET id_estado = $id_estado WHERE usu_id = $id_usuario";
        return $this->update($sql);
    }

}
?>