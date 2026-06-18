<?php

include_once '../model/MasterModel.php';

class UsuariosModel extends MasterModel {

    public function listarUsuarios() {

        $sql = "SELECT
                    u.id_usuario,
                    td.nombre_tipos_doc,
                    p.numero_identificacion,
                    p.nombre,
                    p.apellido,
                    p.telefono,
                    u.nombre_usuario,
                    u.correo_electronico,
                    r.nombre_rol
                FROM usuarios u
                INNER JOIN personas p
                    ON p.id_persona = u.id_persona
                INNER JOIN roles r
                    ON r.id_rol = u.id_rol
                INNER JOIN tipos_de_documento td
                    ON td.id_tipos_documentos = p.id_tipo_documento
                ORDER BY u.id_usuario";

        return $this->select($sql);
    }

    public function obtenerUsuario($id_usuario) {

        $sql = "SELECT
                    u.id_usuario,
                    u.id_persona,
                    u.id_rol,
                    u.nombre_usuario,
                    u.correo_electronico,

                    p.id_tipo_documento,
                    p.numero_identificacion,
                    p.nombre,
                    p.apellido,
                    p.telefono,
                    p.direccion,

                    td.nombre_tipos_doc

                FROM usuarios u

                INNER JOIN personas p
                    ON p.id_persona = u.id_persona

                INNER JOIN tipos_de_documento td
                    ON td.id_tipos_documentos = p.id_tipo_documento

                WHERE u.id_usuario = $id_usuario";

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
                WHERE UPPER(correo_electronico)=UPPER('$correo')
                AND id_persona <> $id_persona";

        return $this->select($sql);
    }

    public function existeUsuario($nombre_usuario, $id_usuario) {

        $sql = "SELECT *
                FROM usuarios
                WHERE UPPER(nombre_usuario)=UPPER('$nombre_usuario')
                AND id_usuario <> $id_usuario";

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
                            nombre = '".$datos['nombre']."',
                            apellido = '".$datos['apellido']."',
                            telefono = '".$datos['telefono']."',
                            direccion = '".$datos['direccion']."',
                            correo_electronico = '".$datos['correo']."'
                        WHERE id_persona = ".$datos['id_persona'];

        $this->update($sql_persona);

        $sql_usuario = "UPDATE usuarios SET
                            nombre_usuario = '".$datos['nombre_usuario']."',
                            correo_electronico = '".$datos['correo']."',
                            id_rol = ".$datos['id_rol']."
                        WHERE id_usuario = ".$datos['id_usuario'];

        return $this->update($sql_usuario);
    }

}
?>