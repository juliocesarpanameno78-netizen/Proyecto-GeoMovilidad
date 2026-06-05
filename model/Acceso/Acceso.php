<?php
    include_once("../model/MasterModel.php");

    class Acceso extends MasterModel {

        public function getUsuario($email, $contrasena) {
            $resultado = $this->findOne("usuarios", "*", "email='$email' AND contrasena='$contrasena'");
            return $resultado;
        }

    }
?>