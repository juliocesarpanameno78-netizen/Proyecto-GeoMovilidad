<?php

    include_once '../model/solicitudSeñales/SeñalModel.php';

    class SeñalController {

        public function getCreate(){
            $obj = new SeñalModel();
            $sql = "SELECT * FROM solictudes_nueva_senal";
            $solicitudes = $obj->select($sql);
            include_once '../view/SolicitudSeñales/create.php';
        }

    }

?>