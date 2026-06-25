<?php

    include_once '../model/Acceso/AccesoModel.php';

    class AccesoController{
        public function login(){

            $obj = new AccesoModel();

            $usuario = $_POST['usu_correo'];
            $password = $_POST['usu_clave'];

            echo $usuario;
            echo $password;
        }
        public function logout(){
            
        }
    }


?>