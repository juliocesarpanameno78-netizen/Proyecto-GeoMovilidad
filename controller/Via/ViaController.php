<?php

    include_once '../model/Via/ViaModel.php';

    class ViaController{
        public function getCreate(){
            $obj = new ViaModel();
            $sql = "SELECT * FROM tipos_de_vias";
            $tipvias = $obj->select($sql);
            include_once '../view/Via/create.php';
        }

        public function postCreate(){
            $obj = new ViaModel();
            
        }
    
    }
?>