<?php
    include_once("../model/MasterModel.php");

    class Acceso extends MasterModel {

        public function getUsuario($correo, $contrasena) {
            $resultado = $this->findOne(
                "usuarios",
                "usuarios.*, roles.nombre_rol",
                "usuarios.correo_electronico='$correo' AND usuarios.contrasena='$contrasena' AND usuarios.id_rol = roles.id_rol"
            );
            return $resultado;
        }
    }
?>