<?php

include_once '../model/MasterModel.php';

class UsuariosModel extends MasterModel {

    public function listarUsuarios() {

        $sql = "SELECT
                    u.usu_id              AS id_usuario,
                    td.tdoc_nombre        AS nombre_tipos_doc,
                    p.per_identificacion  AS numero_identificacion,
                    p.per_nombre          AS nombre,
                    p.per_apellido        AS apellido,
                    p.per_telefono        AS telefono,
                    u.usu_nombre          AS nombre_usuario,
                    u.usu_email           AS correo_electronico,
                    r.nombre_rol
                FROM usuarios u
                INNER JOIN personas p
                    ON p.per_id = u.per_id
                INNER JOIN roles r
                    ON r.id_rol = u.id_rol
                INNER JOIN tipos_de_documento td
                    ON td.tdoc_id = p.tdoc_id
                ORDER BY u.usu_id";

        return $this->select($sql);
    }

    public function obtenerUsuario($id_usuario) {

        $sql = "SELECT
                    u.usu_id              AS id_usuario,
                    u.per_id              AS id_persona,
                    u.id_rol,
                    u.usu_nombre          AS nombre_usuario,
                    u.usu_email           AS correo_electronico,

                    p.tdoc_id             AS id_tipo_documento,
                    p.per_identificacion  AS numero_identificacion,
                    p.per_nombre          AS nombre,
                    p.per_apellido        AS apellido,
                    p.per_telefono        AS telefono,
                    p.per_direccion       AS direccion,

                    td.tdoc_nombre        AS nombre_tipos_doc

                FROM usuarios u

                INNER JOIN personas p
                    ON p.per_id = u.per_id

                INNER JOIN tipos_de_documento td
                    ON td.tdoc_id = p.tdoc_id

                WHERE u.usu_id = $id_usuario";

        $resultado = $this->select($sql);

        if(count($resultado) > 0){
            return $resultado[0];
        }

        return null;
    }

    public function listarRoles() {

        $sql = "SELECT *
                FROM roles
                ORDER BY nombre_rol";

        return $this->select($sql);
    }

    public function existeCorreo($correo, $id_persona) {

        $sql = "SELECT *
                FROM personas
                WHERE UPPER(per_email)=UPPER('$correo')
                AND per_id <> $id_persona";

        return $this->select($sql);
    }

    public function existeUsuario($nombre_usuario, $id_usuario) {

        $sql = "SELECT *
                FROM usuarios
                WHERE UPPER(usu_nombre)=UPPER('$nombre_usuario')
                AND usu_id <> $id_usuario";

        return $this->select($sql);
    }

    public function existeRol($id_rol){

        $sql = "SELECT *
                FROM roles
                WHERE id_rol = $id_rol";

        return $this->select($sql);
    }

    public function actualizarUsuario($datos) {

        $sql_persona = "UPDATE personas SET
                            per_nombre = '".$datos['nombre']."',
                            per_apellido = '".$datos['apellido']."',
                            per_telefono = '".$datos['telefono']."',
                            per_direccion = '".$datos['direccion']."',
                            per_email = '".$datos['correo']."'
                        WHERE per_id = ".$datos['id_persona'];

        $this->update($sql_persona);

        $sql_usuario = "UPDATE usuarios SET
                            usu_nombre = '".$datos['nombre_usuario']."',
                            usu_email = '".$datos['correo']."',
                            id_rol = ".$datos['id_rol']."
                        WHERE usu_id = ".$datos['id_usuario'];

        return $this->update($sql_usuario);
    }

}
?>