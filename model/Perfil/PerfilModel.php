<?php

include_once '../model/MasterModel.php';

class PerfilModel extends MasterModel
{

    public function obtenerPerfil($id_usuario)
    {

        $sql = "SELECT
                    u.usu_id,
                    u.per_nombre,
                    u.per_apellido,
                    u.usu_nombre,
                    u.usu_email,
                    u.per_telefono,
                    u.per_direccion,
                    u.id_rol,
                    r.nombre_rol
                FROM usuarios u
                INNER JOIN roles r
                    ON r.id_rol = u.id_rol
                WHERE u.usu_id = $id_usuario";

        $resultado = $this->select($sql);

        if (count($resultado) > 0) {
            return $resultado[0];
        }

        return null;
    }


    public function correoExiste($correo, $id_usuario)
    {

        $sql = "SELECT *
                FROM usuarios
                WHERE UPPER(usu_email)=UPPER('$correo')
                AND usu_id <> $id_usuario";

        return $this->select($sql);

    }


    public function usuarioExiste($usuario, $id_usuario)
    {

        $sql = "SELECT *
                FROM usuarios
                WHERE UPPER(usu_nombre)=UPPER('$usuario')
                AND usu_id <> $id_usuario";

        return $this->select($sql);

    }


    public function actualizarPerfil($datos)
    {

        $sql = "UPDATE usuarios SET

                    per_nombre = '".$datos['nombre']."',

                    per_apellido = '".$datos['apellido']."',

                    usu_email = '".$datos['correo']."',

                    usu_nombre = '".$datos['usuario']."',

                    per_telefono = '".$datos['telefono']."',

                    per_direccion = '".$datos['direccion']."'

                WHERE usu_id = ".$datos['id_usuario'];

        return $this->update($sql);

    }


    public function validarClaveActual($id_usuario, $clave)
    {

        $clave = md5($clave);

        $sql = "SELECT *

                FROM usuarios

                WHERE usu_id = $id_usuario

                AND usu_contrasena = '$clave'";

        $resultado = $this->select($sql);

        if (count($resultado) > 0) {

            return true;

        }

        return false;

    }


    public function actualizarClave($id_usuario, $clave)
    {

        $clave = md5($clave);

        $sql = "UPDATE usuarios

                SET usu_contrasena = '$clave'

                WHERE usu_id = $id_usuario";

        return $this->update($sql);

    }

}
?>